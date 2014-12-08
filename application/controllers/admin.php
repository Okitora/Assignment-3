<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/admin.php
 *
 * ------------------------------------------------------------------------
 */
class Admin extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'admin';    // this is the view we want shown
        
        //if they are not logged in, they cannot view the page
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
            redirect('/authenticate/noLogin');
        }
        
        //if they are not admin, access denied. Cannot view page
        elseif($this->session->userdata('userRole') != ADMIN)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
            redirect('/authenticate/noAccess');
        }
        elseif($this->session->userdata('userRole') == ADMIN)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
       
        // build the list of places, to pass on to our view
        $source = $this->attractions->all();    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
        foreach ($source as $record) {
           
           //gets the details part in attraction, returns array
            $detail = $this->attractions->convertToObject($record->attr_id); 
            
            $places[] = array(
                'id'          => $record->attr_id,
                'name'        => $record->attr_name, 
                'main'        => $record->main_id,
                'target'      => $record->tar_aud,
                'price_range' => $record->price_range,
                'pic1'        => $detail['gallery']['pic1'],
                'pic2'        => $detail['gallery']['pic2'],
                'pic3'        => $detail['gallery']['pic3'],
           
                'firstName' => $detail['specific']['first']['id'],
                'firstVal' => $detail['specific']['first']['value'],
                'secondName' => $detail['specific']['second']['id'],
                'secondVal' => $detail['specific']['second']['value'],
            );
            
        }
        
        //send places array to our data
        $this->data['places'] = $places;

        $this->render();
    }
    
    function editlist()
    {
        $this->data['pagebody'] = 'editlist';   
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all attractions
        $source = $this->attractions->all();
        $items = '';
        $specifics = array();
        
        //place every attraction into places array.
        foreach ($source as $record) {
            
            //gets the details part in attraction, returns array
            $detail = $this->attractions->convertToObject($record->attr_id);
           
            //array to display to view
            $places[] = array(
                'id'          => $record->attr_id,
                'name'        => $record->attr_name,
                'main'        => $record->main_id,
                'target'      => $record->tar_aud,
                'price_range' => $record->price_range,
                'pic1'        => $detail['gallery']['pic1'],
                'pic2'        => $detail['gallery']['pic2'],
                'pic3'        => $detail['gallery']['pic3'],
            
                'firstName' => $detail['specific']['first']['id'],
                'firstVal' => $detail['specific']['first']['value'],
                'secondName' => $detail['specific']['second']['id'],
                'secondVal' => $detail['specific']['second']['value'],
            );
       
        }
        
        //send places array to our data
        $this->data['places'] = $places;
        
        $this->render();
    }
    
    
    function edit3($which) {
        
        $this->data['pagebody'] = 'edit3';  //this is the view that we want
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }

        // use “item” as the session key
        // assume no item record in-progress
        $item_record = null;
        // do we have an item in the session already {
        $session_record = $this->session->userdata('item');
        if ($session_record !== FALSE) {
            // does its item # match the requested one {
            if (isset($session_record['name']) && ($session_record['name'] == $which)) {
                // use the item record from the session
                $item_record = $session_record;
            }   
        }

        // if no item-in progress record {
        if ($item_record == null) {
            
            // get the item record from the items model
            $item_record = (array) $this->attractions->get($which);
            
            // save it as the “item” session object
            $this->session->set_userdata('item', $item_record);
        }

        // merge the view parms with the current item record
        //$this->data = array_merge($this->data, $item_record);
        
        //gets the details part in attraction, returns array
        $detail = $this->attractions->convertToObject($item_record['attr_id']);
        
        // we need to construct pretty editing fields using the formfields helper
        $this->data['fid'] = makeTextField('Attraction ID', 'attr_id', $item_record['attr_id'], "item identifier ... cannot be changed", 10, 25, true);
        $this->data['fname'] = makeTextField('Name', 'attr_name', $item_record['attr_name'], "Name your customers are comfortable with");
        $this->data['fdescription'] = makeTextArea('Description', 'description', $detail['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.', 1000);
        
        $options = array('Family-Fun' => 'Family Fun', 'Eco-Tourism' => 'Eco Tourism', 'Shopping' => 'Shopping', 'Entertainment' => 'Entertainment', 'Sight-Seeing' => 'Sight Seeing');
        $this->data['fmain'] = makeComboField('Main category', 'main_id', $item_record['main_id'], $options, "Main category. Used to group similar things by column for ordering");
        
        $options2 = array('adult' =>'Adult', 'teenager' => 'Teenager', 'kids' => 'Kids');
        $this->data['ftarget'] = makeComboField('Target Audience', 'tar_aud', $item_record['tar_aud'], $options2, "Target Audience. Used to group similar things by column for ordering");
        $this->data['fcontact'] = makeTextField('Contact', 'contact', $detail['contact'], 'This is the contact info for the attraction');
        $this->data['fdate'] = makeTextField('Date', 'date', $detail['date'], 'Time stamp of when the attraction was added');
        
        $options3 = array('Cheap' => 'Cheap', 'Moderate' => 'Moderate', 'Expensive' => 'Expensive');
        $this->data['fprice_range'] = makeComboField('Price Range', 'price_range', $item_record['price_range'], $options3, "Price range for the attraction");
        $this->data['fprice'] = makeTextField('Price', 'price', $detail['price'], "This is the price for the attraction");
        
        $options4 = array('fee' => 'Fee', 'food' => 'Food', 'cafe' => 'Cafe', 'guide' => 'Guide', 'partysize' => 'Party Size');
        $this->data['ffirstName'] = makeComboField('Specific Detail', 'firstName', $detail['specific']['first']['id'], $options4, "");
        $this->data['ffirst'] = makeTextField('', 'first', $detail['specific']['first']['value'], "Specific Details for the attraction");
        
        $options5 = array('admittance' => 'Admittance', 'wifi' => 'Wifi', 'venue' => 'Venue', 'shop' => 'Shop', 'gear' => 'Gear');
        $this->data['fsecondName'] = makeComboField('Specific Detail', 'secondName', $detail['specific']['second']['id'], $options5, "");
        $this->data['fsecond'] = makeTextField('', 'second', $detail['specific']['second']['value'], "More Specific Details for the attraction");
        $this->data['fpic1'] = showImage('Attraction picture shown at ordering time', $detail['gallery']['pic1']);
        $this->data['fpic2'] = showImage('Attraction picture shown at ordering time', $detail['gallery']['pic2']);
        $this->data['fpic3'] = showImage('Attraction picture shown at ordering time', $detail['gallery']['pic3']);
        $this->data['fsubmit'] = makeSubmitButton('Post Changes', 'Do you feel lucky?');
        
        $this->render();
    }
    
    // handle a proposed menu item form submission
    function post3($which) {
        $fields = $this->input->post(); // gives us an associative array
        
        // test the incoming fields
        if (strlen($fields['attr_name']) < 1)
        {
            $fields['attr_name'] = '';
            $this->errors[] = 'An attraction has to have a name!';
        }
        
        //has have a description....or else!
        if (strlen($fields['description']) < 1) 
        {
            $fields['description'] = '';
            $this->errors[] = 'An attraction has to have a description!';
        }

        //has to have a main category
        $cat = $fields['main_id'];
        if (($cat != 'Entertainment') && ($cat != 'Family-Fun') && ($cat != 'Sight-Seeing') && ($cat != 'Eco-Tourism') && ($cat != 'Shopping')) 
        {
            $this->errors[] = 'Your category has to be one of Entertainment, Family-Fun, Eco-Tourism, Shopping, Sight-Seeing :(';
        }
        
        //has to have a sub category
        $cat = $fields['tar_aud'];
        if(($cat != 'adult') && ($cat != 'teenager') && ($cat != 'kids'))
        {
            $this->errors[] = 'Your Target Audience has to be Kids, Teenagers or Adults :(';
        }
        
        //needs to have a contact
        if (strlen($fields['contact']) < 1) 
        {
            $fields['contact'] = '';
            $this->errors[] = 'An attraction has to have a contact!';
        }
        
        //needs to have a date
        if (strlen($fields['date']) < 1) 
        {
            $fields['date'] = '';
            $this->errors[] = 'An attraction has to have a date!';
        }
        
        //needs to have a price
        $cat = $fields['price_range'];
        if (($cat != 'Cheap') && ($cat != 'Moderate') && ($cat != 'Expensive'))
        {
            $this->errors[] = 'Your price range has to be cheap, moderate or expensive...';
        }
        
        if(strlen($fields['price']) < 1)
        {
            $fields['price'] = '';
            $this->errors[] = 'An attraction has to have a price! If it\'s free just put 0';
        }
        
        if(strlen($fields['first']) < 1)
        {
            $fields['first'] = '';
            $this->errors[] = 'An attraction has to have this field filled';
        }
        if(strlen($fields['second']) < 1)
        {
            $fields['second'] = '';
            $this->errors[] = 'An attraction has to have this field filled';
        }
        

        // get the session item record
        $record = $this->session->userdata('item');
        
        // merge the session record into the model item record, over-riding any edited fields
        $record = array_merge($record, $fields);
        
        // update the session
        $this->session->set_userdata('item', $record);
        
        // update if ok
        //if (count($this->errors) < 1) 
        //{
            // store the merged record into the model
            
            $this->attractions->convertToDBRecord($record);
            
            // remove the item record from the session container
            $this->session->unset_userdata('item');
            redirect('/admin/editlist');
        //} 
        //else 
        //{
        //    $this->edit3($which);
        //}
    }
    
    
    // handle a proposed attraction form submission
    //ends up either going back to the form or adding the attraction
    function post4() {
        $fields = $this->input->post(); // gives us an associative array
        
        // test the incoming fields
        if (strlen($fields['attr_id']) < 1)
        {
            $this->errors[] = 'An attraction has to have an id!';
        }
        if (strlen($fields['attr_name']) < 1)
        {
            $this->errors[] = 'An attraction has to have a name!';
        }
        if (strlen($fields['description']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a description!';
        }

        $cat = $fields['main_id'];
        if (($cat != 'Entertainment') && ($cat != 'Family-Fun') && ($cat != 'Sight-Seeing') && ($cat != 'Eco-Tourism') && ($cat != 'Shopping')) 
        {
            $this->errors[] = 'Your category has to be one of Entertainment, Family-Fun, Eco-Tourism, Shopping, Sight-Seeing :(';
        }
        
        $cat = $fields['tar_aud'];
         
        if(($cat != 'adult') && ($cat != 'teenager') && ($cat != 'kids'))
        {
            $this->errors[] = 'Your Target Audience has to be either Kids, Teenager, Adults :(';
        }
        
        if (strlen($fields['contact']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a contact!';
        }
        
        if (strlen($fields['date']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a date!';
        }
        //needs to have a price
        $cat = $fields['price_range'];
        if (($cat != 'Cheap') && ($cat != 'Moderate') && ($cat != 'Expensive'))
        {
            $this->errors[] = 'Your price range has to be cheap, moderate or expensive...';
        }
        if(strlen($fields['price']) < 1)
        {
            $this->errors[] = 'An attraction has to have a price!';
        
        }
        
        //first specific detail
        $cat4 = $fields['firstName'];
         //echo $fields['firstName'];
        if(($cat4 != 'fee') && ($cat4 != 'food') &&($cat4 != 'cafe') && ($cat4 != 'guide') && ($cat4 != 'partysize'))
        {
            $this->errors[] = 'Your Specific Detail has to be either Fees, Food, Cafe, Guide or Party Size :(';
        }
        if(strlen($fields['first']) < 1)
        {
            $this->errors[] = 'Your Specific Detail has to have a value!';
        }
        
        //second specific detail
        $cat5 = $fields['secondName'];
        //echo $fields['secondName'];
        if(($cat5 != 'admittance') && ($cat5 != 'wifi') && ($cat5 != 'gear') && ($cat5 != 'venue') && ($cat5 != 'shop'))
        {
            $this->errors[] = 'Your Specific Detail has to be either admittance, wifi, gear, venue or shop :(';
        }
        if(strlen($fields['second']) < 1)
        {
            $this->errors[] = 'Your Specific Detail has to have a value!';
        }
        
        //redo/fix later
        // handle any file(s) uploaded
        /*
        $uploaded = array();
        if (count($_FILES) > 0) {
            foreach ($_FILES as $field => $record) {
                if ($record['error'] == 0) {
                    $uploaded[$field] = $this->handle_image_upload($record);
                }
            }
        }
        */

        // get the session item record
        $record = array();
        $record = $this->session->userdata('item');
        
        // merge the session record into the model item record, over-riding any edited fields
        //$record = array_merge($record, $fields);
        
        // update the session
        $this->session->set_userdata('item', $record);
        
        //gets the details part in attraction, returns array
        //$detail = $this->attractions->convertToObject($fields['attr_id']);
        
        // update if ok
        if (count($this->errors) < 1) 
        {
            // store the merged record into the model
            /* uncomment next line when there is db in localhost/phpmyadmin
            right now no update takes place */
            //create attraction
            $dbrecord = $this->attractions->create();
            //echo $record['attr_id'];
            
            $record['attr_id'] = $fields['attr_id'];
            $record['attr_name'] = $fields['attr_name'];
            $record['main_id'] = $fields['main_id'];
            $record['tar_aud'] = $fields['tar_aud'];
            $record['price_range'] = $fields['price_range'];
            $record['description'] = $fields['description'];
            $record['contact'] = $fields['contact'];
            $record['date'] = $fields['date'];
            $record['price'] = $fields['price'];
            $record['firstName'] = (string)$fields['firstName'];
            $record['first'] = $fields['first'];
            $record['secondName'] = (string)$fields['secondName'];
            $record['second'] = $fields['second'];
            
            $record['pic1'] = 'Larnach-Castle-02_opt.jpg';
            $record['pic2'] = 'Larnach-Castle-02_opt.jpg';
            $record['pic3'] = 'Larnach-Castle-02_opt.jpg';
            $dbrecord = $record;
            
            $this->attractions->convertToDBRecordAdd($record);
            
            // remove the item record from the session container
            $this->session->unset_userdata('item');
            redirect('/admin/editlist');
        } 
        else 
        {
            $this->add();
        }
    }
    
    /**function to ask user if they are sure if they want to delete the 
     * attraction specified,
     * 
     */
    function choice($id)
    {
        $this->data['pagebody'] = 'areYouSure';
        $this->data['title'] = 'Are You Sure?';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        $this->data['id'] = $id;
        
        $this->render();
        
    }
    
    /**
     * creates form to add an attraction to the db.
     */
    function add()
    {
         $this->data['pagebody'] = 'add';
         $this->data['title'] = 'Add an Attraction';
         

         //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
         
         // use “item” as the session key
        // assume no item record in-progress
        $item_record = null;
        // do we have an item in the session already {
        $session_record = $this->session->userdata('item');
        if ($session_record !== FALSE) {
            // does its item # match the requested one {
            if (isset($session_record['name'])) {
                // use the item record from the session
                $item_record = $session_record;
            }   
        }

        //gets the details part in attraction, returns array
        //$detail = $this->attractions->convertToObject($item_record['attr_id']);

        // merge the view parms with the current item record
        //$this->data = array_merge($this->data, $item_record);
        
        // we need to construct pretty editing fields using the formfields helper
        //$item_record['attr_id'] = $this->attractions->many() + 1;
        
        $this->data['fid'] = makeTextField('Attraction ID', 'attr_id', $this->attractions->many() + 1, "Item has to have an id");
        $this->data['fname'] = makeTextField('Name', 'attr_name', $item_record['attr_name'], "Name your customers are comfortable with");
        $this->data['fdescription'] = makeTextArea('Description', 'description', $item_record['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.', 1000);
        
        $options = array('Family-Fun' => 'Family Fun', 'Eco-Tourism' => 'Eco Tourism', 'Shopping' => 'Shopping', 'Entertainment' => 'Entertainment', 'Sight-Seeing' => 'Sight Seeing');
        $this->data['fmain'] = makeComboField('Main category', 'main_id', $item_record['main_id'], $options, "Main category. Used to group similar things by column for ordering");
        
        $options2 = array('adult' => 'Adult', 'teenager' => 'Teenager', 'kids' => 'Kids');
        $this->data['ftarget'] = makeComboField('Target Audience', 'tar_aud', $item_record['tar_aud'], $options2, "Target Audience. Used to group similar things by column for ordering");
        $this->data['fcontact'] = makeTextField('Contact', 'contact', $item_record['contact'], 'This is the contact info for the attraction');
        $this->data['fdate'] = makeTextField('Date', 'date', $item_record['date'], 'Time stamp of when the attraction was added');
        
        $options3 = array('Cheap' => 'Cheap', 'Moderate' => 'Moderate', 'Expensive' => 'Expensive');
        $this->data['fprice_range'] = makeComboField('Price Range', 'price_range', $item_record['price_range'], $options3, "Price range for the attraction");
        $this->data['fprice'] = makeTextField('Price', 'price', $item_record['price'], "This is the price for the attraction");
        
        $options4 = array('fee' => 'Fee', 'food' => 'Food', 'cafe' => 'Cafe', 'guide' => 'Guide', 'partysize' => 'Party Size');
        $this->data['ffirstName'] = makeComboField('Specific Detail', 'firstName', $item_record['firstName'], $options4, "");
        $this->data['ffirstValue'] = makeTextField('', 'first', $item_record['firstVal'], "Specific Details for the attraction");
        
        $options5 = array('admittance' => 'Admittance', 'wifi' => 'Wifi', 'venue' => 'Venue', 'shop' => 'Shop', 'gear' => 'Gear');
        $this->data['fsecondName'] = makeComboField('Specific Detail', 'secondName', $item_record['secondName'], $options5, "");
        $this->data['fsecondValue'] = makeTextField('', 'second', $item_record['secondVal'], "More Specific Details for the attraction");
        $this->data['fpic1'] = showImage('Attraction picture shown at ordering time', $item_record['pic1']);
        $this->data['fpic2'] = showImage('Attraction picture shown at ordering time', $item_record['pic2']);
        $this->data['fpic3'] = showImage('Attraction picture shown at ordering time', $item_record['pic3']);
        //$this->data['fpicture'] = makeImageUploader('Picture', $item_record['image_name'], 'Attraction picture uploaded');
        $this->data['fsubmit'] = makeSubmitButton('Post Changes', 'Do you feel lucky?');
                
         $this->render();
    }
    
    /**
     * Deletes the attraction that was specified
     * @param type $id
     */
    function delete($id)
    {
        //gets the record
        $record = $this->attractions->get($id);
        
        //delete record
        $this->attractions->delete($id);
        
        
        redirect('admin/editlist');
    }
    
//redo
    function handle_image_upload($record) 
    {
        $name = $record['name'];
        $temp_name = $record['tmp_name'];
        $size = $record['size'];
        $member = $_SESSION['member'];
        
        $target = $this->config->item('data_folder') . '/data/' . $member->memberID . '/' . $name;
        $target = str_replace(' ', '_', $target);
        
        move_uploaded_file($temp_name, $target);
        
        return $name;
    }

}

/* End of file admin.php */
/* Location: application/controllers/admin.php */
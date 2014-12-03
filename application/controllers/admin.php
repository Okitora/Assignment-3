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
            redirect('/authenticate/noLogin');
        }
        
        //if they are not admin, access denied. Cannot view page
        if($this->session->userdata('userRole') != ADMIN)
        {
            redirect('/authenticate/noAccess');
        }
       
        // build the list of places, to pass on to our view
        $source = $this->attractions->all();    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
        foreach ($source as $record) {
           //
            $places[] = array(
                'id'          => $record->attr_id,
                'name'        => $record->attr_name, 
                'pic'         => $record->image_name, 
                'description' => $record->description,
                'main'        => $record->main_id,
                'sub'         => $record->sub_id,
                'contact'     => $record->contact, 
                'date'        => $record->date,
                'price'       => $record->price,
            );
        
            
        }
        
        //send places array to our data
        $this->data['places'] = $places;

        $this->render();
    }
    
    function editlist()
    {
        $this->data['pagebody'] = 'editlist';   
        
        //get all attractions
        $source = $this->attractions->all();
        $items = '';
        
        //place every attraction into places array.
        foreach ($source as $record) {
           //array to display to view
            $places[] = array(
                'id'          => $record->attr_id,
                'name'        => $record->attr_name, 
                'pic'         => $record->image_name, 
                'description' => $record->description,
                'main'        => $record->main_id,
                'sub'         => $record->sub_id,
                'contact'     => $record->contact,
                'date'        => $record->date,
                'price'       => $record->price,
            );
        
            
        }
        
        //send places array to our data
        $this->data['places'] = $places;
        
        $this->render();
    }
    
    
    function edit3($which) {
        
        $this->data['pagebody'] = 'edit3';  //this is the view that we want

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
        
        // we need to construct pretty editing fields using the formfields helper
        $this->load->helper('formfields');
        $this->data['fid'] = makeTextField('Attraction ID', 'attr_id', $item_record['attr_id'], "item identifier ... cannot be changed", 10, 25, true);
        $this->data['fname'] = makeTextField('Name', 'attr_name', $item_record['attr_name'], "Name your customers are comfortable with");
        $this->data['fdescription'] = makeTextArea('Description', 'description', $item_record['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.', 1000);
        
        $options = array('f' => 'Family Fun', 't' => 'Eco Tourism', 's' => 'Shopping', 'e' => 'Entertainment', 'w' => 'SightSeeing');
        $this->data['fmain'] = makeComboField('Main category', 'main_id', $item_record['main_id'], $options, "Main category. Used to group similar things by column for ordering");
        
        $options2 = array('ra' => 'Racing', 'nc' => 'Night Club', 'st' => 'Stadium', 
            'mo' => 'Movie', 'ng' => 'Nature Garden', 'tp' => 'Theme Park', 'sm' => 'Shopping Mall',
            'df' => 'Duty Free', 'ts' => 'Tourist Shops', 'vo' => 'volcanos', 'bw' => 'bird watching',
            'yc' => 'Yacht Cruising', 'tr' => 'Trails', 'wt' => 'Walking Tracks', 'cw' => 'Coast Walks');
        //$options2 = array('adult' = >'Adult', 'teenager' => 'Teenager', 'kids' => 'Kids');
        $this->data['fsub'] = makeComboField('Sub category', 'sub_id', $item_record['sub_id'], $options2, "Sub category. Used to group similar things by column for ordering");
        $this->data['fcontact'] = makeTextField('Contact', 'contact', $item_record['contact'], 'This is the contact info for the attraction');
        $this->data['fdate'] = makeTextArea('Date', 'date', $item_record['date'], 'Time stamp of when the attraction was added');
        
        $options3 = array('c' => 'Cheap', 'm' => 'Moderate', 'e' => 'Expensive');
        $this->data['fprice'] = makeComboField('Price', 'price', $item_record['price'], $options3, "Price range for the attraction");
        $this->data['fpicture'] = showImage('Attraction picture shown at ordering time', $item_record['image_name']);
        $this->data['fsubmit'] = makeSubmitButton('Post Changes', 'Do you feel lucky?');
        
        $this->render();
    }
    
    // handle a proposed menu item form submission
    function post3($which) {
        $fields = $this->input->post(); // gives us an associative array
        
        // test the incoming fields
        if (strlen($fields['attr_name']) < 1)
        {
            $this->errors[] = 'An attraction has to have a name!';
        }
        
        //has have a description....or else!
        if (strlen($fields['description']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a description!';
        }

        //has to have a main category
        $cat = $fields['main_id'];
        if (($cat != 'e') && ($cat != 'f') && ($cat != 'w') && ($cat != 't') && ($cat != 's')) 
        {
            $this->errors[] = 'Your category has to be one of entertainment, family-fun, eco-tourism, shopping, sightseeing :(';
        }
        
        //has to have a sub category
        $cat = $fields['sub_id'];
        
        if (($cat != 'ra') && ($cat != 'nc') && ($cat != 'st') && ($cat != 'mo') && ($cat != 'ng')
            && ($cat != 'tp') && ($cat != 'sm') && ($cat != 'df') && ($cat != 'ts') && ($cat != 'vo')
            && ($cat != 'bw') && ($cat != 'yc') && ($cat != 'tr') && ($cat != 'wt') && ($cat != 'cw')) 
        //if(($cat != 'adult) && ($cat != 'teenager') && ($cat != 'kids'))
        {
            $this->errors[] = 'Your sub-category has to be one of Racing, Night Club, 
                Stadium, Movies, Nature Garden, Theme Park, Shopping Malls, Duty Free, 
                Tourist Shops, Volcanos, Bird Watching, Yacht Cruising, Trails, Walking Tracks, Coast Walks :(';
        }
        
        //needs to have a contact
        if (strlen($fields['contact']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a contact!';
        }
        
        //needs to have a date
        if (strlen($fields['date']) < 1) 
        {
            $this->errors[] = 'An attraction has to have a date!';
        }
        
        //needs to have a price
        $cat = $fields['price'];
        if (($cat != 'c') && ($cat != 'm') && ($cat != 'e'))
        {
            $this->errors[] = 'Your price range has to be cheap, moderate or expensive...';
        }
        

        // get the session item record
        $record = $this->session->userdata('item');
        
        // merge the session record into the model item record, over-riding any edited fields
        $record = array_merge($record, $fields);
        
        // update the session
        $this->session->set_userdata('item', $record);
        
        // update if ok
        if (count($this->errors) < 1) 
        {
            // store the merged record into the model
            /* uncomment next line when there is db in localhost/phpmyadmin
            right now no update takes place */
            
            $this->attractions->update($record);
            
            // remove the item record from the session container
            $this->session->unset_userdata('item');
            redirect('/admin/editlist');
        } 
        else 
        {
            $this->edit3($which);
        }
    }
    
    
    // handle a proposed attraction form submission
    //ends up either going back to the form or adding the attraction
    function post4() {
        $fields = $this->input->post(); // gives us an associative array
        
        // test the incoming fields
        if(strlen($fields['attr_id']) < 1)
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
        if (($cat != 'e') && ($cat != 'f') && ($cat != 'w') && ($cat != 't') && ($cat != 's')) 
        {
            $this->errors[] = 'Your category has to be one of entertainment, family-fun, eco-tourism, shopping, sightseeing :(';
        }
        
        $cat = $fields['sub_id'];
        if (($cat != 'ra') && ($cat != 'nc') && ($cat != 'st') && ($cat != 'mo') && ($cat != 'ng')
            && ($cat != 'tp') && ($cat != 'sm') && ($cat != 'df') && ($cat != 'ts') && ($cat != 'vo')
            && ($cat != 'bw') && ($cat != 'yc') && ($cat != 'tr') && ($cat != 'wt') && ($cat != 'cw')) 
        //if(($cat != 'adult) && ($cat != 'teenager') && ($cat != 'kids'))
        {
            $this->errors[] = 'Your sub-category has to be one of Racing, Night Club, 
                Stadium, Movies, Nature Garden, Theme Park, Shopping Malls, Duty Free, 
                Tourist Shops, Volcanos, Bird Watching, Yacht Cruising, Trails, Walking Tracks, Coast Walks :(';
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
        $cat = $fields['price'];
        if (($cat != 'c') && ($cat != 'm') && ($cat != 'e'))
        {
            $this->errors[] = 'Your price range has to be cheap, moderate or expensive...';
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
        $record = $this->session->userdata('item');
        
        // merge the session record into the model item record, over-riding any edited fields
        $record = array_merge($record, $fields);
        
        // update the session
        $this->session->set_userdata('item', $record);
        
        // update if ok
        if (count($this->errors) < 1) 
        {
            // store the merged record into the model
            /* uncomment next line when there is db in localhost/phpmyadmin
            right now no update takes place */
            //create attraction
            $record = $this->attractions->create();
            
            $record->attr_id = $fields['attr_id'];
            $record->attr_name = $fields['attr_name'];
            $record->description = $fields['description'];
            $record->main_id = $fields['main_id'];
            $record->sub_id = $fields['sub_id'];
            $record->contact = $fields['contact'];
            $record->date = $fields['date'];
            $record->price = $fields['price'];
            $record->image_name = 'Larnach-Castle-02_opt.jpg';
            
            $this->attractions->add($record);
            
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


        // merge the view parms with the current item record
        //$this->data = array_merge($this->data, $item_record);
        
        // we need to construct pretty editing fields using the formfields helper
        $this->load->helper('formfields');
        //$item_record['attr_id'] = $this->attractions->many() + 1;
        $this->data['fid'] = makeTextField('Attraction ID', 'attr_id', $this->attractions->many() + 1, "Item has to have an id", 10, 25, true);
        $this->data['fname'] = makeTextField('Name', 'attr_name', $item_record['attr_name'], "Name your customers are comfortable with");
        $this->data['fdescription'] = makeTextArea('Description', 'description', $item_record['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.', 1000);
        
        $options = array('f' => 'Family Fun', 't' => 'Eco Tourism', 's' => 'Shopping', 'e' => 'Entertainment', 'w' => 'SightSeeing');
        $this->data['fmain'] = makeComboField('Main category', 'main_id', $item_record['main_id'], $options, "Main category. Used to group similar things by column for ordering");
        
        $options2 = array('ra' => 'Racing', 'nc' => 'Night Club', 'st' => 'Stadium', 
            'mo' => 'Movie', 'ng' => 'Nature Garden', 'tp' => 'Theme Park', 'sm' => 'Shopping Mall',
            'df' => 'Duty Free', 'ts' => 'Tourist Shops', 'vo' => 'volcanos', 'bw' => 'bird watching',
            'yc' => 'Yacht Cruising', 'tr' => 'Trails', 'wt' => 'Walking Tracks', 'cw' => 'Coast Walks');
        //$options2 = array('adult' = >'Adult', 'teenager' => 'Teenager', 'kids' => 'Kids');
        $this->data['fsub'] = makeComboField('Sub category', 'sub_id', $item_record['sub_id'], $options2, "Sub category. Used to group similar things by column for ordering");
        $this->data['fcontact'] = makeTextField('Contact', 'contact', $item_record['contact'], 'This is the contact info for the attraction');
        $this->data['fdate'] = makeTextArea('Date', 'date', $item_record['date'], 'Time stamp of when the attraction was added');
        
        $options3 = array('c' => 'Cheap', 'm' => 'Moderate', 'e' => 'Expensive');
        $this->data['fprice'] = makeComboField('Price', 'price', $item_record['price'], $options3, "Price range for the attraction");
        $this->data['fpicture'] = showImage('Default Attraction picture will be shown, want a different picture? TBA', $item_record['image_name']);
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
        
        $target = $this->config->item('data_folder') . '/members/' . $member->memberID . '/' . $name;
        $target = str_replace(' ', '_', $target);
        
        move_uploaded_file($temp_name, $target);
        
        return $name;
    }

}

/* End of file admin.php */
/* Location: application/controllers/admin.php */
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
                'main'    => $record->main_id,
                'sub'         => $record->sub_id,
                'contact'     => $record->contact, 
                'date'        => $record->date,
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
        $this->data['fdescription'] = makeTextArea('Description', 'description', $item_record['description'], 'This is a long-winded and humorous caption that pops up if the visitor hovers over a menu item picture too long.');
        
        $options = array('f' => 'Family Fun', 't' => 'Eco Tourism', 's' => 'Shopping', 'e' => 'Entertainment', 'w' => 'SightSeeing');
        $this->data['fmain'] = makeComboField('Main category', 'main_id', $item_record['main_id'], $options, "Main category. Used to group similar things by column for ordering");
        
        $options2 = array('ra' => 'Racing', 'nc' => 'Night Club', 'st' => 'Stadium', 
            'mo' => 'Movie', 'ng' => 'Nature Garden', 'tp' => 'Theme Park', 'sm' => 'Shopping Mall',
            'df' => 'Duty Free', 'ts' => 'Tourist Shops', 'vo' => 'volcanos', 'bw' => 'bird watching',
            'yc' => 'Yacht Cruising', 'tr' => 'Trails', 'wt' => 'Walking Tracks', 'cw' => 'Coast Walks');
        $this->data['fsub'] = makeComboField('Sub category', 'sub_id', $item_record['sub_id'], $options2, "Sub category. Used to group similar things by column for ordering");
        $this->data['fcontact'] = makeTextField('Contact', 'contact', $item_record['contact'], 'This is the contact info for the attraction');
        $this->data['fdate'] = makeTextArea('Date', 'date', $item_record['date'], 'Time stamp of when the attraction was added');
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
            $this->errors[] = 'An item has to have a name!';
        }
        if (strlen($fields['description']) < 1) 
        {
            $this->errors[] = 'An item has to have a description!';
        }

        $cat = $fields['main_id'];
        if (($cat != 'e') && ($cat != 'f') && ($cat != 'w') && ($cat != 't') && ($cat != 's')) 
        {
            $this->errors[] = 'Your category has to be one of m, d or c :(';
        }
        
        if (strlen($fields['contact']) < 1) 
        {
            $this->errors[] = 'An item has to have a contact!';
        }
        
        if (strlen($fields['date']) < 1) 
        {
            $this->errors[] = 'An item has to have a date!';
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



}

/* End of file admin.php */
/* Location: application/controllers/admin.php */
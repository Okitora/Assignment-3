<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/caves.php
 *
 * ------------------------------------------------------------------------
 */
class Caves extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'waitomo';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->get('Waitomo \'Glowworm\' Caves');
        $this->data = array_merge($this->data,$source); //merges quote with this data
        $places = array();
        
        //data we want show is the name, pictures, description and which page we want shown
            $places[] = array('name' => $source['name'], 
                'pic' => $source['pic'], 
                'pic2' => $source['pic2'],
                'pic3' => $source['pic3'],
                'description' => $source['description'],
                'href' => $source['where']);
       
        //place places array into data
        $this->data['places'] = $places;

        $this->render();
    }

}

/* End of file caves.php */
/* Location: application/controllers/caves.php */
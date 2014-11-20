<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/main.php
 *
 * ------------------------------------------------------------------------
 */
class Main extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'newest';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->newest();
        
        
        //send the attributes to our newest view
        $this->data['name'] = $source->attr_name;
        $this->data['pic'] = $source->image_name;
        $this->data['description'] = $source->description;

        $this->render();
    }

}

/* End of file main.php */
/* Location: application/controllers/main.php */
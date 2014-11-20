<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/rotoura.php
 *
 * ------------------------------------------------------------------------
 */
class Rotoura extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['pagebody'] = 'springs';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->get('Rotoura');
        $this->data = array_merge($this->data,$source); //merges quote with this data
        $places = array();
        
        //put the attraction we want into the attay
            $places[] = array('name' => $source['name'], 'pic' => $source['pic'], 'description' => $source['description'],'href' => $source['where']);
        
        //put the place array into our data
        $this->data['places'] = $places;

        $this->render();
    }

}

/* End of file rotoura.php */
/* Location: application/controllers/rotoura.php */
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
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->newest();
        $detail = $this->attractions->convertToObject($source->attr_id);
        
        //send the attributes to our newest view
        $this->data['name'] = $source->attr_name;
        $this->data['pic'] = $detail['gallery']['pic1'];
        $this->data['description'] = $detail['description'];

        $this->render();
    }

}

/* End of file main.php */
/* Location: application/controllers/main.php */
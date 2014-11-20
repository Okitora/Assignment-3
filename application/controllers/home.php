<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/home.php
 *
 * ------------------------------------------------------------------------
 */
class Home extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
        $this->data['pagebody'] = 'list';
        
        //get all the main categories
        $source = $this->categories->all();
        
        $catlist = array();
        
        //retrieve all the variables for the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->main_id,
                'name' => $cat->main_name,
                'pic'  => $cat->image_name,
                'href' => '/home/sublist',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        
        $this->render();
        
    }
    function sublist($code)
    {
        $this->data['pagebody'] = 'sublist';
        
        //get all sub categories within the main category
        $source = $this->sub->some('main_id' , $code);
        $name = $this->categories->get($code);
        
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->sub_id,
                'name' => $cat->sub_name,
                'pic'  => $cat->image_name,
                'href' => '/home/destination',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        $this->data['main'] = $name->main_name;
        
        
        $this->render();
    }
    function destination($id) {
        $this->data['pagebody'] = 'homepage';    // this is the view we want shown
        
        // build the list of places, to pass on to our view
        $source = $this->attractions->some('sub_id', $id);    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
        foreach($source as $record)
        {
            $this1 = array(
                'name' => $record->attr_name, 
                'description' => $record->description,
                'pic'   => $record->image_name
            );
            $places[] = $this1;
        }
        
        //send places array to our data
        $this->data['places'] = $places;

        $this->render();
    }

}

/* End of file home.php */
/* Location: application/controllers/home.php */
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
    //--------------------------------------------------------------
    
    
    function index()
    {
        $this->data['pagebody'] = 'list';
        $this->data['title'] = 'Select by:';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        $choice = '';
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
         //get all the main categories
        $source = $this->categories->all();
        
        $catlist = array();
        
        //retrieve all the variables for the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->main_id,
                'name' => $cat->main_name,
                'href' => '/home/sublistType',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        
        $this->render();
    }
    function choice($choice)
    {
        $fields = $this->input->post();
       
        if($fields['choice'] == 1)
        {
            $this->listByType();
        }
        elseif($fields['choice'] == 2)
        {
           $this->listByTarget();
        }
        elseif($fields['choice'] == 3)
        {
            $this->listByPriceRange();
        }
        else
        {
           $this->errors[] = 'Did not get your answer';
            redirect('/List');
        }   
       
     
    }
    
    /** 
     * List all the main categories
     *
     */
    function listByType()
    {
        $this->data['pagebody'] = 'list';
        $choice = '';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
         //get all the main categories
        $source = $this->categories->all();
        
        $catlist = array();
        
        //retrieve all the variables for the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->main_id,
                'name' => $cat->main_name,
                'href' => '/home/sublistType',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        
        $this->render();
        
    }
    
    /**
     * Showing all categories by target Audience
     */
    function listByTarget()
    {
        $this->data['pagebody'] = 'list';
        $choice = '';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //get all the target categories
        $source = $this->sub->all();
        
        $catlist = array();
        
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->sub_id,
                'name' => $cat->sub_id,
                'href' => '/home/subListTarget',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        
        $this->render();
    }
    
    /**
     * List all categories by the Price Range
     */
    function listByPriceRange()
    {
        $this->data['pagebody'] = 'list';
        $choice = '';
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //bogus data until fix db
        $this1 = array(
            'id'   => 'c',
            'name' => 'Cheap',
            'href' => '/home/sublistPriceRange',
            
        );
        $this2 = array(
            'id'   => 'm',
            'name' => 'Moderate',
            'href' => '/home/sublistPriceRange',
        );
        
        $this3 = array(
            'id'   => 'e',
            'name' => 'Expensive',
            'href' => '/home/sublistPriceRange',
        );
        $catlist[] = $this1;
        $catlist[] = $this2;
        $catlist[] = $this3;
        
        
        $this->data['places'] = $catlist;
        
        $this->render();
    }
    
    /**
     * Showing the Sub list of all attractions within the category type
     * 
     * @param type $code the category code
     */
    function sublistType($code)
    {
        $this->data['pagebody'] = 'sublist';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        //$source = $this->sub->some('main_id' , $code);
        //$name = $this->categories->get($code);
        $source = $this->attractions->some('main_id', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                'pic'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/home/destination',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        $this->data['main'] = $code;
        
        
        $this->render();
    }
    
    
    /**
     * Showing the sublist of all attractions by Target Audience
     * 
     * @param type $code the target audience code
     */
    function sublistTarget($code)
    {
        $this->data['pagebody'] = 'sublist';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        //$source = $this->sub->some('main_id' , $code);
        //$name = $this->categories->get($code);
        $source = $this->attractions->some('sub_id', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                'pic'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/home/destination',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        $this->data['main'] = $code;
        
        
        $this->render();
        
    }
    
    function sublistPriceRange($code)
    {
        $this->data['pagebody'] = 'sublist';
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        //$source = $this->sub->some('main_id' , $code);
        //$name = $this->categories->get($code);
        $source = $this->attractions->some('price', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                'pic'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/home/destination',
            );
            
            $catlist[] = $this1;
        }
        
        $this->data['places'] = $catlist;
        $this->data['main'] = $code;
        
        
        $this->render();
        
    }
    
    /**
     * Displays the specific attraction as specified by id
     * 
     * @param type $id 
     * for specific attraction
     */
    function destination($id) {
        $this->data['pagebody'] = 'homepage';    // this is the view we want shown
        
        //if they are not logged in, have login button show
        if($this->session->userdata('userRole') == 0)
        {
            $this->data['btn'] = '<a href="/authenticate/attempt" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/authenticate/logout" class="btn btn-inverse">Logout</a>';
        }
        
        // build the list of places, to pass on to our view
        $record = $this->attractions->get($id);    //get all the attractions from DB
        $places = array();
        
        //place every attraction into places array.
       
            $this1 = array(
                'name'          => $record->attr_name, 
                'description'   => $record->description,
                'price'         => $record->price,
                'target'        => $record->sub_id,
                'pic'           => $record->image_name
            );
       
            $places[] = $this1;
            
        //$this1 = $this->parser->parse('item', (array)$this->attractions->getDetails($id), true);
        //send places array to our data
        $this->data['places'] = $places;
        //$this->data['test'] = $this1;

        $this->render();
    }

}

/* End of file home.php */
/* Location: application/controllers/home.php */
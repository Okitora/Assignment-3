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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        $choice = '';
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //get all the main categories
        $source = $this->attractions->all();
        
        $catlist = array();
        $templist = array();
        
        //retrieve all categories from attractions
        foreach($source as $cat)
        {
            $templist[] = $cat->main_id;
        }
        
        //remove duplicates
        $templist = array_unique($templist);
        
        //add links to the view
        foreach($templist as $cat)
        {
            $this1 = array(
                'id' => $cat,
                'href' => '/home/sublistType'
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //get all the main categories
        $source = $this->attractions->all();
        
        $catlist = array();
        $templist = array();
        
        //retrieve all categories from attractions
        foreach($source as $cat)
        {
            $templist[] = $cat->main_id;
        }
        
        //remove duplicates
        $templist = array_unique($templist);
        
        //add links to the view
        foreach($templist as $cat)
        {
            $this1 = array(
                'id' => $cat,
                'href' => '/home/sublistType'
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] = makeComboField('Choice', 'choice', $choice, $options, "Pick the type to display attractions by.");
        $this->data['fsubmit'] = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //get all the main categories
        $source = $this->attractions->all();
        
        //temp arrays to filter
        $catlist = array();
        $templist = array();
        
        //retrieve all categories from attractions
        foreach($source as $cat)
        {
            $templist[] = $cat->tar_aud;
            //$templist[] = $cat->sub_aud;
        }
        
        //remove duplicates
        $templist = array_unique($templist);
        
        //add links to the view
        foreach($templist as $cat)
        {
            $this1 = array(
                'id' => $cat,
                'href' => '/home/sublistTarget'
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        // we need to construct pretty editing fields using the formfields helper
        $options = array('1' => 'Type', '2' => 'Target-Audience', '3' => 'Price Range');
        $this->data['fmain'] 
                = makeComboField('Choice', 'choice', $choice, $options, 
                        "Pick the type to display attractions by.");
        $this->data['fsubmit'] 
                = makeSubmitButton('Ok', 'Do you feel lucky?');
        
        //get all the main categories
        $source = $this->attractions->all();
        
        $catlist = array();
        $templist = array();
        
        //retrieve all categories from attractions
        foreach($source as $cat)
        {
            //$templist[] = $cat->price_range;
            $templist[] = $cat->price_range;
        }
        
        //remove duplicates
        $templist = array_unique($templist);
        
        //add links to the view
        foreach($templist as $cat)
        {
            $this1 = array(
                'id' => $cat,
                'href' => '/home/sublistPriceRange'
                );
             
            $catlist[] = $this1;
        }
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        $source = $this->attractions->some('main_id', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                //'pic1'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/DestinationSpot',
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        //$source = $this->attractions->some('tar_aud', $code);
        $source = $this->attractions->some('tar_aud', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                //'pic'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/DestinationSpot',
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        //get all sub categories within the main category
        //$source = $this->attractions->some('price_range', $code);
        $source = $this->attractions->some('price_range', $code);
        $catlist = array();
        
        //retrieve all variables from the view
        foreach($source as $cat)
        {
            $this1 = array(
                'id'   => $cat->attr_id,
                'name' => $cat->attr_name,
                //'pic'  => $cat->image_name,
                'description' => $cat->description,
                'href' => '/DestinationSpot',
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
            $this->data['btn'] = '<a href="/Login" class="btn btn-success">Login</a>';
        }
        //if they are logged in have logout button show
        elseif($this->session->userdata('userRole') > 0)
        {
            $this->data['btn'] = '<a href="/Logout" class="btn btn-inverse">Logout</a>';
        }
        
        // build the list of places, to pass on to our view
        $record = $this->attractions->get($id);    //get all the attractions from DB
        $places = array();
        
        //parse xml
        //gets the details part in attraction, returns array
        $detail = $this->attractions->get_xml($id);
        
        //place every attraction into places array.
       
            $this1 = array(
                'id'            => $record->attr_id,
                'name'          => $record->attr_name, 
                //'description'   => $record->description,
                'main_id'       => $record->main_id,
                //'price_range'   => $record->price,
                'price_range'   => $record->price_range,
                //'target'        => $record->sub_id,
                'target'        => $record->tar_aud,
                //'pic'           => $record->image_name,
                'contact'       => $detail['contact'],
                'date'          => $detail['date'],
                'price'         => $detail['price'],
                'description'   => $detail['description'],
                'pic1'          => $detail['gallery']['pic1'],
                'pic2'          => $detail['gallery']['pic2'],
                'pic3'          => $detail['gallery']['pic3'],
                
            );    
                
                foreach($detail['specific'] as $specific)
                {
                    $this2 = array(
                        'sid' => $specific['id'],
                        'svalue' => $specific['value'], 
                    );
                    
                    //place specific details in specifics array
                    $specifics[] = $this2;
                }
                
            //places major details in places array
            $places[] = $this1;
            
        //send places array to our data
        $this->data['places'] = $places;
        $this->data['specific'] = $specifics;
        //$this->data['test'] = $this1;

        $this->render();
    }

}

/* End of file home.php */
/* Location: application/controllers/home.php */

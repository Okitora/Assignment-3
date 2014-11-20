<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data
 *
 * @author Sharon
 */
class Attractions extends MY_Model {

    // Constructor
    public function __construct() {
        parent::__construct('attraction', 'attr_id');
    }


    // retrieve the first attraction
    public function first() {
        return $this->data['kkc'];
    }

    // retrieve the last attraction
    public function last() {
        $CI = & get_instance();
        
        $index = count($CI->attraction) - 1;
        return $CI->attraction[$index];
    }
    
    //retrieve newest attraction
    
    public function newest()
    {
        $CI = & get_instance();
        
        //variable determining if it has the newest date
        $newest = 0;
        //temporary file to store newest record
        $new = 0;
        
        $source = $CI->attractions->all();
        
        foreach ($source as $record) {
            
            $date = $record->date;
            
            //if it is the newest date make the newest attraction
            if($date > $newest)
            {
                $newest = $date;
                $new = $record;
            }

        }
         
        return $new;
    }
   
}

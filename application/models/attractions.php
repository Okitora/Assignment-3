<?php

/**
 * This is a Attractions model for all attractions, with xml data and db
 * data under bcitx762_d08 db
 *
 * @author Sharon
 */
class Attractions extends MY_Model {

    //xml doc to be loaded
    private $xml;
    
    // Constructor
    public function __construct() {
        parent::__construct('attraction', 'attr_id');
        //load xml file
        $this->xml = simplexml_load_file("data/attractiondetail.xml");
    }


    // retrieve the first attraction
    public function first() {
        return $this->data['kkc'];
    }

    // retrieve the last attraction
    public function last() {
        $CI = & get_instance();
        
        $index = count($CI->attractions) - 1;
        return $CI->attractions[$index];
    }
    
    //number of attractions
    public function many()
    {
        $CI = & get_instance();
        return count($CI->attractions->all());
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
    
    //retrieve oldest attraction
    public function oldest()
    {
        $CI = & get_instance();
        
        //variable determining if it has the oldest date
        $oldest = 0;
        $old = 0;
        
        $source = $CI->attractions->all();
        
        foreach($source as $record)
        {
            $date = $record->date;
            
            if($date < $oldest)
            {
                $oldest = $date;
                $old = $record;
            }
        }
        
        return $old;
    }
    
    
    /**
     * Returns all the details for specific attraction from the xml file
     * @return the specified detail
     */
    
    function getDetails($id) 
    {
        $details = array();
        
        foreach($this->xml->children() as $detail) 
        {
            
            if($id == (string)$detail['id'])
            {
                $details = array(
                    'id'            => $detail['id'],
                    'contact'       => $detail['contact'],
                    'date'          => $detail['date'],
                    'price'         => $detail['price'],
                    'description'   => $detail->description->__toString(),
                    'pic1'          => $detail->gallery['pic1'],
                    'pic2'          => $detail->gallery['pic2'],
                    'pic3'          => $detail->gallery['pic3'],
                );
                
                return $details;
            }
        }
        
    }
   
}

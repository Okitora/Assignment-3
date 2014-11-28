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
    
    /**
     * Returns all the ports from the xml file
     * @return the ports
     */
    /*
    function getPorts() 
    {
        $ports = array();
        
        foreach($this->xml->ports->children() as $port) 
        {
            $ports[(string)$port['code']] = $port->__toString();
        }
        
        return $ports;
    }
   */
}

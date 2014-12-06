<?php

/**
 * This is a Attractions model for all attractions, with xml data and db
 * data under bcitx762_d08 db
 *
 * @author Sharon
 */
class Attractions extends MY_Model {
    
    // Constructor
    public function __construct() {
        parent::__construct('attraction', 'attr_id');
        //load xml file
        //$this->xml = simplexml_load_file("data/attractiondetail.xml");
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
    
    public function convertToObject($key)
    {
        $CI = & get_instance();
        
        $record = $CI->attractions->get($key);
        //$specific = array();
        
        $xml = simplexml_load_string((string)$record->detail);
        //$record = array();
        $record['description'] = (string)$xml->description;
        
        $record['id'] = $xml['id'];
        $record['contact'] = $xml['contact'];
        $record['price'] = $xml['price'];
        $record['date'] = $xml['date'];
        
        $record['gallery']= array
        (
            'picture1' => $xml['gallery']->picture,
            'picture' => $xml['gallery']->picture,
            'picture' => $xml['gallery']->picture
        );
        //[specific] = [[first],[second]]
        //[first and second] = [id, value]    
        $record['specific']=array
        (
            'first'=>
                array
                (
                    'id' => $xml['specific']['first'],
                    'value' => (string)$xml['specific']->first
                ),
            'second'=>
                array
                (
                    'id' => $xml['specific']['second'],
                    'value' => (string)$xml['specific']->second
                ),
        );
        return $record;
    }
    //create
    public function convertToDBRecord($record)
    {
        $xml = simplexml_load_string($record['detail']);
        
        $xml->addAttribute('id', $record['id']);
        $xml->addAttribute('contact', $record['contact']);
        $xml->addAttribute('price', $record['price']);
        $xml->addAttribute('date', $record['date']);
        
        $xml->description = $record['description'];
        //$xml->gallery = $record['gallery'];
        foreach($record->gallery as $temp)
        {
            $temp->gallery->addChild('picture', (string)$temp->picture);
        }
        
        //$xml->specific = $record['specific'];
        $xml->specific->addChild('first', (string)$record->specific->first);
        $xml->specific->first->addAttribute('specid',$record['specific']['first']);
        $xml->specific->addChild('second', (string)$record->specific->second);
        $xml->specific->second->addAttribute('specid',$record['specific']['second']);
        
        $newrec['attr_id'] = $record['attr_id'];
        $newrec['attr_name'] = $record['attr_name'];
        $newrec['main_id'] = $record['main_id'];
        $newrec['price_range'] = $record['price_range'];
        $newrec['tar_aud'] = $record['tar_aud'];
        $newrec['detail'] = $xml->asXML();
        
        $this->add($newrec);
    }
//    public function get($key)
//    {
//        return converToObject(parent::get($key));
//    }
    
}

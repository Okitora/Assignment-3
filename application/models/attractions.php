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
    //must be fixed....will fix after sublist/individual attraction pages are functional
    public function newest()
    {
        $CI = & get_instance();
        
        //variable determining if it has the newest date
        $newest = 0;
        //temporary file to store newest record
        $new = 0;
        
        $source = $CI->attractions->all();
        
        foreach ($source as $record)
        {   
            //convert xml to an array to find the date
            $detail = $CI->attractions->convertToObject($record->attr_id);
            $date = (int)$detail['date'];
            
            //if it is the newest date make the newest attraction
            if($date > $newest)
            {
                $newest = $date;
                $new = $record;
            }

        }
         
        return $new;
    }
    
    //number of attractions
    public function many()
    {
        $CI = & get_instance();
        $all = $CI->attractions->all();
        $id = 0;
        
        foreach($all as $record)
        {
            if($record->attr_id > $id)
            {
                $id = $record->attr_id;
            }
        }
        return $id;
    }
    
    public function convertToObject($key)
    {
        $CI = & get_instance();
        
        $recordTyp = $CI->attractions->get($key);
        //$specific = array();
        
        $xml = simplexml_load_string((string)$recordTyp->detail);
        //$record = array();
        $record['description'] = (string)$xml->description;
        
        $record['id'] = $xml['id'];
        $record['contact'] = $xml['contact'];
        $record['price'] = $xml['price'];
        $record['date'] = $xml['date'];
        
        $record['gallery'] = array(
            'pic1' => (string)$xml->gallery->pic1,
            'pic2' => (string)$xml->gallery->pic2,
            'pic3' => (string)$xml->gallery->pic3,
            );
        
        //[specific] = [[first],[second]]
        //[first and second] = [id, value]    
        $record['specific']=array
        (
            'first'=>
                array
                (
                    'id' => $xml->specific->first['specid'],
                    'value' => (string)$xml->specific->first
                ),
            
            'second'=>
                array
                (
                    'id' => $xml->specific->second['specid'],
                    'value' => (string)$xml->specific->second
                ),
        );
        return $record;
    }
    /**
     * update record already in database
     * takes in array and converts all a db record
     * takes in the minor/specific details and converts into xml
     */
    
    public function convertToDBRecord($record)
    {
        $CI = & get_instance();
        
        $xml = simplexml_load_string($record['detail']);
        
        $xml->attributes()->id = (string)$record['id'];
        $xml->attributes()->contact = (string)$record['contact'];
        $xml->attributes()->price = (string)$record['price'];
        $xml->attributes()->date = (string)$record['date'];
        
        $xml->description = $record['description'];
        $xml->gallery->addChild('pic1', (string)$record->pic1);
        $xml->gallery->addChild('pic2', (string)$record->pic2);
        $xml->gallery->addChild('pic3', (string)$record->pic3);
        
        
        //$xml->specific = $record['specific'];
        //$xml->specific->addChild('first', (string)$record->specific->first);
        //$xml->specific->first->addAttribute('specid',$record['specific']['first']);
        $xml->specific->first->attributes()->specid = $record['firstName'];
        $xml->specific->first = (string)$record['first'];
        $xml->specific->second = (string)$record['second'];
        $xml->specific->second->attributes()->specid = $record['secondName'];
        //$xml->specific->addChild('second', (string)$record->specific->second);
        //$xml->specific->second->addAttribute('specid',$record['second']);
        
        $newrec['attr_id'] = $record['attr_id'];
        $newrec['attr_name'] = $record['attr_name'];
        $newrec['main_id'] = $record['main_id'];
        $newrec['price_range'] = $record['price_range'];
        $newrec['tar_aud'] = $record['tar_aud'];
        $newrec['detail'] = $xml->asXML();
        
        $CI->attractions->update($newrec);
    }
//    public function get($key)
//    {
//        return converToObject(parent::get($key));
//    }
    
    /**
     * adds record
     * takes in array and converts all a db record
     * takes in the minor/specific details and converts into xml
     */
    
    public function convertToDBRecordAdd($record)
    {
        $CI = & get_instance();
        $standard = $CI->attractions->newest();
        $xml = simplexml_load_string($standard->detail);
        
        $xml->attributes()->id = (string)$record['attr_id'];
        $xml->attributes()->contact = (string)$record['contact'];
        $xml->attributes()->price = (string)$record['price'];
        $xml->attributes()->date = (string)$record['date'];
        
        $xml->description = $record['description'];
        $xml->gallery->addChild('pic1', (string)$record->pic1);
        $xml->gallery->addChild('pic2', (string)$record->pic2);
        $xml->gallery->addChild('pic3', (string)$record->pic3);
        
        
        //$xml->specific = $record['specific'];
        //$xml->specific->addChild('first', (string)$record->specific->first);
        //$xml->specific->first->addAttribute('specid',$record['specific']['first']);
        $xml->specific->first->attributes()->specid = $record['firstName'];
        $xml->specific->first = (string)$record['first'];
        $xml->specific->second = (string)$record['second'];
        $xml->specific->second->attributes()->specid = $record['secondName'];
        //$xml->specific->addChild('second', (string)$record->specific->second);
        //$xml->specific->second->addAttribute('specid',$record['second']);
        
        $newrec['attr_id'] = $record['attr_id'];
        $newrec['attr_name'] = $record['attr_name'];
        $newrec['main_id'] = $record['main_id'];
        $newrec['price_range'] = $record['price_range'];
        $newrec['tar_aud'] = $record['tar_aud'];
        $newrec['detail'] = $xml->asXML();
        
        $CI->attractions->add($newrec);
    }
    
}

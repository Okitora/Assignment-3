<?php

/**
 * This is a Attractions model for all attractions, with xml data and db
 * data under bcitx762_d08 db
 *
 * @author Sharon
 */
class Attractions extends MY_Model {

    //xml doc to be loaded
    //private $xml;
    
    // Constructor
    public function __construct() {
        parent::__construct('attraction', 'attr_id');
        //load xml file
        //$this->xml = simplexml_load_file("data/attractiondetail.xml");
    }


    // retrieve the first attraction
    //public function first() {
//        return $this->data['kkc'];
//    }
//
//    // retrieve the last attraction
//    public function last() {
//        $CI = & get_instance();
//        
//        $index = count($CI->attractions) - 1;
//        return $CI->attractions[$index];
//    }
//    
//    //number of attractions
//    public function many()
//    {
//        $CI = & get_instance();
//        return count($CI->attractions->all());
//    }
//    
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
//    public function oldest()
//    {
//        $CI = & get_instance();
//        
//        //variable determining if it has the oldest date
//        $oldest = 0;
//        $old = 0;
//        
//        $source = $CI->attractions->all();
//        
//        foreach($source as $record)
//        {
//            $date = $record->date;
//            
//            if($date < $oldest)
//            {
//                $oldest = $date;
//                $old = $record;
//            }
//        }
//        
//        return $old;
//    }
    
    
    /**
     * Returns all the details for specific attraction from the xml file
     * @return the specified detail
     */
    
//    function getDetails($id) 
//    {
//        $details = array();
//        
//        foreach($this->xml->children() as $detail) 
//        {
//            
//            if($id == (string)$detail['id'])
//            {
//                $details = array(
//                    'id'            => $detail['id'],
//                    'contact'       => $detail['contact'],
//                    'date'          => $detail['date'],
//                    'price'         => $detail['price'],
//                    'description'   => $detail->description->__toString(),
//                    'pic1'          => $detail->gallery['pic1'],
//                    'pic2'          => $detail->gallery['pic2'],
//                    'pic3'          => $detail->gallery['pic3'],
//                );
//                
//                return $details;
//            }
//        }
//        
//    }
    
    
    public function convertToObject($key)
    {
        $CI = & get_instance();
        
        $records = $CI->attractions->get($key);
        $specific = array();
        
        $xml = simplexml_load_string($records->detail);
        $record = array();
        $record['description'] = (string)$xml->description;
        
        $record['id'] = $xml['id'];
        $record['contact'] = $xml['contact'];
        $record['price'] = $xml['price'];
        $record['date'] = $xml['date'];
        
        $record['gallery']= array(
            'pic1' => $xml['gallery']['pic1'],
            'pic2' => $xml['gallery']['pic2'],
            'pic3' => $xml['gallery']['pic3']
                                    );
        
        //this needs to be fixed
        /*
        $specific = $xml['specific'];
        foreach($specific as $temp)
        {
            $this1 = array(
                    'id'    => $temp['id'],
                    'value' => $temp['value']
                   );
            $record['specific'][] = $this1;
        }
        */
        return $record;
    }
    
    //some returns 2d array of rows. 
//    public function some_xml($what, $which)
//    {
//        $records = $this->some($what, $which);
//        
//        foreach($records as $temp)
//        {
//            $xml = simplexml_load_string($records['detail']);
//            
//            $temp['description'] = (string)$xml->description;
//
//            $temp['id'] = $xml['id'];
//            $temp['contact'] = $xml['contact'];
//            $temp['price'] = $xml['price'];
//            $temp['date'] = $xml['date'];
//
//            $temp['gallery']= array(
//                                        $xml->gallery['pic1'],
//                                        $xml->gallery['pic2'],
//                                        $xml->gallery['pic3']
//                                    );
//
//            foreach($temp->specfic as $spectemp)
//            {
//                $this1 =array(
//                        'id' => $spectemp['id'],
//                        'value' =>$spectemp['value']
//                       );
//                $temp['specific'] = $this1;
//            }
//            $records[/*not sure what goes in here*/][] = $temp;
//        }
//        return $records;
//    }
    //update
//    public function update_xml($record)
//    {
//        $xml = simplexml_load_string($record['detail']);
//        
//        $xml->description = $record['description'];
//        $xml->gallery = $record['gallery'];
//        //do i need to specify another specific creation because i have 2 in my xml?
//        $xml->specific = $record['specific'];
//        
//        $newrec['attr_id'] = $record['attr_id'];
//        $newrec['attr_name'] = $record['attr_name'];
//        $newrec['main_id'] = $record['main_id'];
//        $newrec['price_range'] = $record['price_range'];
//        $newrec['tar_aud'] = $record['tar_aud'];
//        $newrec['detail'] = $xml->asXML();
//        
//        $this->update($newrec);
//    }
//    //delete
//    // do we need a delete xml function? wouldnt update with empty 
//    // elements be enough to for deleting a specific xml?
//    public function delete_xml($key)
//    {
//    }
    //create
    public function convertToDBRecord($record)
    {
        $xml = simplexml_load_string($record['detail']);
        
        $xml->addAttribute('id', $record['id']);
        $xml->addAttribute('contact', $record['contact']);
        $xml->addAttribute('price', $record['price']);
        $xml->addAttribute('date', $record['date']);
        
        $xml->description = $record['description'];
        $xml->gallery = $record['gallery'];
        foreach($record['picture'] as $temp)
        {
            $xml->gallery->addChild('picture', $record['picture']);
        }
        
        $xml->specific = $record['specific'];
        switch($record['main_id'])
        {
            case 'Entertainment':
                $xml->specific->addChild('fee', $record['specific']['fee']);
                $xml->specific->addChild('seating', $record['specific']['seating']);
                break;
            case 'Family-Fun':
                $xml->specific->addChild('food', $record['specific']['food']);
                $xml->specific->addChild('wifi', $record['specific']['wifi']);
                break;
            case 'Shopping':
                $xml->specific->addChild('cafe', $record['specific']['cafe']);
                $xml->specific->addChild('venue', $record['specific']['venue']);
                break;
            case 'Eco-Tourism':
                $xml->specific->addChild('', $record['specific']['']);
                $xml->specific->addChild('', $record['specific']['']);
                break;
            case 'Sight-Seeing':
                $xml->specific->addChild('', $record['specific']['']);
                $xml->specific->addChild('', $record['specific']['']);
                break;
        }
        //do i need to specify another specific creation because i have 2 in my xml?
//        $xml->specific = $record['specific'];
//        $xml->addAttribute('id', $record['specific']['id']);
//        $xml->addAttribute('value', $record['specific']['value']);
        
        $newrec['attr_id'] = $record['attr_id'];
        $newrec['attr_name'] = $record['attr_name'];
        $newrec['main_id'] = $record['main_id'];
        $newrec['price_range'] = $record['price_range'];
        $newrec['tar_aud'] = $record['tar_aud'];
        $newrec['detail'] = $xml->asXML();
        
        $this->add($newrec);
        //whoops, not this stuff.
        /*foreach($record['specific'] as $specattr)
        {
            $xml->addAttribute('id', 'value');
        }*/
    }
}

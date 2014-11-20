<?php

/**
 * This is a "CMS" model for categories, but with bogus hard-coded data
 *
 * @author Sharon
 */
class Sub extends MY_Model {

    // The data comes from http://www.quotery.com/top-100-funny-quotes-of-all-time/?PageSpeed=noscript
    
    // Constructor
    public function __construct() {
        parent::__construct('sub_cat', 'sub_id');
    }

}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zapFourController
 *
 * @author ryan
 */
class zapFourController {
    //put your code here
    private $weather_keywords;
    private $foursquare_keywords;
    private $products;
    
    function __construct() {
        $this->products = array();  //setup a blank array so array_merge is error free in getXYZPRoducts(...)
    }
    
    public function getWeatherProducts($zip){
        //these two could timeout.
        $zappos = new zappos();  //instantiate zappos, but don't do any lookups just yet
        $weather = new forecast($zip); //instantiate the forecast and get the object built.
        
        //get some keywords
        $this->weather_keywords = $weather->getKeywords();
        
        //search the keywords, build a list of products
        foreach($this->weather_keywords as $searchTerm){
            $this->products = array_merge($this->products, $zappos->search($searchTerm)->getProducts());
        }
    }

}

?>
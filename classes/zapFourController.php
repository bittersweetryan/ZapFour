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
    private $forecast;
    
    function __construct() {
        $this->products = array();  //setup a blank array so array_merge is error free in getXYZPRoducts(...)
    }
    
    public function getWeatherProducts($zip){
        //these two could timeout.
        $zappos = new zappos();  //instantiate zappos, but don't do any lookups just yet
        $this->forecast = new forecast($zip); //instantiate the forecast and get the object built.
        
        //get some keywords
        $this->weather_keywords = $this->forecast->getKeywords();
        
        //search the keywords, build a list of products
        foreach($this->weather_keywords as $searchTerm){
            $this->products = array_merge($this->products, $zappos->search($searchTerm)->getProducts());
        }
    }
    
    public function getWeatherProductsHTML($zip){
        $this->products = array();
        $this->getWeatherProducts($zip);
        $inc = 0;
        foreach($this->products as $prod){
            //echo"<pre>";print_r($prod);echo"</pre>";
            $inc++;
            $last = "";
            if($inc % 3)$last = "last";
            echo"<div class=\"fourcol $last\"><img src='".$prod->getThumbnailImageURL()."' alt='' /></div>";
        }
    }
    
    public function getWeatherForecastHTML(){
        if( $this->forecast instanceof forecast ){
            return $this->forecast->getSixDayForecastHTML();
        }
        return FALSE;
    }
}
?>
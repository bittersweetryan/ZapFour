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
        //shuffle($this->products);
        
        echo"<div class=\"row\">";
        foreach($this->products as $prod){
            //echo"<pre>";print_r($prod);echo"</pre>";
            $inc++;
            if( ($inc % 4) == 0 )$last = "last";
            else $last = "";
            //echo"<div class=\"fourcol $last\"><img src='".$prod->getThumbnailImageURL()."' alt='' /></div>";
            echo "<div class=\"threecol $last\">
			<div class=\"product\">
				<p class=\"productImg\"><img alt=\"Sperry\" src=\"".$prod->getThumbnailImageURL()."\" /></p>
				<h3>".$prod->getProductName()."</h3>
				<p>".$prod->getBrandName()."</p>
				<p>".$prod->getPrice()."</p>
			</div>
		</div>";
            if( ($inc % 4) == 0 && count($this->products)>$inc) echo"</div>\n<div class=\"row\">";
        }
        echo"</div>";
        //echo"<pre>";print_r($this->products);echo"</pre>";
    }
    
    public function getWeatherForecastHTML(){
        if( $this->forecast instanceof forecast ){
            return $this->forecast->getSixDayForecastHTML();
        }
        return FALSE;
    }
	
	public function getFoursquareProducts($checkins){
		$zappos = new zappos();  //instantiate zappos, but don't do any lookups just yet
		$this->products = array();
		$searchTearm = array();
		
		foreach($checkins as $key => $category){
                    $this->products = array_merge($this->products, $zappos->search($key)->getProducts());
		}
		
                $inc = 0;
                echo"<div class=\"row\">";
                foreach($this->products as $prod){
                    //echo"<pre>";print_r($prod);echo"</pre>";
                    $inc++;
                    if( ($inc % 4) == 0 )$last = "last";
                    else $last = "";
                    //echo"<div class=\"fourcol $last\"><img src='".$prod->getThumbnailImageURL()."' alt='' /></div>";
                    echo "<div class=\"threecol $last\">
                                <div class=\"product\">
                                        <p class=\"productImg\"><img alt=\"Sperry\" src=\"".$prod->getThumbnailImageURL()."\" /></p>
                                        <h3>".$prod->getProductName()."</h3>
                                        <p>".$prod->getBrandName()."</p>
                                        <p>".$prod->getPrice()."</p>
                                </div>
                        </div>";
                    if( ($inc % 4) == 0 && count($this->products)>$inc) echo"</div>\n<div class=\"row\">";
                }
                echo"</div>";
	}
}
?>
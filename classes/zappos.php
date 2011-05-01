<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zappos
 *
 * @author ryan
 */
class zappos {
    //put your code here
    protected $_URL;
    protected $_responsestr;
    protected $_data;
    protected $_products;
    
    function __construct($term = null) {
        if($term){
            $term = urlencode($term);
            $this->_URL = "http://api.zappos.com/Search?key=91c3e78e9bef5d946328a5cef5b18b5023d65907&limit=4&term=$term";
            $this->_responsestr = "";
            $this->_data = array();
            $this->_products = array();
            $this->fetch()->parse();
        }
    }
    
    
    
    private function fetch(){
        $ch = curl_init($this->_URL);
        curl_setopt($ch, CURLOPT_HEADER, 0); //I don't want any headers.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //I want a string returned.
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, TIMEOUT); //they get two seconds to respond or we take action
        $this->_responsestr = curl_exec($ch);
        //if this query exceeds our predefined timeout value, cry bloody murder.
        if( !$this->_responsestr ) throw new Exception ("ZAPPOS_DTA: ".curl_error($ch));
        curl_close($ch);
        return $this;
    }
    
    private function parse(){
        $this->_data = json_decode($this->_responsestr);
        foreach($this->_data as $key=>$data){
            if($key == "results"){
                foreach($data as $temp){
                    $product = new product();
                    $style = new style();
                    $style->setStyleId($temp->styleId);
                    $style->setProductId($temp->productId);
                    $style->setColorId($temp->colorId);
                    $style->setProductUrl($temp->productUrl);
                    $style->setPercentOff($temp->percentOff);
                    $style->setOriginalPrice($temp->originalPrice);
                    $style->setPrice($temp->price);
                    $style->setThumbnailImageUrl($temp->thumbnailImageUrl);
                    $product->setStyle($style, $temp->styleId);
                    $product->setProductId($temp->productId);
                    $product->setProductName($temp->productName);
                    $this->_products[] = $product;
                    
                }
            }
        }
        $this->_data = NULL;
        $this->_responsestr = NULL;
        return $this;
    }
    
    function search($term){
        return new zappos($term);
    }
    
    function getProduct($productID){
        return new product($productID);
    }
    function getProducts(){
        return $this->_products;
    }
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of style
 *
 * @author ryan
 */
class style {
    private $styleId;
    private $color;
    private $originalPrice;
    private $price;
    private $productUrl;
    private $percentOff;
    private $imageUrl;
    private $thumbnailImageUrl;
    private $goLiveDate;
    private $productId;
    private $onSale;
    private $isNew;
    private $colorId;
    
    function __construct() {
        
    } 
    
    public function getStyleId() {
        return $this->styleId;
    }

    public function getColor() {
        return $this->color;
    }

    public function getOriginalPrice() {
        return $this->originalPrice;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getProductUrl() {
        return $this->productUrl;
    }
    
    public function getPercentOff() {
        return $this->percentOff;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getThumbnailImageUrl() {
        return $this->thumbnailImageUrl;
    }

    public function getGoLiveDate() {
        return $this->goLiveDate;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getOnSale() {
        return $this->onSale;
    }

    public function getIsNew() {
        return $this->isNew;
    }

    public function getColorId() {
        return $this->colorId;
    }

    public function setStyleId($styleId) {
        $this->styleId = $styleId;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setOriginalPrice($originalPrice) {
        $this->originalPrice = $originalPrice;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setProductUrl($productUrl) {
        $this->productUrl = $productUrl;
    }

    public function setPercentOff($percentOff) {
        $this->percentOff = $percentOff;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    public function setThumbnailImageUrl($thumbnailImageUrl) {
        $this->thumbnailImageUrl = $thumbnailImageUrl;
    }

    public function setGoLiveDate($goLiveDate) {
        $this->goLiveDate = $goLiveDate;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setOnSale($onSale) {
        $this->onSale = $onSale;
    }

    public function setIsNew($isNew) {
        $this->isNew = $isNew;
    }

    public function setColorId($colorId) {
        $this->colorId = $colorId;
    }


    
}

?>

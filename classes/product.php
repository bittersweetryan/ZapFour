<?PHP

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author ryan
 */
class product {
    private $URL;
    private $productId;
    private $brandId;
    private $brandName;
    private $productName;
    private $defaultProductUrl;
    private $defaultImageUrl;
    private $rootProductType;
    //private $productType[*] NOTE: 3/7/2011 - We noticed that the value 
    //returned in the productType field is returning our old productTypes. 
    //We'll be fixing this in an upcoming release so expect these values to change
    private $description;
    private $gender;
    private $weight;
    private $videoFileName;
    private $videoUrl;
    private $videoUploadedDate;
    private $sizeFit;
    private $widthFit;
    private $archFit;
    private $productRating;
    private $styles;
    
    function __construct($productID = null) {
        if($productID){
            $this->URL = "http://api.zappos.com/Product/id/$productID?key=91c3e78e9bef5d946328a5cef5b18b5023d65907&includes=[\"styles\",\"colorId\"]";
            $this->fetch()->parse();
        }
    }
    
    private function fetch(){
        $ch = curl_init($this->URL);
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
            if($key == "product"){
                foreach($data as $temp){
                   if(isset($temp->productId)) $this->productId = $temp->productId;
                   if(isset($temp->brandId)) $this->brandId = $temp->brandId;
                   if(isset($temp->brandName)) $this->brandName = $temp->brandName;
                   if(isset($temp->productName)) $this->productName = $temp->productName;
                   if(isset($temp->defaultProductUrl)) $this->defaultProductUrl = $temp->defaultProductUrl;
                   if(isset($temp->defaultImageUrl)) $this->defaultImageUrl = $temp->defaultImageUrl;
                   if(isset($temp->rootProductType)) $this->rootProductType = $temp->rootProductType;
                   if(isset($temp->description)) $this->description = $temp->description;
                   if(isset($temp->gender)) $this->gender = $temp->gender;
                   if(isset($temp->weight)) $this->weight = $temp->weight;
                   if(isset($temp->videoFileName)) $this->videoFileName = $temp->videoFileName;
                   if(isset($temp->videoUrl)) $this->videoUrl = $temp->videoUrl;
                   if(isset($temp->videoUploadedDate)) $this->videoUploadedDate = $temp->videoUploadedDate;
                   if(isset($temp->sizeFit)) $this->sizeFit = $temp->sizeFit;
                   if(isset($temp->widthFit)) $this->widthFit = $temp->widthFit;
                   if(isset($temp->archFit)) $this->archFit = $temp->archFit;
                   if(isset($temp->productRating)) $this->productRating = $temp->productRating;
                   if(isset($temp->styles) && count($temp->styles)>0){
                       foreach($temp->styles as $temp){
                            $style = new style();
                            if(isset($temp->styleId)) $style->setStyleId($temp->styleId);
                            if(isset($temp->color)) $style->setColor($temp->color);
                            if(isset($temp->originalPrice)) $style->setOriginalPrice($temp->originalPrice);
                            if(isset($temp->price)) $style->setPrice($temp->price);
                            if(isset($temp->productUrl)) $style->setProductUrl($temp->productUrl);
                            if(isset($temp->percentOff)) $style->setPercentOff($temp->percentOff);
                            if(isset($temp->imageUrl)) $style->setImageUrl($temp->imageUrl);
                            if(isset($temp->thumbnailImageUrl)) $style->setThumbnailImageUrl($temp->thumbnailImageUrl);
                            if(isset($temp->goLiveDate)) $style->setGoLiveDate($temp->goLiveDate);
                            if(isset($temp->productId)){
                                $style->setProductId($temp->productId);
                                $this->productId = $temp->productId;
                            }
                            if(isset($temp->onSale)) $style->setOnSale($temp->onSale);
                            if(isset($temp->isNew)) $style->setIsNew($temp->isNew);
                            if(isset($temp->colorId)) $style->setColorId($temp->colorId);
                            $this->styles[$temp->styleId] = $style;
                       }
                   }
                    
                }
            }
        }
        $this->_data = NULL;
        $this->_responsestr = NULL;
        
        return $this;
    }
    
    public function getThumbnailImageURL(){
        
        if(count($this->styles) > 0){
            $style = array_shift($this->styles);
            if($style instanceof style){
                return $style->getThumbnailImageUrl();
            }
        }
    }
    
    public function setStyle( style $style, $styleID){ $this->styles[$styleID] = $style;}
    
    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setBrandId($brandId) {
        $this->brandId = $brandId;
    }

    public function setBrandName($brandName) {
        $this->brandName = $brandName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function setDefaultProductUrl($defaultProductUrl) {
        $this->defaultProductUrl = $defaultProductUrl;
    }

    public function setDefaultImageUrl($defaultImageUrl) {
        $this->defaultImageUrl = $defaultImageUrl;
    }

    public function setRootProductType($rootProductType) {
        $this->rootProductType = $rootProductType;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setVideoFileName($videoFileName) {
        $this->videoFileName = $videoFileName;
    }

    public function setVideoUrl($videoUrl) {
        $this->videoUrl = $videoUrl;
    }

    public function setVideoUploadedDate($videoUploadedDate) {
        $this->videoUploadedDate = $videoUploadedDate;
    }

    public function setSizeFit($sizeFit) {
        $this->sizeFit = $sizeFit;
    }

    public function setWidthFit($widthFit) {
        $this->widthFit = $widthFit;
    }

    public function setArchFit($archFit) {
        $this->archFit = $archFit;
    }

    public function setProductRating($productRating) {
        $this->productRating = $productRating;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getBrandId() {
        return $this->brandId;
    }

    public function getBrandName() {
        return $this->brandName;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getDefaultProductUrl() {
        return $this->defaultProductUrl;
    }

    public function getDefaultImageUrl() {
        return $this->defaultImageUrl;
    }

    public function getRootProductType() {
        return $this->rootProductType;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getVideoFileName() {
        return $this->videoFileName;
    }

    public function getVideoUrl() {
        return $this->videoUrl;
    }

    public function getVideoUploadedDate() {
        return $this->videoUploadedDate;
    }

    public function getSizeFit() {
        return $this->sizeFit;
    }

    public function getWidthFit() {
        return $this->widthFit;
    }

    public function getArchFit() {
        return $this->archFit;
    }

    public function getProductRating() {
        return $this->productRating;
    }


    
}

?>

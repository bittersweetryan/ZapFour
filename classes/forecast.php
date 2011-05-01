<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
interface iSearchable {
    //put your code here
    public function getKeywords();
}

class forecast implements iSearchable{
    protected $_zip;
    protected $_XMLURL;
    protected $_xmlstr;
    protected $_data;
    
    private $conditions;
    private $min_precip_threshold;
    private $min_arctic_fahrenheit;
    private $max_arctic_fahrenheit;
    private $min_cold_fahrenheit;
    private $max_cold_fahrenheit;
    private $min_warm_fahrenheit;
    private $max_warm_fahrenheit;
    private $min_hot_fahrenheit;
    private $max_hot_fahrenheit;
    
    
    public function __construct($zip, $type="WUND_SIMPLE") {
        $this->_data = array();
        $this->_zip = $zip;
        $this->_XMLURL = "http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=".$this->_zip;
        
        $this->min_precip_threshold = 40;
        
        $this->min_arctic_fahrenheit = -100;
        $this->max_arctic_fahrenheit = 32;
        
        $this->min_cold_fahrenheit = 0;
        $this->max_cold_fahrenheit = 55;
        
        $this->min_warm_fahrenheit = 50;
        $this->max_warm_fahrenheit = 75;
        
        $this->min_hot_fahrenheit = 70;
        $this->max_hot_fahrenheit = 140;
        
        $this->conditions = array(    
            'chanceflurries'=>0,'chancerain'=>0,'chancesleet'=>0,'chancesnow'=>0,
            'chancetstorms'=>0,'clear'=>0,'cloudy'=>0,'flurries'=>0,'fog'=>0,'hazy'=>0,
            'mostlycloudy'=>0,'mostlysunny'=>0,'partlycloudy'=>0,'partlysunny'=>0,
            'rain'=>0,'sleet'=>0,'snow'=>0,'sunny'=>0,'tstorms'=>0,'tstorms'=>0,'unknown'=>0 );
    
        $this->fetchXML()->parseXML();
    }
    
    private function fetchXML(){
        $ch = curl_init($this->_XMLURL);
        curl_setopt($ch, CURLOPT_HEADER, 0); //I don't want any headers.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //I want a string returned.
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, TIMEOUT); //they get two seconds to respond or we take action
        $this->_xmlstr = curl_exec($ch);
        //if this query exceeds our predefined timeout value, cry bloody murder.
        if( !$this->_xmlstr ) throw new Exception ("WEATHER_DTA: ".curl_error($ch));
        curl_close($ch);
        return $this;
    }
    
    private function parseXML(){
        //assume the XML has been obtained already by fetchXML()
        $xml = new SimpleXMLElement($this->_xmlstr);
        foreach($xml->xpath("simpleforecast/forecastday") as $forecast){
            
            $period = (int) $forecast->period;
            $e_date = (int) $forecast->date->epoch;
            $low = (int) $forecast->low->fahrenheit;
            $high = (int) $forecast->high->fahrenheit;
            $conditions = (string) $forecast->conditions;
            $icon = (string) $forecast->icon;
            $pop = (int) $forecast->pop;
            
            $this->_data [$period] = array(
                'epoch'=>$e_date,
                'lowFahrenheit'=>$low,
                'highFahrenheit'=>$high,
                'conditions'=>$conditions,
                'icon'=>$icon,
                'pop'=>$pop
            );
        }
        return $this;
    }
    
    public function render($days = false){
        echo "<pre>";print_r($this->_data);echo"</pre>";
    }
    
    public function getAverageForecast($days = false){
        $avg_fcast = array('lowFahrenheit'=>0,'highFahrenheit'=>0,'pop'=>0,'has_precip'=>false,'conditions'=>$this->conditions);
        if( !$days ) $days = count($this->_data);
        
        for($i=1; $i<=$days; $i++){
            $avg_fcast['lowFahrenheit'] += $this->_data[$i]['lowFahrenheit'];
            $avg_fcast['highFahrenheit'] += $this->_data[$i]['highFahrenheit'];
            $avg_fcast['pop'] += $this->_data[$i]['pop'];
            $avg_fcast['conditions'][$this->_data[$i]['icon']] += 1;
            if($this->_data[$i]['pop'] >= $this->min_precip_threshold) $avg_fcast['has_precip'] = true;
        }
        $avg_fcast['lowFahrenheit'] = round($avg_fcast['lowFahrenheit']/$days);
        $avg_fcast['highFahrenheit'] = round($avg_fcast['highFahrenheit']/$days);
        $avg_fcast['pop'] = round($avg_fcast['pop']/$days);
        foreach($avg_fcast['conditions'] as $key=>$val){
            if($val == 0) unset($avg_fcast['conditions'][$key]);
        }
        arsort($avg_fcast['conditions']);
        return $avg_fcast;
    }
    
    public function getAverageForecastJSON($days = false){
        return json_encode($this->getAverageForecast($days));
    }
    
    public function getKeywords(){
        $avg = (object) $this->getAverageForecast();
        $keywords = array();
        if($avg->highFahrenheit > $this->min_hot_fahrenheit) {
            $keywords[] = "shorts";
            $keywords[] = "sandals";
        }elseif($avg->highFahrenheit > $this->min_warm_fahrenheit){
            $keywords[] = "windbreaker";
        }elseif($avg->highFahrenheit > $this->min_cold_fahrenheit){
            $keywords[] = "Fleece Jacket";
        }elseif($avg->highFahrenheit > $this->min_arctic_fahrenheit){
            $keywords[] = "Arctic Jacket";
        }
        
        if($avg->has_precip){
            if($avg->lowFahrenheit > 32){
                $keywords[] = "umbrella";
            }else{
                $keywords[] = "scarf";
                $keywords[] = "gloves";
            }
        }
        return $keywords;
    }
    
    public function getSixDayForecastHTML(){
        if(count($this->_data) > 0){
            $html = "<ul class=''>";
            foreach($this->_data as $day){
                $html .= "<li class='".$this->getForecastIcon($day['icon'])."'>".$day['highFahrenheit']."</li>\n";
            }
            $html .= "</ul>";
            return $html;
        }else{
            return false;
        }
    }
    
    public function hasRain(){
        
    }
    public function hasSnow(){
        
    }
    public function isArctic(){
        
    }
    public function isCold(){
        
    }
    public function isWarm(){
        
    }
    public function isHot(){
        
    }
    public function getMinPrecipThreshold(){
        return $this->min_precip_threshold;
    }
    public function getMinArcticFahrenheit(){
        return $this->min_arctic_fahrenheit;
    }
    public function getMaxArcticFahrenheit(){
        return $this->max_arctic_fahrenheit;
    }
    public function getMinColdFahrenheit(){
        return $this->min_cold_fahrenheit;
    }
    public function getMaxColdFahrenheit(){
        return $this->max_cold_fahrenheit;
    }
    public function getMinWarmFahrenheit(){
      return $this->min_warm_fahrenheit;
    }
    public function getMaxWarmFahrenheit(){
       return $this->max_warm_fahrenheit;
    }
    public function getMinHotFahrenheit(){
        return $this->min_hot_fahrenheit;
    }
    public function getMaxHotFahrenheit(){
        return $this->max_hot_fahrenheit;
    }
    public function getForecastIcon($cond){
        $translate = array("chanceflurries" => "snow",
        "chancerain" => "rain",
        "chancesleet" => "snow",
        "chancesnow" => "snow",
        "chancetstorms" => "rain",
        "clear" => "warm",
        "cloudy" => "cloudy",
        "flurries" => "snow",
        "fog" => "cloudy",
        "hazy" => "cloudy",
        "mostlycloudy" => "partlysunny",
        "mostlysunny" => "partlysunny",
        "partlycloudy" => "partlysunny",
        "partlysunny" => "partlysunny",
        "rain"  => "rain",
        "sleet" => "snow",
        "snow" => "snow",
        "sunny" => "warm",
        "tstorms" => "rain",
        "tstorms" => "rain",
        "unknown" => "na");
        return $translate[$cond];
    }
    
    
    public function setMinPrecipThreshold($val){
        $this->min_precip_threshold = $val;
    }
    public function setMinArcticFahrenheit($val){
        $this->min_arctic_fahrenheit = $val;
    }
    public function setMaxArcticFahrenheit($val){
        $this->max_arctic_fahrenheit = $val;
    }
    public function setMinColdFahrenheit($val){
        $this->min_cold_fahrenheit = $val;
    }
    public function setMaxColdFahrenheit($val){
        $this->max_cold_fahrenheit = $val;
    }
    public function setMinWarmFahrenheit($val){
        $this->min_warm_fahrenheit = $val;
    }
    public function setMaxWarmFahrenheit($val){
        $this->max_warm_fahrenheit = $val;
    }
    public function setMinHotFahrenheit($val){
        $this->min_hot_fahrenheit = $val;
    }
    public function setMaxHotFahrenheit($val){
        $this->max_hot_fahrenheit = $val;
    }
}


?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class forecast {
    protected $_zip;
    protected $_XMLURL;
    protected $_xmlstr;
    protected $_forecastDays;
    protected $_data;
    
    public function __construct($zip, $type="WUND_SIMPLE") {
        $this->_data = array();
        $this->_zip = $zip;
        $this->_XMLURL = "http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=".$this->_zip;
        $this->fetchXML()->parseXML()->render();
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
        //assume 
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
    
    public function render(){
        echo "<pre>";print_r($this->_data);echo"</pre>";
    }
}


?>

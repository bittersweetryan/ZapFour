<?php
/* 
 * Foursquare-php location fetcher class
 * Connect to foursquare and retrive your last location to display it along with a google map on your page
 * Author: Elie Bursztein (fourlocfetcher@elie.im)
 * URL:http://code.google.com/p/foursquare-php/
 * Version: 0.1
 * License: GPL
 */

class fourSquare {

  private $user = "";
  private $pass = "";
  private $url = "http://api.foursquare.com/v1/user.json"; //foursquare api call

  public $date = "";
  public $venueName = "";
  public $venueCat = "";
  public $venueType = "";
  public $venueIcon = "http://foursquare.com/img/categories/question.png";
  public $comment = "";
  public $address = "";
  public $city = "";
  public $state = "";
  public $geolong = "";
  public $geolat = "";
  

  /*
   * @param $user foursquare username or email
   * @param $pass foursquare password
   */
    function __construct($user, $pass) {
           $this->user = $user;
           $this->pass = $pass;

           //fetching data
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $this->url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ;
           curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
           curl_setopt($ch, CURLOPT_USERAGENT, "fetcher " . time()); //prevent rate limit
           curl_setopt($ch, CURLOPT_SSLVERSION,3);
           $data = curl_exec($ch);
           curl_close($ch);

           //decoding data
           $fd = json_decode($data);

           if (isset($fd->{"unauthorized"}))
                die("Foursquare widget API: wrong login or password");

           //parsing
           try {
           $this->date      = $fd->{"user"}->{"checkin"}->{"created"};
           $this->venueName = $fd->{"user"}->{"checkin"}->{"venue"}->{"name"};

           if (isset($fd->{"user"}->{"checkin"}->{"venue"}->{"primarycategory"}->{"fullpathname"})) {
            $this->venueCat  =  $fd->{"user"}->{"checkin"}->{"venue"}->{"primarycategory"}->{"fullpathname"};
            $this->venueCat  = str_replace(':', '/', $this->venueCat);
           }

           if (isset($fd->{"user"}->{"checkin"}->{"venue"}->{"primarycategory"}->{"nodename"})) {
            $this->venueType =  $fd->{"user"}->{"checkin"}->{"venue"}->{"primarycategory"}->{"nodename"};
            $this->venueIcon =  $fd->{"user"}->{"checkin"}->{"venue"}->{"primarycategory"}->{"iconurl"};
           }
           
           if (isset($fd->{"user"}->{"checkin"}->{"shout"})) {
            $this->comment   =  $fd->{"user"}->{"checkin"}->{"shout"};
           }

           if (isset($fd->{"user"}->{"checkin"}->{"venue"}->{"address"})) {
            $this->address   =  $fd->{"user"}->{"checkin"}->{"venue"}->{"address"};
            $this->city      = $fd->{"user"}->{"checkin"}->{"venue"}->{"city"};
            $this->state     = $fd->{"user"}->{"checkin"}->{"venue"}->{"state"};
            $this->geolat    = $fd->{"user"}->{"checkin"}->{"venue"}->{"geolat"};
            $this->geolong   = $fd->{"user"}->{"checkin"}->{"venue"}->{"geolong"};
            }
           } catch(Exception $e) {
               
           }

     }

      /*
      * get the google map img url corresponding to the foursquare location
      * @param $width map width
      * @param $height map height
      * @param $mobile is this a map for a mobile page ? default false
      * @param $maptype what type of map to render. Possible choice : roadmap, satellite, hybrid, and terrain. Default "roadmap"
      * @param $zoom : level of zoom in the map default 12
      * @param $markerText: text en the marker default "" (can only be a single uppercase letter) put "" for a .
      * @param $markerText: color of the marker default blue
      */

     public function getMapUrl($width, $height,  $zoom = 12, $markerText = "me", $markerColor = "blue", $mobile = FALSE, $maptype = "roadmap") {



        $mapUrl      = "http://maps.google.com/maps/api/staticmap?";      //static map url
        $mapUrl     .= "sensor=true";                                     //we are using the GPS through foursquare so it is a sensor map.
        $mapUrl     .= "&center=". $this->geolat . ",". $this->geolong ;   //position returned by foursquare

        $mapUrl     .= "&maptype=" . $maptype;

        $mapUrl     .= "&size=". $width . "x" . $height;
        $mapUrl     .= "&zoom=" . $zoom;

        $markerText = strtoupper(substr($markerText, 0, 1));
        $mapUrl     .= "&markers=color:".$markerColor."|label:".$markerText."|".$this->geolat.",".$this->geolong . "|";


        return $mapUrl;

     }

}

?>
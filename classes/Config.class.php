<?php

class Config{
	
	private $fsClientId = "LCSLN3T0TOVU2O3PCYSL312FYGDPTPIAKGYTI0GMKLWZFP31";
	private $fsSecret = "K2BYPPF0SNZYO0A5V0SRCYIZQXKCP3ZPOBXMT2QCDVNTXEAC";
	private $fsCallbackURI = "http://localhost/z4/tokenrequest.php"; 
	private $fsAuthToken = "";
	
	public function __construct(){
		
	}
	
	public function getFSClientID(){
		return $this->fsClientId;
	}
	
	public function getFSSecret(){
		return $this->fsSecret;
	}
	
	public function getFSCallbackURI(){
		return $this->fsCallbackURI;
	}
	
	public function getFSAuthToken(){
		return $this->fsAuthToken;
	}
	
	public function setFSAuthToken($fsAuthToken){
		$this->fsAuthToken = $fsAuthToken;
	}
}

?>
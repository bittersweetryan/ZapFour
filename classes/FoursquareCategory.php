<?php
class FouresquareCategory{

	private $categoryDescription = "";
	private $quip = "";		
	
	public function _construct(){
		
	}
	
	public function getCategoryDescription(){
		return $this->categoryDescription;
	}
	
	public function setCategoryDescription($categoryDescription){
		return $this->categoryDescription;
	}
	
	public function getQuip(){
		return $this->quip;
	}
	
	public function setQuip($quip){
		return $this->quip;
	}
}
?>
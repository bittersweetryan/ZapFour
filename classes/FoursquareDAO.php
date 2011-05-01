<?php
	
class FoursquareDAO {
	
	 public function __construct(){
	 	
	 }
	
	public function getKeywordsForCategories($categoriesToGet){
		$sql = " SELECT 
					 K.keywordDescription
					,J.quip
				FROM 
					Category C
				INNER JOIN
					JoinCategoryKeyword J ON J.categoryID = C.categoryID
				INNER JOIN
					Keyword K ON K.keywordID = J.keywordID
				WHERE 
					C.categoryName in (";
		
		$mylist =  $this->turnCategoriesIntoList($categoriesToGet);
					
		$sql .= $mylist;
		
		$sql .= ");";
		
		return $this->queryGetKeywords($sql);
	}

	private function turnCategoriesIntoList($_categories){
		$list = "";
		
		$end = count($_categories);
		
		for($i=0; $i < $end; $i++){
			$list .= "\"" . $_categories[$i] . "\",";
		}
		
		return substr($list,0,strlen($list)-1);
	}
	
	private function queryGetKeywords($sql){
		
		$keywords = array();
		
		$MYSQL_USER = 'z4';
    	$MYSQL_PASS = 'lemmein';
    	$MYSQL_DATABASE = 'zapfour';
    	$MYSQL_HOST = 'localhost';
		
		$keywords["Coffee Shop"] = "Your coffee you brew at home would tast better with a nice new coffee maker.  It'll save you a few bucks a week too!";
		$keywords["Monument or Landmark"] = "We see that you like to sight see, you might want to protect that expensive camera!";
		$keywords["Zoo or Aquarium"] = "The perfect companion to the zoo is a comfortable pair of shoes!";
		$keywords["Music Venue"] = "Those jenas you are wearing are soo not cool enough for a concert, check these out instead!";
	/*
		// Connect to the DB
	    $link = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
		
	    mysql_select_db($MYSQL_DATABASE, $link);
		
		$result = mysql_query($sql);
		
		
		while ($row = mysql_fetch_assoc($result)) {
		
			//$cat = new FoursquareCategory();
			
		   $key = $row["categoryDescription"];
		   $value = $row["quip"];
			
			$keywords[$key] = $value;
			
			return $keywords;
		}
	
		mysql_free_result($result);
		*/
		return $keywords;
		
	}
		
}
?>
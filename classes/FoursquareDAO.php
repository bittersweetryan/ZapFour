<?php
	
class FoursquareDAO {
	
	 public function __construct(){
	 	
	 }
	
	public function getKeywordsForCategories($categories){
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
		$sql .= turnCategoriesIntoList($categories);
		
		$sql .= ");";
	}

	private function turnCategoriesIntoList($categories){
		$list = "";
		
		foreach($categories as $key => $category){
			$list .= "\"" . $category . "\",";
		}
		
		return substr($list,0,strlen($list)-1);
	}
	
	private function queryGetKeywords($sql){
		
		$keywords = array();
			
		$MYSQL_USER = 'z4';
    	$MYSQL_PASS = 'lemmein';
    	$MYSQL_DATABASE = 'z4';
    	$MYSQL_HOST = 'localhost';
	
		// Connect to the DB
	    $link = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
	    mysql_select_db($MYSQL_DATABASE, $sql);
		
		$result = mysql_query($sql,$link);
		
		while ($row = mysql_fetch_assoc($result)) {
			$cat = new FoursquareCategory();
			
		    $cat->setCategoryDescription($row["categoryDescription"]);
		    $cat->setQuip($row["quip"]);
			
			$keywords[] = $cat;
		}
	
		mysql_free_result($result);
		
		return $keywords;
		
	}
		
}

?>
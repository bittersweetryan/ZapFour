<?php

class FoursquareDAO {

	public function getKeywordsForCategories($categories){
		$sql = " SELECT 
					* 
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
		
		
		//Coffee Shop","Zoo or Aquarium","Music Venue","Monument or Landmark")
	}
	
}

?>
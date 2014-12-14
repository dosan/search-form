<?php 

class BooksModel extends MainModel{

	public function selectAllFrom($table){
		$sql = "SELECT * FROM $table ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $this->getArrayResult($query);
	}
	public function getYears(){
		$sql = "SELECT DISTINCT YEAR(released_at) AS year FROM books ORDER BY released_at ASC";
		$query = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
	public function search(){
		$sql = "SELECT DISTINCT bk.title AS Title, YEAR(bk.released_at) AS Year, bk.price AS Price, cat.name AS Category, aut.name AS Author
		FROM books bk

		JOIN categories cat
			ON cat.id = bk.category

		JOIN books_covers bk_co
			ON bk_co.book_id = bk.id

		JOIN covers co
			ON co.id = bk_co.cover_id

		JOIN books_authors bk_aut
			ON bk_aut.book_id = bk.id

		JOIN authors aut
			ON aut.id = bk_aut.author_id

		JOIN books_languages bk_lan
			ON bk_lan.book_id = bk.id

		JOIN languages lan
			ON lan.id = bk_lan.lang_id

		JOIN books_locations bk_loc
			ON bk_loc.book_id = bk.id

		JOIN locations loc
			ON loc.id = bk_loc.location_id";

		if (isset($_GET['srch_for'])) {
			if (isset($_GET['srch_cover']) AND $_GET['srch_cover'] == 0)
				unset($_GET['srch_cover']);
			$locations = array();
			$getters = array();
			$queries = array();
			foreach ($_GET as $key => $value) {
				$temp = is_array($value) ? $value : trim($value);
				if (!empty($temp)) {

					list($key) = explode("-", $key);
					if ($key == 'srch_locations') {
						array_push($locations, $value);
					}
					if (!in_array($key, $getters)) {
						$getters[$key] = $value;
					}
				}
			}
			if (!empty($locations)) {
				$loc_qry = implode(",",$locations);
			}
			if (!empty($getters)) {
				foreach ($getters as $key => $value) {
					${$key} = $value;
					switch ($key) {
						case 'srch_for':
							array_push($queries, "(bk.title LIKE '%$srch_for%' || bk.description LIKE'%$srch_for%' || bk.isbn LIKE'%$srch_for%') ");
							break;
						case 'srch_category':
							array_push($queries, "bk.category = $srch_category");
							break;
						case 'srch_cover':
							array_push($queries, "bk_co.cover_id = $srch_cover");
							break;
						case 'srch_author':
							array_push($queries, "bk_aut.author_id = $srch_author");
							break;
						case 'srch_language':
							array_push($queries, "bk_lan.lang_id = $srch_language"); 
							break;
						case 'srch_year':
							array_push($queries, "YEAR(bk.released_at) = $srch_year"); 
							break;
						case 'srch_locations':
							array_push($queries, "bk_loc.location_id IN ($loc_qry)"); 
							break;
					}
				}
			}
			if (!empty($queries)) {
				$sql .= " WHERE ";
				$i = 1;
				foreach ($queries as $query) {
					if ($i < count($queries)) {
						$sql .= $query." AND ";
					}else{
						$sql .= $query;
					}
					$i++;
				}
			}
		}
		$sql .= " GROUP BY bk.title ASC";
		$query = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
}
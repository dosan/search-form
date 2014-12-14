<?php 
namespace libs\View;
class GetSticky{
	/**
	 * 
	 * @param array ['for','name', 'id', 'default','keyval', 'nameval', 'selectedval', 'data' => array()]
	*/
	public function __construct($case,$par, $value="", $initial=""){
		switch ($case,$par, $value="", $initial="") {
			case 1:
				if (isset($_GET[$par]) AND $_GET[$par] != "") {
					echo stripcslashes($_GET[$par]);
				}
				break;
			case 2:
				if (isset($_GET[$par]) AND $_GET[$par] == $value) {
					
				}
				break;
			default:
				# code...
				break;
		}
	}
}
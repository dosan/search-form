<?php
namespace libs\View;

class Checkbox{
	 /**
	* checkboxMulti
	* This method returns multiple checkbox elements in order given in an array
	* For checking of checkbox pass checked
	* Each checkbox should look like array(0=>array('id'=>'1', 'name'=>'cb[]', 'value'=>'x', 'label'=>'label_text' ))
	* @param array(array(id, name, value, class, checked, disabled))
	* @return string
	*/
	public function __construct($params = array()) {
		$r = "<ul class=\"{$params['class']}\">";
		foreach ($params['data'] as $k => $v) {
			$get = $params['name'].'-'.$v['id'];
			$r .= "<li>";
			if (isset($params['keyval']) AND isset($params['nameval'])) {
				$get = $params['name'].'-'.$v[$params['keyval']];
				$r .= "<input type=\"checkbox\" name=\"$get\"";
				$r .= " id=\"$get\" value=\"".$v[$params['keyval']]."\" ";
				if (isset($_GET[$params['name']]) AND $_GET[$params['name']] === $v[$params['keyval']]) {
					$r .= " checked=\"checked\"";
					unset($_GET[$params['name']]);
				}
				$r .= "/>";
				$r .= "<label for=\"{$params['id']}-".$v[$params['keyval']]."\">)".$v[$params['nameval']]."</label>\n";
			}else{
				$r .= "<input type=\"checkbox\" name=\"{$params['name']}-{$v['id']}\"";
				$r .= " id=\"$get\" value=\"{$v['id']}\" ";
				if (isset($_GET[$get]) AND $_GET[$get] === $v['id']) {
					$r .= " checked=\"checked\"";
					unset($_GET[$params['name']]);
				}
				$r .= "/>\n";
				$r .= "<label for=\"$get\">{$v['name']}</label>\n";
			}
			$r .= "</li>";
		}
		$r .= "</ul>";
		print $r;
	}

} 
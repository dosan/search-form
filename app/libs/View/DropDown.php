<?php
namespace libs\View;

class DropDown{
	/**
	 * 
	 * @param array ['name', 'id', 'default','keyval', 'nameval', 'selectedval', 'data' => array()]
	*/
	public function __construct(array $params){
		$r = "<select ";
		$r .= (isset($params['name']))  ? "name=\"{$params['name']}\" " : '';
		$r .= (isset($params['id']))    ? "id=\"{$params['id']}\" " : '';
		$r .= (isset($params['class'])) ? "class=\"{$params['class']}\" " : '';
		$r .= (isset($params['onclick'])) ? " onclick='{$params['onclick']}'" : '';
		$r .= (isset($params['width'])) ? " style='width:{$params['width']}px;'" : '';
		$r .= (isset($params['disabled'])) ? " disabled='{$params['disabled']}'" : '';
		$r .= (isset($params['style'])) ? " style='{$params['style']}'" : '';
		$r .= ">\n";
		if (isset($params['selectedval'])){
			$r .= "<option value=\"{$params['selectedval'][id]}\">".$params["selectedval"][1]."</option>\n";
			$drdata = array_search($params['selectedval'], $params['data']);
			unset($params["data"][$drdata]);
		} elseif(isset($params['default'])){
			$r .= "<option value=\"\">{$params['default']}</option>\n";
		}
		foreach ($params['data'] as $k => $v) {
			if (isset($params['keyval']) AND isset($params['nameval'])) {
				$r .= "<option value=\"".$v[$params['keyval']]."\"";
				if (isset($_GET[$params['name']]) AND $_GET[$params['name']] === $v[$params['keyval']]) {
					$r .= " selected=\"selected\"";
					unset($_GET[$params['name']]);
				}
				$r .= ">".$v[$params['nameval']]."</option>\n";
			}else{
				$r .= "<option value=\"{$v['id']}\"";
				if (isset($_GET[$params['name']]) AND $_GET[$params['name']] === $v['id']) {
					$r .= " selected=\"selected\"";
					unset($_GET[$params['name']]);
				}
				$r .= ">{$v['name']}</option>\n";
			}
		}
		$r .= "</select>";
		print $r;
	}
}
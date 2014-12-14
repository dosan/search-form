<?php
namespace libs\View;

class RadioButton{
	/**
	 * 
	 * @param array ['for','name', 'id', 'default','keyval', 'nameval', 'selectedval', 'data' => array()]
	*/
	public function __construct(array $params){
		$r = "<input type='radio' ";
		$r .= (isset($params['id']))    ? " id=\"{$params['id']}-0\" " : '';
		$r .= (isset($params['name'])) ? " name='{$params['name']}'" : '';
		$r .= " value='0'";
		$r .= (isset($params['class'])) ? " class='{$params['class']}'" : '';
		$r .= (!isset($_GET[$params['name']])) ? " checked='checked'" : '';
		$r .= " />\n";
		$r .= (isset($params['default'])) ? "<label for='{$params['id']}-0'>{$params['default']}</label>\n" : '';
		foreach ($params['data'] as $k => $v) {
			$get = $params['name'].'-'.$v['id'];
			if (isset($params['keyval']) AND isset($params['nameval'])) {
				$get = $params['name'].'-'.$v[$params['keyval']];
				$r .= "<label for=\"$get\">\n";
				$r .= "<input type=\"radio\" name=\"{$params['name']}\" id=\"$get\"";
				$r .= " value=\"".$v[$params['keyval']]."\"";
				if (isset($_GET[$params['name']]) AND $_GET[$params['name']] === $v[$params['keyval']]) {
					$r .= ' checked="checked"';
				}
				$r .= ">\n";
				$r .= $v[$params['keyval']]."</label>";
			}else{
				$r .= "<label for=\"$get\">\n";
				$r .= "<input type=\"radio\" name=\"{$params['name']}\" id=\"$get\"";
				$r .= " value=\"{$v['id']}\"";
				if (isset($_GET[$params['name']]) AND $_GET[$params['name']] === $v['id']) {
					$r .= ' checked="checked"';
				}
				$r .= ">\n";
				$r .= "{$v['name']}</label>\n";
			}
		}
		print $r;
	}
}
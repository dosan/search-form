<?php
namespace libs;
use libs\View\DropDown;
use libs\View\RadioButton;
use libs\View\Checkbox;

class View{
	public function dropdown($data){
		return new DropDown($data);
	}
	public function radiobutton($data){
		return new RadioButton($data);
	}
	public function checkbox($data){
		return new Checkbox($data);
	}
}
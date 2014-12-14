<?php

class Home extends Controller
{
	public $model;
	public function index()
	{
		$model = $this->model('BooksModel');
		//for our view
		$langs      = $model->selectAllFrom('languages');
		$authors    = $model->selectAllFrom('authors');
		$categories = $model->selectAllFrom('categories');
		$years      = $model->getYears();
		$covers     = $model->selectAllFrom('covers');
		$locations  = $model->selectAllFrom('locations');
		$search     = $model->search();
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'home'.DS.'index.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
	}
	public function selectAllLang(){
	}
}

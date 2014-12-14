<?php
use libs\View;
/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
	/**
	 * @var null Database Connection
	 */
	private $models = array();
	public $view;
	public $user_login_status = null;
	public $user_name = null;

	public $basketcountProducts = null;

	public $db = null;

	public $views_path = "app/views/";

	public $dashboard = null;

	public $shop_cats;
	/**
	 * @var $mess messages for pages
	 */
	public $mess;
	public $languages;

	public $categories_model;

	public $isUser = false;
	
	public $isAdmin = false;
	/**
	 * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
	 * that can be used by multiple models (there are frameworks that open one connection per model).
	 */
	function __construct()
	{
		$this->dbconnect();
		//проверяем корзину
		if (isset($_SESSION['basket'])) {
			$this->basketcountProducts =  count($_SESSION['basket']);
		}else{
			$_SESSION['basket'] = array();
		}
		$this->view = new View();
		if (Session::get('user_lang')) {
			$user_lang = Session::get('user_lang');
			$lang = new Lang($user_lang);
		}else{
			//get the default language, in this case 'en'
			$lang = new Lang();
		}

		$this->mess = $lang->lang;
		$this->languages = $lang->langs();
	}
	/**
	 * simple model loader
	 * @param  [string] $model [model name]
	 * @return [object]    [models object with connected to database]
	 */
	protected function model($model)
	{
		require_once 'app'.DS.'models'.DS.'MainModel.php';
		require 'app'.DS.'models'.DS. strtolower($model) . '.php';
		return new $model($this->db, $this->mess);
	}
	/**
	 * simple view loader
	 * @param  [string] $view [view name]
	 * @return [object]    [view]
	 */
	protected function view($view)
	{
		require 'app'.DS.'libs'.DS.'View'.DS.strtolower($view).'.php';
		return new $view();
	}
	/**
	 * connect to db
	 */
	private function dbconnect()
	{
		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
		
		$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
		//default charset utf8
		$this->db->exec("set names utf8");
	}
	/**
	 * check the  php version
	 * @return [type] [description]
	 */
	public function versionPhp(){
		if (version_compare(PHP_VERSION, '5.3.7', '<')) {
			exit("Sorry,Your PHP version smaller than 5.3.7 !");
		} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			return true;
		}
	}
	/**
	* Truncate string, make sure it ends in a word so assassinate doesn't become ass...
	* @param string $string for cut
	* @param integer $intLess default = 500 
	**/
	public function stringCut($string, $intLess = 500){
		if (strlen($string) > $intLess) {
			// truncate string
			$stringCut = substr($string, 0, $intLess);
			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
		}
		return $string;
		
	}
		public function loadViewTemplFolderTemplName($templateFolder, $templateName, $withOutTempl = false){
		if ($withOutTempl == false) {
			$this->loadTemplate('header');
			require "app/views/".$templateFolder."/".$templateName;
			$this->loadTemplate('sidebar');
			$this->loadTemplate('footer');
		}else{
			require "app/views/".$templateFolder."/".$templateName;
		}
	}

	public function loadTemplate($templateName)
	{
		require $this->views_path.'layouts/'.$templateName . '.php';
	}
}
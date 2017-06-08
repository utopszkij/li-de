<?php
//require_once "tests/testJoomlaFramework.php";

class temakorokModelTest extends PHPUnit_Framework_TestCase {
    function __construct() {
		global $testData,$componentName,$viewName;
		$componentName = 'com_temakorok';
		$viewName = 'temakorok';
		define('JPATH_COMPONENT', 'componens_telepitok/com_temakorok/site');
		require_once "componens_telepitok/com_temakorok/site/models/temakorok.php";
		parent::__construct();
	}
	protected function setupConfig() {
		global $testData,$componentName;
		$testData->clear();
		$testData->addDbResult(JSON_decode('{
		"id":1, 
		"szulo":0, 
		"megnevezes":"Elso-temakor" 
		}'));
	}

	public function test_getItem()  {
		global $testData,$componentName;
		$this->setupConfig();
        $model = new temakorokModelTemakorok();
        $result = $model->getItem(1);
		$this->expectEquals($result,'???');   
    }
}
?>
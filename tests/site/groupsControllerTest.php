<?php
require_once "tests/testJoomlaFramework.php";

class groupsControllerTest extends PHPUnit_Framework_TestCase {
    function __construct() {
		global $testData,$componentName,$viewName;
		$componentName = 'lide';
		$viewName = 'groups';
		define('JPATH_COMPONENT', 'componens_telepitok/com_lide/site/');
		require_once "componens_telepitok/com_lide/site/controllers/groups.php";
		parent::__construct();
	}
	protected function setupConfig() {
	}

	public function test_getItem()  {
		global $testData,$componentName;
		$this->setupConfig();
        $controller = new lideControllerGroups();
        $controller->browse();
		// $this->expectEquals($result,'123456');   
		$this->expectOutputRegex('/divGroups/');   
    }
}
?>
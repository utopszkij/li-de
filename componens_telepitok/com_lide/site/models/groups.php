<?php 
/**
* @version 1.00
* @package Joomla
* @subpackage com_lide
* @copyright	Copyright (C) 2017, Fogler Tibor. All rights reserved.
* @license #GNU/GPL
* @author Fogler Tibor
* @authorEmail tibor.fogler@gmail.com
*/
defined('_JEXEC') or die('Fatal error :(');

class lideModelGroups extends JModelLegacy {
	
	/**
	* @return array [{id,title,alias,decription,loogo},...]
	*/
	public function getItems($group, $limitStart, $order, $filter) {
		return array();
	}
	
	public function getTotal($group, $filter) {
		return 0;
	}
	
	/**
	* @return array [{title,alias},...]
	*/
	public function getOwners($group) {
		return array();
	}
	
	public function canDo($group, $user, $action, $item) {
		return true;
	}
	
	public function getItem($alias) {
		return JSON_decode('{"id":1,"title":"test group","alias":"test","description":"test group desc.","logo":"images/groups/logo.png"}');
	}
}
?>
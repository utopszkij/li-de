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
define( 'DS', DIRECTORY_SEPARATOR );

// define local vars
$input = nul;
$w = array();
$i = 0;
$task = '';
$viewName = '';
$componentName = '';
$controller = nul;
$input = JFactory::getApplication()->input;

// joomla standart init
jimport('joomla.application.component.controller');
jimport('joomla.application.component.model');
jimport('joomla.application.component.helper');

// http://domain/component/lide/viewName.task/groupAlias/disqAlias/limitStart/order.asc|desc/uri_encoded(json_encoded(filter))
// URL kezelése
$w = explode('/',$_SERVER['REQUEST_URI']);
$i = 0;
while ($i < count($w)) {
	if ($w[$i] == 'lide') {
		$input->set('option','com_lide');
		if (count($w) > ($i+1)) $input->set('task',$w[$i+1]);
		if (count($w) > ($i+2)) $input->set('group',$w[$i+2]);
		if (count($w) > ($i+3)) $input->set('disq',$w[$i+3]);
		if (count($w) > ($i+4)) $input->set('limitstart',$w[$i+4]);
		if (count($w) > ($i+5)) $input->set('order',$w[$i+5]);
		if (count($w) > ($i+6)) $input->set('filter',$w[$i+6]);
		$i = count($w); // kilép a ciklusból 	
	}
	$i = $i + 1;
}

// végrehajtandó viewname és task kiolvasása az input -bol
$task = $input->get('task','groups.browse');
$w = explode('.',$task);
if (count($w) == 2) {
  $viewName = $w[0];
  $task = $w[1];
} else {
  $viewName = 'groups';
} 

// language file betöltése
$lang = JFactory::getLanguage();
$lang->load('com_lide.'.$viewName, JPATH_SITE, $lang->getTag(), true);

// végrehajtás
$componentName = 'lideController'.ucFirst($viewName);
if (file_exists(JPATH_COMPONENT.'/controllers/'.$viewName.'.php')) { 
	include_once (JPATH_COMPONENT.'/controllers/'.$viewName.'.php');
	$controller = new $componentName ();
	$controller->$task ();
} else {
	die('Fatal error file not found:'.JPATH_COMPONENT.'/controllers/'.$viewName.'.php');
}	
?>
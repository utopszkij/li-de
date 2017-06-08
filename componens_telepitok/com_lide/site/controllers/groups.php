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


class lideControllerGroups extends JControllerLegacy {

	/**
	* inherited method JModel = getModel($modelname)
	*/
	
	/**
	* inherited method JView = getView($modelname)
	*/
	
	/**
	* task   Browse group list
	* @input string group owner group alias
	* @input integer limitstart
	* @input string order
	* @input json_encoded_object filter
	* @echo group list
	* @return void
	*/
	public function browse() {

		$input = JFactory::getApplication()->input;
		$user = JFactory::getUser();
		$view = $this->getView('groups','html'); 
		$model = $this->getModel('groups'); 
		
		$group = $input->get('group','root');
		$limitStart = $input->get('limitstart',0);
		$order = str_replace('.',' ',$input->get('order','title.ASC'));
		$filter = JSON_decode($input->get('filter','{}'));
	
		$view->set('model',$model);
		$view->set('errorMsg','');
		$view->set('owners',$model->getOwners($group));
		$view->set('limitStart',$limitStart);
		$view->set('order',$order);
		$view->set('owner',$model->getItem($group));
		$view->set('filter',$filter);
		$view->set('total',0);
		$view->set('actions',array());
		$view->set('items',array());
		if ($model->canDo($group, $user, 'browse', nul)) {
			$actions = array();
			if ($model->canDo($group, $user, 'add', nul)) {
				$actions[] = 'groups.add';
			}	
			$view->set('items',$model->getItems($group, $limitStart, $order, $filter));
			$view->set('total',$model->getTotal($group, $filter));
			$view->set('actions', $actions);
		} else {
			$view->set('errorMsg',JText::_('ACCESS_VIOLATION'));
		}
		$view->setLayout('default');
		$view->display(); 
	} // browse task

}
?>
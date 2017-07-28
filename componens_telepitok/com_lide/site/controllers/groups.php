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
	* get browser status from session / input
	* @input string group owner group
	* @input json_encodes object filter
	* @input integer limitstart
	* @input string order
	* @return object
	*/
	protected function browserGetStatus() {
		$input = JFactory::getApplication()->input;
		$session = JFactory::getSession();
		$group = $input->get('group','root');
		$status = $session->get('statusGroupsBrowse_'.$group,'');
		if ($status == '') {
			$status = new stdClass();
			$status->limitStart = 0;
			$status->order = 'title ASC';
			$status->filter = new stdClass();
			$status->filter->active = true;
			$status->filter->proporse = false;
			$status->filter->closed = false;
			$status->filter->archive = false;
		}
		$status->group = $group;
		$status->order = $input->get('order', $status->order);
		$status->order = str_replace('.',' ',$status->order);
		$status->limitStart = $input->get('limitstart', $status->limitStart);
		$s = $input->get('filter','');
		if ($s != '') $status->filter = JSON_decode($s);
		if ($filter2 == 'active') {
			$status->filter->active = true;
			$status->filter->proporse = false;
			$status->filter->closed = false;
			$status->filter->archived = false;
		}
		if ($filter2 == 'proporse') {
			$status->filter->active = false;
			$status->filter->proporse = true;
			$status->filter->closed = false;
			$status->filter->archived = false;
		}
		if ($filter2 == 'closed') {
			$status->filter->active = false;
			$status->filter->proporse = false;
			$status->filter->closed = true;
			$status->filter->archived = false;
		}
		if ($filter2 == 'archived') {
			$status->filter->active = false;
			$status->filter->proporse = false;
			$status->filter->closed = false;
			$status->filter->archived = true;
		}
		return $status;
	}
	
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
		$limit = 20; // items per page
		$input = JFactory::getApplication()->input;
		$user = JFactory::getUser();
		$session = JFactory::getSession();
		$view = $this->getView('groups','html'); 
		$model = $this->getModel('groups'); 
		$view->set('limit',$limit);
		$view->set('model',$model);
		$view->set('errorMsg','');
		$view->set('owners',array());
		$view->set('limitStart',0);
		$view->set('order','');
		$view->set('owner',new stdClass());
		$view->set('filter',new stdClass());
		$view->set('total',0);
		$view->set('actions',array());
		$view->set('items',array());
		if ($model->canDo($group, $user, 'browse', nul)) {
			$status = $this->browserGetStatus();
			$total = $model->getTotal($status->group, $status->filter);
			if (($status->limitStart * $limit) >= $total) $status->limitStart = 0;
			$items = $model->getItems($status->group, $status->limitStart, $status->order, $status->filter);
			$session->set('statusGroupsBrowse_'.$group,$status);
			$view->set('model',$model);
			$view->set('errorMsg','');
			$view->set('owners',$model->getOwners($status->group));
			$view->set('limitStart',$status->limitStart);
			$view->set('order',$status->order);
			$view->set('owner',$model->getItem($status->group));
			$view->set('filter',$status->filter);
			$view->set('total',$total);
			$view->set('actions',array());
			$view->set('items',$items);
			$actions = array();
			if ($model->canDo($status->group, $user, 'add', nul)) {
				$actions[] = 'groups.add';
			}	
			$view->set('actions', $actions);
		} else {
			$view->set('errorMsg', JText::_('ACCESS VIOLATION'));
		} // acces right		
		$view->setLayout('default');
		$view->display(); 
	} // browse task

}
?>
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

class lideViewGroups extends JViewLegacy {
  
  /**
  * inherited setLayout($tmplName)
  */
  
  /**
  * load, process and display template
  * @param string $tmpl (if not empty: tmplName = 'layout'_'tmpl'.php else tmplName = 'layout'
  * if exists 'lngCode'.'tmplName'.php then load it else load 'tmplName.php' 
  * frorm component'path or template'path
  */
  public function display($tmpl = null) {
	$currentLanguage = JFactory::getLanguage();
	$lng = $currentLanguage->getTag();
	if (file_exists(JPATH_TEMPLATE.'/html/com_lide/groups/'.$lng.'.'.$this->getLayout().'.php'))
		$this->setLayout($lng.'.'.$this->getLayout());
	else if (file_exists(JPATH_COMPONENT.'/views/groups/tmpl/'.$lng.'.'.$this->getLayout().'.php'))	
		$this->setLayout($lng.'.'.$this->getLayout());
	parent::display($tmpl);	
  }
 }

?>	

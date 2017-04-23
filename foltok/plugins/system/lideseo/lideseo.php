<?php

/**
 * domain/SU/option/view/task/temakorID/szavazasID  formátum kezelése
 * 'csoportok' option ==> 'temakorok'
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * ePrivacy system plugin
 */
class plgSystemlideseo extends JPlugin {

    function __construct($params) {
		$input = JFactory::getApplication()->input;
		if ($input->get('option') == '') {
			$s = $_SERVER['REQUEST_URI'];
			$i = strpos($s,'?');
			if ($i > 0) $s = substr($s,0,$i);
			$w = explode('/',$s);
			$i = 0;
			while ($i < count($w)) {
				if ($w[$i] == 'SU') {
					$input->set('Itemid',1); // cimoldali slideshow tiltása
					if ($w[$i+1] == 'csoportok') $w[$i+1]='temakorok';
					if ($w[$i+2] == 'csoportok') $w[$i+2]='temakorok';
					if ($w[$i+1] == 'csoportoklist') $w[$i+1]='temakoroklist';
					if ($w[$i+2] == 'csoportoklist') $w[$i+2]='temakoroklist';
					$input->set('option','com_'.$w[$i+1]);
					$input->set('view',$w[$i+2]);
					$input->set('task',$w[$i+3]);
					$input->set('temakor',$w[$i+4]);
					$input->set('szavazas',$w[$i+5]);
					$i = count($w); // kilép a ciklusból 	
				}
				$i = $i + 1;
			}
		}	
		parent::__construct($params);
	}
}
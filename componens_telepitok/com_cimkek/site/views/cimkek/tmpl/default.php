<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->cimke; ?></h3>
<div class="contentpane">
	<div><h4>Some interesting informations</h4></div>
	
	<div>
		Cimke: <?php echo $this->item->cimke; ?>
	</div>
	<div>
		Id: <?php echo $this->item->id; ?>
	</div>

</div>

<?php 
/**
* groups browse display
* @this->items array of Group_record : {id,title,alias,logo,desc}
* @this->total integer
* @this->limitStart integer
* @this->order string
* @this->filter Json_encoded object
* @this->owner Group_record
* @this->owners array of [{title,alias,...]
* @this->actions array of string
* @this->errorMsg string
*/

$currentLanguage = JFactory::getLanguage();
$currentLanguageName = $currentLanguage->getTag();

?>
<div id="divGroups">
	<form action="" method="get" name="adminForm" id="adminForm">
	<input type="hidden" name="group" value="<?php echo $this->owner->alias; ?>" />
	<input type="hidden" name="limitstart" value="<?php echo $this->limitStart; ?>" />
	<input type="hidden" name="order" value="<?php echo $this->order; ?>" />
	<input type="hidden" name="filter" value="<?php echo JSON_encode($this->filter); ?>" />

	<?php if ($this->errorMsg != '') : ?>
		<div class="errorMsg"><?php echo $this->errormsg; ?></div>
	<?php endif; ?>
	
	<div class="breadcumb">
		<?php for ($i=count($this->owners) - 1; $i >=0; $i--) : ?>
			<a href="<?php echo JURI::base()?>component/lide/groups.browse/<?php echo $this->owners[$i]->alias; ?>">
				<?php 
					if ($this->owners[$i]->title == 'root') $this->owners[$i]->title = JText::_('COM_LIDE_GROUPS_ROOT');
					echo $this->owners[$i]->title; 
				?></a>&nbsp;
			</a>	
		<?php endfor; ?>
	</div>
	
	<div class="owner">
		<a href="<?php echo JURI::base()?>component/lide/groups.browse/<?php echo $this->owner->alias; ?>">
			<h3>
				<?php echo $this->owner->title; ?>
			</h3>
		</a>
	</div>

	<h2><?php echo JText::_('COM_LIDE_GROUPS'); ?></h2>

	<ul class="ulGroups">
		<?php foreach ($this->items as $item) : ?>
			<li>
				<a href="<?php echo JURI::base()?>component/lide/groups.browse/<?php echo $item->alias; ?>"
					title="<?php echo $item->description; ?>">
					<img src="<?php echo $item->logo; ?>" />
					<label><?php echo $this->title; ?></label>
					<div class="description"><?php echo $item->description; ?></div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	
	<div class="divTotal">
	   <?php echo JText::_('TOTAL').':'.$zhis->total; ?>
	</div>
	
	<?php if (count($this->actions) > 0) : ?>
		<div class="actions">
		<?php foreach ($this->actions as $action) : ?>
			<?php if ($action == 'groups.add') : ?>
				<button type="button" class="add" onclick="goupAddClick()">
					<i class="fa fa-add">&nbsp;</i>
					<span><?php echo JText::_('COM_LIDE_GROUPS_ADD'); ?></span>
				</button>
			<?php endif; ?>	
		<?php endforeach; ?>
		</div>	
	<?php endif; ?>
	
	<div class="paginator">
	
	</div>
	
	</form>
	
	<script type="text/javascript">
		function groupAddClick() {
			document.forms.adminForm.task = 'groups.add';
			document.forms.adminForm.submit();
		}
	</script>
</div>
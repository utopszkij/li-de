<?php 
/**
* groups browse display
* @this->limit integer item/page
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
?>
<div id="divGroups">
	<form action="" method="get" name="adminForm" id="adminForm">
	<input type="hidden" name="group" value="<?php echo $this->owner->alias; ?>" />
	<input type="hidden" name="limitstart" value="<?php echo $this->limitStart; ?>" />
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

	<div class="mobile divPageSelector">
		<select name="filter1" id="filter1">
			<option value="groups" selected="selected" onclick="groupSelected()">
				<?php 
					if ($this->owner->alias == 'root')
						echo JText::_('COM_LIDE_GROUPS');
					else
						echo JText::_('COM_LIDE_SUBGROUPS');
				?>
			</option>
			<option value="disqusions"><?php echo JText::_('COM_LIDE_DISQUSIONS'); ?></option>
			<option value="polls"><?php echo JText::_('COM_LIDE_POLLS'); ?></option>
			<option value="projects"><?php echo JText::_('COM_LIDE_PROJECTS'); ?></option>
			<option value="market"><?php echo JText::_('COM_LIDE_MARKET'); ?></option>
			<option value="files"><?php echo JText::_('COM_LIDE_FILES'); ?></option>
			<option value="events"><?php echo JText::_('COM_LIDE_EVENTS'); ?></option>
			<option value="messages"><?php echo JText::_('COM_LIDE_MESSAGES'); ?></option>
		</select>
		<?php if ($this->filter->archived == false) : ?>
			<button type="button" onclick="pageClick('archive')"><?php echo JText::_('COM_LIDE_ARCHIVE'); ?></button>
		<?php else : ?>
			<var><?php echo JText::_('COM_LIDE_ARCHIVE'); ?></var>
		<?php endif; ?>
	</div>
	<div class="tablet_desctop">
		<div class="divPageSelector">
			<button type="button" onclick="pageClick('groups')" 
					disabled="disabled" class="disabled" title="<?php echo JText::_('COM_LIDE_GROUPS'); ?>">
					<i class="fa fa-group">&nbsp;</i>
					<span>
					<?php 
						if ($this->owner->alias == 'root')
							echo JText::_('COM_LIDE_GROUPS');
						else
							echo JText::_('COM_LIDE_SUBGROUPS');
					?>
					</span>
			</button>
			<button type="button" onclick="pageClick('disqusions')" title="<?php echo JText::_('COM_LIDE_DISQUSIONS'); ?>">
				<i class="fa fa-comment-o">&nbsp;</i><span><?php echo JText::_('COM_LIDE_DISQUSIONS'); ?></span>
			</button>
			<button type="button" onclick="pageClick('polls')" title="<?php echo JText::_('COM_LIDE_POLLS'); ?>">
				<i class="fa fa-sort">&nbsp;</i><span><?php echo JText::_('COM_LIDE_POLLS'); ?></span>
			</button>
			<button type="button" onclick="pageClick('projects')" title="<?php echo JText::_('COM_LIDE_PROJECTS'); ?>">
				<i class="fa fa-gears">&nbsp;</i><span><?php echo JText::_('COM_LIDE_PROJECTS'); ?></span>
			</button>
			<button type="button" onclick="pageClick('market')" title="<?php echo JText::_('COM_LIDE_MARKET'); ?>">
				<i class="fa fa-shopping-cart">&nbsp;</i><span><?php echo JText::_('COM_LIDE_MARKET'); ?></span>
			</button>
			<button type="button" onclick="pageClick('files')" title="<?php echo JText::_('COM_LIDE_FILES'); ?>">
				<i class="fa fa-files">&nbsp;</i><span><?php echo JText::_('COM_LIDE_FILES'); ?></span>
			</button>
			<button type="button" onclick="pageClick('events')" title="<?php echo JText::_('COM_LIDE_EVENTS'); ?>">
				<i class="fa fa-calendar">&nbsp;</i><span><?php echo JText::_('COM_LIDE_EVENTS'); ?></span>
			</button>
			<button type="button" onclick="pageClick('messages')" title="<?php echo JText::_('COM_LIDE_MESSAGES'); ?>">
				<i class="fa fa-envelope-o">&nbsp;</i><span><?php echo JText::_('COM_LIDE_MESSAGES'); ?></span>
			</button>
		</div>	
		<table border="0" width="80%">
		<tbody>
			<tr>
				<td class="altitle">
				<h4>
				<?php 
					if ($this->owner->alias == 'root')
						echo JText::_('COM_LIDE_GROUPS');
					else
						echo JText::_('COM_LIDE_SUBGROUPS');
				?>
				</h4>
				</td>
				<td class="divArchive">
					<?php if ($this->filter->archived == false) : ?>
						<button type="button" onclick="pageClick('archive')">
							<i class="fa fa-lock">&nbsp;</i>
							<span><?php echo JText::_('COM_LIDE_ARCHIVE'); ?></span>
						</button>
					<?php else : ?>
						<var><?php echo JText::_('COM_LIDE_ARCHIVE'); ?></var>
					<?php endif; ?>
				</td>
			</tr>	
		</tbody>
		</table>
	</div>
	
	
	<div class="divPageSelector2">
			<input type="radio" name="filter2" value="proporse"<?php if ($this->filter->proporse == true) echo ' checked="checked"'; ?> />
			<?php echo JText::_('COM_LIDE_PROPORSE'); ?>
			<input type="radio" name="filter2" value="active"<?php if ($this->filter->active == true) echo ' checked="checked"'; ?> />
			<?php echo JText::_('COM_LIDE_ACTIVE'); ?>
			<input type="radio" name="filter2" value="closed"<?php if ($this->filter->closed == true) echo ' checked="checked"'; ?> />
			<?php echo JText::_('COM_LIDE_CLOSED'); ?>
	</div>
	
	<div class="orderSelector">
		<span><?php echo JText::_('COM_LIDE_ORDER'); ?>:</span>
		<select name="order">
			<option value="title.ASC"<?php if ($this->order == 'title ASC') echo ' selected="selected"'; ?>>
				<?php echo JText::_('COM_LIDE_TITLE'); ?>
			</option>
			<option value="created.ASC"<?php if ($this->order == 'created ASC') echo ' selected="selected"'; ?>>
				<?php echo JText::_('COM_LIDE_CREATED_ASC'); ?>
			</option>
			<option value="created.DESC"<?php if ($this->order == 'created DESC') echo ' selected="selected"'; ?>>
				<?php echo JText::_('COM_LIDE_CREATED_DESC'); ?>
			</option>
			<option value="actDisqCount.DESC"<?php if ($this->order == 'actDisqCount DESC') echo ' selected="selected"'; ?>>
				<?php echo JText::_('COM_LIDE_DISQUSION_ORDER'); ?>
			</option>
			<option value="actVoksCount.DESC"<?php if ($this->order == 'actVoksCount DESC') echo ' selected="selected"'; ?>>
				<?php echo JText::_('COM_LIDE_POLL_ORDER'); ?>
			</option>
		</select>
	</div>

	<?php if (count($this->actions) > 0) : ?>
		<div class="actions">
		<?php foreach ($this->actions as $action) : ?>
			<?php if ($action == 'groups.add') : ?>
				<button type="button" class="add" onclick="goupAddClick()">
					<i class="fa fa-plus-circle">&nbsp;</i>
					<span><?php echo JText::_('COM_LIDE_GROUPS_ADD'); ?></span>
				</button>
			<?php endif; ?>	
		<?php endforeach; ?>
		</div>	
	<?php endif; ?>

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
	   <span><?php echo JText::_('COM_LIDE_TOTAL').':</span>&nbsp;<var>'.$this->total; ?></var>
	</div>
	
	<?php if ((count($this->actions) > 0) & (count($this->items) > 5)) : ?>
		<div class="actions">
		<?php foreach ($this->actions as $action) : ?>
			<?php if ($action == 'groups.add') : ?>
				<button type="button" class="add" onclick="goupAddClick()">
					<i class="fa plus-circéle"&nbsp;</i>
					<span><?php echo JText::_('COM_LIDE_GROUPS_ADD'); ?></span>
				</button>
			<?php endif; ?>	
		<?php endforeach; ?>
		</div>	
	<?php endif; ?>
	
	<?php if ($this->total > $this->limit) : ?>
	<div class="paginator">
		<span><?php echo JText::_('COM_LIDE_PAGES'); ?></span>
		<?php if ($this->limitStart > 0) : ?>
			<button type="button" onclick=""><i class="fa fa-fast-backward">&nbsp;</i><span><?php echo JText::_('COM_LIDE_FIRST');?></span></button>&nbsp;
			<button type="button" onclick=""><i class="fa fa-step-backward">&nbsp;</i><span><?php echo JText::_('COM_LIDE_PRIOR');?></span></button>&nbsp;
		<?php endif; ?>
		<select name="selPaginator" id="selPaginator">
			<?php for ($i = 0; $i < ($this->total - $this->limit); $i = $i + $this->limit) : ?>
				<option value="<?php echo $i; ?>"<?php if ($this->limitStart == $i) echo ' selected="selected"'; ?>>
					<?php echo ($i / $this->limit); ?>
				</option>
			<?php endfor; ?>
		</select>
		<?php if ($this->limitStart < ($this->total - $this->limit)) : ?>
			<button type="button" onclick=""><i class="fa fa-step-forward">&nbsp;</i><span><?php echo JText::_('COM_LIDE_NEXT');?></span></button>&nbsp;
			<button type="button" onclick=""><i class="fa fa-fast-forward">&nbsp;</i><span><?php echo JText::_('COM_LIDE_LAST');?></span></button>&nbsp;
		<?php endif; ?>
	</div>
	<?php endif; ?>
	</form>
	
	<script type="text/javascript">
		function groupAddClick() {
			document.forms.adminForm.task = 'groups.add';
			document.forms.adminForm.submit();
		}
	</script>
</div>
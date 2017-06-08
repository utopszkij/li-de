<div class="subthemePolicy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h3>Altémakör / Alcsoport beállításai</h3>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=temakorok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="subthemepolicysave" />
    <input type="hidden" name="limit" value="<?php echo JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<h4>Új altéma / alcsoport létrehozása</h4>
	<blockquote>
		<p>
		</p>
		<p>Új altéma / alcsoport létrehozását javasolhatják:</p>
		<p>
		<?php foreach ($this->subthemePolicy->ranks as $rank) : ?>
			<input type="checkbox" name="subthemeProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->subthemePolicy->subthemeProporse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>A léthrehozási javaslatot támogathatják:</p>
		<p>
		<?php foreach ($this->subthemePolicy->ranks as $rank) : ?>
			<input type="checkbox" name="subthemeEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->subthemePolicy->subthemeEndorse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>
		<select name="subthemeRule">
			<option value="10"<?php if ($this->subthemePolicy->subthemeRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->subthemePolicy->subthemeRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->subthemePolicy->subthemeRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->subthemePolicy->subthemeRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->subthemePolicy->subthemeRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->subthemePolicy->subthemeRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->subthemePolicy->subthemeRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->subthemePolicy->subthemeRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->subthemePolicy->subthemeRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
		</select> támogatottság esetén lesz az új altéma / alcsoport létrehozva.<br />
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		</p>
		<p>Közvetlenül, azonnal létrehozhatnak altémákat / alcsoportokat:</p>
		<p>
		<?php foreach ($this->subthemePolicy->ranks as $rank) : ?>
			<input type="checkbox" name="subthemeAdd[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->subthemePolicy->subthemeAdd)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		
	</blockquote>
  <center>
  <button type="submit" class="btnOK">
    Rendben
  </button>
  <button type="button" onclick="cancelClick()" class="btnCancel">
    Mégsem
  </button>
  </center>
  </form>
  </div>

<script type="text/javascript">
  function cancelClick() {
	  document.forms.adminForm.task.value="edit";
	  document.forms.adminForm.submit();
  }
</script>
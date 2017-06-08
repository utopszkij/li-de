<div class="memberPolicy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h3>Témakör / Csoport tagság beállításai</h3>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=temakorok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="memberpolicysave" />
    <input type="hidden" name="limit" value="<?php echo JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<h4>Új tag felvétele</h4>
	<blockquote>
		<p>
		<input type="checkbox" name="memberCandidate" value="1" <?php if ($this->memberPolicy->memberCandidate == 1) echo 'checked="checked"'; ?> />
		Regisztrált látogatók jelentjezhetnek tagnak
		</p>
		<p>Új tag felvételét javasolhatják:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberProporse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>A jelentkezést vagy felvételi javaslatot támogathatják:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberEndorse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>
		<select name="memberRule">
			<option value="10"<?php if ($this->memberPolicy->memberRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->memberPolicy->memberRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->memberPolicy->memberRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->memberPolicy->memberRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->memberPolicy->memberRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->memberPolicy->memberRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->memberPolicy->memberRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->memberPolicy->memberRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->memberPolicy->memberRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
		</select> támogatottság esetén lesz az új tag felvéve.
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		</p>
		<p>Közvetlenül, azonnal felvehetnek tagokat:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberAdd[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberAdd)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		
	</blockquote>
	<h4>Tag kilépése, kizárása</h4>
	<blockquote>
		<p>A tag saját maga bármikor kiléphet a csoportból - kivéve ha csak Ő a csoport egyetlen adminisztrátora.</p>
		<p>Tag kizárását javasolhatják:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberExludeProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberExludeProporse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>A kizárási javaslatot támogathatják:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberExludeEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberExludeEndorse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>
		<select name="memberExludeRule">
			<option value="10"<?php if ($this->memberPolicy->memberExludeRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->memberPolicy->memberExludeRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->memberPolicy->memberExludeRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->memberPolicy->memberExludeRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->memberPolicy->memberExludeRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->memberPolicy->memberExludeRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->memberPolicy->memberExludeRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->memberPolicy->memberExludeRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->memberPolicy->memberExludeRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
		</select> támogatottság esetén lesz a tag kizárva.
		</p>
		<p>Közvetlenül, azonnal kizárhatnak tagokat:</p>
		<p>
		<?php foreach ($this->memberPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="memberExlude[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->memberPolicy->memberExlude)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		</p>
		<p>A kizárt tagok nem jelentkezhetnek újra tagnak, de az erre jogosultak javasolhatják a visszavételüket.</p>
		<p><strong>Ha a csoportnak csak egyetlen adminisztrátora van, akkor Ő nem zárható ki a csoportból.</strong></p>
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
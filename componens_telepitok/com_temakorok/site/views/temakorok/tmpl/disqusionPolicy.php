<div class="disqusionPolicy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h3>Témakör / Csoport viták / szavazások beállításai</h3>
  <p>Ezek a csoport/témakör alaéprtelmezett vita/szavazás beállításai. Az egyes vitáknál/szavazásoknál ezek a beállítások felülbirálhatóak.</p>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=temakorok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="disqusionpolicysave" />
    <input type="hidden" name="limit" value="<?php echo JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<h4>Új vita / szavazás indítása</h4>
	<blockquote>
		<p>
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="addProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->addProporse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		Javasolhatnak új vita indítást.
		</p>
		<p>
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="addEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->addEndorse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		Támogathatják a vita indítási javaslatot.
		</p>
		<p>
		<select name="addRule">
			<option value="10"<?php if ($this->disqusionPolicy->addRule == 'egy') echo ' selected="selected"'; ?>>egy szavazat</option>
			<option value="10"<?php if ($this->disqusionPolicy->addRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->disqusionPolicy->addRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->disqusionPolicy->addRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->disqusionPolicy->addRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->disqusionPolicy->addRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->disqusionPolicy->addRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->disqusionPolicy->addRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->disqusionPolicy->addRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->disqusionPolicy->addRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
		</select> támogatottság esetén lesz az új vita megnyitva.
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		</p>
		<p>
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="add[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->add)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		Azonnal indíthatnak vitákat.
		</p>
	</blockquote>

	<h4>Vita / szavazás adatainak, beállításainak módosítása</h4>
	<p>(Beleértve az alternatívák módosítását és törlését is)</p>
	<blockquote>
		<p>
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="edit[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->edit)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		<input type="checkbox" name="edit[]" value="Létrehozó"<?php if (in_array('Létrehozó',$this->disqusionPolicy->aedit)) echo ' checked="checked"';?> /> 
			&nbsp;Létrehozó<br />
		Módisthatnak a vita / szavazás adatain, beállításain.
		</p>
		<p><strong>Módosítás csak a vita szakaszban megengedett.</strong></p>
	</blockquote>

	<h4>Vita, Szavazás, új alternatívák javaslása</h4>
	<blockquote>
		<p>
		<input type="checkbox" name="comment[]" value="Látogatók"<?php if (in_array('Látogatók',$this->disqusionPolicy->comment)) echo ' checked="checked"';?> /> 
			&nbsp;Látogatók<br />
		<input type="checkbox" name="comment[]" value="Regisztráltak"<?php if (in_array('Regisztráltak',$this->disqusionPolicy->comment)) echo ' checked="checked"';?> /> 
			&nbsp;Regisztráltak<br />
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="comment[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->comment)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		<input type="checkbox" name="comment[]" value="Létrehozó"<?php if (in_array('Létrehozó',$this->disqusionPolicy->comment)) echo ' checked="checked"';?> /> 
			&nbsp;Létrehozó<br />
		Vehetnek részt a vitában.
		</p>
		<p>
		<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="voks[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->voks)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		<input type="checkbox" name="voks[]" value="Létrehozó"<?php if (in_array('Létrehozó',$this->disqusionPolicy->voks)) echo ' checked="checked"';?> /> 
			&nbsp;Létrehozó<br />
		Javasolhatnak új alternatívákat és szavazhatnak.
		</p>

	</blockquote>

	<h4>vita hossza, lezárása; szavazás indítása, szavazás hossza</h4>
	<blockquote>
		<p>
			Vita maximális hossza:<input type="text" name="disqusionTime" value="<?php echo $this->disqusionPolicy->disqusionTime; ?>" />&nbsp;nap
		</p>
		<p>
			<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
				<input type="checkbox" name="voksProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->voksProporse)) echo ' checked="checked"';?> /> 
				&nbsp;<?php echo $rank; ?><br />
			<?php endforeach; ?>
			<input type="checkbox" name="voksProporse[]" value="Létrehozó"<?php if (in_array('Létrehozó',$this->disqusionPolicy->voksProporse)) echo ' checked="checked"';?> /> 
				&nbsp;Létrehozó<br />
			Javasolhatják a vita lezárását és a szavazás megindítását.
		</p>
		<p>
			<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
				<input type="checkbox" name="voksEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->voksEndorse)) echo ' checked="checked"';?> /> 
				&nbsp;<?php echo $rank; ?><br />
			<?php endforeach; ?>
			<input type="checkbox" name="voksEndorse[]" value="Létrehozó"<?php if (in_array('Létrehozó',$this->disqusionPolicy->voksEndorse)) echo ' checked="checked"';?> /> 
				&nbsp;Létrehozó<br />
			Támogathatják a vita lezáró és a szavazás megindító javaslatot.
		</p>
		<p>
		<select name="voksRule">
			<option value="10"<?php if ($this->disqusionPolicy->voksRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->disqusionPolicy->voksRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->disqusionPolicy->voksRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->disqusionPolicy->voksRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->disqusionPolicy->voksRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->disqusionPolicy->voksRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->disqusionPolicy->voksRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->disqusionPolicy->voksRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->disqusionPolicy->voksRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
			<option value="nonewalt"<?php if ($this->disqusionPolicy->voksRule == 'nonewalt') echo ' selected="selected"'; ?>>
			   "10 napig nincs új alternatíva javaslat" 
			</option>
			
		</select> támogatottság esetén lesz a vita lezárva és a szavazás megindítva.
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		</p>
		<p>
			<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
				<input type="checkbox" name="voksStart[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->voksStart)) echo ' checked="checked"';?> /> 
				&nbsp;<?php echo $rank; ?><br />
			<?php endforeach; ?>
			Azonnal lezárhatják a vitát és indithatják a szavazást.
		</p>
		<p>
			Szavazás hossza:<input type="text" name="voksTime" value="<?php echo $this->disqusionPolicy->voksTime; ?>" />&nbsp;nap
		</p>
	</blockquote>

	<h4>A szavazás érvényes</h4>
	<blockquote>
		<p>
		<select name="valid">
			<option value="10"<?php if ($this->disqusionPolicy->valid == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->disqusionPolicy->valid == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->disqusionPolicy->valid == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->disqusionPolicy->valid == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->disqusionPolicy->valid == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->disqusionPolicy->valid == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->disqusionPolicy->valid == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->disqusionPolicy->valid == '100') echo ' selected="selected"'; ?>>100%</option>
		</select> leadott szavazat esetén.
		</p>
	</blockquote>

	<h4>Vita megszakítása szavazás nélkül</h4>
	<blockquote>
		<p>
			<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
				<input type="checkbox" name="cancel[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->cancel)) echo ' checked="checked"';?> /> 
				&nbsp;<?php echo $rank; ?><br />
			<?php endforeach; ?>
			Megszakíthatják a vitát szavazás nélkül is. (ilyenkor további kommenteket már nem lehet írni).
			Ugyanők a megszakított vitákat újra nyithatják.
		</p>
	</blockquote>

	<h4>Vita / szavazás archiválása</h4>
	<p>A lezárult szavazások, megszakított viták <input type="text" name="archiveRule" value="<?php echo $this->disqusionPolicy->archiveRule; ?>" />
	 nap után automatikusan átjerülnek az "archivált" területre (ha nulla akkor nincs automatikus archiválás).
	</p>
	<p>Az adminisztrátorok a lezárt szavazásokat, megszakított vitákat áthelyezhetik az "aktív" területről az "archívált" területre.
	Az archivált vitákat / szavazásokat vissza hozhatják az éles területre.</p>
	
	<h4>Törlés</h4>
	<blockquote>
			<?php foreach ($this->disqusionPolicy->ranks as $rank) : ?>
				<input type="checkbox" name="remove[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->disqusionPolicy->remove)) echo ' checked="checked"';?> /> 
				&nbsp;<?php echo $rank; ?><br />
			<?php endforeach; ?>
			véglegesen törölhetik az archivált, lezárt vagy megszakított vitákat szavazásokat. Ez minden hozzá tartozó adat (kommentek, 
			alternatívák, szavazatok) törlését is jelenti.
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
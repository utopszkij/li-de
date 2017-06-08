<div class="basicPolicy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h3>Témakör / Csoport alap beállításai</h3>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=temakorok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="basicpolicysave" />
    <input type="hidden" name="limit" value="<?php echo JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<h4>Csoport tipus</h4>
	<blockquote>
		<input type="radio" name="groupType" value="1" <?php if ($this->basicPolicy->groupType == 1) echo 'checked="checked"'; ?> />
		Formális csoport <br />
		<input type="radio" name="groupType" value="0" <?php if ($this->basicPolicy->groupType == 0) echo 'checked="checked"'; ?> />
		Informális csoport <br />
		<i>
		Formális csoportok: Rögzitett szervezeti struktúrával, alapszabályzat szerint müködő szervezetek pl. pártok, egyesületek, gazdálodó szervezetek<br />
		Informális csoportok: Kötetlen formában müködő csoportok
		</i>
	</blockquote>
	<h4>Maximális csoport létszám</h4>
	<blockquote>
		Maximális csoport létszám: <input type="text" name="groupMemberLimit" value="<?php echo $this->basicPolicy->groupMemberLimit; ?>" style="width:40px" />
		<i>Ha csoport létszáma eléri ezt a számot, akkor újabb tag a csoportba nem jelentkezhet / nem vehető fel. (ha nulla akkor nincs limit)</i><br />
		<input type="checkbox" name="autoGroupSplit" value="1" <?php if ($this->basicPolicy->autoGroupSplit == 1) echo 'checked="checked"'; ?> />
		A létszám limit elérésekor a csoport automatikusan két alcsoportra oszlik, a tagok véletlenszerű szétosztásával.
	</blockquote>
	<h4>Csoport lezárás, archiválás</h4>
	<blockquote>
		<p>A csoport lezárását<br />
		<?php foreach ($this->basicPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="groupCloseProporse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->basicPolicy->groupCloseProporse)) echo ' checked="checked"';?> /> 
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		javasolhatják.
		</p>
		<p>A lezárási javaslatot<br />
		<?php foreach ($this->basicPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="groupCloseEndorse[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->basicPolicy->groupCloseEndorse)) echo ' checked="checked"'; ?> />
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		támogathatják.
		</p>
		<p>
		<select name="groupCloseRule">
			<option value="10"<?php if ($this->basicPolicy->groupCloseRule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
			<option value="20"<?php if ($this->basicPolicy->groupCloseRule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
			<option value="33"<?php if ($this->basicPolicy->groupCloseRule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
			<option value="50"<?php if ($this->basicPolicy->groupCloseRule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
			<option value="66"<?php if ($this->basicPolicy->groupCloseRule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
			<option value="80"<?php if ($this->basicPolicy->groupCloseRule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
			<option value="90"<?php if ($this->basicPolicy->groupCloseRule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
			<option value="100"<?php if ($this->basicPolicy->groupCloseRule == '100') echo ' selected="selected"'; ?>>100%</option>
			<option value="debian"<?php if ($this->basicPolicy->groupCloseRule == 'debian') echo ' selected="selected"'; ?>>
			   "Debián" feltétel
			</option>
		</select> támogatottság esetén lesz a csoport lezárva.
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		</p>
		<p>
		Az adminisztrátorok a csoportot azonnal lezárhatják. <br />
		Az adminisztrátorok a lezárt és még nem archivált csoportot újra nyithatják. <br />
		<i>A lezárt csoportba új tag nem jelentkezhet, nem vehető fel, abban új vita már nem indítható, kommentelni nem lehet.</i><br />
		A lezárt csoport a lezárást követő
		<input type="text" name="groupArchiveDay" value="<?php echo $this->basicPolicy->groupArchiveDay; ?>" style="width:50px" /> 
		nap mulva az "aktív" oldalról automatikusan átkerül az "archiváltak" oldalra (ha nulla akkor nincs automatikus archiválás).<br />
		Adminisztrátorok lezárt csoportot azonnal archiválhatnak, archivumbol az aktív oldalra visszatehetnek.
		</p>
	</blockquote>
	<h4>Témakor / csoport adatainak és beállításainak modosítása</h4>
	<blockquote>
		<p>
		<?php foreach ($this->basicPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="edit[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->basicPolicy->edit)) echo ' checked="checked"'; ?> />
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		módosíthatják az adatokat és a beállításokat.
		</p>
	</blockquote>
	<h4>Témakor / csoport végleges törlése</h4>
	<blockquote>
		<p>
		<?php foreach ($this->basicPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="remove[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->basicPolicy->remove)) echo ' checked="checked"'; ?> />
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		véglegesen törölhetik a lezárt és archivált témaköröket / csoportokat. 
		Ilyenkor a hozzá tartozó minden adat (altéma, vita, szavazás, komment stb) is törlődik.
		</p>
	</blockquote>
	<h4>Kommentelési beállítások</h4>	
	<blockquote>
		</p>
		<p>A témakörben / csoportban<br />
		<input type="checkbox" name="groupComment[]" value="Látógatók"<?php if (in_array('Látógatók',$this->basicPolicy->groupComment)) echo ' checked="checked"'; ?> />
		&nbsp;Látogatók<br />
		<input type="checkbox" name="groupComment[]" value="Regisztráltak"<?php if (in_array('Regisztráltak',$this->basicPolicy->groupComment)) echo ' checked="checked"'; ?> />
		&nbsp;Regisztráltak<br />
		<?php foreach ($this->basicPolicy->ranks as $rank) : ?>
			<input type="checkbox" name="groupComment[]" value="<?php echo $rank; ?>"<?php if (in_array($rank,$this->basicPolicy->groupComment)) echo ' checked="checked"'; ?> />
			&nbsp;<?php echo $rank; ?><br />
		<?php endforeach; ?>
		irhatnak kommenteket.
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
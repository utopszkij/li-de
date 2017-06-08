<div class="ranksPolicy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h3>Tisztségviselők beállításai</h3>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=temakorok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="rankspolicysave" />
    <input type="hidden" name="limit" value="JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	
	<table border="0">
		<thead>
			<tr>
				<th>Megnevezés</th>
				<th>Létszám</th>
				<th>Mandátum hossza [év]</th>
				<th>Visszahívási feltétel</th>
			</tr>
		</thead>
		<tbody>
		<?php for ($i = 0; $i < 10; $i++) : ?>
			<?php 
			$rank = new stdClass();
			$rank->name = '';
			$rank->rankCount = 0;
			$rank->interval = 0;
			$rank->rule = '50';
			if ($i < count($this->ranksPolicy)) {
				if ($this->ranksPolicy[$i]->name != '')
					$rank = $this->ranksPolicy[$i];
			}
			?>
			<tr>
				<td>
					<?php if (($rank->name != 'Tagok') & ($rank->name != 'Adminisztrátorok')) :?>
						<input type="text" name="rankName[]" value="<?php echo $rank->name; ?>" style="width:200px" />
					<?php else : ?>
						<input type="hidden" name="rankName[]" value="<?php echo $rank->name; ?>" style="width:200px" />
						<?php echo $rank->name; ?>
					<?php endif; ?>	
				</td>
				<td>
					<?php if ($rank->name != 'Tagok') :?>
						<input type="text" name="rankCount[]" value="<?php echo $rank->rankCount; ?>" style="width:30px" />
					<?php else : ?>
						<input type="hidden" name="rankCount[]" value="0" style="width:30px" />
						---
					<?php endif; ?>	
				</td>
				<td>
					<?php if ($rank->name != 'Tagok') :?>
						<input type="text" name="rankInterval[]" value="<?php echo $rank->interval; ?>" style="width:30px" />
					<?php else : ?>
						<input type="hidden" name="rankInterval[]" value="0" style="width:30px" />
						---
					<?php endif; ?>		
				</td>
				<td>
					<?php if ($rank->name != 'Tagok') : ?>
						<select name="rankRule[]">
							<option value="0"<?php if ($rank->rule == '0') echo ' selected="selected"'; ?>>Nincs</option>
							<option value="10"<?php if ($rank->rule == '10') echo ' selected="selected"'; ?>>10% + 1</option>
							<option value="20"<?php if ($rank->rule == '20') echo ' selected="selected"'; ?>>20% + 1</option>
							<option value="33"<?php if ($rank->rule == '33') echo ' selected="selected"'; ?>>33% + 1</option>
							<option value="50"<?php if ($rank->rule == '50') echo ' selected="selected"'; ?>>50% + 1</option>
							<option value="66"<?php if ($rank->rule == '66') echo ' selected="selected"'; ?>>66% + 1</option>
							<option value="80"<?php if ($rank->rule == '80') echo ' selected="selected"'; ?>>80% + 1</option>
							<option value="90"<?php if ($rank->rule == '90') echo ' selected="selected"'; ?>>90% + 1</option>
							<option value="100"<?php if ($rank->rule == '100') echo ' selected="selected"'; ?>>100%</option>
							<option value="debian"<?php if ($rank->rule == 'debian') echo ' selected="selected"'; ?>>
							   "Debián" feltétel
							</option>
						</select>				
					<?php else : ?>
						<input type="hidden" name="rankRule[]" value="0" style="width:30px" />
						Nincs
					<?php endif; ?>		
				</td>
			</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<p>A tisztségviselő bármikor lemondhat - kivéve ha Ő az egyetlen adminisztrátor; ekkor az adminisztrátor tisztségéről nem mondhat le.</p>
	<p>A tisztségviselők visszahívását a tagok javasolhatják, a visszahivási javaslatot a tagok támogathatják. A "Feltétel" oszlopban megadott 
	támogatottság esetén kerül a tisztségviselő visszahívásra.</p>
	<p>Ha a csoportban betöltetlen tisztség van; akkor automatikusan elindul a tisztségviselő választás.</p>
	<p><strong>Ha a csoportnak csak egy adminisztrátora van az nem hívható vissza.</strong></p>
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
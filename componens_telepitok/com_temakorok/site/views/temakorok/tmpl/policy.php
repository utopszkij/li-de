<?php
// témakör beállítások (müködési szabályzat) megjelenitése
//DBG echo JSON_encode($this->policy).'íbr /><br />';
$this->basicPolicy = $this->policy->basicPolicy;
$this->memberPolicy = $this->policy->memberPolicy;
$this->ranksPolicy = $this->policy->ranksPolicy;
$this->subthemePolicy = $this->policy->subthemePolicy;
$this->disqusionPolicy = $this->policy->disqusionPolicy;
//DBG echo JSON_encode($this->disqusionPolicy);
?>
<div class="Policy">
  <h2><?php echo $this->temakor->megnevezes; ?></h2>
  <h2>Müködési szabályzat</h2>
  <form name="adminForm" method="post" action="<?php echo JURI::base();?>index.php?option=com_temakorok&view=szavazasok">
	<input type="hidden" name="temakor" value="<?php echo $this->temakor->id; ?>" />
	<input type="hidden" name="task" value="list" />
    <input type="hidden" name="limit" value="<?php echo JRequest::getVar('limit'); ?>" />
    <input type="hidden" name="limitstart" value="<?php echo JRequest::getVar('limitstart'); ?>" />
    <input type="hidden" name="order" value="<?php echo JRequest::getVar('order'); ?>" />
    <input type="hidden" name="filterStr" value="<?php echo JRequest::getVar('filterStr'); ?>" />
    <input type="hidden" name="itemId" value="<?php echo JRequest::getVar('itemId'); ?>" />
    <input type="hidden" name="id" value="<?php echo $this->temakor->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	<h3>Általános szabályok, beállítások</h3>
	<h4>Csoport tipus</h4>
	<ul>
		<li>
		<?php if ($this->basicPolicy->groupType == 1) 
		   echo 'Formális csoport';
		else
		   echo 'Informális csoport';
	    ?>
		</li>
	</ul>
	<h4>Maximális csoport létszám</h4>
	<ul>
		<li>
		<?php if ($this->basicPolicy->groupMemberLimit > 0) : ?>
			Maximális csoport létszám: <?php echo $this->basicPolicy->groupMemberLimit; ?>&nbsp;
			<i>Ha csoport létszáma eléri ezt a számot, akkor újabb tag a csoportba nem jelentkezhet / nem vehető fel. </i><br />
		<?php else : ?>
			Maximális csoport létszám nincs meghatározva.
		</li>	
		<?php endif; ?>
		<?php if ($this->basicPolicy->autoGroupSplit == 1) : ?>
			<li>A létszám limit elérésekor a csoport automatikusan két alcsoportra oszlik, a tagok véletlenszerű szétosztásával.</li>
		<?php endif; ?>	
	</ul>
	<h4>Csoport lezárás, archiválás</h4>
	<ul>
		<?php if (count($this->basicPolicy->groupCloseProporse) > 0) {  
				echo '<li>A csoport lezárását<br />'.implode(',',$this->basicPolicy->groupCloseProporse).' javasolhatják.</li>';  
				echo '<li>A lezárási javaslatot<br >'.implode(',',$this->basicPolicy->groupCloseEndorse).' támogathatják</li>';  
				if ($this->basicPolicy->groupCloseRule == 'debian') 
					echo '<li>Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else
					echo '<li>'.$this->basicPolicy->groupCloseRule.'%';
				echo ' támogatottság esetén lesz a csoport lezárva.</li>';
			  } else {
				echo '<li>Csoport lezárást senki nem javasolhat.</li>';
			  }
		?>
		<li>Az adminisztrátorok a csoportot azonnal lezárhatják.</li>
		<li>Az adminisztrátorok a lezárt és még nem archivált csoportot újra nyithatják.</li>
		<li>A lezárt csoportba új tag nem jelentkezhet, nem vehető fel, abban új vita már nem indítható, kommentelni nem lehet.</li>
		<?php if ($this->basicPolicy->groupArchiveDay > 0)
			echo '<li>A lezárt csoport a lezárást követő ';
			echo $this->basicPolicy->groupArchiveDay.' nap mulva az "aktív" oldalról automatikusan átkerül az "archiváltak" oldalra.</li>';
		?>
		<li>Adminisztrátorok lezárt csoportot azonnal archiválhatnak, archivumbol az aktív oldalra visszatehetnek.</li>
	</ul>
	<h4>Témakor / csoport adatainak és beállításainak modosítása</h4>
	<ul>
		<li>
		<?php if (count($this->basicPolicy->edit) > 0) 
				echo implode(',',$this->basicPolicy->edit).' módosíthatják az adatokat és a beállításokat.';  
			  else
				echo 'A csoport adatai nem modosíthatóak.';  
		?>
		</li>
	</ul>
	<h4>Témakor / csoport végleges törlése</h4>
	<ul>
		<?php if (count($this->basicPolicy->remove) > 0) {
				echo '<li>'.implode(',',$this->basicPolicy->remove).' véglegesen törölhetik a lezárt és archivált témaköröket / csoportokat.</li>';  
				echo '<li>Ilyenkor a hozzá tartozó minden adat (altéma, vita, szavazás, komment stb) is törlődik.</li>';
			  } else {
				echo '<li>Nem törölhető.</li>';  
			  }	
		?>
	</ul>
	<h4>Kommentelési beállítások</h4>	
	<ul>
		<li>A témakörben / csoportban<br />
		<?php if (count($this->basicPolicy->groupComment) > 0)
				echo implode(',',$this->basicPolicy->groupComment).' irhatnak kommenteket.';  
			  else
				echo 'kommentelni nem lehet.';  
		?>
		</li>
		<li>A kommenteket az adminisztrátorok moderálhatják.</li>
	</ul>

	<h3>Témakör / Csoport tagságra vonatkozó szabályok</h3>
	<h4>Új tag felvétele</h4>
	<ul>
		<?php if ($this->memberPolicy->memberCandidate == 1) : ?>
			<li>Regisztrált látogatók jelentkzhetnek tagnak.</li>
		<?php endif; ?>
		<?php if(count($this->memberPolicy->memberProporse) > 0) : ?>
			<li>Új tag felvételét <?php  echo implode(',',$this->memberPolicy->memberProporse); ?> javasolhatják.</li>
			<li>A jelentkezést, felvételi javaslatot <?php  echo implode(',',$this->memberPolicy->memberEndorse); ?> támogathatják.</li>
			<li><?php 
				if ($this->memberPolicy->memberRule == 'debian')
					echo 'Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else	
					echo $this->memberPolicy->memberRule.'%';
				?>	
				támogatottság esetén lesz az új tag felvéve.
			</li>	
		<?php endif; ?>
		<?php if ($this->memberPolicy->memberRule == 'debian') : ?>
		&nbsp;&nbsp;<i>(Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2)
		<?php endif; ?>
		<?php if(count($this->memberPolicy->memberAdd) > 0) : ?>
			<li><?php echo implode(',',$this->memberPolicy->memberAdd); ?> közvetlenül, azonnal felvehetnek tagokat.</li>
		<?php endif; ?>
	</ul>
	<h4>Tag kilépése, kizárása</h4>
	<ul>
		<li>A tag saját maga bármikor kiléphet a csoportból - kivéve ha csak Ő a csoport egyetlen adminisztrátora.</li>
		<?php if(count($this->memberPolicy->memberExludeProporse) > 0) : ?>
			<li><?php echo implode(',',$this->memberPolicy->memberExludeProporse); ?> javasolhatják tag kizárását.</li>
			<li><?php echo implode(',',$this->memberPolicy->memberExludeEndorse); ?> támogathatják a kizárási javaslatot.</li>
			<li><?php 
				if ($this->memberPolicy->memberExludeRule == 'debian')
					echo 'Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else	
					echo $this->memberPolicy->memberExludeRule.'%';
				?>	
				támogatottság esetén lesz a tag kizárva.
			</li>	
		<?php endif; ?>
		<?php if(count($this->memberPolicy->memberExclude) > 0) : ?>
			<li><?php echo implode(',',$this->memberPolicy->memberExlude); ?> közvetlenül, azonnal kizárhatnak tagokat.</li>
		<?php endif; ?>
		<li>A kizárt tagok nem jelentkezhetnek újra tagnak, de az erre jogosultak javasolhatják a visszavételüket.</li>
		<li><strong>Ha a csoportnak csak egyetlen adminisztrátora van, akkor Ő nem zárható ki a csoportból.</strong></li>
	</ul>

  <h3>Tisztségviselőkre vonatkozó szabályok</h3>
	<blockquote>
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
				if ($rank->rule != 'debian') $rank->rule .= '%';
				if ($rank->interval == 0) $rank->interval = 'határozatlan';
			}
			if (($rank->name != 'Tagok') & ($rank->name != '')) {
				echo '<tr>
				  <td>'.$rank->name.'</td>
				  <td>'.$rank->rankCount.'</td>
				  <td>'.$rank->interval.'</td>
				  <td>'.$rank->rule.'</td>
				</tr>
				';
				
			}
			?>
		<?php endfor; ?>
		</tbody>
	</table>
	</blockquote>
	<ul>
		<li>A tisztségviselő bármikor lemondhat - kivéve ha Ő az egyetlen adminisztrátor; ekkor az adminisztrátor tisztségéről nem mondhat le.</li>
		<li>A tisztségviselők visszahívását a tagok javasolhatják, a visszahivási javaslatot a tagok támogathatják. A "Feltétel" oszlopban megadott 
		támogatottság esetén kerül a tisztségviselő visszahívásra.</li>
		<li>Ha a csoportban betöltetlen tisztség van; akkor automatikusan elindul a tisztségviselő választási vita és szavazás.</li>
		<li><strong>Ha a csoportnak csak egy adminisztrátora van az nem hívható vissza.</strong></li>
	</ul>

  <h3>Altémakör / Alcsoport kezelési szabályok</h3>
  
	<h4>Új altéma / alcsoport létrehozása</h4>
	<ul>
		<?php if(count($this->subthemePolicy->subthemeProporse) > 0) : ?>
			<li><?php echo implode(',',$this->subthemePolicy->subthemeProporse); ?> javasolhatják új alcsoport/altéma létrehozását.</li>
			<li><?php echo implode(',',$this->subthemePolicy->subthemeEndorse); ?> támogathatják a javaslatot.</li>
			<li><?php 
				if ($this->subthemePolicy->subthemeRule == 'debian')
					echo 'Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else	
					echo $this->subthemePolicy->subthemeRule.'%';
				?>	
				támogatottság esetén lesz az alcsoport/altéma létrehozva.
			</li>	
		<?php endif; ?>
		<?php if(count($this->subthemePolicy->subthemeAdd) > 0) : ?>
			<li><?php echo implode(',',$this->subthemePolicy->subthemeAdd); ?> közvetlenül, azonnal létrehozhatnak alcsoportokat/altémákat.</li>
		<?php endif; ?>	
	</ul>
	
	<h3>Vitákra / szavazásokra vonatkozó szabályok</h3>
	<p>Ezek a csoport/témakör alaéprtelmezett vita/szavazás szabályai. Az egyes vitáknál/szavazásoknál ezek a szabályok felülbirálhatóak.</p>
	<h4>Új vita / szavazás indítása</h4>
	<ul>
		<?php if(count($this->disqusionPolicy->addProporse) > 0) : ?>
			<li><?php echo implode(',',$this->disqusionPolicy->addProporse); ?> javasolhatják új vita inditását.</li>
			<li><?php echo implode(',',$this->disqusionPolicy->addEndorse); ?> támogathatják a javaslatot.</li>
			<li><?php 
				if ($this->disqusionPolicy->addRule == 'debian')
					echo 'Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else	
					echo $this->disqusionPolicy->addRule.'%';
				?>	
				támogatottság esetén lesz a vita elinditva.
			</li>	
		<?php endif; ?>
		<?php if (count($this->disqusionPolicy->add) > 0) : ?>
			<li><?php echo implode(',',$this->disqusionPolicy->add); ?> közvetlenül, azonnal indithatnak vitákat.</li>
		<?php endif; ?>	
	</ul>

	<h4>Vita / szavazás adatainak, beállításainak módosítása</h4>
	<p>(Beleértve az alternatívák módosítását és törlését is)</p>
	<ul>
	<?php if (count($this->disqusionPolicy->edit) > 0) : ?>
		<li><?php echo implode(',',$this->disqusionPolicy->edit); ?> módisthatnak a vita / szavazás adatain, beállításain.</li>
		<li><strong>Módosítás csak a vita szakaszban lehetséges.</strong></li>
	<?php else : ?>
		<li>A vita / szavazás adatai nem módosíthatóak</li>
	<?php endif; ?>
	</ul>

	<h4>Vita, Szavazás, új alternatívák javaslása</h4>
	<ul>
		<li><?php echo implode(',',$this->disqusionPolicy->comment); ?> vehetnek részt a vitában.</li>
		<li><?php echo implode(',',$this->disqusionPolicy->voks); ?> javasolhatnak alternatív megoldásokat, szavazhatnak.</li>
	</ul>

	<h4>Vita hossza, vita lezárása, szavazás indítása, szavazás hossza</h4>
	<ul>
		<li>
			Vita maximális hossza:<?php echo $this->disqusionPolicy->disqusionTime; ?>&nbsp;nap
		</li>
		<?php if (count($this->disqusionPolicy->voksProprse) > 0) : ?>
			<li><?php echo implode(',',$this->disqusionPolicy->voksProprse); ?> javasolhatnak a vita lezárását és a szavazás inditását.</li>
			<li><?php echo implode(',',$this->disqusionPolicy->voksEndorse); ?> támogathatják a javaslatot.</li>
			<li><?php 
				if ($this->disqusionPolicy->voksRule == 'debian')
					echo 'Debián feltétel:</i>&radic;<span style="text-decoration: overline;">Létszám</span>&nbsp;/&nbsp;2';
				else	
					echo $this->disqusionPolicy->voksRule.'%';
				?>	
				támogatottság esetén lesz a vita lezárva és a szavazás elinditva.
			</li>	
		<?php endif; ?>
		<?php if (count($this->disqusionPolicy->voksStart) > 0) : ?>
			<li><?php echo implode(',',$this->disqusionPolicy->voksStart); ?> közvetlenül, azonnal lezárhatják a vitát és indithatják a szavazást.</li>
		<?php endif; ?>
		<li>
			Szavazás hossza:<?php echo $this->disqusionPolicy->voksTime; ?>&nbsp;nap
		</li>
	</ul>

	<h4>A szavazás érvényes</h4>
	<ul>
		<li><?php
			if (($this->disqusionPolicy->valid != 'debian') & ($this->disqusionPolicy->valid != 'egy'))
				echo $this->disqusionPolicy->valid.'%';
			else
				echo $this->disqusionPolicy->valid;
			?> leadott szavazat esetén.
		</li>
	</ul>

	<h4>Vita megszakítása szavazás nélkül</h4>
	<ul>
		<?php if (count($this->disqusionPolicy->cancel) > 0) : ?>
		<li><?php echo implode(',',$this->disqusionPolicy->cancel); ?>&nbsp;
			Megszakíthatják a vitát szavazás nélkül is. (ilyenkor további kommenteket már nem lehet írni).
			Ugyanők a megszakított vitákat újra nyithatják.
		</li>
		<?php else : ?>
			<li>A vita szavazás nélkül nem szakítható meg.</li>
		<?php endif; ?>
	</ul>

	<h4>Vita / szavazás archiválása</h4>
	<ul>
		<?php if ($this->disqusionPolicy->archiveRule > 0) : ?>
		<li>A lezárult szavazások, megszakított viták <?php echo $this->disqusionPolicy->archiveRule; ?> nap után automatikusan
		átjerülnek az "archivált" területre. 
		</li>
		<?php endif; ?>
		<li>Az adminisztrátorok a lezárt szavazásokat, megszakított vitákat áthelyezhetik az "aktív" területről az "archívált" területre.
	Az archivált vitákat / szavazásokat vissza hozhatják az éles területre.</li>
	</ul>
	
	<h4>Törlés</h4>
	<ul>
		<?php if (count($this->disqusionPolicy->remove) > 0) : ?>
		<li><?php echo implode(',',$this->disqusionPolicy->remove); ?>&nbsp;
			véglegesen törölhetik az archivált, lezárt vagy megszakított vitákat szavazásokat. Ez minden hozzá tartozó adat (kommentek, 
			alternatívák, szavazatok) törlését is jelenti.
		</li>
		<?php else : ?>
		<li>Vita, szavazás törlés nem megengedett.</li>
		<?php endif; ?>
	</ul>
	
	
  <center>
  <button type="submit" class="btnOK">
    Rendben
  </button>
  </center>
  </form>
  </div>

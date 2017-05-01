<?php
/**
 * témakör böngésző képernyő
 * bemenet:
 * $this->Items
 *      ->Akciok      [name=>link,...]
 *      ->Kepviselok  [kepviselojeLink=>link, kepviselojeloltLink=>link,.....]
 *      ->reorderLink
 *      ->dofilterLink
 *      ->itemLink
 *      ->Lapozosor
 *  Jrequest:  filterStr             
 */ 
// no direct access
defined('_JEXEC') or die('Restricted access');

// segéd fubction a th order -függő szinezéséhez
function thClass($col) {
  if (JRequest::getVar('order')==$col)
    $result = 'thOrdering';
  else
    $result = 'th';
  return $result;  
}


echo '
<div class="componentheading'.$this->escape($this->params->get('pageclass_sfx')).'">
<h2>'.Jtext::_('TEMAKOROK').'</h2></div>
<div class="kepviselo">
';
      if ($this->Kepviselo['kepviselojeLink'] != '') {
        echo '<a class="btnKepviselo" href="'.$this->Kepviselo['kepviselojeLink'].'">
             '.$this->Kepviselo['image'].'
             <br />'.$this->Kepviselo['nev'].'
             <br />'.JText::_('GLOBALISKEPVISELO').'
             </a>
             ';
      }
      if ($this->Kepviselo['kepviseloJeloltLink'] != '') {
        echo '<a class="akcioGomb btnJelolt" href="'.$this->Kepviselo['kepviseloJeloltLink'].'">
              '.JText::_('KEPVISELOJELOLT').'
              </a>
             ';
      }
      if ($this->Kepviselo['kepviselotValasztLink'] != '') {
        echo '<a class="akcioGomb btnKepviselotValaszt" href="'.$this->Kepviselo['kepviselotValasztLink'].'">
             '.JText::_('GLOBALISKEPVISELOTVALASZT').'
              </a>
              ';
      }
      if ($this->Kepviselo['ujJeloltLink'] != '') {        
        echo '
              <a class="akcioGomb btnUjJelolt" href="'.$this->Kepviselo['ujJeloltLink'].'">
             '.JText::_('UJGLOBALISKEPVISELOJELOLT').'
             </a>
             ';
      };
echo '
</div>
<div class="akciogombok">
';
    if ($this->Akciok['ujTemakor'] != '') {
      echo '<a href="'.$this->Akciok['ujTemakor'].'" class="akcioGomb ujGomb">'.JText::_('UJTEMAKOR').'</a>
      ';
    }  
    if ($this->Akciok['beallitasok'] != '') {  
      echo '<a href="'.$this->Akciok['beallitasok'].'" class="akcioGomb beallitasokGomb">'.JText::_('BEALLITASOK').'</a>
      ';
    }
    echo '<a href="'.$this->Akciok['tagok'].'" class="akcioGomb tagokGomb">'.JText::_('REGISZTRALTTAGOK').'</a>
         <a href="'.$this->Akciok['sugo'].'" class="akcioGomb btnHelp modal" 
         rel="{handler: '."'iframe'".', size: {x: 800, y: 600}}">'.JText::_('SUGO').'</a>
         '; 
echo '
</div>
<div class="szuroKepernyo">
  <form action="'.$this->doFilterLink.'&task=dofilter" method="post">
    <div class="szurourlap">
      '.JText::_('SZURES').'
      <input type="text" name="filterStr" size="40" value="'.JRequest::getVar('filterStr').'" />
      <button type="submit" class="btnFilter">'.JText::_('SZURESSTART').'</button>
      <button type="button" class="btnClrFilter" onclick="location='."'".$this->doFilterLink.'&filterStr='."'".'">
        '.JText::_('SZURESSTOP').'
      </button>
    </div>
  </form>
</div>
<br /><br />
<center class="temakorLista">
';
  foreach ($this->Items as $i => $item) { 
		//you may want to do this anywhere else					
		$link = $this->itemLink.'&temakor='. $item->id;
	
		// img tag kiemelése
		$kep = '';
		$matches = Array();
		preg_match('/<img[^>]+>/i', $item->leiras, $matches);
		if (count($matches) > 0) {
		  $img = $matches[0];
		  
		  
		  // src attributum kiemelése
		  preg_match('/src="[^"]+"/i', $img, $matches);
		  if (count($matches) > 0) {
			$src = $matches[0];
		  } else {
			$src = '';  
		  }	
		} else {
		  $src = 'src="images/stories/utelagazas.jpg"';	
		}
		if ($src != '') {
		  $kep = '<img '.$src.' class="temakorLogo" style="width:165px; height:165px;" />';
		} else {
		  $kep = '<img src="images/stories/noimage.png" class="temakorLogo" style="width:165px; height:165px;" />';
		}	
		
        if ($item->vita == '') $item->vita = '0';				
        if ($item->szavazas == '') $item->szavazas = '0';				
        if ($item->lezart == '') $item->lezart = '0';
        if ($item->allapot == 1) $item->megnevezes .= '('.JText::_('CLOSED').')';				
		echo '
		<div style="display:inline-block; width:200px; height:220px;">
		  <center>
		    <a href="'.$link.'">
		    <div style="width:170px; heigh:170px;">
			   '.$kep.'  
			</div>
			<div>'.$item->megnevezes.'</div>
			</a>
		  </center>
		</div>
		';
  } 
echo '
</center>		
<div class="lapozosor">
  '.$this->LapozoSor.'
</div>
</div>
';
include 'components/com_jumi/files/forum.php'; 
?>
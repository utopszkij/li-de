<?php
/**
 * szavazasok böngésző képernyő
 * bemenet:
 * $this->Items
 *      ->Akciok      [name=>link,...]
 *      ->Kepviselo   [kepviselojeLink=>link, kepviselojeloltLink=>link,.....]
 *      ->altKepviselo
 *      ->temakor  
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

/**
* get avatar img from a user
* @param  int user_id or Juser user_object
* @param  int kép szélesség
* @return string url
*/
function getAvatar($user, $w = 80) {
	if (!is_object($user)) {
		$user = JFactory::getUser($user);
	}
	if (is_object($user->params))
	   $params = $user->params;
	else	
	   $params = JSON_decode($user->params);
	if ($params->avatar == '') {
	   $params->avatar = 'http://gravatar.com/avatar/'.md5(strtolower(trim($user->email))).'?s='.$w.'mmg';
	}
	return '<img src="'.$params->avatar.'" width="'.$w.'" />';
}

function kepLeirasbol($leiras) {
	  $matches = Array();
	  $kep = '';
	  preg_match('/<img[^>]+>/i', $leiras, $matches);
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
		  $src = '';	
	  }
	  if ($src != '') {
		  $kep = '<img '.$src.' style="width:80px; float:left; margin:2px;" />';
	  }
	  return $kep;
}

echo '
<div class="componentheading'.$this->escape($this->params->get('pageclass_sfx')).'">
<h3>'.$this->Temakor->megnevezes.'
  <a href="javascript:infoClick()" class="akcioIkon btnInfo" title="Infó" id="iconInfo" style="display:none">&nbsp;</a>';
  if ($this->Akciok['temakoredit'] != '') {  
      echo '<a href="'.$this->Akciok['temakoredit'].'" class="akcioIkon beallitasokGomb" title="'.JText::_('TEMAKORBEALLITASOK').'">&nbsp;</a>
      ';
  }
  if (($this->Akciok['tagJelentkezes'] != '') & ($this->Temakor->id > 0)) {
      echo '<a href="'.$this->Akciok['tagJelentkezes'].'" class="akcioIkon tagJelentkezoGomb" title="'.JText::_('TAGJELENTKEZES').'">&nbsp;</a>
      ';
  }
  echo '
  <button type="button" onclick="policyClick()">
	témakör / csoport müködési szabályzat
  </button>
  ';
  if ($this->Temakor->allapot == 1) echo '('.JText::_('CLOSED').')';
  if ($this->Temakor->leiras != '')
		echo '  
		</h3>
		<div id="temakorInfo" style="display:block;">
		  <div style="width:80px; height:80px; float:left; margin:2px;" class="avatarDiv">'.getAvatar($this->Temakor->letrehozo).'</div>
		  <p style="text-align:right">
			<button type="button" onclick="infoClose()"><b>X</b></button>
		  </p>
		  '.$this->Temakor->leiras.'
		</div>
		</div>
		<div class="kepviselo">
		';
  if ($this->AltKepviselo['kepviselojeLink'] != '') {
        echo '<a class="btnKepviselo" href="'.$this->AltKepviselo['kepviselojeLink'].'">
             '.$this->AltKepviselo['image'].'
             <br />'.$this->AltKepviselo['nev'].'
             <br />'.JText::_('GLOBALISKEPVISELO').'
             </a>
             ';
      }       
      if ($this->Kepviselo['kepviselojeLink'] != '') {
        echo '<a class="btnKepviselo" href="'.$this->Kepviselo['kepviselojeLink'].'">
             '.$this->Kepviselo['image'].'
             <br />'.$this->Kepviselo['nev'].'
             <br />'.JText::_('TEMAKORKEPVISELO').'
             </a>
             ';
      } else if ($this->Kepviselo['kepviseloJeloltLink'] != '') {
        echo '<a class="akcioGomb btnJelolt" href="'.$this->Kepviselo['kepviseloJeloltLink'].'">
              '.JText::_('TEMAKORKEPVISELOJELOLT').'
              </a>
             ';
      } else if ($this->Kepviselo['kepviselotValasztLink'] != '') {
        echo '<a class="akcioGomb btnKepviselotValaszt" href="'.$this->Kepviselo['kepviselotValasztLink'].'">
             '.JText::_('TEMAKORKEPVISELOTVALASZT').'
              </a>
              <a class="akcioGomb btnUjJelolt" href="'.$this->Kepviselo['ujJeloltLink'].'">
             '.JText::_('UJTEMAKORKEPVISELOJELOLT').'
             </a>
             ';
      };
echo '
</div>
<div class="clr"></div>
';

echo '<div class="akciogombok">
';
    
    if ($this->Akciok['ujAltema'] != '') {
      echo '<a href="'.$this->Akciok['ujAltema'].'" class="akcioGomb ujAlTemaGomb">'.JText::_('UJALTEMA').'</a>
      ';
    }  
    if ($this->Akciok['ujSzavazas'] != '') {
      echo '<a href="'.$this->Akciok['ujSzavazas'].'" class="akcioGomb ujGomb">'.JText::_('UJSZAVAZAS').'</a>
      ';
    }  
    echo '<a href="'.$this->Akciok['tagok'].'" class="akcioGomb tagokGomb">'.JText::_('TEMAKORTAGOK').'</a>
          <a href="'.$this->backLink.' "class="akcioGomb btnBack">'.JText::_('TEMAKOROK').'</a>
          <a href="'.$this->Akciok['sugo'].'" class="akcioGomb btnHelp modal" 
          rel="{handler: '."'iframe'".', size: {x: 800, y: 600}}">'.JText::_('SUGO').'</a>
    ';      
    
// filterStr = keresendő_str|activeFlag szétbontása
$w = explode('|',urldecode(JRequest::getVar('filterStr','')));
if ($w[1]==1) $filterAktiv = 'checked="checked"';
echo '
</div>
';
if (count($this->AlTemak) > 0) {
	  echo '<div class="altemakDiv">
	  <h3>'.JText::_('ALTEMAK').'</h3>
	  <ul class="altemakUl">
	  ';
	  foreach ($this->AlTemak as $alTema) {
		$alTemaLink = JURI::base().'/index.php?option=com_szavazasok&view=szavazasoklist&temakor='.$alTema->id;
		$kep = kepLeirasbol($alTema->leiras);
		echo '<li><a href="'.$alTemaLink.'">'.$kep.$alTema->megnevezes.' </a></li>';
	  }
	  echo '</ul>
	  </div>
	  ';
};
echo '
<div class="szavazasokDiv'.$this->escape($this->params->get('pageclass_sfx')).'">
<h2>'.$this->Title.'</h2>
<div class="szuroKepernyo">
  <form action="'.$this->doFilterLink.'&task=dofilter" method="post">
    <div class="szurourlap">
      '.JText::_('SZURES').'
      <input type="text" name="filterKeresendo" size="40" value="'.$w[0].'" />
      <input type="checkbox" name="filterAktiv" value="1" '.$filterAktiv.'" />
      <input type="hidden" name="filterStr" value="'.JRequest::getVar('filterStr','').'" />
      '.JText::_('CSAKAKTIVAK').'
      <button type="submit" class="btnFilter">'.JText::_('SZURESSTART').'</button>
      <button type="button" class="btnClrFilter" onclick="location='."'".$this->doFilterLink.'&filterStr='."'".'">
        '.JText::_('SZURESSTOP').'
      </button>
    </div>
  </form>
</div>
<table border="0" width="100%"  class="szavazasokTable">
  <thead>
  <tr>
    <th class="'.thClass(1).'">
      <a href="'.$this->reorderLink.'&order=1">
  		'.JText::_('ID').'
      </a>  
    </th>
    <th class="'.thClass(2).'">
      <a href="'.$this->reorderLink.'&order=2">
  		'.JText::_('SZAVAZASMEGNEVEZES').'
      </a>  
    </th>
    <th class="thClass(4)">'.JText::_('SZAVAZASALLAPOT').'</th>
    <th class="'.thClass(7).'">
      <a href="'.$this->reorderLink.'&order=7">
  		'.JText::_('SZAVAZAS_VEGE').' 
      </a>  
    </th>
    <th class="'.thClass(8).'">
      <a href="'.$this->reorderLink.'&order=8">
  		'.JText::_('TITKOSSAG').' 
      </a>  
    </th>
    <th>
  		'.JText::_('SZAVAZTAL').' 
    </th>
  </tr>
  </thead>
  <tbody>
  ';
	
  $rowClass = 'row0';
  foreach ($this->Items as $item) { 
      if (($item->user_id  == '') | ($item->kepviselo_id > 0))
        $szavaztal = '';
      else
        $szavaztal = '<img src="images/stories/ok.gif" />';  
     	echo '<tr class="'.$rowClass.'">';
		
      // 2015.12.06 FB nem bitja a hosszú linkeket    $link = $this->itemLink.'&szavazas='. $item->id;
	  $link = str_replace('szavazas',$item->id,$this->itemLink);
	  $kep = '';
	  $allapot = $item->vita1.'/'.$item->vita1.'/'.$item->szavazas.'/'.$item->lezart;
	  if ($item->vita1 == 'X') $allapot = JText::_('SZAVAZASVITA1'); 
  	  if ($item->vita2 == 'X') $allapot = JText::_('SZAVAZASVITA2'); 
  	  if ($item->szavazas == 'X')	$allapot = JText::_('SZAVAZAS'); 
  	  if ($item->lezart == 'X') $allapot = JText::_('LEZART'); 
	  $kep = kepLeirasbol($item->leiras);
	  
      if ($item->vita == '') $item->vita = '0';				
      if ($item->szavazas == '') $item->szavazas = '0';				
      if ($item->lezart == '') $item->lezart = '0';
      if ($item->titkos==0) $item->titkos = JText::_('NYILT');
      if ($item->titkos==1) $item->titkos = JText::_('TITKOS');
      if ($item->titkos==2) $item->titkos = JText::_('SZIGORUANTITKOS');
     	echo '
        <td align="right">'.$item->id.'</td>
        <td><a href="'.$link.'">'.$kep.$item->megnevezes.'</a></td>
        <td align="left">'.$allapot.'</td>
		<td align="center">'.$item->szavazas_vege.'</td>
        <td align="center">'.$item->titkos.'</td>
        <td align="center">'.$szavaztal.'</td>
        </tr>
       '; 
       if ($rowClass == 'row0') $rowClass='row1'; else $rowClass='row0';
  } 
echo '
</tbody>
</table>		
<div style="clear:booth"></div>
<div class="lapozosor">
  '.$this->LapozoSor.'
</div>
</div>
<script type="text/javascript">
  function infoClick() {
    document.getElementById("temakorInfo").style.display="block";
    document.getElementById("iconInfo").style.display="none";
  }
  function infoClose() {
    document.getElementById("temakorInfo").style.display="none";
    document.getElementById("iconInfo").style.display="inline-block";
  }
  function policyClick() {
	  location="'.JURI::base().'index.php?option=com_temakorok&view=temakorok&task=policy'.
	  '&temakor='.JRequest::getVar('temakor').
	  '&'.JSession::getFormToken().'=1";
  }
</script>
';

// kommentek megjelenitése
if ($this->CommentId > 0) {
  echo JComments::show($this->CommentId, 'com_content', $this->Szavazas->megnevezes);
}

include 'components/com_jumi/files/forum.php'; 


?>
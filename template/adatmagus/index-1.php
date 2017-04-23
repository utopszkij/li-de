<?php
/**
li-de.tk valasztoimozgalom.hu számára specializáld változat tmplv=1
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template-1.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
  
  <script type="text/javascript">
  // ENTER ne jelentsen SUBMIT -et.
  function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
  } 
  document.onkeypress = stopRKey; 
  </script>

  <script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'hu'}
  </script>
  
</head>

<body class="body">
	<h1>index-1.php</h1> 
	<div id="banner">
	   <img src="http://robitc/valasztoimozgalom/images/banners/vm-logo-80x80.jpg" float:left; />
		<a href="">Rólunk</a>
		<a href="">Felhívás</a>
		<a href="">Alapszabály</a>
		<a href="">Egyéb írások</a>
		<a href="">Események</a>
		<a href="">Csatlakozás</a>
		<a href="">Csatlakozók listája</a>
	<br />
	Választói Mozgalom
	</div>
	<div class="page">
		<div class="message">
		  <jdoc:include type="message" />
		</div>
		<div class="component">
		  <jdoc:include type="component" />
		</div>
	</div>
</body>
</html>

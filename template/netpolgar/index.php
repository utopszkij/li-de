<?php
error_reporting(E_ERROR | E_PARSE & ~E_STRICT);
// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$input = JFactory::getApplication()->input;
$user = JFactory::getUser();
$userToken = JSession::getFormToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="head" />
	
	<!-- core CSS -->
    <link href="templates/netpolgar/css/font-awesome.min.css" rel="stylesheet">
    <link href="templates/netpolgar/css/animate.min.css" rel="stylesheet">
    <link href="templates/netpolgar/css/prettyPhoto.css" rel="stylesheet">
    <link href="templates/netpolgar/css/main.css" rel="stylesheet">
    <link href="templates/netpolgar/css/responsive.css" rel="stylesheet">
    <link href="templates/netpolgar/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/netpolgar/css/template.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="templates/netpolgar/js/html5shiv.js"></script>
    <script src="templates/netpolgar/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="templates/netpolgar/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="templates/netpolgar/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="templates/netpolgar/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

    <header id="header">
		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-xs-4">
						<div class="top-email">
						  <p><a class="fa fa-email"href="mailto:info@li-de.tk">tibor.fogler@gmail.com</a></p>
						</div>
					</div>
					<div id="userDoboz" class="col-sm-6 col-xs-4">
						<?php if ($user->id == 0) : ?>
						  <a href="ssologin/index.php"><i class="icon-regist"></i>&nbsp;Regisztrálás</a>&nbsp;
						  <a href="ssologin/index.php"><i class="icon-login"></i>&nbsp;Bejelentkezés</a>&nbsp;
						<?php else : ?>
						  <i class="icon-user"></i><var class="username"><?php echo $user->name; ?></var>&nbsp;
						  <a href="index.php?option=com_users&view=profile&layout=edit"><i class="icon-profil"></i>&nbsp;Profilom</a>&nbsp;
						  <a href="index.php?option=com_users&task=user.logout&<?php echo $userToken; ?>=1"><i class="icon-logout"></i>&nbsp;Kijelentkezés</a>&nbsp;
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php">
					   <img src="templates/netpolgar/images/logo-lide.jpg" class="logo" alt="logo" />
					</a>
                </div>
                <div>
					<jdoc:include type="modules" name="position-1" style="none" />
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		<jdoc:include type="modules" name="after-navbar" style="well" />
    </header><!-- header -->
	
	<?php if ($input->get('Itemid') == 994) : ?> <!--  994 a kezdőlap menüpont ID -je -->
    <section id="myslider" class="no-margin">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div id="slide1" class="item active" style="background-image: url(templates/netpolgar/images/slider/bg1.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Csináljunk egy jobb világot!</h1>
                                    <h2 class="animation animated-item-2">Elemezzük a múltat és a jelent, 
									vizsgáljuk meg a javítási lehetőségeket, tervezzük meg a jövőt!
									A kollektív bölcsesség segitségével talájuk meg a legjobb alternatív megoldásokat!</h2>
                                    <a class="btn-slide" href="index.php/cikkek/13-netpolgar-rendszer/1-net-polgar-rendszer-ismertetese">Ismertető</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img" style="margin-top:185px">
                                    <img src="templates/netpolgar/images/slider/img1.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div id="slide2" class="item" style="background-image: url(templates/netpolgar/images/slider/bg2.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Demokratikusan hozzuk meg a döntéseket!</h1>
                                    <h2 class="animation animated-item-2">A XXI század technikai lehetőségeinek falhasználásával korszerű szavazási rendszereket használhatunk.</h2>
                                    <a class="btn-slide" href="index.php/cikkek/13-netpolgar-rendszer/1-net-polgar-rendszer-ismertetese">Ismertető</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img" style="margin-top:4px">
                                    <img src="templates/netpolgar/images/slider/img2.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div id="slide3" class="item" style="background-image: url(templates/netpolgar/images/slider/bg3.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Ha megszületett a döntés akkor valósítsuk is meg!</h1>
                                    <h2 class="animation animated-item-2">Jobb világot hagyjunk a következő nemzedékeknek, 
									mint amiben mi élünk! A termelés és elosztás folyamatait is demokratikusan szervezzük meg!</h2>
                                    <a class="btn-slide" href="index.php/cikkek/13-netpolgar-rendszer/1-net-polgar-rendszer-ismertetese">Ismertető</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img" style="margin-top:45px">
                                    <img src="templates/netpolgar/images/slider/img3.png" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->

                <div id="slide4" class="item" style="background-image: url(templates/netpolgar/images/slider/bg4.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Hozzunk létre egyenlő felek közötti, kölcsönösen előnyös együttműködést!</h1>
                                    <h2 class="animation animated-item-2">A tervezés, döntéshozatal, termelés, elosztás, kommunikáció, kultúrális élet minden szintjén.</h2>
                                    <a class="btn-slide" href="index.php/cikkek/13-netpolgar-rendszer/1-net-polgar-rendszer-ismertetese">Ismertető</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img" style="margin-top:45px">
                                    <img src="templates/netpolgar/images/slider/img4.png" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
				
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
    </section><!--/#main-slider-->
	<?php endif; ?>

	<section id="content-area">
        <div class="container">
            <div class="row">
				<?php if (($this->countModules('position-7') > 0) & ($this->countModules('position-8') > 0)) : ?>
					<div class="col-c col-c-2">
						<div class="breadcum">
						  <jdoc:include type="modules" name="breadcumb" style="xhtml" />
					    </div>
						<div class="before">
						  <jdoc:include type="modules" name="position-3" style="well" />
					    </div>
						<div class="message">
						  <jdoc:include type="message" />
					    </div>
						<div class="content">
						  <jdoc:include type="component" />
					    </div>
						<div class="after">
						  <jdoc:include type="modules" name="position-5" style="well" />
					    </div>
					</div>
					<div class="col-m col-left">
						<jdoc:include type="modules" name="position-7" style="well" />
					</div>
					<div class="col-m col-right">	
						<jdoc:include type="modules" name="position-8" style="well" />
					</div>
				<?php elseif ($this->countModules('position-7') | $this->countModules('position-8')) : ?>
					<?php if ($this->countModules('position-7')) : ?>
					<div class="col-m col-left">
						<jdoc:include type="modules" name="position-7" style="well" />
					</div>
					<?php endif; ?>
					<div class="col-c col-c-1">
						<div class="breadcum">
						  <jdoc:include type="modules" name="breadcumb" style="xhtml" />
					    </div>
						<div class="before">
						  <jdoc:include type="modules" name="position-3" style="well" />
					    </div>
						<div class="message">
						  <jdoc:include type="message" />
					    </div>
						<div class="content">
						  <jdoc:include type="component" />
					    </div>
						<div class="after">
						  <jdoc:include type="modules" name="position-5" style="well" />
						</div>  
					</div>
					<?php if ($this->countModules('position-8')) : ?>
					<div class="col-m col-right">	
						<jdoc:include type="modules" name="position-8t" style="well" />
					</div>
					<?php endif; ?>
				<?php else : ?>
					<div class="col-c col-c-0">
						<div class="breadcum">
					      <jdoc:include type="modules" name="breadcumb" style="xhtml" />
					    </div>
						<div class="before">
					      <jdoc:include type="modules" name="position-3" style="well" />
					    </div>
						<div class="message">
					      <jdoc:include type="message" />
					    </div>
						<div class="content">
					      <jdoc:include type="component" />
					    </div>
						<div class="after">
						  <jdoc:include type="modules" name="position-5" style="well" />
						</div>  
					</div>
				<?php endif; ?>
			</div>
		</div>

	</section><!-- content-area -->

    <section id="temak">
        <div class="container">
            <div class="row">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="component/uddeim/?task=inbox">
                            <i class="fa fa-uzenetek"></i>
                            <h2>Üzenetek</h2>
                            <h3>Privát üzenetek olvasása, küldése</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="SU/tagok/tagoklist/browse/<?php echo $input->get('temakor',0); ?>">
                            <i class="fa fa-tag"></i>
                            <h2>Tagok</h2>
                            <h3>A csoport vagy a web oldal regisztrált felhasználói</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="component/temakorok/temakoroklist">
                            <i class="fa fa-csoport"></i>
                            <h2>Csoportok</h2>
                            <h3>Együttmüködő csoportok</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->

					<div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="index.php?option=com_icagenda&view=list">
                            <i class="fa fa-aktiv"></i>
                            <h2>Események</h2>
                            <h3>Globális, csoport, projekt események.</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="index.php/?option=com_content&view=article&id=276">
                            <i class="fa fa-fotok"></i>
                            <h2>Fénykép album</h2>
                            <h3>Globális, csoport, projekt, privát fényképek.</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="tema-wrap">
						  <a href="https://www.youtube.com/channel/UCPH4kycqMrxH9x3j9KJcJ4g">
                            <i class="fa fa-videok"></i>
                            <h2>Videó album</h2>
                            <h3>Globális, csoport, projekt, privát videók.</h3>
						  </a>	
                        </div>
                    </div><!--/.col-md-4-->
                
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#temak-->

    <section id="recent-works">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Ajánlott oldalak</h2>
                <p class="lead">A szerkesztők ajánlata</p>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item1.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Szellemi termelési mód</a> </h3>
                                <p>Kapitány Ágnes és Gábor könyve egy lehetséges új termelési mód körvonalait vázolja.</p>
                                <a href="https://hu.wikipedia.org/wiki/Szellemi_termel%C3%A9si_m%C3%B3d"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div>   

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item2.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Internet filozófia</a></h3>
                                <p>A 'blogoló' a tulajdonképpeni, a teljes jogú, a teljes fegyverzetében előttünk álló hálópolgár, a kiberkultúra eminens létrehozója.</p>
                                <a href="http://internetfilozofia.blog.hu/"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div> 

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item3.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Információs társadalom</a></h3>
                                <p>Wikipedia szó cikk.</p>
                                <a href="https://hu.wikipedia.org/wiki/Inform%C3%A1ci%C3%B3s_t%C3%A1rsadalom_(fogalom)"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div>   

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item4.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Katedrális és bazár</a></h3>
                                <p>A "szabadszoftver" világ alapműve.</p>
                                <a href="http://magyar-irodalom.elte.hu/robert/szovegek/bazar/"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div>   
                
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item5.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Szelid pénz</a></h3>
                                <p>Egy alternatív pénzrendszer....</p>
                                <a href="http://edok.lib.uni-corvinus.hu/284/1/Szalay93.pdf"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div>   

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item6.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Likvid demokrácia</a></h3>
                                <p>A napjainkra már teljesen kiüresedett, funkcióját vesztett képviseleti demokrácia egy lehetséges utóda.</p>
                                <a href="http://hu.alternativgazdasag.wikia.com/wiki/Likvid_demokr%C3%A1cia"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div> 

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item7.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Vénusz projekt</a></h3>
                                <p>Egy átfogó jövő kép...</p>
								<a href="https://www.youtube.com/watch?v=Uh9VxaO12zY&list=PL255C39DA73A5F10B&index=149"><i class="fa fa-eye"></i>Röviditett magyar szinkronos video</a><br>
                                <a href="https://www.youtube.com/watch?v=JcbMW5Y5HxY"><i class="fa fa-eye"></i>Teljes magyar feliratos video</a>
                            </div> 
                        </div>
                    </div>
                </div>   

                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="templates/netpolgar/images/portfolio/recent/item8.png" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="#">Feltétel nélküli alapjövedelem</a></h3>
                                <p>Ezt akár holnap megcsinálhatnánk....</p>
                                <a href="http://alapjovedelem.hu/index.php/gyik"><i class="fa fa-eye"></i>Megnézem</a>
                            </div> 
                        </div>
                    </div>
                </div>   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#recent-works-->

    <section id="services" class="service-item">
	   <div class="container">
            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="rolunk/program-dokumentacio/267-keszul">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/services1.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Média és fájl könyvtár</h3>
							<p>Tagokhoz, csoportokhoz, szavazásokhoz, projektekthez, termékekhez rendelve képek, videók és pdf, odt, ods, doc, xls fájlok kapcsolhatóak, és publikálhatóak.
							Letöltési statisztika, értékelés</p>
                        </div>
						</a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="rolunk/program-dokumentacio/267-keszul">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/services2.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Fórum</h3>
                            <p>A kommunikációhoz, viták rendezett, struktúrált lebonyolításához a tagokhoz, csoportokhoz, projektekhez, termékekhez, szavazásokhoz egy-egy vita oldal kapcsolódik.</p>
                        </div>
						</a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="events">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/services3.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Határidő napló</h3>
                            <p>A különböző tennivalók, események, határidők kezelésére a csoportokhoz, projektekhez, termékekhez, szavazásokhoz események csatolhatóak.
							Az eseményekre fel lehet iratkozni.</p>
                        </div>
						</a>
                    </div>
                </div>  

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="rolunk/program-dokumentacio/267-keszul">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/services4.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Projekt kezelés</h3>
                            <p>feladatok, felelősök, határidők kezelése</p>
                        </div>
						</a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="SU/szavazasok/szavazasoklist/browse">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/utelagazas.jpg" style="width:130px">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Szavazások</h3>
                            <p>A csoportokhoz, projektekhez NET -es szavazások rendelhetőek.
							Prefenciális (Borda) rendszerű szavazás.</p>
                        </div>
						</a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
						<a href="rolunk/program-dokumentacio/267-keszul">
                        <div class="pull-left">
                            <img class="img-responsive" src="templates/netpolgar/images/services/services6.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Alternatív piac</h3>
                            <p>Anyagi termékek, szellemi termékek, szolgáltatások egymás közti megosztása / cseréjére egy virtuális elszámolási rendszert alkalmazunk</p>
                        </div>
						</a>
                    </div>
                </div>                                                
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="before-footer">
        <div class="container">
		    <div class="row">
				<jdoc:include type="modules" name="before-footer" style="well" />
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#middle-->
    
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
				<jdoc:include type="modules" name="footer" style="well" />
            </div>
        </div>
    </footer><!--/#footer-->

	<div id="debug">
	<jdoc:include type="modules" name="debug" style="well" />
	</div>
	
    <!-- script src="templates/netpolgar/js/jquery.js"></script -->
    <!-- script src="templates/netpolgar/js/bootstrap.min.js"></script -->
    <script src="templates/netpolgar/js/jquery.prettyPhoto.js"></script>
    <script src="templates/netpolgar/js/jquery.isotope.min.js"></script>
    <script src="templates/netpolgar/js/main.js"></script>
    <script src="templates/netpolgar/js/wow.min.js"></script>
	<script type="text/javascript">
	  // jó lenne ezt az üzenetet egy felhasználónak csak egyszer kiirni.....
	  var s = "<?php echo $browserWarning; ?>";
	  if (s != '') {
		  alert(s);
	  }
	</script>
	<p onclick="jQuery('#fontdemo').show();" style="cursor: pointer">*</p>
	<?php
	echo '<div id="fontdemo" style="display:none">
	';
	echo 'option:'.$input->get('option').'<br />';
	echo 'view:'.$input->get('view').'<br />';
	echo 'id:'.$input->get('id').'<br />';
	echo 'cid:'.$input->get('cid').'<br />';
	echo '
	<h2>FontAwesome karakter készlet</h2>
	<p>Használati példa:</p>
	<pre><code>
	&lt;style type="text/css"&gt;
	  .icon_12 {font-family:FontAwesome; font-size:16px; content:"\012"}
	&lt;/style&gt;
	&lt;span class="icon12"&gt; &lt;/span&gt;
	</code></pre>
	<style type="text/css">;
	';
	for ($i=0; $i<255; $i++) {
		$s = dechex($i);
		if (strlen($s) < 3) $s = '0'.$s;
		if (strlen($s) < 3) $s = '0'.$s;
		$s ='"\f'.$s.'"';
		echo '.icon'.$i.'::before {font-family:FontAwesome; font-size:16px; content:'.$s.'}'."\n";
	}
	echo '</style>'."\n";
	for ($i=0; $i<255; $i++) {
		$s = dechex($i);
		if (strlen($s) < 3) $s = '0'.$s;
		if (strlen($s) < 3) $s = '0'.$s;
		$s ='"\f'.$s.'"';
		echo '<div style="display:inline-block; width:100px;">'.$s.' <span class="icon'.$i.'"> </span></div>'; 
	}
	echo '</div>';
	?>
</body>
</html>
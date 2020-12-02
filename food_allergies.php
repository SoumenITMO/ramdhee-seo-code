<?PHP	
	include_once 'init.php';

	$cmsVal = $general_cls_call->select_query("*", CMS_MASTER, "WHERE id=:id", array(':id'=>1), 1);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title> Food Allergies </title>
<meta name="keywords" content="<?PHP echo $pageName->meta_key; ?>">
<meta name="description" content="<?PHP echo $pageName->meta_desc; ?>">

<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>
</head>
<body>
<div class="wrapper-wide">

  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->

  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Toiduallergiad</a></li>
      </ul>
      <div class="row">
        <div id="content" class="col-sm-12">
          <h1 class="title">Toiduallergiad</h1>
          <div class="row">
            <div class="col-sm-12">
			  <div>
				<h4> Gluteeni sisaldavad teraviljad </h4>
				<p> Nisu, rukist, otra ja kaera leidub sageli toitu, mis sisaldab jahu, mõnda küpsetuspulbrit, taigna,
riivsaia, kooke, kuskusi, lihatooteid, makarone, saia, kastmeid, suppe ja mõnda praetud toitu. </p>
			  </div>
			  
			  <div>
				<h4> Koorikloomad </h4>
				<p> Krabid, homaar, krevetid ja scampi on koorikloomad. Krevetipasta on sellesse kategooriasse kuuluv
allergeen, mida kasutatakse tavaliselt Tai ja Kagu-Aasia toiduvalmistamisel. </p>
			  </div>
			  
			  <div>
				<h4> Munad </h4>
				<p> Mune leidub kookides, mõnedes lihatoodetes, majoneesis, võis, pastades, quiches, kastmetes ja
kondiitritoodetes. Mõned toiduained glasuuritakse keetmise ajal munadega. </p>
			  </div>
			  
			  <div>
				<h4> Kala </h4>
				<p> Kalakastmeid võite leida pizzades, maitsestamisvormides, salatikastmetes, kuubikuteks ja Worcestershire'i kastmes. </p>
			  </div>
			  
			  <div>
				<h4> Maapähklid </h4>
				<p> Maapähkleid kasutatakse sageli küpsiste, kookide, karri, magustoitude, kastmete, maapähkliõli ja
maapähkli jahu koostisainena. </p>
			  </div>
			  
			  <div>
				<h4> Soja </h4>
				<p> Leidub mõnikord oad kohupiimas, edamame oades, misomates, tekstureeritud sojavalgus, sojajahus
või tofus, soja on idamaise toidu põhikoostisosa. Seda võib leida magustoitudes, jäätises,
lihatoodetes, kastmetes ja taimetoitudes. </p>
			  </div>
			  
			  <div>
				<h4> Piim </h4>
				<p> Piima leidub piimatoodetes nagu või, juust, koor, piimapulbrid ja jogurt. Mõned toidud glasuuritakse
keetmise ajal ka piimaga. Seda leidub tavaliselt ka pulbristatud suppides ja kastmetes. </p>
			  </div>
			  
			  <div>
				<h4> Pähklid </h4>
				<p> Pähklid (välja arvatud maapähklid) tähistavad pähkleid, mida kasvatatakse puudel; erinevalt
maapähklitest, mida kasvatatakse maa all. See hõlmab kašupähkleid, mandleid ja sarapuupähkleid. </p>
			  </div>
			  
			  <div>
				<h4> Seller </h4>
				<p> See hõlmab selleri varred, lehed, seemned ja juur. Tavaliselt leidub sellerisoola, salateid, mõningaid
lihatooteid, suppe ja varukooke. </p>
			  </div>
			  
			  <div>
				<h4> Sinep </h4>
				<p> Siia hulka kuulub sinep pulbri, vedeliku ja seemnete kujul. Seda koostisosa kasutatakse leibades,
karrites, marinaadides, lihatoodetes, salatikastmetes, kastmetes ja suppides. </p>
			  </div>
			  
			  <div>
				<h4> Seesami </h4>
				<p> Neid leidub tavaliselt leivas, tavaliselt puistatakse sellistele kuklitele nagu hamburgeripulgad,
leivapulgad, kohupiim, seesamiõli ja tahini. </p>
			  </div>
			  
			  <div>
				<h4> Vääveldioksiid (sulfitid) </h4>
				<p> See on koostisosa, mida kasutatakse sageli kuivatatud puuviljades ja mõnedes lihatoodetes,
karastusjookides, köögiviljades, veinis ja õlles. Astmaatikutel on suurem sulfitiallergia tekke oht. </p>
			  </div>
			  
			  <div>
				<h4> Lupiin </h4>
				<p> Lupiin on lill, kuid seda leidub mõnikord ka jahus ja seda kasutatakse mõnikord leiva, saiakeste ja pasta valmistamisel. </p>
			  </div>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
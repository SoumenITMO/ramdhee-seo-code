<?PHP	
	include_once 'init.php';

	$cmsVal = $general_cls_call->select_query("*", CMS_MASTER, "WHERE id=:id", array(':id'=>2), 1);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title><?PHP echo $pageName->meta_title; ?></title>
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
        <li><a href="#"><?PHP echo $cmsVal->name; ?></a></li>
      </ul>
      <div class="row">
        <div id="content" class="col-sm-12">
          <h1 class="title"> Kättetoimetamise teave </h1>
          <div class="row">
            <div class="col-sm-12">
				<p>
					Korraldame praegu kampaaniat ja üle Tallinna on kohaletoimetamine tasuta. Loodame säilitada
					tasuta kohaletoimetamise kontseptsiooni nii kaua kui võimalik. Kauba tarnimine toimub ettetellimise
					või tellimise mudeli ajakava alusel.
					Oleme volitatud toidukäitleja, kontrollige palun siit:

					<p> 
						https://jvis.agri.ee/jvis/avalik.html#/toitKaitlemisettevotedparing?query=%257B%2522filter%2522%
						253A%257B%2522kaitlejaKood%2522%253A%252214459892%2522%257D%252C%2522sort%22
						253A% 257B% 2522asc% 2522% 253Arve% 252C% 2522fieldName% 2522% 253A%
						2522kaitlejaNimi% 252CtegevuskohaNimi% 2522% 257D% 252C% 2522pagination% 2522% 253A%
						257B% 2522page% 2522% 2522% 2522% 2522 252C% 2522rowCount% 2522% 253A0% 252C%
						2522ellipsisSize%2522%253A3%257D%257D
					</p>
				</p>
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
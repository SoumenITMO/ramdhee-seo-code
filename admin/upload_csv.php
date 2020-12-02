<?PHP
	include_once '../init.php';
	$general_cls_call->validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL);		// VALIDATION CHEK
	ob_start();

/*=========== INSERT SLIDER START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])) && $_POST['btnSubmit'] === "SUBMIT")
	{
		extract($_POST);
		if($_FILES['txtCsv']['tmp_name']!='') 
		{
			$file = $_FILES['txtCsv']['tmp_name']; 
			$handle = fopen($file, "r");   

			$general_cls_call->empty_query(PRODUCT);
		   
			if ( $handle !== FALSE) 
			{
				$n=1;
				while ($data = fgetcsv($handle, 1024, ",")) 
				{
					if($n >=1 )
					{            
						if($data[0]!='')
						{
							$field = "name, category, cts, cla, col, col_shade, rate, back, rap, amount, cut, pol, sym, fl, lw, measurement, depth, table_val, luster, bit, bic, tabcrn_inc, girdle, pav_dpt, ca, opens_tcp, cert, cert_no, key_symbols, comments, status, cert_link, image, image_link, video_link";

							$value = ":name, :category, :cts, :cla, :col, :col_shade, :rate, :back, :rap, :amount, :cut, :pol, :sym, :fl, :lw, :measurement, :depth, :table_val, :luster, :bit, :bic, :tabcrn_inc, :girdle, :pav_dpt, :ca, :opens_tcp, :cert, :cert_no, :key_symbols, :comments, :status, :cert_link, :image, :image_link, :video_link";

							$addExecute=array(
								':name'			=>$general_cls_call->specialhtmlremover($data[0]),
								':category'		=>$general_cls_call->specialhtmlremover($data[1]),
								':cts'			=>$general_cls_call->specialhtmlremover($data[2]),
								':cla'			=>$general_cls_call->specialhtmlremover($data[3]),
								':col'			=>$general_cls_call->specialhtmlremover($data[4]),
								':col_shade'	=>$general_cls_call->specialhtmlremover($data[5]),
								':rate'			=>$general_cls_call->specialhtmlremover($data[6]),
								':back'			=>$general_cls_call->specialhtmlremover($data[7]),
								':rap'			=>$general_cls_call->specialhtmlremover($data[8]),
								':amount'		=>$general_cls_call->specialhtmlremover($data[9]),
								':cut'			=>$general_cls_call->specialhtmlremover($data[10]),
								':pol'			=>$general_cls_call->specialhtmlremover($data[11]),
								':sym'			=>$general_cls_call->specialhtmlremover($data[12]),
								':fl'			=>$general_cls_call->specialhtmlremover($data[13]),
								':lw'			=>$general_cls_call->specialhtmlremover($data[14]),
								':measurement'	=>$general_cls_call->specialhtmlremover($data[15]),
								':depth'		=>$general_cls_call->specialhtmlremover($data[16]),
								':table_val'	=>$general_cls_call->specialhtmlremover($data[17]),
								':luster'		=>$general_cls_call->specialhtmlremover($data[18]),
								':bit'			=>$general_cls_call->specialhtmlremover($data[19]),
								':bic'			=>$general_cls_call->specialhtmlremover($data[20]),
								':tabcrn_inc'	=>$general_cls_call->specialhtmlremover($data[21]),
								':girdle'		=>$general_cls_call->specialhtmlremover($data[22]),
								':pav_dpt'		=>$general_cls_call->specialhtmlremover($data[23]),
								':ca'			=>$general_cls_call->specialhtmlremover($data[24]),
								':opens_tcp'	=>$general_cls_call->specialhtmlremover($data[25]),
								':cert'			=>$general_cls_call->specialhtmlremover($data[26]),
								':cert_no'		=>$general_cls_call->specialhtmlremover($data[27]),
								':key_symbols'	=>$general_cls_call->specialhtmlremover($data[28]),
								':comments'		=>$general_cls_call->specialhtmlremover($data[29]),
								':status'		=>$general_cls_call->specialhtmlremover($data[30]),
								':cert_link'	=>$general_cls_call->specialhtmlremover($data[31]),
								':image'		=>$general_cls_call->specialhtmlremover($data[32]),
								':image_link'	=>$general_cls_call->specialhtmlremover($data[33]),
								':video_link'	=>$general_cls_call->specialhtmlremover($data[34]),
							);
							$general_cls_call->insert_query(PRODUCT, $field, $value, $addExecute);
						}           
					}
				$n++;
				}
			fclose($handle);
			}
		}
	}
/*=========== INSERT SLIDER END ===========*/


ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<title><?PHP echo ADMIN_TITLE; ?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>
<body>

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminHeader.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminMenu.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### BODY START ############### -->
<div id="main" role="main">
  <div id="ribbon"><span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i></span></span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Upload CSV</li>
    </ol>
  </div>
  <div id="content">
	<?PHP
		if(isset($erMsg) && $erMsg != '')
		{
	?>
		<div class="alert alert-danger fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-times"></i><strong>Error!</strong> <?PHP echo $erMsg; ?>
		</div>
	<?PHP
		}
		if(isset($sucMsg) && $sucMsg != '')
		{
	?>
		<div class="alert alert-success fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-check"></i><strong>Success</strong> <?PHP echo $sucMsg; ?>
		</div>
	<?PHP
		}
	?>
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-3"> </article>
      <article class="col-sm-12 col-md-12 col-lg-6" style="margin: 2% 0;">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Upload CSV</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" name="frm" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <section class="col-lg-9 col-lg-offset-9">
                      <label class="label">Upload File</label>
                      <div class="input input-file">
						<span class="button"><input type="file" id="txtCsv" name="txtCsv" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" name="txtUpload" readonly="" value="" placeholder="Upload your csv file">
					 </div>
                    </section>
                </fieldset>
                <footer>
					<input type="submit" name="btnSubmit" value="SUBMIT" class="btn btn-success">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-3 hidden-xs hidden-sm">&nbsp;</article>
  

    </div>
  </div>
</div>
<!-- ######### BODY END ############### -->

<!-- ######### FOOTER START ############### -->
	<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->

<!-- END PAGE FOOTER -->
<!-- END SHORTCUT AREA -->
<!--================================================== -->
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="js/jquery.min.js"></script>
<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>
<script src="js/jquery-ui.min.js"></script>
<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
<!-- IMPORTANT: APP CONFIG -->
<script src="js/app.config.js"></script>
<!-- CUSTOM NOTIFICATION -->
<script src="js/notification/SmartNotification.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- JQUERY VALIDATE -->
<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>
<!-- JQUERY MASKED INPUT -->
<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<!-- JQUERY SELECT2 INPUT -->
<script src="js/plugin/select2/select2.min.js"></script>
<!-- JQUERY UI + Bootstrap Slider -->
<script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- browser msie issue fix -->
<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<!-- FastClick: For mobile devices -->
<script src="js/plugin/fastclick/fastclick.min.js"></script>
<!-- MAIN APP JS FILE -->
<script src="js/app.min.js"></script>
<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!		
		$(document).ready(function() {			
			pageSetUp();					
			var $registerForm = $("#smart-form-register").validate({	
				// Rules for form validation
					txtUpload : {
						required : true
					}
				},	
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});		
		})
</script>

</body>
</html>
<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== SELECT QUERY START ===========*/
	$page_details = $general_cls_call->select_query("*", CMS_MASTER, "WHERE id=:id", array(':id'=>$_GET['PageID']), 1);
/*=========== SELECT QUERY END ===========*/

/*=========== UPDATE QUERY START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnSubmit']))
	{	
		extract($_POST);
		$setValues="name=:name, description=:description, map=:map";
		$updateExecute=array(
			':name'			=>$general_cls_call->specialhtmlremover($txtName),
			':description'	=>$general_cls_call->specialhtmlremover($txtDesc),
			':map'			=>$general_cls_call->specialhtmlremover($txtMap)
		);
		$whereClause=" WHERE id=".$_GET['PageID'];
		$update_deal_city=$general_cls_call->update_query(CMS_MASTER, $setValues, $whereClause, $updateExecute);	
		header("location:".ADMIN_SITE_URL."page.php?PageID=".$_GET['PageID']);
	}	
/*=========== UPDATE QUERY END ===========*/

	if(!isset($_POST['txtName'])) { $_POST['txtName'] = $page_details->name; }
	if(!isset($_POST['txtDesc'])) { $_POST['txtDesc'] = $page_details->description; }
	if(!isset($_POST['txtMap'])) { $_POST['txtMap'] = $page_details->map; }

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="iso-8859-1">
<title><?PHP echo ADMIN_TITLE; ?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700"> -->

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

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
      <li>Manage CMS</li>
      <li><?PHP echo $page_details->name; ?></li>
    </ol>
  </div>
  <form name="frm" method="post" action="" enctype="multipart/form-data">
  <div id="content">
	<?PHP
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
      <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
		  <section>
			<label class="input">&nbsp;&nbsp;</label>
		  </section>
		    <section>
			  <label class="textbox" style="margin-top:15px;width:95%;">Name&nbsp;</label>
			  <div class="input">
				<input type="text" name="txtName" value="<?PHP echo $_POST['txtName']; ?>" style="width:90% !important;">
			  </div>
			</section>
				<br/>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
			  <textarea id="description" name="txtDesc"><?PHP echo stripslashes($_POST['txtDesc']); ?></textarea>
				<script type="text/javascript">
					var editor = CKEDITOR.replace( 'description', {
					filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
					filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
					//filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
					filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					//filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
					uiColor : '#F5F5F5'
					});

					CKFinder.setupCKEditor( editor, '' );
				</script>

            </div>
          </div>
        </div>
      </article>
	  <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <input type="submit" name="btnSubmit" value="SAVE" class="btn btn-success">
      </article>
    </div>
  </div>
  </form>
</div>
<!-- ######### BODY END ############### -->

<!-- ######### FOOTER START ############### -->
	<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->

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
</body>
</html>
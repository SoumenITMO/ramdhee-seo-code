<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== SELECT QUERY START ===========*/
	$page_details = $general_cls_call->select_query("*", CMS_MASTER, "WHERE id=:id", array(':id'=>$_GET['maID']), 1);
/*=========== SELECT QUERY END ===========*/

/*===========  UPDATE QUERY START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])))
	{		
		extract($_POST);
		$setValues="description=:description, subject=:subject";
		$updateExecute=array(
			':description'	=>$general_cls_call->specialhtmlremover($txtDesc),
			':subject'	=>$general_cls_call->specialhtmlremover($txtSubject)
		);
		$whereClause=" WHERE id=".$_GET['maID'];
		$update_deal_city=$general_cls_call->update_query(CMS_MASTER, $setValues, $whereClause, $updateExecute);
		header("location:".ADMIN_SITE_URL."mail_content.php?maID=".$_GET['maID']);
	}

/*===========  UPDATE QUERY START ===========*/

	if(!isset($_POST['txtDesc'])) { $_POST['txtDesc'] = $page_details->description; }
	if(!isset($_POST['txtSubject'])) { $_POST['txtSubject'] = $page_details->subject; }

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
<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

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
  <div id="ribbon"> <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i> </span> </span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Manage CMS</li>
      <li><?PHP echo $showVal->name; ?></li>
    </ol>
  </div>
  <div id="content">
    <?PHP
		if(isset($erMsg) && $erMsg != '')
		{
	?>
    <div class="alert alert-danger fade in">
      <button class="close" data-dismiss="alert">X</button>
      <i class="fa-fw fa fa-times"></i><strong>Error!</strong> <?PHP echo $erMsg; ?> </div>
    <?PHP
		}
		if(isset($sucMsg) && $sucMsg != '')
		{
	?>
    <div class="alert alert-success fade in">
      <button class="close" data-dismiss="alert">X</button>
      <i class="fa-fw fa fa-check"></i><strong>Success</strong> <?PHP echo $sucMsg; ?> </div>
    <?PHP
		}
	?>
    <section id="widget-grid" class="">
      <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget well" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
            <header> <span class="widget-icon"> <i class="fa fa-comments"></i> </span> </header>
            <div>
              <div class="jarviswidget-editbox"> </div>
              <div class="widget-body" style="padding:0px;">                          
                <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
					<fieldset>
					  <section class="col-lg-51 col-lg-offset-11">
						<label class="label"> Subject:&nbsp;
						  <input type="text" name="txtSubject" value="<?PHP echo $_POST['txtSubject']; ?>" placeholder="Mail Subject" style="width:90% !important;border: solid 1px #bdbdbd;padding:3px;">
						</label>
					  </section>
					  <section class="col-lg-12 col-lg-offset-1">
						<label class="label">Description</label>
						<div class="textarea textarea-resizable">
						  <textarea id="txtDescE" class="custom-scroll" placeholder="Decription" name="txtDesc" rows="8"><?PHP echo $_POST['txtDesc']; ?></textarea>
						  <script type="text/javascript">
								var editor = CKEDITOR.replace( 'txtDescE', {
								uiColor: '#F5F5F5',
								toolbar: [
									[ 'Bold', 'Italic', '-', '-' ],
									[ 'FontSize', 'TextColor', 'BGColor' ],
									['Source']
										]
								});

								CKFinder.setupCKEditor( editor, '' );
							</script>
						</div>
					  </section>
					</fieldset>
                  <footer><input type="submit" name="btnSubmit" value="SAVE" class="btn btn-success"></footer>
                </form>
              </div>
            </div>
          </div>
        </article>
	<?PHP
		if($_GET['maID'] == 8)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME]</b> text.</article>
	<?PHP
		}
		if($_GET['maID'] == 9)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME]</b> text.</article>
	<?PHP
		}
		if($_GET['maID'] == 10)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME], [COMPLAINT NUMBER]</b> text.</article>
	<?PHP
		}
		if($_GET['maID'] == 12)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME], [ORDER NUMBER]</b> text.</article>
	<?PHP
		}
		if($_GET['maID'] == 13)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME], [ORDER NUMBER]</b> text.</article>
	<?PHP
		}
		if($_GET['maID'] == 14)
		{
	?>
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">NOTE: Please don't edit or delete <b>[NAME], [URL]</b> text.</article>
	<?PHP
		}
	?>
      </div>
    </section>
  </div>
</div>
<!-- ######### BODY END ############### -->
<!-- ######### FOOTER START ############### -->
<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->
<script src="js/common.js"></script>
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
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">		
	$(document).ready(function() {

		pageSetUp();			
		var $registerForm = $("#smart-form-register").validate({
			rules : {
				txtPage : {
					required : true
				}
			},

			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});	
	})
</script>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script type="text/javascript">				

	$(document).ready(function() {	

		pageSetUp();
		var responsiveHelper_dt_basic = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});	
	})
</script>
</body>
</html>
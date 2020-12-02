<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();


	
/*=========== STATUS CHANGE START ================*/
	if(isset($_GET['mode']) && ($_GET['mode'] == '1' || $_GET['mode'] == '0'))
	{		
		$setValues="status=:status";
		$updateExecute=array(':status'=>$general_cls_call->specialhtmlremover($_GET['mode']));
		$whereClause=" WHERE id=".$_GET['staID'];
		$general_cls_call->update_query(MEMBER, $setValues, $whereClause, $updateExecute);
		header("location:".ADMIN_SITE_URL."member.php");
	}
/*=========== STATUS CHANGE END ================*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{
		$general_cls_call->delete_query(MEMBER, "WHERE id=:id", array(':id'=>$_GET['id']));
		header("location:".ADMIN_SITE_URL."member.php");
	}
/*=========== DELETE END ================*/	

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
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<script type="text/javascript">
	var GB_ROOT_DIR = "./greybox/";
</script>

<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
<!--
	ShowCenterView = function(caption, url, height, width, callback_fn)
	{
		var options =
		{
			caption: caption,
			height: '380px',
			width: '',
			fullscreen: false,
			show_loading: true,
			center_win:true,
			callback_fn: callback_fn
		}
			var win = new GB_Window(options);
			return win.show(url);			
	}
//-->
</script>

<script type="text/javascript">
<!--
	function del(uid)
	{
		if(confirm('Are you sure to delete?'))
		{
		   window.location.href='member.php?mode=del&id='+uid;
		   //document.frm.submit();
		}
	}
//-->
</script>

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
      <li>Member</li>
    </ol>
  </div>
  <div id="content">	  
	  
	<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
		<header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
		  <h2>Member List</h2>
		</header>
		<div>
		  <div class="jarviswidget-editbox"></div>
		  <div class="widget-body no-padding">
			<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
	<?PHP
		$docSql = $general_cls_call->select_query("id,name,email,status", MEMBER, "WHERE 1 ORDER BY name ASC", array(), 2);
		if($docSql[0] != '')
		{
	?>
			  <thead>
				<tr>
				  <th data-hide="phone">SL NO</th>
				  <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Name</th>
				  <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Email Address</th>
				  <th data-hide="phone,tablet">ACTION</th>
				</tr>
			  </thead>
			  <tbody>
		<?php 
			$i = 1;
			foreach($docSql as $docValue)
			{
		?>
				<tr>
				  <td><?PHP echo $i; ?></td>
				  <td><?PHP echo $docValue->name; ?></td>
				  <td><?PHP echo $docValue->email; ?></td>
				  <td>
					<?php	
						if($docValue->status == '1')
						{
					?>
					<a href = "<?PHP echo ADMIN_SITE_URL; ?>member.php?staID=<?php echo($docValue->id);?>&mode=0" title = "Click Inactive"><i class="fa fa-check-circle" style="color:green;"></i></a>
					<?php
						}
						else
						{
					?>
					<a href = "<?PHP echo ADMIN_SITE_URL; ?>member.php?staID=<?php echo($docValue->id);?>&mode=1" title = "Click Active"><i class="fa fa-times-circle" style="color:red;"></i></a>
					<?php
						}	
					?>
					&nbsp;<a href = "viewMember.php?LinkID=<?php echo $docValue->id; ?>" title="Click View" onclick="return ShowCenterView('', this.href)"><i class="fa fa-user" style="color:#33A1CE;"></i></a>
					&nbsp;&nbsp;<a href="javascript: del('<?php echo $docValue->id; ?>')" title="Click Delete"><i class="fa fa-trash-o" style="color:red;"></i></a></td>
				</tr>
	<?PHP
				$i++;
			}
		}
		else
		{
	?>
                    <tr>
                      <td height="25" align="center" colspan="4" class="tableText" style="color:red">No Record Found !!!</td>
					</tr>
	<?PHP
		}	
	?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</article>
	<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</article>
      
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
				rules : {
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});		
		})

	});

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
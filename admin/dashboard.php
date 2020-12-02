<?PHP
	include_once '../init.php';
	$general_cls_call->validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL);		// VALIDATION CHEK
	ob_start();

	$totalUser = $general_cls_call->select_query_count(MEMBER, "WHERE 1", array());
	$totalNeOrder = $general_cls_call->select_query_count(ORDERS, "WHERE status=:status", array(':status'=>1));
	$totalCoOrder = $general_cls_call->select_query_count(ORDERS, "WHERE status=:status", array(':status'=>4));


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
			height: '450px',
			width: '',
			fullscreen: false,
			show_loading: true,
			center_win:true,
			callback_fn: callback_fn
		}
			var win = new GB_Window(options);
			return win.show(url);			
	}
	ShowCenterReply = function(caption, url, height, width, callback_fn)
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

	function del(uid)
	{
		if(confirm('Are yor sure to delete?'))
		{
		   document.frm.action='order.php?mode=del&id='+uid;
		   document.frm.submit();
		}
	}
	
	function ChangeStatus(val,id)
	{
		document.frm.action='order.php?mode=status&staID='+id+'&val='+val;
		document.frm.submit();
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
      <li>Seadistused</li>
      <li>Armatuurlaud</li>
    </ol>
  </div>
  <div id="content">
	<?PHP
		if(isset($erMsg) && $erMsg != '')
		{
	?>
		<div class="alert alert-danger fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-times"></i><strong>Viga</strong> <?PHP echo $erMsg; ?>
		</div>
	<?PHP
		}
		if(isset($sucMsg) && $sucMsg != '')
		{
	?>
		<div class="alert alert-success fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-check"></i><strong>Edu</strong> <?PHP echo $sucMsg; ?>
		</div>
	<?PHP
		}
	?>
    <div class="row">

	 <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 <div class="col-md-4">
	  <div style="background:#19A9D5;text-align:center;">
		<div style="font-size:45px;color:#FFFFFF;width:100%;padding:10px 0;"><?PHP echo $totalUser; ?></div>
		<div style="font-size:21px;color:#FFFFFF;width:100%;padding:0 0 5px 0;">Kasutajaid kokku</div> 
	  </div>
	 </div>
	 <div class="col-md-4">
	  <div style="background:#7266BA;text-align:center;">
		<div style="font-size:45px;color:#FFFFFF;width:100%;padding:10px 0;"><?PHP echo $totalNeOrder; ?></div>
		<div style="font-size:21px;color:#FFFFFF;width:100%;padding:0 0 5px 0;">
Uued tellimused</div> 
	  </div>
	 </div>
	 <div class="col-md-4">
	  <div style="background:#23AD44;text-align:center;">
		<div style="font-size:45px;color:#FFFFFF;width:100%;padding:10px 0;"><?PHP echo $totalCoOrder; ?></div>
		<div style="font-size:21px;color:#FFFFFF;width:100%;padding:0 0 5px 0;">Täidetud tellimused</div> 
	  </div>
	 </div>
	 </article>
	<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</article>
			
		
      <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
		<header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
		  <h2>Viimati registreeritud kasutajate loend</h2>
		</header>
		<div>
		  <div class="jarviswidget-editbox"></div>
		  <div class="widget-body no-padding">
			<table class="table table-striped table-bordered table-hover" width="100%">
	<?PHP
		$docSql = $general_cls_call->select_query("id,name,email,status", MEMBER, "WHERE 1 ORDER BY name ASC LIMIT 0, 5", array(), 2);
		if($docSql[0] != '')
		{
	?>
			  <thead>
				<tr>
				  <th data-hide="phone">Seerianumber</th>
				  <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Nimi</th>
				  <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;E-posti aadress</th>
				  <th data-hide="phone,tablet">TEGEVUS</th>
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
				  <td><a href = "viewMember.php?LinkID=<?php echo $docValue->id; ?>" title="Click View" onclick="return ShowCenterView('', this.href)"><i class="fa fa-user" style="color:#33A1CE;"></i></a></td>
				</tr>
	<?PHP
				$i++;
			}
			?>
                    <tr>
                      <td colspan="6" style="text-align:right;"><a href="member.php">Vaata kõiki</a></td>
                    </tr>
			<?PHP
		}
		else
		{
	?>
                    <tr>
                      <td height="25" align="center" colspan="4" class="tableText" style="color:red">Ühtegi kirjet ei leitud !!!</td>
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

	  <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Recent Orders</h2>
            </header>
            <div>
              <div class="jarviswidget-editbox"></div>
              <div class="widget-body no-padding">
                <table class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
		<?PHP
			$slideSql = $general_cls_call->select_query("DISTINCT(order_number)", ORDERS, "WHERE 1 ORDER BY created_date ASC LIMIT 0, 5", array(), 2);
			if($slideSql[0] != '')
			{
		?>
                    <tr>
                      <th data-hide="phone">SL NO</th> 
                      <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Tellimuse number</th>
                      <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Nimi</th>
                      <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;E-posti aadress</th>
                      <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Kuupäev</th>
                      <th data-class="expand"><i class="fa text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Vaade</th>
                    </tr>
                  </thead>
                  <tbody>
			<?php 
				$i = 1;
				foreach($slideSql as $ordVal)
				{	
					$orderVal = $general_cls_call->select_query("*", ORDERS, "WHERE order_number=:order_number", array(':order_number'=>$ordVal->order_number), 1);
					$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$orderVal->user_id), 1);
			?>
                    <tr>
                      <td><?PHP echo $i; ?></td>
                      <td><?PHP echo $orderVal->order_number; ?></td>
                      <td><a href="delivery_address.php?id=<?PHP echo $orderVal->user_id; ?>" onclick="return ShowCenterView('', this.href)"  title="<?PHP echo $Click_Delivery_Details; ?>"><?PHP echo $userVal->name; ?></a></td>
                      <td><?PHP echo $userVal->email; ?></td>
                      <td><?PHP echo $orderVal->created_date; ?></td>
                      <td><a href="orderDetails.php?orderID=<?PHP echo $orderVal->order_number; ?>" class="text" onclick="return ShowCenterView('', this.href)"  title="View to order details"><img src="img/order.png" alt="" border="0" /></a></td>
                    </tr>
			<?PHP
					$i++;
				}
			?>
                    <tr>
                      <td colspan="6" style="text-align:right;"><a href="order.php">Vaata kõiki</a></td>
                    </tr>
			<?PHP
			}
			else
			{
			?>
                    <tr>
                      <td height="25" align="center" colspan="4" class="tableText" style="color:red">Ühtegi kirjet ei leitud</td>
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
				rules : {
					txtName : {
						required : true
					},
			<?PHP
				if($_GET['LinkID']=='')
				{
			?>
					txtUpload : {
						required : true
					},
			<?PHP
				}				
			?>
					txtLink : {
						required : true
					},
					txtPage : {
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
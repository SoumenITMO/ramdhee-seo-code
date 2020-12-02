<?php
	include_once '../init.php';
	//$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

	$ordUser = $general_cls_call->select_query("*", ORDERS, "WHERE order_number=:order_number", array(':order_number'=>$_GET['orderID']), 1);

	
	/* =========== STATUS CHANGE START ================ */
	if(isset($_POST['btnSubmit']))
	{
		$setValues="status=:status, remark=:remark";
		$updateExecute=array(
			':status'		=>$_POST['txtStatus'],
			':remark'			=>$_POST['txtRemark']
		);
		$whereClause=" WHERE order_number = '".$_GET['orderID']."'";
		$general_cls_call->update_query(ORDERS, $setValues, $whereClause, $updateExecute);

	?>
		<script type="text/javascript">
		<!--
			window.parent.parent.location.href='order.php';
		//-->
		</script>
	<?PHP
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
<meta charset="iso-8859-1">
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-2" />
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

	<style type="text/css">	
.home_text {
			font-family:arial;
			color:#FFF;
			font-size:16px; 
			line-height:21px; 
			font-weight:bold; 
			font-style:normal;
		}
		.big_text {
			font-family:arial;
			color:#000;
			font-size:13px; 
			line-height:15px; 
			font-weight:bold; 
			font-style:normal;
		}
		.small_text {
			font-family:arial;
			color:#000;
			font-size:12px; 
			line-height:15px; 
			font-weight:normal; 
			font-style:normal;
		}
	</style>
	<script type="text/javascript">
	<!--
		function doCheck()
		{
			if(document.frm.txtDate.value == '')
			{
				alert("Please select payment date");
				document.frm.txtDate.focus();
				return false;
			}
			else
			{
				return true;
			}
		}
	//-->
	</script>
</head>
<body style="margin:0px;background-color:#FFF">
<form name="frm" method="post" action="">
  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
	<tr>
	  <td width="100%" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp;&nbsp;APPROVED PAYMENT</td>
	</tr>
	<tr>
	  <td width="100%" class="home_text">
		<div style="height:325px;overflow:auto;">
			<table border="1" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 1px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
				<tr>
				  <td width="100%" class="big_text" colspan="2" align="center" style="font-family:arial;font-weight:normal;font-size:15px;color:#267D07;padding-left:5px;">&nbsp;</td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td align="right" class="big_text">Status:</td>
				  <td height="50" align="left" class="big_text">
				    <select style="border: solid 1px #000;width:175px;padding:3px;" name="txtStatus">
					  <option value="1" <?PHP echo ($ordUser->status == '1' ? 'selected' : ''); ?>>Received</option>
					  <option value="2" <?PHP echo ($ordUser->status == '2' ? 'selected' : ''); ?>>In process</option>
					  <option value="3" <?PHP echo ($ordUser->status == '3' ? 'selected' : ''); ?>>Out for delivery</option>
					  <option value="4" <?PHP echo ($ordUser->status == '4' ? 'selected' : ''); ?>>Delivered</option>
					  <option value="5" <?PHP echo ($ordUser->status == '5' ? 'selected' : ''); ?>>Returned</option>
					  <option value="6" <?PHP echo ($ordUser->status == '6' ? 'selected' : ''); ?>>Cancelled</option>
					<select>
				  </td>
				</tr>
				<tr>
				  <td align="right" class="big_text">Remark:</td>
				  <td height="70" align="left" class="big_text"><textarea name="txtRemark" style="border: solid 1px #000;width:80%;height:150px;"><?PHP echo $ordUser->remark; ?></textarea></td>
				</tr>
				<tr>
				  <td align="right" class="big_text">&nbsp;</td>
				  <td height="50" align="left" class="big_text"><input type="submit" name="btnSubmit" value="SAVE" class="btn btn-success btn-xs" style="width:80px;height:30px;" onclick="return doCheck();"></td>
				</tr>				
			</table>
		</div>
	  </td>
	</tr>
  </table>
</form>

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="js/jquery.min.js"></script>
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


<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
			
		// START AND FINISH DATE
			
		$( function() {
			$(".expDate").datepicker({
				format: "yyyy-mm-dd",
				showMeridian: true,
				autoclose: true,
				todayBtn: false,
				startDate: new Date(),
				pickerPosition: "top-down",
				orientation: "auto",
				changeMonth: true,
				changeYear: true
			});
		});

</script>
</body>
</html>

<?php
	include_once '../init.php';
	$general_cls_call->validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL);		// VALIDATION CHEK
	ob_start();
	
	$docVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$_GET['LinkID']), 1);

	/* =========== STATUS CHANGE START ================ */
	/*if(isset($_GET['mode']) && $_GET['mode'] == 'status')
	{
		$setValues="location=:location";
		$updateExecute=array(':location'=>$_GET['val']);
		$whereClause=" WHERE id = '".$_GET['LinkID']."'";
		$general_cls_call->update_query(MEMBER, $setValues, $whereClause, $updateExecute);
		header("location:viewUser.php?LinkID=".$_GET['LinkID']);
	}*/
	/* =========== STATUS CHANGE END ================ */
	if(isset($_POST['btnSubmit'])){
		$purchase_date = $_POST['txtDay'].'-'.$_POST['txtMonth'];
		$setValues="purchase_date=:purchase_date, location=:location";
		$updateExecute=array(':purchase_date'=>$purchase_date,':location'=>$_POST['txtStatus']);

		$whereClause=" WHERE id = '".$_GET['LinkID']."'";

		$general_cls_call->update_query(MEMBER, $setValues, $whereClause, $updateExecute);

		//header("location:user.php");
		?>
		<script>
			window.parent.parent.location.href='user.php';
		</script>

		<?PHP
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
<meta charset="iso-8859-1">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

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
			padding-left:10px;
		}
		.small_text {
			font-family:arial;
			color:#000;
			font-size:12px; 
			line-height:15px; 
			font-weight:normal; 
			font-style:normal;
			padding-left:10px;
		}
	</style>
	<script type="text/javascript">
	<!--
		function ChangeStatus(val,LinkID)
		{
			document.frm.action='viewUser.php?mode=status&val='+val+'&LinkID='+LinkID;
			document.frm.submit();
		}
	//-->
	</script>
</head>
<body style="margin:0px;background-color:#FFF">
<form name="frm" method="post" action="">
  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
	<tr>
	  <td width="100%" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp;&nbsp;DETAILS</td>
	</tr>
	<tr>
	  <td width="100%" class="home_text">
		<div style="height:425px;overflow:auto;">
			<table border="1" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 1px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
				<tr>
				  <td width="100%" colspan="2" class="big_text" align="center" style="font-family:arial;font-weight:normal;font-size:15px;color:#267D07;padding-left:5px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td width="50%" height="30" align="left" class="big_text">Name: &nbsp;<span class="small_text"><?PHP echo $docVal->first_name.' '.$docVal->last_name; ?></span></td>
				  <td align="left" height="30" class="big_text">Email Address: &nbsp;<span class="small_text"><?PHP echo $docVal->email; ?></span></td>
				</tr>
				<tr>
				  <td align="left" height="30" class="big_text">Phone: &nbsp;<span class="small_text"><?PHP echo $docVal->phone; ?></span></td>
				  <td align="left" height="30" class="big_text">Address: &nbsp;<span class="small_text"><?PHP echo $docVal->address; ?></span></td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td align="left" height="30" class="big_text">City: &nbsp;<span class="small_text"><?PHP echo $docVal->city; ?></span></td>
				  <td align="left" height="30" class="big_text">Post: &nbsp;<span class="small_text"><?PHP echo $docVal->zip; ?></span></td>
				</tr>
				<tr>
				  <td align="left" height="30" class="big_text">Country: &nbsp;<span class="small_text"><?PHP echo $docVal->country; ?></span></td>
				  <td align="left" height="30" class="big_text">State: &nbsp;<span class="small_text"><?PHP echo $docVal->state; ?></span></td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td align="left" height="45" class="big_text">Government issued document with address proof: <br><span class="small_text"><img src="resize.php?pic=<?PHP echo ADMIN_USER_IMAGE.$docVal->id_photo; ?>&w=250&h=70" alt="" /></span></td>
				  <td align="left" height="45" class="big_text">User ID: &nbsp;<span class="small_text"><?PHP echo $docVal->member_number; ?></span></td>
				</tr>
				<tr>
				  <td align="left" height="55" class="big_text" >Location:<br/>	
				    <select style="border: solid 1px #000;width:175px;padding:5px;" name="txtStatus">
							<option value="">Select...</option>
					<?PHP
						$attSql = $general_cls_call->select_query("*", LOCATION, "WHERE status=:status", array(':status'=>1), 2);
						if($attSql[0] != '')
						{
							foreach($attSql as $attriVal)
							{
					?>
							<option value="<?PHP echo $attriVal->id; ?>" <?PHP echo($attriVal->id == $docVal->location ? 'selected' : ''); ?>><?PHP echo $attriVal->name; ?></option>
					<?PHP
							}
						}
					?>
					</select>&nbsp;&nbsp;
								
				  </td>
				  
				
					<td align="left" height="55" class="big_text">Date:<br/>		
				    
					<select name="txtDay" style="border: solid 1px #000;width:75px;padding:5px;" required>
						<option value="">Day</option>
						<?php for($i=1;$i<=28;$i++){ ?>
						<option value="<?php echo $i ?>" <?PHP echo ($docVal->purchase_date == $i ? 'selected' : ''); ?>><?php echo $i ?></option>
						<?php } ?>
					</select>
						<input type="submit" name="btnSubmit" value="SAVE" class="btn btn-success btn-xs" style="padding:4px">				
				  </td>

				</tr>
				<tr>
				  <td align="left" height="30" colspan="2" class="big_text" style="padding:10px">
				  
                    <table style="width:100%;">
                      <tr>
			<?PHP
				$useProSql = $general_cls_call->select_query_distinct(MEMBER_PRO_BRAND, "WHERE member_id=:member_id", array(':member_id'=>$docVal->id), "pro_id");
				if($useProSql[0] !='')
				{
					foreach($useProSql as $useProVal)
					{
						$useProValue = $general_cls_call->select_query("*", USE_PRODUCT, "WHERE id=:id", array(':id'=>$useProVal->pro_id), 1);
			?>
                        <td width="25%" style="font-weight:bold;text-align:left;height:30px;"><?PHP echo $useProValue->name; ?></td>
			<?PHP
					}
				}
			?>
                      </tr>
                      <tr>
			<?PHP
				$useBProSql = $general_cls_call->select_query_distinct(MEMBER_PRO_BRAND, "WHERE member_id=:member_id", array(':member_id'=>$docVal->id), "pro_id");
				if($useBProSql[0] !='')
				{
					foreach($useBProSql as $useBProVal)
					{
			?>
                        <td width="25%">
						  <table style="width:100%;">
					<?PHP
						$useBraSql = $general_cls_call->select_query("*", MEMBER_PRO_BRAND, "WHERE member_id=:member_id AND pro_id=:pro_id", array(':member_id'=>$docVal->id,':pro_id'=>$useBProVal->pro_id), 2);
						if($useBraSql[0] !='')
						{
							foreach($useBraSql as $useBraVal)
							{
								$useBraValue = $general_cls_call->select_query("*", USE_BRAND, "WHERE id=:id", array(':id'=>$useBraVal->brand_id), 1);
					?>
							<tr>
							  <td style="text-align:left;font-weight:normal;height:25px;"><?PHP echo $useBraValue->name; ?></td>
							</tr>
					<?PHP
							}
						}
					?>
                          </table>

						</td>
			<?PHP
					}
				}
			?>
                      <tr>
                    </table>
				  </td>
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

</body>
</html>

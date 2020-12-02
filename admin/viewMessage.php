<?php
	include_once '../init.php';
	$general_cls_call->validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL);		// VALIDATION CHEK
	ob_start();

	$messDetails = $general_cls_call->select_query("*", CONTACT_US, "WHERE id=:id", array(':id'=>$_GET['MessID']), 1);

	$setValues="status=:status";
	$updateExecute=array(
		':status'			=>1
	);
	$whereClause=" WHERE id=".$_GET['MessID'];
	$update_deal_city=$general_cls_call->update_query(CONTACT_US, $setValues, $whereClause, $updateExecute);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
<meta charset="iso-8859-1">
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-2" />
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
</head>
<body style="margin:0px;background-color:#FFF">
<form name="frm" method="post" action="">
  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
	<tr>
	  <td width="100%" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp;&nbsp;MESSAGE DETAILS</td>
	</tr>
	<tr>
	  <td width="100%" class="home_text">
		<div style="height:325px;overflow:auto;">
			<table border="1" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 1px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
				<tr>
				  <td width="100%" class="big_text" align="center" style="font-family:arial;font-weight:normal;font-size:15px;color:#267D07;padding-left:5px;">&nbsp;</td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td width="100%" height="25" align="left" class="big_text">Name: &nbsp;<span class="small_text"><?PHP echo $messDetails->name; ?></span></td>
				</tr>
				<tr>
				  <td align="left" height="25" class="big_text">Email Address: &nbsp;<span class="small_text"><?PHP echo $messDetails->email; ?></span></td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td align="left" height="25" class="big_text">Phone: &nbsp;<span class="small_text"><?PHP echo $messDetails->phone; ?></span></td>
				</tr>
				<tr>
				  <td align="left" height="25" class="big_text">Date: &nbsp;<span class="small_text"><?PHP echo $messDetails->date; ?></span></td>
				</tr>
				<tr style="background-color: #f9f9f9;">
				  <td align="left" height="25" class="big_text">Message: &nbsp;<span class="small_text"><?PHP echo nl2br($messDetails->message); ?></span></td>
				</tr>
			</table>
		</div>
	  </td>
	</tr>
  </table>
</form>
</body>
</html>

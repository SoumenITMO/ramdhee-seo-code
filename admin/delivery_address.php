<?php
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

	$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$_GET['id']), 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
<meta charset="iso-8859-1">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
.button{
	border: solid 0px #69CCEB; 
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	color:#FFFFFF;
	width:10%;
	height:30px;
	background-color:#F10F24;
	cursor:pointer;
	border-radius: 3px;
}
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
 <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #BF4C8B"  width="100%"  height="1">
  <tr>
	<td width="100%">
	  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #BF4C8B"  width="100%"  height="1">
		<tr>
		  <td width="50%" height="38" bgcolor="#6A747D" class="home_text" style="color:#FFF">&nbsp;&nbsp;&nbsp;DELIVERY DETAILS</td>
		</tr>
		<tr>
		  <td width="100%" colspan="2" height="5"></td>
		</tr>
		<tr>
		  <td width="50%">
		    <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #BF4C8B"  width="100%"  height="1">
				<tr>
				  <td width="30%" align="right" height="25" class="big_text">Name</td>
				  <td width="2%" align="center" class="big_text">:</td>
				  <td width="68%" align="left" class="small_text"><?PHP echo $userVal->name; ?></td>
				</tr>
				<tr style="background-color: #ECF3F8;">
				  <td align="right" height="25" class="big_text">Address</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->address; ?></td>
				</tr>
				<tr>
				  <td align="right" height="25" class="big_text">Town City</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->city; ?></td>
				</tr>
				<tr style="background-color: #ECF3F8;">
				  <td align="right" height="25" class="big_text">State</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->state; ?></td>
				</tr>
				<tr>
				  <td align="right" height="25" class="big_text">Postcode</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->postal_code; ?></td>
				</tr>
				<tr style="background-color: #ECF3F8;">
				  <td align="right" height="25" class="big_text">Country</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->country; ?></td>
				</tr>
				<tr>
				  <td align="right" height="25" class="big_text">Phone</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->phone; ?></td>
				</tr>
				<tr style="background-color: #ECF3F8;">
				  <td align="right" height="25" class="big_text">Email Address</td>
				  <td align="center" class="big_text">:</td>
				  <td align="left" class="small_text"><?PHP echo $userVal->email; ?></td>
				</tr>
			</table>
		  </td>
		</tr>
	  </table>
	 </td>
   </table>
  </form>
</body>
</html>

<?php
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();
	
	$ordUser = $general_cls_call->select_query("*", ORDERS, "WHERE order_number=:order_number", array(':order_number'=>$_GET['orderID']), 1);
	$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$ordUser->user_id), 1);

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
		  <td width="100%" colspan="3" height="38" bgcolor="#6A747D" class="home_text" style="color:#FFFFFF">&nbsp;&nbsp;&nbsp;VIEW DETAILS</td>
		</tr>
		<tr>
		  <td width="100%" align="center">
		    <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #BF4C8B"  width="100%"  height="1">
			  <tr style="background-color:#F2931D">
			    <td width="17%" height="38" class="big_text" align="center" style="color:#FFF;">IMAGE</td>
			    <td width="43%" class="big_text" style="color:#FFF;text-align:left">Product Name</td>
			    <td width="15%" class="big_text" style="color:#FFF;text-align:center">Quantity</td>
			    <td width="10%" class="big_text" style="color:#FFF;text-align:center">Unit Price</td>
			    <td width="15%" class="big_text" style="color:#FFF;text-align:center">Total</td>
			    
			  </tr>
	<?PHP		
		$oredrVal = $general_cls_call->select_query("*", ORDERS, "WHERE order_number=:order_number", array(':order_number'=>$_GET['orderID']), 1);
		$slideSql = $general_cls_call->select_query("*", ORDERS, "WHERE order_number=:order_number ORDER BY id DESC", array(':order_number'=>$_GET['orderID']), 2);
		
		if($slideSql[0] != '')
		{
			foreach($slideSql as $ordVal)
			{ 				 
				 $item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ordVal->pro_id), 1);
				 $pri = explode('$',$ordVal->price);
				 if(empty($pri[1]))
				 {
					$pri = explode('&euro;',$ordVal->price);
				 }
				 if(empty($pri[1]))
				 {
					$pri = explode('&pound;',$ordVal->price);
				 }

				$ProductTotal = $ordVal->qnt*$item->price;
				$orderTotal += $ProductTotal;
				$priSign = rtrim($ordVal->price,$pri[1]);
	?>
			  <tr style="background-color:<?PHP echo($i%2==0?'#FFFFFF':'#ECF3F8'); ?>" class="small_text">
			    <td class="text" height="25" align="center"><img src="<?PHP echo $item->image1; ?>" style="width:60px;height:80px;" alt="" /></td>
			    <td class="text" style="color:#000;text-align:left">
					<?PHP echo $item->name; ?><br>
					<strong>SKU:</strong>&nbsp;<?PHP echo $item->sku; ?><br>
					<strong>Color:</strong>&nbsp;<?PHP echo $ordVal->color; ?><br>
					<strong>Size:</strong>&nbsp;<?PHP echo $ordVal->size; ?></td>
			    <td class="text" style="color:#000;text-align:center"><?PHP echo $ordVal->qnt; ?>
				</td>
			    <td class="text" style="color:#000;text-align:center"><i class="fa fa-inr" style="font-size: 15px;"></i><?PHP echo '&euro;' . number_format($ordVal->price, 2, ',','.'); ?></td>
			    <td class="text" style="color:#000;text-align:center"><i class="fa fa-inr" style="font-size: 15px;"></i><?PHP echo '&euro;' . number_format($ProductTotal, 2, ',', '.'); ?></td>
			  </tr>
	<?PHP
			$i++;
			}
		}	
		$total = $orderTotal;	

		if($oredrVal->discount !='')
		{
			$discount = $total * $oredrVal->discount / 100;
	?>
			  <tr>
			    <td class="home_text"></td>
			    <td class="home_text"></td>
			    <td class="big_text" colspan="2" style="text-align:right">Total&nbsp;</td>
			    <td class="text" height="20" bgcolor="#1C3F95" style="color:#FFF;text-align:right"><?PHP echo number_format($total,2,'.',''); ?>&nbsp;&nbsp;</td>
			  </tr>
			  <tr>
			    <td class="home_text"></td>
			    <td class="home_text"></td>
			    <td class="big_text" colspan="2" style="text-align:right">Discount&nbsp;</td>
			    <td class="text" height="20" bgcolor="#1C3F95" style="color:#FFF;text-align:right">-<?PHP echo number_format($discount,2,'.',''); ?>&nbsp;&nbsp;</td>
			  </tr>
	<?PHP
		}
	?>
			  <tr>
			    <td class="home_text"></td>
			    <td class="home_text"></td>
			    <td class="big_text" colspan="2" style="text-align:right">Grand Total&nbsp;</td>
			    <td class="text" height="20" bgcolor="#1C3F95" style="color:#FFF;text-align:right"><?PHP echo '&euro;' . number_format($orderTotal,2,',','.'); ?>&nbsp;&nbsp;</td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
  </form>
</body>
</html>

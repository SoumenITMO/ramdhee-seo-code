<?php
	include_once 'init.php';

	$ShoppingCart = new ShoppingCart;
	$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');

	//echo"<pre>";
	//print_r($_POST);
	
	//Receive the RAW post data.
	$json_arr=$_POST['json'];
	 
	//Attempt to decode the incoming RAW post data from JSON.
	$decoded = json_decode($json_arr, true);
	$status = $decoded['status'];
	$amount = $decoded['amount'];
	$reference_mail = $decoded['reference'];
	$transaction = $decoded['transaction'];
	//echo "</pre>";
	$txnId = $_REQUEST;

	if($transaction != '' && $status == 'COMPLETED')
	{		
		foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
		{
			if($countArray == 2)
			{
				$doCoupon = $general_cls_call->select_query("*", COUPON, "WHERE id=:id", array(':id'=>$lastPosation), 1);
				$limit = $doCoupon->limit_qnt - 1;
				$setValues = "limit_qnt=:limit_qnt";
				$updateExecute=array(
					':limit_qnt' =>$limit
				);
				$whereClause=" WHERE id=".$doCoupon->id;
				$update_deal_city=$general_cls_call->update_query(COUPON, $setValues, $whereClause, $updateExecute);
			}
			$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);

			$field = "order_number, user_id, pro_id, price, size, color, qnt, discount, created_date, status";
			$value = ":order_number, :user_id, :pro_id, :price, :size, :color, :qnt, :discount, :created_date, :status";
			$addExecute=array(
				':order_number'	=>$transaction,
				':user_id'		=>$_SESSION['FRONT_USER_ID'],
				':pro_id'		=>$ProductCode,
				':price'		=>$general_cls_call->price_format($item->price),
				':size'			=>$ShoppingCart->arrayCartProductSize[$key],
				':color'		=>$ShoppingCart->arrayCartProductColor[$key],
				':qnt'			=>$ShoppingCart->arrayCartProductQuantity[$key],
				':discount'		=>$doCoupon->discount,
				':created_date'	=>date("Y-m-d H:i:s"),
				':status'		=>1
			);
			$general_cls_call->insert_query(ORDERS, $field, $value, $addExecute);
			
			$currentStock = ($item->stock - $ShoppingCart->arrayCartProductQuantity[$key]);
			$setValues = "stock=:stock";
			$updateExecute=array(
				':stock' =>$currentStock
			);
			$whereClause=" WHERE id=".$ProductCode;
			$update_deal_city=$general_cls_call->update_query(PRODUCT, $setValues, $whereClause, $updateExecute);

		}

		if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID'] != '')
		{
			$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$_SESSION['FRONT_USER_ID']), 1);
		}			
		

		$mail_subject = 'Marketshop - Order Details!';
		$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #4787CE;">					
						<tr>
						  <td align="left" valign="middle" width="100%" style="background-color:#FFF;padding:20px;border-bottom: solid 5px #E33C3D"><img src="'.DOMAIN_NAME.'image/logo.png" alt="'.SITE_TITLE.'"></td>
						</tr>
						<tr>
						  <td align="center" height="10" width="100%">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center">
						   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
							<tr>
							  <td align="left" width="100%" colspan="2" height="25" style="font-family: Arial;font-size:13px;color:#69676A;">Hi,</td>
							</tr>
							<tr>
							  <td align="left" width="100%" colspan="2" height="15"></td>
							</tr>
							<tr>
							  <td align="left" width="100%" colspan="2" height="25" style="font-family: Arial;font-size:13px;color:#69676A;">Below New Order Details:</td>
							</tr>
							<tr>
							  <td align="left" width="100%">
							   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="4" style="border: dashed 1px #9E9393;">
								 <tr>
								  <td align="left" colspan="3" width="39%" style="font-family: Arial;font-size:13px;color:#69676A;padding-left:5px"><b>Delivery Information</b></td>
								 </tr>
								 <tr>
								  <td align="right" width="24%" style="font-family: Arial;font-size:13px;color:#69676A;">Name</td>
								  <td align="center" width="1%" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" width="75%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->name.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">E-mail</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->email.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Phone Number</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->phone.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Address</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->address.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">City/Town</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->city.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Postcode</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->postal_code.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Country</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->country.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">County</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->state.'</td>
								 </tr>
							   </table>
							  </td>			
							</tr>
							<tr>
							  <td align="center" width="100%" colspan="2">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center" width="100%" colspan="2">
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" style="border: dashed 1px #9E9393;">
								 <tr bgcolor="#9E9393">
								  <td align="center" height="35" width="17%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Image</b></td>
								  <td align="left" width="48%" style="font-family: Arial;font-size:13px;color:#FFFFFF;">&nbsp;<b>Product Name</b></td>
								  <td align="center" width="15%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Quantity</b></td>
								  <td align="center" width="5%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Unit Price</b></td>
								  <td align="center" width="15%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Total</b></td>
								 </tr>';

								foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
								{
									if($ShoppingCart->arrayCartProductType[$key] == 'normal')
									{
										$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
										$ProductTotal = $ShoppingCart->arrayCartProductQuantity[$key] * $item->price;
										//$orderTotal += $ProductTotal;
										$orderTotal1 += $ProductTotal;
							if($ShoppingCart->arrayCartProductQuantity[$key]==1)
							{
								$orderTotal = $ShoppingCart->arrayCartProductCourierPrice[$key]+$orderTotal1;
							}else{
								$orderTotal = ($ShoppingCart->arrayCartProductCourierPrice[$key]*$ShoppingCart->arrayCartProductQuantity[$key]) + ($item->price*$ShoppingCart->arrayCartProductQuantity[$key]);
							}

					$mailBody .= '<tr>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;padding-top:5px"><img src="'.$item->image1.'" style="width:50px;height:50px;"></td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;padding-bottom:6px;margin-left:3px" valign="top">'.$item->name.'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$general_cls_call->price_format($item->price).'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$ShoppingCart->arrayCartProductQuantity[$key].'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$general_cls_call->price_format($ProductTotal).'</td>
								 </tr>';
									}
									else
									{
										$totalProductsQuantity += $ShoppingCart->arrayCartProductQuantity[$key];
										$ProductTotal = $ShoppingCart->arrayCartProductQuantity[$key]*9.99;
										$orderTotal += $ProductTotal;

					$mailBody .= '<tr>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;padding-top:5px"><img src="'.DOMAIN_NAME.'customize_product/'.$ProductCode.'.png'.'" style="width:50px;height:50px;"></td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;padding-bottom:6px;margin-left:3px" valign="top">Customize</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$general_cls_call->price_format(9.99).'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$ShoppingCart->arrayCartProductQuantity[$key].'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$general_cls_call->price_format($ProductTotal).'</td>
								 </tr>';
									}

								}				

				   $mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>Total </b></td>
								  <td align="right" class="text"><font color="#E32452">'.$general_cls_call->price_format($orderTotal).'</font>&nbsp;&nbsp;</td>
								</tr>';

					if($countArray == 2)
					{
						$doCoupon = $general_cls_call->select_query("*", COUPON, "WHERE id=:id", array(':id'=>$lastPosation), 1);
						if(!empty($doCoupon))
						{
							$couponPrice = $orderTotal * $doCoupon->discount / 100;
						}
				   $mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>Discount </b></td>
								  <td align="right" class="text"><font color="#E32452">-'.$general_cls_call->price_format($couponPrice).'</font>&nbsp;&nbsp;</td>
								</tr>';
				   $mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>Total </b></td>
								  <td align="right" class="text"><font color="#E32452">'.$general_cls_call->price_format($orderTotal - $couponPrice).'</font>&nbsp;&nbsp;</td>
								</tr>';
					}

				 $mailBody .= '</table>
							  </td>
							</tr>
						   </table>
						  </td>
						</tr>
						<tr>
						  <td align="center" height="10" width="100%">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" width="100%" height="25" style="font-family:arial;font-size:11px;color:#4E4E4E">&copy; Copyright makelikethis.com</td>
						</tr>
					  </table>';

		$headers  = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=UTF-8\r\n";
		$headers.= "From: ".SITE_TITLE."<noreply@makelikethis.com>\r\n";
		$headers.= "X-Sender: <www.makelikethis.com> \n";	
		mail($userVal->email,$mail_subject,$mailBody,$headers);

		
		mail($adminVal->email,$mail_subject,$mailBody,$headers);

		unset($_SESSION["SESS_CART"]);
		session_destroy();
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title><?PHP echo $pageName->meta_title; ?></title>
<meta name="keywords" content="<?PHP echo $pageName->meta_key; ?>">
<meta name="description" content="<?PHP echo $pageName->meta_desc; ?>">

<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>
</head>
<body>
<div class="wrapper-wide">

  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader.php'); ?>
  <!-- ################## HEADER END ################## -->

  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Cancel</a></li>
      </ul>
      <div class="row">
        <div id="content" class="col-sm-12">
          <h1 class="title">Payment Canceled</h1>
          <div class="row">
            <div class="alert alert-danger">
			  <strong>Oops, Something went wrong!</strong> Your payment is not Completed. Try again Later!
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
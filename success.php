<?php
	
	if(isset($_POST)) {
		$pricequote = explode(".", $result)[0].explode(".", $result)[1];
		print_r($result);
		$delv = [];
		$pack = [];

		array_push($pack, array("description" => "Batų dėžė", "size" => "40x26x12", "weight" => 900));
		array_push($delv, array("delivery_address" => 
		array("contact_name" => "Petras Petraitis", "contact_phone" => "+37067812345", "address" => $delvaddress), 
		"pickup_payment_type" => "prepaid", 
		"packages" => $pack,
		"is_contactless" => true));

		$f = array("pickup_address" => array("contact_name" => "Ramanaiah Dheraj", "contact_phone" => "+37258892503", "address" => "Vana kalamaja 29/4"),
		"deliveries" => $delv, "pickup_time_block" => null, "delivery_time_block" => array("start" => $delvstart, "end" => $delvend), 
		"delivery_fee_quote" => $pricequote);

		$ch    = curl_init("https://api-ext.staging.ziticity.com/orders/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($f));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization:Token 2231876d3716851890fe879496fb1db29f447029'));
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response, true);

		// echo $result["pricing"]["delivery_fee"];
	}
?>

<?php
	include_once 'init.php';
	
	$ShoppingCart = new ShoppingCart;
	$prodShopp = $ShoppingCart;
	$productTotalWithoutTax = 0.0;
	$addOnTotal = "";
	$addOnTotalGrand = 0.0;
	$productTax = 0.0;
	$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');
	$txnId = $_REQUEST;
	$vals__ = "";
	
	if(!isset($ShoppingCart->arrayCartProductCode) || empty($ShoppingCart->arrayCartProductCode)) { 
		header("location:".DOMAIN_NAME);
	}
	
	//if($vals__->transaction != '' && $vals__->status == "COMPLETED")
	$countArray = 2;
	$orderTotal = 0;
	$index = 0;
	if(1)
	{		
		foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
		{
			/*if($countArray == 2)
			{
				$doCoupon = $general_cls_call->select_query("*", COUPON, "WHERE id=:id", array(':id'=>$lastPosation), 1);
				$limit = $doCoupon->limit_qnt - 1;
				$setValues = "limit_qnt=:limit_qnt";
				$updateExecute=array(
					':limit_qnt' =>$limit
				);
				$whereClause=" WHERE id=".$doCoupon->id;
				$update_deal_city=$general_cls_call->update_query(COUPON, $setValues, $whereClause, $updateExecute);
			}*/
			$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
			
			$field = "order_number, user_id, pro_id, price, size, color, qnt, discount, created_date, status";
			$value = ":order_number, :user_id, :pro_id, :price, :size, :color, :qnt, :discount, :created_date, :status";
			
			$addExecute = array
			(
				':order_number'	=>rand(), //$vals__->transaction,
				':user_id'		=>$_SESSION['FRONT_USER_ID'],
				':pro_id'		=>$ProductCode,
				':price'		=>$item->price, //$general_cls_call->price_format($vals__->amount),
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
			if($userVal->name == '' || $userVal->email) { 
				//header("location:".DOMAIN_NAME.'success');
			}
		}			
				
		$mail_subject = 'Marketshop - Order Details!';
		$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #4787CE;">					
						<tr>
						  <td align="left" valign="middle" width="100%" style="background-color:#FFF;padding:20px;border-bottom: solid 5px #E33C3D"><img src="'.DOMAIN_NAME.'/favicon.ico"" alt="'.SITE_TITLE.'"></td>
						</tr>
						<tr>
						  <td align="center" height="10" width="100%">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center">
						   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
							<tr>
							  <td align="left" width="100%" colspan="2" height="25" style="font-family: Arial;font-size:13px;color:#69676A;">Tere,</td>
							</tr>
							<tr>
							  <td align="left" width="100%" colspan="2" height="15"></td>
							</tr>
							<tr>
							  <td align="left" width="100%" colspan="2" height="25" style="font-family: Arial;font-size:13px;color:#69676A;">Uus kord:</td>
							</tr>
							<tr>
							  <td align="left" width="100%">
							   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="4" style="border: dashed 1px #9E9393;">
								 <tr>
								  <td align="left" colspan="3" width="39%" style="font-family: Arial;font-size:13px;color:#69676A;padding-left:5px"><b>Tarneteave</b></td>
								 </tr>
								 <tr>
								  <td align="right" width="24%" style="font-family: Arial;font-size:13px;color:#69676A;">Nimi</td>
								  <td align="center" width="1%" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" width="75%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->name.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">E-post</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->email.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Telefoninumber</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->phone.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Aadress</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->address.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Linn</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->city.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Postiindeks</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->postal_code.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Riik</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">:</td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$userVal->country.'</td>
								 </tr>
								 <tr>
								  <td align="right" style="font-family: Arial;font-size:13px;color:#69676A;">Osariik</td>
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
								  <td align="center" height="35" width="17%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Foto</b></td>
								  <td align="left" width="40%" style="font-family: Arial;font-size:13px;color:#FFFFFF;">&nbsp;<b>Tootenimi</b></td>
								  <td align="center" width="5%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Kogus</b></td>
								  <td align="center" width="13%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Ühikuhind</b></td>
								  <td align="center" width="13%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>KMKR(20%)</b></td>
								  <td align="center" width="13%" style="font-family: Arial;font-size:13px;color:#FFFFFF;"><b>Kokku</b></td>
								 </tr>';

								 
								foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
								{
										$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
										$ProductTotal = $ShoppingCart->arrayCartProductQuantity[$key] * $item->price;
										$productTotalWithoutTax += $ShoppingCart->arrayCartProductQuantity[$key] * ($item->price - ($item->price * 0.20));
										$orderTotal += $ProductTotal + $addOnPrice;
										$productTax += $item->price * 0.20;
										$addons = "";
										$extraAddonsPrice = "";
										$extraAddonsTax = "";
										foreach(explode(",", $prodShopp->arrayCartProductAddOn[$index]) as $key=>$addonVal) {
											$addOnProduct = explode("-", $addonVal);
											if($addOnProduct[0] != null) {
												// $addons .= $addOnProduct[0] . "  €" . $addOnProduct[1]."</br>";	
												$addOnTotal .= "  €".number_format($addOnProduct[1], 2, ',','.');
												$addons .= "</br>" . $addOnProduct[0];
												$extraAddonsPrice .= "</br>" . "  €" . number_format(($addOnProduct[1] - ($addOnProduct[1] * 0.20)), 2, ',', '.');
												$extraAddonsTax .= "  </br>€" . number_format(($addOnProduct[1] * 0.20), 2, ',','.')."</br>";
											}
											$addOnPrice += number_format(($addOnProduct[1] - ($addOnProduct[1] * 0.20)), 2, ',', '.');
											$addOnTotalGrand += $addOnProduct[1];
										}
										if($addons != "") {
										$addons = "</br><b> Lisa : </b>" . $addons;
										}
										$prodShopp->arrayCartProductAddOn[$key] = null;

					$mailBody .= '<tr>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;padding-top:5px"><a href="https://ramadhee.ee/product_details.php?product_id='.$ProductCode.'"><img src="https://ramadhee.ee/upload_images./'.$item->image1.'" style="width:50px;height:50px;"></a></td>
								  <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;padding-bottom:6px;margin-left:3px" valign="top">'.$item->name . $addons .'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">'.$ShoppingCart->arrayCartProductQuantity[$key].'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;"> €'.number_format($item->price - ($item->price * 0.20), 2, ',', '.') . $extraAddonsPrice .'</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">€'.number_format(($item->price * 0.20), 2, ',', '.'). "</br>" . $extraAddonsTax . '</td>
								  <td align="center" style="font-family: Arial;font-size:13px;color:#69676A;">€'.number_format($ProductTotal, 2, ',', '.'). "</br>".$addOnTotal.'</td>
								 </tr>';
									
									/*else
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
									}*/
								  $index++;
								}			

				   $mailBody .= '<tr>
								  <td align="center" class="text" colspan=5><b>Kuller : </b></td>
								  <td align="center" class="text" colspan=1>€'.number_format(0, 2, ',', '.').'</font></td>
								</tr>
								';							

				   $mailBody .= '<tr>
								  <td align="center" class="text" colspan=3><b>Kokku : </b> </td>
								  <td align="center" class="text" colspan=1> <span class="txt-sty">€'.number_format($productTotalWithoutTax, 2, ',', '.').'</span> </td>
								  <td align="center" class="text" colspan=1> <span class="txt-sty"> €'.number_format($productTax, 2, ',', '.').' </span> </td>
								  <td align="center" class="text" colspan=1> <span> €'.number_format(($productTotalWithoutTax + $productTax + $addOnTotalGrand), 2, ',', '.').'</span></td>
								</tr>
								';
								
					
								$addOnPrice = 0.0;

					if($countArray == 2)
					{
						$doCoupon = $general_cls_call->select_query("*", COUPON, "WHERE id=:id", array(':id'=>$lastPosation), 1);
						if(!empty($doCoupon))
						{
							$couponPrice = $orderTotal * $doCoupon->discount / 100;
						}
				   /*$mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>Allahindlus </b></td>
								  <td align="right" class="text"><font color="#E32452">-'.number_format(0.00, 2, ',', '.').'</font>&nbsp;&nbsp;</td>
								</tr>';
				   $mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>VAT </b></td>
								  <td align="right" class="text"><font color="#E32452">20%</font>&nbsp;&nbsp;</td>
								</tr>';
				   $mailBody .= '<tr>
								  <td align="right" class="text" colspan="4"><b>Kokku </b></td>
								  <td align="right" class="text"><font color="#E32452">'.number_format(($orderTotal) + ($orderTotal * 0.20), 2, ',', '.').'</font>&nbsp;&nbsp;</td>
								</tr>';*/
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
						  <td align="center" width="100%" height="25" style="font-family:arial;font-size:11px;color:#4E4E4E">&copy; Autoriõigus ramadhee.ee/</td>
						</tr>
					  </table>';
		
	    if(isset($ShoppingCart->arrayCartProductCode) || !empty($ShoppingCart->arrayCartProductCode)) { 	  
			$headers  = "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=UTF-8\r\n";
			$headers.= "From: ".SITE_TITLE."<noreply@ramadhee.ee>\r\n";
			$headers.= "X-Sender: <www.ramadhee.ee/> \n";	
			mail($userVal->email,$mail_subject,$mailBody,$headers);
			mail("soumenbanerjeenik@gmail.com",$mail_subject,$mailBody,$headers);
			mail($adminVal->email,$mail_subject,$mailBody,$headers);
			mail("ramanaiah_01@hotmail.com",$mail_subject,$mailBody,$headers);
			unset($_SESSION["SESS_CART"]);
			session_destroy();
		}
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
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->

  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Edukus</a></li>
      </ul>
      <div class="row">
        <div id="content" class="col-sm-12">
          <h1 class="title">Makse õnnestumine</h1>
          <div class="row">
            <div class="col-sm-12">
			  Aitäh! Teie makse edukalt. Keegi võtab teiega esimesel võimalusel ühendust.
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
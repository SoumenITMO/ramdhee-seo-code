<?php
	include_once 'init.php';
	include_once 'vars.php';
	//include_once 'test_paypal.php';	
	$ShoppingCart = new ShoppingCart;
	$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');
	$ShopProduct = $ShoppingCart;
	if(isset($_POST['btnCheckout']))
	{
		if($_POST['txtName'] == "" || $_POST['txtEmail'] == "") {
			header("location:".DOMAIN_NAME);
		}
		
		extract($_POST);
		$docCheck = $general_cls_call->select_query("id,email", MEMBER, "WHERE email=:email", array(':email'=>$general_cls_call->specialhtmlremover($txtEmail)), 1); 
		if($docCheck!='')
		{			
			echo 11;
			$setValues = "name=:name, email=:email, phone=:phone, state=:state, city=:city, country=:country, address=:address, postal_code=:postal_code";
			$updateExecute=array(
				':name'				=>$general_cls_call->specialhtmlremover($txtName),
				':email'			=>$general_cls_call->specialhtmlremover($txtEmail),
				':phone'			=>$general_cls_call->specialhtmlremover($txtPhone),
				':state'			=>$general_cls_call->specialhtmlremover($txtState),
				':city'				=>$general_cls_call->specialhtmlremover($txtCity),
				':country'			=>$general_cls_call->specialhtmlremover($txtCountry),
				':address'			=>$general_cls_call->specialhtmlremover($txtAddress),
				':postal_code'		=>$general_cls_call->specialhtmlremover($txtZip)
			);
			$whereClause=" WHERE email='".$general_cls_call->specialhtmlremover($txtEmail)."'";
			$general_cls_call->update_query(MEMBER, $setValues, $whereClause, $updateExecute);
			$_SESSION['FRONT_USER_ID'] = $docCheck->id;
			header("location:".DOMAIN_NAME.'seo/'."success.php");
		}
		
		else
		{
			$rand = rand();
			$field = "name, email, password, phone, state, city, country, address, postal_code, created_date, status";
			$value = ":name, :email, :password, :phone, :state, :city, :country, :address, :postal_code, :created_date, :status";
			$addExecute=array(
				':name'				=>$general_cls_call->specialhtmlremover($txtName),
				':email'			=>$general_cls_call->specialhtmlremover($txtEmail),
				':password'			=>$rand,
				':phone'			=>$general_cls_call->specialhtmlremover($txtPhone),
				':state'			=>$general_cls_call->specialhtmlremover($txtState),
				':city'				=>$general_cls_call->specialhtmlremover($txtCity),
				':country'			=>$general_cls_call->specialhtmlremover($txtCountry),
				':address'			=>$general_cls_call->specialhtmlremover($txtAddress),
				':postal_code'		=>$general_cls_call->specialhtmlremover($txtZip),
				':created_date'		=>date("Y-m-d H:i:s"),
				':status'			=>1
			);
			$id = $general_cls_call->insert_query(MEMBER, $field, $value, $addExecute);
			$_SESSION['FRONT_USER_ID'] = $id; 
			
			$mail_subject = 'Your password '.SITE_TITLE;
			$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #000000">					
							<tr>
							  <td align="left" valign="middle" width="100%" style="background-color:#FFFFFF;padding:20px;border-bottom: solid 5px #E33C3D"><img src="'.DOMAIN_NAME.'image/logo.png" alt="makelikethis"></td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center">
							   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>Dear '.ucfirst($general_cls_call->specialhtmlremover($txtName)).'</b>,</td>
								 </tr>
								 <tr>
								   <td align="right" width="5%">&nbsp;</td>
								   <td align="left" width="95%" style="font-family: Arial;font-size:13px;color:#69676A;">Thank you for registering on our online secure and user-friendly ecommerce platform. The following describes your login information.</td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25">&nbsp;</td>
								 </tr>
								 <tr>
								   <td align="right" width="5%">&nbsp;</td>
								   <td align="center" width="95%" style="font-family: Arial;font-size:13px;color:#69676A;">
									 <table width="96%" border="0" align="center" cellpadding="0" cellspacing="4">
									   <tr>
										 <td align="right" width="25%" style="font-family: Arial;font-size:13px;color:#000;font-weight:bold">Email:&nbsp;&nbsp;</td>
										 <td align="left" width="75%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$general_cls_call->specialhtmlremover($txtEmail).'</td>
									   </tr>
									   <tr>
										 <td align="right" style="font-family: Arial;font-size:13px;color:#000;font-weight:bold">Password:&nbsp;&nbsp;</td>
										 <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$rand.'</td>
									   </tr>
									 </table>
								   </td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25">&nbsp;</td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000;"><b>Thanks,<br/>Administrator</b></td>
								 </tr>
							   </table>
							  </td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center" width="100%" height="25" style="background-color:#4E4E4E;font-family:arial;font-size:11px;color:#FFFFFF">Copyright &copy; '.date('Y').' . All Rights Reserved.</td>
							</tr>
						  </table>';

			$mail_to = $general_cls_call->specialhtmlremover($txtEmail);
			$headers  = "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=UTF-8\r\n";
			$headers.= "From: ".SITE_TITLE."<noreply@makelikethis.ee>\r\n";
			$headers.= "X-Sender: <www.makelikethis.ee> \n";
			
			//mail("soumenbanerjeenik@gmail.com", $mail_subject, $mailBody, $headers);
			//mail("ramanaiah_01@hotmail.com", $mail_subject, $mailBody, $headers);
			header("location:".DOMAIN_NAME."success");
		}		
	}
	
	if(isset($_POST['btnCheckout_nets']))
	{
		////////////////////////////////////////////////////// NETS PAYMENT ///////////////////////////////////////////////////////////////
		mb_internal_encoding('UTF-8');
		
		$ver          = 004;
		$auto         = "N";
		$cur          = 'EUR';
		$id           = "PLOPMHDTA8";  //"AFGVEU5KHO"; // SHOP ID
		$ecuno        = rand(100000, 999999);
		$action       = 'gaf';
		$eamount      = $sum_;
		$respcode     = "000";
		$datetime     = date('YmdHis');
		$msgdata      = "Soumen Banerjee";
		$actiontext   = "OK, tehing autoriseeritud";
		$receipt_no   = "02973";
		$charEncoding = "UTF-8";
		
		$feedBackUrl = "https://www.makelikethis.co.uk/merchantpage";
		$delivery    = "S";
		$additionalinfo = "";
		
		$mac = ""; 
		$mac1 = "";
			
		//// PRIVATE KEY CHECKING 
		
		$key = 'private.key'; # key file name and location
		$fp = fopen("$key", "r");
		$fs = filesize("$key");
		$priv_key = fread($fp, $fs);
		fclose($fp);
		
		# Load public key
		$key = "public.key";
		$fp = fopen("$key", "r");
		$fs = filesize("$key");
		$pub_key = fread($fp, $fs);
		fclose($fp);
		
		$data = '';
		
		if($action == "afb")
		{
					$data = ''
					. mb_sprintf("%03d", $ver)
					. mb_sprintf("%-10s", $id)
					. mb_sprintf("%012d", $ecuno)
					. mb_sprintf("%06d", 012545)
					. mb_sprintf("%012d", $eamount )
					. mb_sprintf("%s", $cur)
					. mb_sprintf("%s", $respcode)
					. mb_sprintf("%s", $datetime)
					. mb_sprintf("%-40s", $msgdata)
					. mb_sprintf("%-40s", $actiontext);
		
		}
		
		else
		{
					$data = ''
					. mb_sprintf('%03d', $ver)
					. mb_sprintf('%-10s', $id)
					. mb_sprintf('%012d', $ecuno)
					. mb_sprintf('%012d', $eamount)
					. mb_sprintf('%s', $cur)
					. mb_sprintf('%s', $datetime)
					. mb_sprintf('%-128s', $feedBackUrl)
					. mb_sprintF('%s', $delivery);
		}
		
		//$signature = sha1($data); 
		$signature = "";
		
		openssl_sign($data, $signature, openssl_pkey_get_private($priv_key));
		
		$mac   = bin2hex($signature);
		$mac1   = "72BCD391A52F94B25DC3B030219F8E6E1B3EA23DE73315CD364BD79A0CAB7AC96D12306D313D653252573C197AFD72069101B63AC1C871498D5F04426B923F048FBC4F41BB2C4C5A8B60D0BCBA0B3EF231C44BD48A8480D8873A4217DF2F587F22AA172345D79C19FA32E1BDFD1854363D73E24B14C70036404A2EA6B7C643B9";
		
		//openssl_free_key($priv_key);
		
		
		$result = openssl_verify($data_res, pack('H*', $mac1), openssl_pkey_get_public($pub_key));
		
		
		///////////////////////////////////////////////////////////////////
	
		function mb_sprintf($format) 
		{
			$argv = func_get_args() ;
			array_shift($argv) ;
			return mb_vsprintf($format, $argv);
		}
	
		function mb_vsprintf($format, $argv, $encoding = NULL) 
		{
			if (is_null($encoding)) 
			{
				$encoding = mb_internal_encoding();
			}

			// Use UTF-8 in the format so we can use the u flag in preg_split
			$format = mb_convert_encoding($format, 'UTF-8', $encoding);

			$newformat = ""; // build a new format in UTF-8
			$newargv = array(); // unhandled args in unchanged encoding

			while ($format !== "") 
			{
				// Split the format in two parts: $pre and $post by the first %-directive
				// We get also the matched groups
				$rx = "!\%(\+?)('.|[0 ]|)(-?)([1-9][0-9]*|)(\.[1-9][0-9]*|)([%a-zA-Z])!u";
				list ($pre, $sign, $filler, $align, $size, $precision, $type, $post) =
				preg_split($rx, $format, 2, PREG_SPLIT_DELIM_CAPTURE) ;

				$newformat .= mb_convert_encoding($pre, $encoding, 'UTF-8');

				if ($type == '') 
				{
					// didn't match. do nothing. this is the last iteration.
				}
				
				elseif ($type == '%') 
				{
					// an escaped %
					$newformat .= '%%';
				}
				
				elseif ($type == 's') 
				{
					$arg = array_shift($argv);
					$arg = mb_convert_encoding($arg, 'UTF-8', $encoding);
					$padding_pre = '';
					$padding_post = '';

					// truncate $arg
					if ($precision !== '') 
					{
						$precision = intval(substr($precision, 1));
						
						if ($precision > 0 && mb_strlen($arg, $encoding) > $precision) 
						{
							$arg = mb_substr($precision, 0, $precision, $encoding);
						}
					}

					// define padding
					if ($size > 0) 
					{
						$arglen = mb_strlen($arg, $encoding);
						if ($arglen < $size) 
						{
							if ($filler === '') 
							{
								$filler = ' ';
							}
							if ($align == '-') 
							{	
								$padding_post = str_repeat($filler, $size - $arglen);
							}
							else 
							{
								$padding_pre = str_repeat($filler, $size - $arglen);
							}
						}
					}

					// escape % and pass it forward
					$newformat .= ''. $padding_pre. str_replace('%', '%%', $arg). $padding_post;
				}
				
				else 
				{
					// another type, pass forward
					$newformat .= "%$sign$filler$align$size$precision$type";
					$newargv[] = array_shift($argv);
				}
				$format = strval($post);
			}
		
			// Convert new format back from UTF-8 to the original encoding
			$newformat = mb_convert_encoding($newformat, $encoding, 'UTF-8');
			return vsprintf($newformat, $newargv);	
		}
		
		function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = 'UTF-8')
		{
			$input_length = mb_strlen($input, $encoding);
			$pad_string_length = mb_strlen($pad_string, $encoding);

			if ($pad_length <= 0 || ($pad_length - $input_length) <= 0) 
			{
				return $input;
			}

			$num_pad_chars = $pad_length - $input_length;

			switch ($pad_type) 
			{
				case STR_PAD_RIGHT:
									$left_pad = 0;
									$right_pad = $num_pad_chars;
									break;

				case STR_PAD_LEFT:
									$left_pad = $num_pad_chars;
									$right_pad = 0;
									break;

				case STR_PAD_BOTH:
									$left_pad = floor($num_pad_chars / 2);
									$right_pad = $num_pad_chars - $left_pad;
									break;
			}

			$result = '';
			
			for ($i = 0; $i < $left_pad; ++$i) 
				$result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);
			
			$result .= $input;
			
			for ($i = 0; $i < $right_pad; ++$i) 
				$result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);

			return $result;
		}

		echo  "<form  name='form' action='https://test.estcard.ee/ecom/iPayServlet' name='netpay_' class = 'netpay_' method='POST' style = 'display:none'> 
				   <input type='hidden' name = 'action' value = '<?=$action?>'>
				   <input type='hidden' name = 'ver' value = '<?=$ver ?>'>
				   <input type='hidden' name = 'id' value = '<?=$id?>'> 
				   <input type='hidden' name = 'ecuno' value='<?=$ecuno?>'>
				   <input type='hidden' name = 'eamount' value='<?=$eamount?>'>
				   <input type='hidden' name = 'cur' value='EUR'>
				   <input type='hidden' name = 'datetime' value='<?=$datetime?>'>
				   <input type='hidden' name = 'mac' value='<?=$mac?>'>
				   <input type='hidden' name = 'lang' value='en'>
				   <input type='hidden' name = 'charEncoding' value='UTF-8'>
				   <input type='hidden' name = 'feedBackUrl' value='<?=$feedBackUrl?>'>
				   <input type='hidden' name = 'delivery' value='<?=$delivery?>'>			
			   </form>";
	}

	if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID'] != '')
	{
		$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$_SESSION['FRONT_USER_ID']), 1);
	}
	
	if(!isset($_POST['txtName'])) { $_POST['txtName'] =			$userVal->name; }
	if(!isset($_POST['txtEmail'])) { $_POST['txtEmail'] =		$userVal->email; }
	if(!isset($_POST['txtPhone'])) { $_POST['txtPhone'] =		$userVal->phone; }
	if(!isset($_POST['txtZip'])) { $_POST['txtZip'] =			$userVal->postal_code; }
	if(!isset($_POST['txtState'])) { $_POST['txtState'] =		$userVal->state; }
	if(!isset($_POST['txtCity'])) { $_POST['txtCity'] =			$userVal->city; }
	if(!isset($_POST['txtCountry'])) { $_POST['txtCountry'] =	$userVal->country; }
	if(!isset($_POST['txtAddress'])) { $_POST['txtAddress'] =	$userVal->address; }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title> Tasty and Delicious Food with free delivery across Tallinn </title>
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

<style>
.nets_pay
{
	width: 200px;
	height: 1px;
	//position: relative;
	top: -85px;
    left: 928px;
}

.bank-links
{
	//position: relative;
    //right: 568px;
}

.nets_pay_
{
	position: relative;
	left: 352px;
}
</style>

<body>
<div class="wrapper-wide">
  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->

   <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Kassas</a></li>
      </ul>
      <div class="row">
		<form name="frm" method="post" action="" onsubmit="return validateMyForm()">
        <div id="content" class="col-sm-12">
          <h1 class="title">Kassas</h1>
          <div class="row">
            <div class="col-sm-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-user"></i> Saaja aadress</h4>
                </div>
                  <div class="panel-body">
					<fieldset id="account">
					  <div class="form-group required">
						<label for="input-payment-firstname" class="control-label">Nimi</label>
						<input type="text" class="form-control name_" placeholder="Nimi" value="<?PHP echo $_POST['txtName']; ?>" name="txtName" required>
					  </div>
					  <div class="form-group required">
						<label for="input-payment-email" class="control-label">E-post</label>
						<input type="email" class="form-control email_" placeholder="E-post" value="<?PHP echo $_POST['txtEmail']; ?>" name="txtEmail" required>
					  </div>
					  <div class="form-group required">
						<label for="input-payment-telephone" class="control-label">Telefon</label>
						<input type="text" class="form-control phone_" placeholder="Telefon" value="<?PHP echo $_POST['txtPhone']; ?>" name="txtPhone" required>
					  </div>
					  <div class="form-group required">
						<label for="input-payment-fax" class="control-label">Postiindeks</label>
						<input type="text" class="form-control zip_code_" placeholder="Postiindeks" value="<?PHP echo $_POST['txtZip']; ?>" name="txtZip" required>
					  </div>
					  <div class="form-group required">
						<label for="input-payment-fax" class="control-label">Osariik</label>
						<input type="text" class="form-control state_" placeholder="Osariik" value="<?PHP echo $_POST['txtState']; ?>" name="txtState" required>
					  </div>
					  <div class="form-group required">
						<label for="input-payment-fax" class="control-label">Linn</label>
						<input type="text" class="form-control city_" placeholder="Linn" value="<?PHP echo $_POST['txtCity']; ?>" name="txtCity" required>
					  </div>
					
					  <div class="form-group required">
						<label for="input-payment-fax" class="control-label">Aadress</label>
						<input type="text" class="form-control address_" placeholder="Aadress" value="<?PHP echo $_POST['txtAddress']; ?>" name="txtAddress" required>
					  </div>
					</fieldset>
				  </div>
              </div>
            </div>
<?PHP
	if((isset($_SESSION["SESS_CART"]) && $_SESSION["SESS_CART"] != "") && count($_SESSION["SESS_CART"][0])!=0)
	{
?>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Ostukorv</h4>
                    </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-center">Fotod</td>
                                <td class="text-left">Tootenimi</td>
                                <td class="text-left">Kogus</td>
                                <td class="text-right">Ühikuhind</td>
								<td class="text-right">KMKR(20%)</td>
								<td class="text-right">Kokku</td>
                              </tr>
                            </thead>
                            <tbody>
				
				<?PHP
				
					$sum_         = 0;
					$i			  = 1;
					$index        = 0;
					$orderTotal   = 0;
					$ProductTotal = 0.0;
					$orderTotal1  = 0;
					$prod_total	  = 0;
					$totalProductsQuantity = 0;
					$addonFinalPrice = 0;
					$addOnPrice = 0.0;
					$addOnTotal = 0.0;
					$productTaxTotal = 0.0;
					$addOnTax = 0.0;
					$productTotalWithoutTax = 0.0;
					
					foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
					{
						if($ShoppingCart->arrayCartProductType[$key] != 'normal')
						{
							$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
							$totalProductsQuantity += $ShoppingCart->arrayCartProductQuantity[$key]; 
							
							//$ProductTotal = ($ShoppingCart->arrayCartProductQuantity[$key] * $general_cls_call->price_format($item->price)) + ($ShoppingCart->arrayCartProductQuantity[$key] * $ShoppingCart->shippngCost[$key]);
							$ProductTotal += number_format(($ShoppingCart->arrayCartProductQuantity[$key] * $item->price), 2); // - ($item->price * 0.20)), 2);
							$productTotalWithoutTax += number_format(($ShoppingCart->arrayCartProductQuantity[$key] * $item->price - ($item->price * 0.20)), 2);
							$productTaxTotal += $item->price * 0.20;
							//$ProductTotal = $ProductTotal + $ShoppingCart->arrayCartProductQuantity[$key];
							//$orderTotal1  += $ProductTotal;
														
							if($ShoppingCart->arrayCartProductQuantity[$key] == 1)
							{
								$orderTotal = $ShoppingCart->arrayCartProductCourierPrice[$key]+$orderTotal1;
							}
							
							else
							{
								$orderTotal = ($ShoppingCart->arrayCartProductCourierPrice[$key]*$ShoppingCart->arrayCartProductQuantity[$key]) + ($item->price*$ShoppingCart->arrayCartProductQuantity[$key]);
							}		
				?>
                              <tr>
                                <td class="text-center"><a href="<?PHP echo "https://ramadhee.ee/product_details.php?product_id=".$item->id; ?>"><img height="50" width="50" src="<?php echo "https://ramadhee.ee/upload_images./".$item->image1; ?>" alt="<?php echo $item->name; ?>" class="img-thumbnail" /></a></td>
                                <td class="text-left" style="font-size:12px;">
								<?php 
										$addons = "";
										$extraAddonsPrice = "";
										$extraAddonsTax = "";
										
										$withoutTax = "€" . $item->price;
										foreach(explode(",", $ShopProduct->arrayCartProductAddOn[$key]) as $key=>$addonVal)
										{
											$addOnProduct = explode("-", $addonVal);
											if($addOnProduct[0] != null) {
												$withoutTax .= "</br> €" . $addOnProduct[1];	
												$addons .= "</br> <b>" . $addOnProduct[0] . "</b>";
												$extraAddonsPrice .= "</br>" . "  €" . number_format(($addOnProduct[1] - ($addOnProduct[1] * 0.20)), 2);
												$extraAddonsTax .= "</br>" . "  €" . number_format(($addOnProduct[1] * 0.20), 2);
											} 
											
											if($addOnProduct[1] != null) {
												$addOnTax += ($addOnProduct[1] * 0.20);
												$addOnPrice += number_format(($addOnProduct[1] - ($addOnProduct[1] * 0.20)), 2);
												$addOnTotal += number_format(($addOnProduct[1]), 2);
											}
										}

										$ShopProduct->arrayCartProductAddOn[$key] = null;
										echo $item->name . "</br> <b> Lisa : </b>" . $addons;
								?>
								
								<br />
								</td>
                                <td class="text-left"><?=$ShoppingCart->arrayCartProductQuantity[$index]?></td>
								<td class="text-right"><?php 
															//echo "€".number_format($general_cls_call->price_format($item->price), 2, '.', ',');
															echo "€".number_format($item->price - ($item->price * 0.20), 2, ',', ',') . " " . $extraAddonsPrice;
	
														?>
								</td>
								<td class="text-right"><?="€".number_format(($item->price * 0.20), 2, ',', ',') . " " . $extraAddonsTax?></td>
								<td class="text-right"><?=$withoutTax?></td>
                              </tr>
				<?PHP
						}
						
						else
						{
							$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
							$totalProductsQuantity += $ShoppingCart->arrayCartProductQuantity[$key];
							$ProductTotal = $ShoppingCart->arrayCartProductQuantity[$key]*9.99;
							// $orderTotal += $ProductTotals;
							// $orderTotal += $addOnPrice;
				?>
                              <tr> 
                                <td class="text-center"><img height="120" width="120" src="<?php echo $item->image1?>" alt="<?php echo $item->name; ?>" class="img-thumbnail" /></td>
                                
								
								<td class="text-left" style="font-size:12px;">
								 <b>Body Length:</b> <?PHP echo $ShoppingCart->arrayCartProductColor[$key]; ?>cm.<br>
								 <b>Hand Length:</b> <?PHP echo $ShoppingCart->arrayCartProductSize[$key]; ?>cm.
								</td>
                                <td class="text-left"><?PHP echo $ShoppingCart->arrayCartProductQuantity[$key]; ?></td>
								<td class="text-right"><?PHP echo $general_cls_call->price_format(9.99); ?></td>
								<td class="text-right"><?PHP echo $general_cls_call->price_format($ProductTotal); ?></td>
                              </tr>
				<?PHP
						}
						$index++;
						
					}
					
				?>
                            </tbody>
				<?PHP
					$vat_ = 1.45;
					if(isset($_POST['btnCoupon']))
					{
						$doCoupon = $general_cls_call->select_query("*", COUPON, "WHERE coupon=:coupon AND status=:status AND limit_qnt<>:limit_qnt", array(':coupon'=>$_POST['txtCoupon'], ':status'=>1, ':limit_qnt'=>0), 1);
						if(!empty($doCoupon))
						{
							//echo number_format((($orderTotal1 * $doCoupon->discount) / 100), 2)."  ".$doCoupon->discount;
							//$coupon_discount = $doCoupon->discount."%";
							//$couponPrice = $orderTotal1 * $doCoupon->discount / 100;
							//$orderTotal1 = $orderTotal1 - $couponPrice;
							$orderTotal1 = $prod_total	 - number_format((($prod_total * $doCoupon->discount) / 100), 2,',',',');
						}
						
						else
						{
							$erMsg = '<li>This coupon code is not valid.</li>';
						}
					}
				?>
                            <tfoot>
                             
						<?PHP
							if($couponPrice =='')
							{
						?>	  
							  <!-- <tr>
                                <td class="text-right" colspan="4"><strong>Kokku:</strong></td> 
                                <td class="text-right"> 
									
									<input type="hidden" name="total_" value="<?php echo "&euro;".number_format((($orderTotal1*100)/100), 2, ',',','); $sum_ = str_replace(".","",(floor(($orderTotal1*100))/100));?>" />
								</td>
                              </tr> -->
							  
							  <tr>
                                
                              </tr>
							  <!--<tr>
							   <td class="text-right" colspan="5"><strong>Kohaletoimetamine:</strong></td>
							  <td class="text-right" colspan="5"><strong><?php echo "&euro;".$_SESSION["delv_fee"];?></strong></td>
							  </tr> -->
							  <tr>
								<td class="text-right" colspan="1"><strong>Kuller : </strong></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td style="text-align: right;"><?php echo "€".number_format(0, 2)?></td>
							  </tr>
								
								
							  <tr>
                                <td class="text-right" colspan="1"><strong>Kokku : </strong></td> 
								<td> </td>
								<td> </td>
								<td style="text-align: right;"><?php echo "€".number_format(($productTotalWithoutTax + $addOnPrice) ,2)?> </td>
								<td style="text-align: right;"><?php echo "€".number_format(($productTaxTotal + $addOnTax), 2)?></td>
                                <td class="text-right"> 
									<?php //"&euro;".number_format(((($orderTotal1*100))/100) + $_SESSION["delv_fee"], 2, ',',',')
									      // echo "&euro;".number_format(($orderTotal1 + $addOnPrice) + (($orderTotal1 + $addOnPrice) * 0.20), 2, ',',',');
										  // echo "&euro;".number_format(($orderTotal1 + (($orderTotal1 + $addOnPrice) * 0.20)), 2);
										  echo "&euro;".number_format(($ProductTotal + $addOnTotal), 2, ',',','); 
										  $addOnPrice = 0.0;
									?> 
									<!-- <input type="hidden" name="total_" value="<?php echo "&euro;".(($orderTotal1*100)/100) + $_SESSION["delv_fee"]; 
																					$sum_ = str_replace(".","",$orderTotal2);
																					$_SESSION["amount_"] = $sum_;
																			  ?>" /> -->
								    
									<input type="hidden" name="total_" value="<?php echo "&euro;".(($orderTotal1*100)/100); 
																					$sum_ = str_replace(".","",$orderTotal2 + ($orderTotal2 * 0.20));
																					$_SESSION["amount_"] = $sum_;
																			  ?>" /> 
								</td>
								
                              </tr>
						<?PHP
							}
						?>
						
						<?PHP
							if($couponPrice !='')
							{
						?>
								<tr>
                                <td class="text-right" colspan="5"><strong>Sub Total:</strong></td> 
                                <td class="text-right"> 
									<?="&euro;".(floor(($orderTotal1*100))/100)?> 
									<input type="hidden" name="total_" value="<?php echo "&euro;".(floor(($orderTotal1*100))/100);?>" />
								</td>
                              </tr>
							  
							  <tr>
                                <td class="text-right" colspan="5"><strong>VAT:</strong></td>
                                <td class="text-right">
														<?php echo "20%";?>
														<input type="hidden" name="total_" value="<?php echo number_format($orderTotal, 2, ',',','); $sum_ = str_replace(".","",(floor(($orderTotal1*100))/100));?>" />
								</td>
                              </tr>
							  
                              <tr>
                                <td class="text-right" colspan="5"><strong>Discount:</strong></td>
                                <td class="text-right"><?=$coupon_discount?><input type="hidden" name="txtCodeId" value="<?PHP echo $doCoupon->id; ?>"></td>
                              </tr>
							  
                              <tr>
                                <td class="text-right" colspan="5"><strong>Total:</strong></td>
								
                                <td class="text-right"><?php echo "&euro;".(floor(($orderTotal1*100))/100); ?></td>
                              </tr>
							  
						<?PHP
							}
						?>
                            </tfoot>
							
                          </table>
                        </div>
                      </div>
                  </div>
				  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-address-card"></i> Aadress </h4>
                    </div>
					<p> &nbsp; &nbsp; &nbsp; <b> RAMADHEE OU Paldiski mnt 38a-16, 10612, Tallinn, Harju County, ESTONIA 10612, +372 53525273 </b>
				  </div>
                </div>
                <div class="col-sm-12">
		   <?PHP
				if(isset($erMsg) && $erMsg != '')
				{
			?>
				<div class="alert alert-danger fade in">
				  <button class="close" data-dismiss="alert">X</button><i class="fa fa-exclamation-triangle"></i><strong>Error</strong><br /><ul><?PHP echo $erMsg; ?></ul> 
				</div>
			<?PHP
				}
			?>
                <!-- <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-ticket"></i> Use Coupon Code</h4>
                    </div>
                      <div class="panel-body">
                        <label for="input-coupon" class="col-sm-3 control-label">Enter coupon code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Enter your coupon here" value="<?PHP echo $_POST['txtCoupon']; ?>" name="txtCoupon">
                          <span class="input-group-btn">
                          <input type="submit" name="btnCoupon" class="btn btn-primary" value="Apply Coupon">
                          </span></div>
                      </div>
                </div>  -->
			    </div> <!--EndPaypal-->
              </div>
            </div>
			
			<div class="panel panel-default">
						<!--
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-ticket"></i> Bank Details to pay :</h4>
						</div>
						
						<div class="panel-body">
							<label for="input-coupon" class="col-sm-3 control-label">Bank Name  : </label>
							<label for="input-coupon" class="col-sm-3 control-label">Swedbank </label>
							
						</div>
						<div class="panel-body">
							<label for="input-coupon" class="col-sm-3 control-label">Name : </label>
							<label for="input-coupon" class="col-sm-3 control-label">RAMANAIAH DHERAJ </label>
							
						</div>
						<div class="panel-body">
							<label for="input-coupon" class="col-sm-3 control-label"> Account Number  : </label>
							<label for="input-coupon" class="col-sm-3 control-label"> EE332200221070545811 </label>
						</div>
						<div class="panel-body">
							<label for="input-coupon" class="col-sm-3 control-label"> Total Sum  : </label>
							<label for="input-coupon" class="col-sm-3 control-label"> <?php echo "&euro;".number_format((floor(($orderTotal1*100))/100), 2, ',',','); ?> </label>
						</div>
						-->
						<div class="panel-body">
                        <div class="buttons">
                          <div class="pull-right">
                            <input type="submit" name="btnCheckout" class="btn btn-primary" value="Confirm Order">
                          </div>
                        </div>
                      </div>
					
				</div>
				
<?PHP
		$disp = "block;";
	}
	else
	{
		$disp = "none;";
		echo '<span style="color:red;">Cart is empty.</span>';
	}
	
?>
          </div>
        </div>
		</form>
		
<?php
////////////////////////////////////////////////////// NETS PAYMENT ///////////////////////////////////////////////////////////////
	mb_internal_encoding('UTF-8');
	
	$ver          = 004;
	$auto         = "N";
	$cur          = 'EUR';
	$id           = "PLOPMHDTA8"; //"PLOPMHDTA8"; //"AFGVEU5KHO"; // SHOP ID
	$ecuno        = rand(100000, 999999);
	$action       = 'gaf';
	$eamount      = $sum_; //$sum_; //1; //100; 
	$respcode     = "000";
	$datetime     = date('YmdHis');
	$msgdata      = "Soumen Banerjee";
	$actiontext   = "OK, tehing autoriseeritud";
	$receipt_no   = "02973";
	$charEncoding = "UTF-8";
	
	$feedBackUrl = "https://www.makelikethis.co.uk/merchantpage";
	$pay_url	 = "https://pos.estcard.ee/ecom/iPayServlet"; //"https://pos.estcard.ee/ecom/iPayServlet"; //"https://test.estcard.ee/ecom/iPayServlet";
	$delivery    = "S";
	$additionalinfo = "";
	
	$mac = ""; 
	$mac1 = "";
		
	//// PRIVATE KEY CHECKING 
	
	$key = 'private.key'; # key file name and location
	$fp = fopen("$key", "r");
	$fs = filesize("$key");
	$priv_key = fread($fp, $fs);
	fclose($fp);
	
	# Load public key
	$key = "public.key";
	$fp = fopen("$key", "r");
	$fs = filesize("$key");
	$pub_key = fread($fp, $fs);
	fclose($fp);
	
	$data = '';
	
	if($action == "afb")
	{
				$data = ''
				. mb_sprintf("%03d", $ver)
				. mb_sprintf("%-10s", $id)
				. mb_sprintf("%012d", $ecuno)
				. mb_sprintf("%06d", 012545)
				. mb_sprintf("%012d", $eamount )
				. mb_sprintf("%s", $cur)
				. mb_sprintf("%s", $respcode)
				. mb_sprintf("%s", $datetime)
				. mb_sprintf("%-40s", $msgdata)
				. mb_sprintf("%-40s", $actiontext);
	
	}
	
	else
	{
				$data = ''
				. mb_sprintf('%03d', $ver)
				. mb_sprintf('%-10s', $id)
				. mb_sprintf('%012d', $ecuno)
				. mb_sprintf('%012d', $eamount)
				. mb_sprintf('%s', $cur)
				. mb_sprintf('%s', $datetime)
				. mb_sprintf('%-128s', $feedBackUrl)
				. mb_sprintF('%s', $delivery);
	}
	
	//$signature = sha1($data); 
	$signature = "";
	
	openssl_sign($data, $signature, openssl_pkey_get_private($priv_key));
	
	$mac   = bin2hex($signature);
	$mac1   = "72BCD391A52F94B25DC3B030219F8E6E1B3EA23DE73315CD364BD79A0CAB7AC96D12306D313D653252573C197AFD72069101B63AC1C871498D5F04426B923F048FBC4F41BB2C4C5A8B60D0BCBA0B3EF231C44BD48A8480D8873A4217DF2F587F22AA172345D79C19FA32E1BDFD1854363D73E24B14C70036404A2EA6B7C643B9";
	
	//openssl_free_key($priv_key);
	
	
	$result = openssl_verify($data_res, pack('H*', $mac1), openssl_pkey_get_public($pub_key));
	
	
	///////////////////////////////////////////////////////////////////
	
	function mb_sprintf($format) 
	{
		$argv = func_get_args() ;
		array_shift($argv) ;
		return mb_vsprintf($format, $argv);
	}
	
	function mb_vsprintf($format, $argv, $encoding = NULL) 
	{
		if (is_null($encoding)) 
		{
			$encoding = mb_internal_encoding();
		}

		// Use UTF-8 in the format so we can use the u flag in preg_split
		$format = mb_convert_encoding($format, 'UTF-8', $encoding);

		$newformat = ""; // build a new format in UTF-8
		$newargv = array(); // unhandled args in unchanged encoding

		while ($format !== "") 
		{
			// Split the format in two parts: $pre and $post by the first %-directive
			// We get also the matched groups
			$rx = "!\%(\+?)('.|[0 ]|)(-?)([1-9][0-9]*|)(\.[1-9][0-9]*|)([%a-zA-Z])!u";
			list ($pre, $sign, $filler, $align, $size, $precision, $type, $post) =
			preg_split($rx, $format, 2, PREG_SPLIT_DELIM_CAPTURE) ;

			$newformat .= mb_convert_encoding($pre, $encoding, 'UTF-8');

			if ($type == '') 
			{
				// didn't match. do nothing. this is the last iteration.
			}
			
			elseif ($type == '%') 
			{
				// an escaped %
				$newformat .= '%%';
			}
			
			elseif ($type == 's') 
			{
				$arg = array_shift($argv);
				$arg = mb_convert_encoding($arg, 'UTF-8', $encoding);
				$padding_pre = '';
				$padding_post = '';

				// truncate $arg
				if ($precision !== '') 
				{
					$precision = intval(substr($precision, 1));
					
					if ($precision > 0 && mb_strlen($arg, $encoding) > $precision) 
					{
						$arg = mb_substr($precision, 0, $precision, $encoding);
					}
				}

				// define padding
				if ($size > 0) 
				{
					$arglen = mb_strlen($arg, $encoding);
					if ($arglen < $size) 
					{
						if ($filler === '') 
						{
							$filler = ' ';
						}
						if ($align == '-') 
						{	
							$padding_post = str_repeat($filler, $size - $arglen);
						}
						else 
						{
							$padding_pre = str_repeat($filler, $size - $arglen);
						}
					}
				}

				// escape % and pass it forward
				$newformat .= ''. $padding_pre. str_replace('%', '%%', $arg). $padding_post;
			}
			
			else 
			{
				// another type, pass forward
				$newformat .= "%$sign$filler$align$size$precision$type";
				$newargv[] = array_shift($argv);
			}
			$format = strval($post);
		}
	
		// Convert new format back from UTF-8 to the original encoding
		$newformat = mb_convert_encoding($newformat, $encoding, 'UTF-8');
		return vsprintf($newformat, $newargv);	
	}
	
	function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = 'UTF-8')
	{
		$input_length = mb_strlen($input, $encoding);
		$pad_string_length = mb_strlen($pad_string, $encoding);

		if ($pad_length <= 0 || ($pad_length - $input_length) <= 0) 
		{
			return $input;
		}

		$num_pad_chars = $pad_length - $input_length;

		switch ($pad_type) 
		{
			case STR_PAD_RIGHT:
								$left_pad = 0;
								$right_pad = $num_pad_chars;
								break;

			case STR_PAD_LEFT:
								$left_pad = $num_pad_chars;
								$right_pad = 0;
								break;

			case STR_PAD_BOTH:
								$left_pad = floor($num_pad_chars / 2);
								$right_pad = $num_pad_chars - $left_pad;
								break;
		}

		$result = '';
		
		for ($i = 0; $i < $left_pad; ++$i) 
			$result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);
		
		$result .= $input;
		
		for ($i = 0; $i < $right_pad; ++$i) 
			$result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);

		return $result;
	}		
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>		 
      </div> 
    </div>
  </div>

  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>
</body>
</html>

<script>
$(document).ready(function()
{
	var name     = "";
	var email    = "";
	var phone    = "";
	var zip_code = "";
	var state    = "";
	var city     = "";
	var country  = "";
	var address  = "";
});

function pay_pal(paypal_lnk)
{
	if(validateMyForm() != false)
		window.location = paypal_lnk; 
}

function validateMyForm()
{
	var frm_valid__ = true;
	
	name = $(".name_").val();
	email = $(".email_").val();
	phone = $(".phone_").val();
	zip_code = $(".zip_code_").val();
	state = $(".state_").val();
	city = $(".city_").val();
	country = $(".country_").val();
	address = $(".address_").val();
	/*
	if(name == "" || email == "" || phone == "" || zip_code == "" || state == "" || city == "" || country == "" || address == "")
	{	
		alert("Please Fill Checkout Form ..");
		return false;
	}
	
	if(name == "")
	{
		alert("Name is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(email == "")
	{
		alert("Email is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(phone == "")
	{
		alert("Phone is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(zip_code == "")
	{
		alert("Zip Code is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(state == "")
	{
		alert("State is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(city == "")
	{
		alert("City is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(country == "")
	{
		alert("Country is empty.");
		frm_valid__ = false;
		return false;
	}
	
	else if(address == "")
	{
		alert("Address is empty.");
		frm_valid__ = false;
		return false;
	}
	
	if(frm_valid__ == true)
	{
		guest_data_ = {"guest_name":name, "guest_email":email, "guest_phone":phone, "guest_zip_code":zip_code, "guest_state":state, "guest_city":city, "guest_country":country, "guest_address":address};	
		$.ajax({type: "POST", url: "save_guest_data.php", data:guest_data_, success: function(result) 
		{
		
		}});
		return false;
	}	
	else return false;	
	*/
}
</script>
<?PHP	
	include_once 'init.php';
	$ShoppingCart = new ShoppingCart;
	$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');	
	$cartProducts = $ShoppingCart;
	if(isset($_GET['mode']) && $_GET['mode'] == "del")
	{
		if($_GET['item']!='')
		{
			$variable=explode('_',$_GET['item']);
			$ShoppingCart->Remove($variable[0],$variable[1]);
		}
		
		$_SESSION["SESS_CART"] = $ShoppingCart->CartValues(); 
		//$msg='Checked Item(s) removed successfully.';
		header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(5));
	}
	
	if(isset($_GET['mode1']) && $_GET['mode1'] == "edit")
	{		
	    $productIds=array();
		$ShoppingCart->arrayCartProductcode = $_POST['hidProductCode'];
		foreach($_POST['hidProductCode'] AS $pid)
		{
			$productIds[]=$pid;
		}
		$i=0;
		
		foreach($_POST['txtQuantity'] AS $key=>$quan)
		{
			if($quan == "0")
			{
				$quan = "1";
				$courierPrice = $_POST['hidProductcourierPrice'];	
			}
			else
			{
				$quan = $quan;
				$courierPrice = $_POST['hidProductcourierPrice'];
			}
			$ShoppingCart->Update($_POST['hidProductCode'][$key], $quan);
			$i++;
		} 	
			
		$_SESSION["SESS_CART"] = $ShoppingCart->CartValues();
		$msg1 = 'Quantities Updated Successfully.';
		header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(5));
	}
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
<script type="text/javascript">
<!--
	function doDelete(item)
	{
		if(confirm('Kas eemaldate selle toote kindlasti?'))
		{
			document.frm.action="cart.php?mode=del&item="+item;
			document.frm.submit();
			return true;
		}
	}

	function update(pid)
	{
		if(confirm("Kas olete kindel, et värskendate seda kogust?"))
		{
			document.frm.action="cart.php?mode1=edit&pid=" + pid;
			document.frm.submit();
			return true;
		}
	}
//-->
</script>
</head>
<body>
<div class="wrapper-wide">
  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->
   <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo "https://ramadhee.ee/"; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Ostukorv</a></li>
      </ul>
      <div class="row">
        <form action="" method="post" name="frm">

        <div id="content" class="col-sm-12" style="text-align:center;">
          <h1 style="text-align:left;" class="title">Ostukorv</h1>
<?PHP
	
	if((isset($_SESSION["SESS_CART"]) && $_SESSION["SESS_CART"] != "") && count($_SESSION["SESS_CART"][0])!=0)
	{		
?>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
						<td width="8%" class="text-center">Foto</td>
						<td width="30%" class="text-left">Tootenimi</td>
						<td width="11%" class="text-left">Kogus</td>
						<td width="8%" class="text-right">Ühikuhind</td>
						<!-- <td width="8%" class="text-right">Saatmise hind ühiku kohta</td> -->
						<td width="8%" class="text-right">Kokku</td>
						<td width="10%" class="text-right">Tegevus</td>
                  </tr>
                </thead>
                <tbody>
	<?PHP
		$orderTotal = 0;
		$ProductTotal = 0;
		$totalProductsQuantity = 0;
		$addOnPrice = 0;
		$i=1;
		$index = 0;
		
		foreach($cartProducts->arrayCartProductCode AS $key=>$ProductCode)
		{
			if($cartProducts->arrayCartProductType[$key] != 'normal')
			{
				$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
				//$item_price__ = $general_cls_call->price_format($item->price);
				$item_price__ = number_format($item->price, 2);
				$item_price__ = (float)number_format($item_price__, 2);
				
				$totalProductsQuantity += $cartProducts->arrayCartProductQuantity[$key];
				$ProductTotal = ($cartProducts->arrayCartProductQuantity[$key] * $item_price__) + ($cartProducts->shippngCost[$key] * $cartProducts->arrayCartProductQuantity[$key]);
				$orderTotal1 += $ProductTotal;
				
				
				if($cartProducts->arrayCartProductQuantity[$key]==1) 
					$orderTotal = number_format($cartProducts->arrayCartProductCourierPrice[$key]+$orderTotal1, 2, ',', ',');
				
				else 
					$orderTotal = number_format(($cartProducts->arrayCartProductCourierPrice[$key]*$cartProducts->arrayCartProductQuantity[$key]) + ($item_price__ * $cartProducts->arrayCartProductQuantity[$key]), 2, ',', ',');
	?>
                
                  <tr>
                    <td class="text-center"><a href="<?PHP echo "https://ramadhee.ee/".'product_details.php?product_id='.$item->id; ?>">
						<img height="50" width="50" src="<?php echo "https://ramadhee.ee/upload_images./".$item->image1; ?>" alt="<?php echo $item->name; ?>" class="img-thumbnail" /></a>
					</td>
					
                    <td class="text-left" style="font-size:12px;">
						<a href="<?PHP echo "https://ramadhee.ee/seo/".'productdetails.php?product_id='.$item->id; ?>">
						<?php 
								$addons = "";
								$extraAddonsPrice = "";
								foreach(explode(",", $cartProducts->arrayCartProductAddOn[$key]) as $key=>$addonVal) {
									$addOnProduct = explode("-", $addonVal);
									if($addOnProduct[0] != null) {
										// $addons .= $addOnProduct[0] . "  €" . $addOnProduct[1]."</br>";	
										$addons .= "</br>" . $addOnProduct[0];
										$extraAddonsPrice .= "</br>" . "  €" . $addOnProduct[1];
									}
									$addOnPrice += number_format($addOnProduct[1], 2);
								}
							    $cartProducts->arrayCartProductAddOn[$key] = null;
								if($addons != "") {
									echo $item->name . "</br> <b> Lisa : </b> " . $addons;
								}
								else {
									echo $item->name;
								}
						?></a><br />
                    </td>
										
                    <td class="text-left">
					  <input type="hidden" name="hidProductCode[]" value="<?=$item->id?>"/>
					  <input type="hidden" name="hidProductcourierPrice" value="<?PHP echo $cartProducts->arrayCartProductCourierPrice[$key]; ?>"/>
					  <input type="number" class="QntVal<?PHP echo $i; ?>" name="txtQuantity[]" max="<?PHP echo $itemVer->stock; ?>" min="1" value="<?php echo $ShoppingCart->arrayCartProductQuantity[$index]; ?>" class="form-control" onkeydown="return false" style="width:70px;">
					</td>
					 
                    <td class="text-right"><?="€".number_format($item_price__, 2,',',',') . " " . $extraAddonsPrice?></td>
					<!-- <td class="text-right"><?="€".$_SESSION["delv_fee"]?></td> -->
					<td class="text-right"><?="€".number_format($ProductTotal, 2, ',', ',')?></td>
                    <td class="text-right">
						<button type="button" data-toggle="tooltip" title="Uuenda" class="btn btn-primary" onclick="return update(<?=$item->id?>);"><i class="fa fa-refresh"></i></button>
						<button type="button" data-toggle="tooltip" title="Kustuta" class="btn btn-danger" onclick="return doDelete('<?php echo ($ProductCode.'_'.$ShoppingCart->arrayCartCurrentTime[$key]); ?>');" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
					</td>
                  </tr>
	<?PHP
			}
			
			else
			{
				$totalProductsQuantity += $ShoppingCart->arrayCartProductQuantity[$key];
				$ProductTotal = $ShoppingCart->arrayCartProductQuantity[$key]*9.99;
				$orderTotal += $ProductTotal;
				$item = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
	?>    
                  <tr>
                    <td class="text-center"><img height="120" width="120" src="<?php echo $item->image1; ?>" alt="<?php echo $item->name; ?>" class="img-thumbnail" /></td>
                    <td class="text-left" style="font-size:12px;">
					 <b>Body Length:</b> <?PHP echo $ShoppingCart->arrayCartProductColor[$key]; ?>cm.<br>
					 <b>Hand Length:</b> <?PHP echo $ShoppingCart->arrayCartProductSize[$key]; ?>cm.
                    </td>
                    <td class="text-left">
					  <input type="hidden" name="hidProductCode[]" value="<?PHP echo $ShoppingCart->arrayCartCurrentTime[$key]; ?>"/>
						  <input type="number" id="QntVal<?PHP echo $i; ?>" name="txtQuantity[]" max="<?PHP echo $itemVer->stock; ?>" min="1" value="<?PHP echo $ShoppingCart->arrayCartProductQuantity[$key]; ?>" class="form-control" onkeydown="return false" style="width:70px;">
					</td>
                    <td class="text-right"><?PHP echo $general_cls_call->price_format(9.99); ?></td>
					
                    <td class="text-right"><?PHP echo $general_cls_call->price_format($ProductTotal + $addOnPrice); ?></td>
                    <td class="text-right">
                    <button type="button" data-toggle="tooltip" title="Update" class="btn btn-primary" onclick="return update();"><i class="fa fa-refresh"></i></button>
                    <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="return doDelete('<?php echo ($ProductCode.'_'.$ShoppingCart->arrayCartCurrentTime[$key]); ?>');" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
					</td>
                  </tr>
	<?PHP			
			}
		$index++;
		$i++;
		}
	?>                     
                </tbody>
              </table>
            </div>
            <table class="table table-bordered">
              <!-- <tr>
                <td class="text-right"><strong>Sub-Total:</strong></td>
                <td class="text-right">Rs. <?=$orderTotal1?></td>
              </tr> -->    
              <tr>
                <td class="text-right" width="90%"><strong>Kokku:</strong></td>
                <td class="text-right"><?php /* echo '&euro;'.number_format($orderTotal1 + $_SESSION["delv_fee"] + $addOnPrice, 2, ',',',') */ 
				echo '&euro;'.number_format($orderTotal1 + $addOnPrice, 2, ',',',')?></td>
              </tr>
            </table>        
          
          <div class="row">
            <div class="col-sm-4 col-sm-offset-8"></div>
          </div>
          <div class="buttons">
            <div class="pull-left"><a href="<?PHP echo DOMAIN_NAME; ?>" class="btn btn-default">Jätka ostlemist</a></div>
            <div class="pull-right"><input type="checkbox" name="checkbox" value="check" id="agree" /> <a href="https://ramadhee.ee/seo/terms_conditions.php" target="_blank">Olen tutvunud tingimustega ja nõustun nendega </a> ja <a href="https://ramadhee.ee/seo/privacy-policy.php" target="_blank">Privaatsuspoliitika.</a> &nbsp; <a onclick="if(document.getElementById('agree').checked) { return true; } else { alert('Palun märkige, et olete tutvunud tingimustega ja privaatsuseeskirjadega ning nõustute nendega'); return false; }" href="<?PHP echo DOMAIN_NAME.'seo/'."checkout.php"; ?>" class="btn btn-primary">Kassas</a></div>
          </div>
		  
		  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-address-card"></i> Aadress </h4>
                    </div>
					<p> &nbsp; &nbsp; &nbsp; <b> RAMADHEE OU Paldiski mnt 38a-16, 10612, Tallinn, Harju County, ESTONIA 10612, +372 53525273 </b>
				  </div>
<?PHP
	}
	else
	{
		echo '<span style="color:red;font-size: 20px;font-weight: bold;">Ostukorv on tühi.</span>';
	}
?>
        </div>        
		</form>
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
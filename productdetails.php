<?PHP
	include_once 'init.php';
	
	/* ============== WISHLIST START ================== */
	if(isset($_GET['mode']) && $_GET['mode'] == "wish")
	{
		$field = "user_id, pro_id";
		$value = ":user_id, :pro_id";
		$addExecute=array(
			':user_id'		=>$_SESSION['FRONT_USER_ID'],
			':pro_id'		=>$_GET['itemID']
		);
		$general_cls_call->insert_query(WISHLIST, $field, $value, $addExecute);
		header("location:".$_GET['link']);
	}
	/* ============== WISHLIST END ================== */
	
	/* ============== SHOPPING CART START ================== */
	if(isset($_GET['mode']) && $_GET['mode'] == "buy")
	{		
		$ShoppingCart = new ShoppingCart;
		$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');
		$Quantity = $_POST["qnt"];
		$key = array_search($_GET['itemID'], $ShoppingCart->arrayCartProductDetails); 	
		$addOn = $_POST["addons1"];
		$ship_price_ = str_replace("€","", $_POST['txtCourierPrice']);
		$ship_price_ = (float)number_format($ship_price_, 2, '.','.');
		$ShoppingCart->Add($_GET['itemID'], (int)$Quantity, $_POST['txtSize'], $_POST['txtColor'], $ship_price_, 'normal', $addOn);
		$_SESSION["SESS_CART"] = $ShoppingCart->CartValues();	
		header("location:".DOMAIN_NAME.'seo/cart.php');
	}

	/* ============== SHOPPING CART END ================== */
	//$proVal = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$_GET["product_id"]), 1);
	
	$proVal = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$_GET["product_id"]), 1);
	//$wishList = $general_cls_call->select_query("*", WISHLIST, "WHERE pro_id=:pro_id AND user_id=:user_id", array(':pro_id'=>$proVal->id, ':user_id'=>$_SESSION['FRONT_USER_ID']), 1);
	$setValues = "view=:view";
	$updateExecute=array(
		':view'		=>$proVal->view
	);
	
	$whereClause=" WHERE id=".$proVal->id;
	//$general_cls_call->update_query(PRODUCT, $setValues, $whereClause, $updateExecute);
	//die;
	
	if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID']!='')
	{
		$userVal = $general_cls_call->select_query("*", MEMBER, "WHERE id=:id", array(':id'=>$_SESSION['FRONT_USER_ID']), 1);
	}
	
	if(isset($_POST['btnSubmit']))
	{
		extract($_POST);
		$field = "pro_id, name, rating, comment, date, status";
		$value = ":pro_id, :name, :rating, :comment, :date, :status";
		$addExecute=array(
			':pro_id'	=>$proVal->id,
			':name'		=>$general_cls_call->specialhtmlremover($txtName),
			':rating'	=>$general_cls_call->specialhtmlremover($txtStar),
			':comment'	=>$general_cls_call->specialhtmlremover($txtComment),
			':date'		=>date('F j, Y'),
			':status'	=>1
		);
		$general_cls_call->insert_query(RATING, $field, $value, $addExecute);
		header("location:".$_POST['txtLink']);
	}
	if(!isset($_POST['txtName'])) { $_POST['txtName'] =	$userVal->name; }
	$totalReview = $general_cls_call->select_query_count(RATING, "WHERE status=:status AND pro_id=:pro_id", array(':status'=>1, ':pro_id'=>$lastPosation));
	
	
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
<?php $url = "https://ramadhee.ee{$_SERVER['SCRIPT_NAME']}"; echo "<link rel='canonical' href=$url>";?>
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />

<link rel="stylesheet" type="text/css" href="<?PHP echo DOMAIN_NAME; ?>js/swipebox/src/css/swipebox.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>starability-all.min.css"/>
<script type="text/javascript">
<!--		
	function next_item(itemID)
	{
		document.frm.action="http://ramadhee.ee/seo/productdetails.php?mode=buy&itemID="+itemID;
		document.frm.submit();
		return true;
	}
	/*function wishlist(itemID,link)
	{
		window.location.href="<?PHP echo DOMAIN_NAME; ?>product_details.php?mode=wish&itemID="+itemID+'&link='+link;
		return true;
	}*/
	function doLogin()
	{
		alert("Please login.");
		return true;
	}
	function check_delivery_time(){
		var x = document.getElementById("txtDeliveryTime").selectedIndex;
    		var y = document.getElementById("txtDeliveryTime").options;
    		//alert("Index: " + y[x].index + " is " + y[x].text);
    		var sel_index = y[x].index;
    		
    		var txtCourierPrice = document.getElementById("txtCourierPrice").selectedIndex=sel_index;
	}
	function select_courier(){
		var x = document.getElementById("txtCourier").selectedIndex;
    		var y = document.getElementById("txtCourier").options;
    		//alert("Index: " + y[x].index + " is " + y[x].text);
    		var sel_index = y[x].index;
    		
    		var txtCourierPrice = document.getElementById("txtDeliveryTime").selectedIndex=sel_index;
    		var txtCourierPrice = document.getElementById("txtCourierPrice").selectedIndex=sel_index;
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
		<li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
		<li><a href="#">Toote üksikasjad</a></li>
      </ul>
      <div class="row">
        <div id="content" class="col-sm-12">
          <div>
			<h1 class="title" itemprop="name" style="font-size:20px;"><?PHP echo $proVal->name; ?></h1>
            <div class="row product-info">
              <div class="col-sm-5">
                <div class="image"><img class="img-responsive" itemprop="image" id="zoom_01" src="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>" alt="<?PHP echo $proVal->name; ?>" data-zoom-image="<?php echo 'http://ramadhee.ee/'.explode("/",$proVal->image1)[3]."/".explode("/",$proVal->image1)[4]?>" /></div>
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Galerii jaoks klõpsake pilti</span></div>
                <div class="image-additional" id="gallery_01">
			<?PHP
				if($proVal->image1 !='')
				{
			?>
				  <a class="thumbnail" href="#" data-zoom-image="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>" data-image="<?php echo 'http://ramadhee.ee/'.explode("/",$feVal->image1)[3]."/".explode("/",$feVal->image1)[4]?>"><img src="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>"/></a>
			<?PHP
				}
				if($proVal->image2 !='')
				{
			?>
				  <a class="thumbnail" href="#" data-zoom-image="<?php echo 'https://ramadhee.ee'.explode("/",$proVal->image2)[3]."/".explode("/",$proVal->image2)[4]?>" data-image="<?php echo 'http://ramadhee.ee/'.explode("/",$proVal->image2)[3]."/".explode("/",$proVal->image2)[4]?>"><img src="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>" alt="<?PHP echo $proVal->name; ?>"/></a>
			<?PHP
				}
				if($proVal->image3 !='') 
				{
			?>
				  <a class="thumbnail" href="#" data-zoom-image="<?php echo 'https://ramadhee.ee'.explode("/",$proVal->image3)[3]."/".explode("/",$proVal->image3)[4]?>" data-image="<?php echo 'http://makelikethis.ee/'.explode("/",$proVal->image3)[3]."/".explode("/",$proVal->image3)[4]?>"><img src="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>" alt="<?PHP echo $proVal->name; ?>"/></a>
			<?PHP
				}
				if($proVal->image4 !='') 
				{
			?>
				  <a class="thumbnail" href="#" data-zoom-image="<?php echo 'https://ramadhee.ee'.explode("/",$proVal->image4)[3]."/".explode("/",$proVal->image4)[4]?>" data-image="<?php echo 'http://makelikethis.ee/'.explode("/",$proVal->image4)[3]."/".explode("/",$proVal->image4)[4]?>"><img src="<?php echo 'https://ramadhee.ee/upload_images./'.$proVal->image1?>" alt="<?PHP echo $proVal->name; ?>"/></a>
			<?PHP
				}
			?>
				</div>
              </div>
			  
			<?php
					/////  INSERT VISITOR DETAILS 
					$num_vis_ = 0;
					
					$field = "id, pro_id, ip_address, geoplugin_countryCode, geoplugin_city, date_";
					$value = ":id, :pro_id, :ip_address, :geoplugin_countryCode, :geoplugin_city, :date_";
					
					$g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
					
				    $addExecute = array(
											':id'						=>0,
											':pro_id'					=>$proVal->id,
											':ip_address'				=>$_SERVER['REMOTE_ADDR'],
											':geoplugin_countryCode'	=>$g["geoplugin_countryCode"],
											':geoplugin_city'			=>$g["geoplugin_city"],
											':date_'					=>date("Y-m-d H:i:s")
											);
	  
					$userVal = $general_cls_call->select_query("*", LOCATION, "WHERE pro_id=:pro_id AND ip_address=:ip_address", array(':pro_id'=>$proVal->id, ':ip_address'=>$_SERVER['REMOTE_ADDR']), 1);
					$userVis = $general_cls_call->select_query("*", LOCATION, "WHERE pro_id=:pro_id AND ip_address=:ip_address", array(':pro_id'=>$proVal->id, ':ip_address'=>$_SERVER['REMOTE_ADDR']), 2);
					$num_vis_ = sizeof($userVis);
					
					if(empty($userVal))
					{
						$num_vis_ ++;
						$general_cls_call->insert_query(LOCATION, $field, $value, $addExecute);
					}
	  
					//////////////////////////
			?>
			
			
			<form name="frm" method="post" action="">
              <div class="col-sm-5">
                <ul class="list-unstyled description">
                  <li style="color:red;"><b><?PHP echo $num_vis_;?> 
				  vaadatud.</b></li>
                  <!--<li><b>Toote number:</b> <a href="#"><span itemprop="brand"><?PHP echo $proVal->pro_number; ?></span></a></li>
                   <li><b>Quantity:</b> <a href="#"><span itemprop="brand"><?PHP echo $proVal->stock; ?></span></a></li>
                  <li><b>SKU:</b> <a href="#"><span itemprop="brand"><?PHP echo $proVal->sku; ?></span></a></li> -->
			<?PHP
				if($proVal->stock <= 0)
				{
			?>
                  <li><b>Saadavus:</b> <span class="nostock">Läbimüüdud</span></li>
			<?PHP
				}
				else
				{
			?>
                  <li><b>Saadavus:</b> <span class="instock">Laos</span></li>
			<?PHP
				}
			?>
                  <li style="color:red;" class="add-to-links"></li>
                </ul>
                <ul class="price-box">
				  <li class="price">				  
					<span class="price-old" style="display:none">
						<?="&euro;".$proVal->list_price?>
					</span> 
					
					<span itemprop="price">
						<?php 
						         //"&euro;".$general_cls_call->price_format($proVal->price)
								 echo "&euro;".number_format($proVal->price, 2, ',', ',');
						?>
					</span>
					
				  </li>  
                </ul>
                <div id="product">
                  <!--- <h3 class="subtitle">Available Options</h3>
                  <div class="form-group required" style="display:none">                   
                    <label class="control-label">Size</label>         
					  <select  class="form-control" name="txtSize" style="width:40%">
				<?php 
					$sizeVal = explode(",",$proVal->size);
					for($s=0; $s<count($sizeVal); $s++) 
					{ 
				?>
					    <option value="<?PHP echo $sizeVal[$s]; ?>"><?PHP echo $sizeVal[$s]; ?></option>
				<?PHP				
					}
				?>
					  </select> 
                    <label class="control-label" style="margin-top:15px;">Color</label>
					  <select  class="form-control" name="txtColor" style="width:40%">
				<?php 
					$colorVal = explode(",",$proVal->color);
					for($c=0; $c<count($colorVal); $c++) 
					{ 
				?>
					    <option value="<?PHP echo $colorVal[$c]; ?>"><?PHP echo $colorVal[$c]; ?></option>
				<?PHP				
					}
				?>
					  </select> 
				     		                    
                  </div> -->
                  
                  
                  <!-------Weight and Courier Details Start here----->

<div class="form-group">
                  
				 
			<div><label class="control-label" style="margin-top:15px;">Kuller : Ziticity </label></div>
			<label class="control-label" style="margin-top:15px;">Adress : Sisestage saaja aadress </label>
			<input type="text" id="delvaddress" class="form-control">
					  
			<!-- <label class="control-label" style="margin-top:15px;">Delivery Time in Days: </label>
					  <select  class="form-control" name="txtDeliveryTime" id="txtDeliveryTime" style="width:40%; pointer-events: none;
  touch-action: none;" onchange="check_delivery_time();" onmousedown="return false" onkeydown="return false">
				<?php 
					$deliv_timeVal = explode(",",$proVal->deliv_time);
					for($dt=0; $dt<count($deliv_timeVal); $dt++) 
					{ 
				?>
					    <option value="<?PHP echo $deliv_timeVal[$dt]; ?>"><?PHP echo $deliv_timeVal[$dt]; ?></option>
				<?PHP				
					}
				?>
					  </select>	-->
					  
			<label class="control-label" style="margin-top:15px;">Kullerhind </label>
			
					 <input type="text" id="courierprice" class="form-control">
					  <!-- <label class="control-label" style="margin-top:15px;">Weight: </label>&nbsp; 
                  		<strong><?PHP //echo $proVal->weight; ?></strong> -->
			<label class="control-label" style="margin-top:15px;">Kogus  </label>
			<select  class="form-control" name="qnt" id="qnt" >
				<option value=1> 1 </option>
				<option value=2> 2 </option>
				<option value=3> 3 </option>
				<option value=4> 4 </option>
			</select>
			
			<label class="control-label" style="margin-top:15px;">Lisa  </label>
			<?php
				if($proVal->brand != null) 
				{
					$addon = json_decode($proVal->brand);
			?>
			
			<ul class="list-group list-group-flush">
			<?php
					foreach($addon as $key=>$value) {
			?>
						<li class="list-group-item addons">
							<!-- Default checked -->
							<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input addon-data" name="addon-data" id="check1" value="<?=$key . "-" . number_format($value, 2)?>">
							<label class="custom-control-label" for="check1"><?php echo $key . " &euro; " . number_format($value, 2); ?></label>
							</div>
						</li>
			<?php
					}
				}
			?>
			</ul>
			<input type="hidden" name="addons1" value="" class="haddons">
					
</div>
                  
<!-------Weight and Courier Details End here----->
                  
                  
                  <div class="cart">
			<?PHP
				if($proVal->stock > 0)
				{
			?>
                    <button type="button" id="button-cart" class="btn btn-primary btn-lg" onclick="return next_item('<?php echo $proVal->id; ?>')">Lisa ostukorvi</button>
			<?PHP
				}
				if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID'] !='')
				{
					if($wishList->pro_id != $proVal->id)
					{
			?>
						<!-- <a href="javascript:void(0);" onclick="return wishlist('<?php echo $proVal->id; ?>','<?PHP echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>')">
							<button class="btn btn-success" type="button" style="padding:11px;">
								<span> WISH LIST </span>
							</button> 
						</a> -->
			<?PHP
					}
				}
				else
				{
			?>
                   <!-- <a href="javascript:void(0);" onclick="return doLogin();">
						<button class="btn-success" type="button" style="padding:11px;">
							<span>WISH LIST</span>
						</button>
					</a> -->
			<?PHP
				}
			?>
                  </div>
                </div>
               
              
                <!-- AddThis Button BEGIN -->
                <!-- <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div> --->
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                <!-- AddThis Button END -->
              </div>
			</form>
			  <div class="col-sm-2"></div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-description" data-toggle="tab">Kirjeldus</a></li>
              <li><a href="#tab-review" data-toggle="tab">Arvustused (<?PHP echo $totalReview; ?>)</a></li>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="tab-description" class="tab-pane active">
                <div>
                  <p><?PHP echo $proVal->description; ?></p>
                </div> 
              </div>
			  
			  <div id="tab-review" class="tab-pane">
				<form name="frmRe" method="post" action="" class="form-horizontal">
				  <div id="review">
					<div>
		<?PHP
			$revSql = $general_cls_call->select_query("*", RATING, "WHERE status=:status AND pro_id=:pro_id ORDER BY id DESC", array(':status'=>1, ':pro_id'=>$lastPosation), 2);
			if(!empty($revSql))
			{
				foreach($revSql as $revVal)
				{
		?>
					  <table class="table table-striped table-bordered">
						<tbody>
						  <tr>
							<td style="width: 50%;"><strong><span><?PHP echo $revVal->name; ?></span></strong></td>
							<td class="text-right"><span><?PHP echo $revVal->date; ?></span></td>
						  </tr>
						  <tr>
							<td colspan="2">
							  <?PHP echo nl2br($revVal->comment); ?>
							  <div class="rating"> 
								<?PHP 
									if($revVal->rating == '1') 
									{
								?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
								<?PHP
									}
									if($revVal->rating == '2')
									{
								?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
								<?PHP
									}
									if($revVal->rating == '3')
									{
								?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
								<?PHP
									}
									if($revVal->rating == '4')
									{
								?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
								<?PHP
									}
									if($revVal->rating == '5')
									{
								?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> 
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
								<?PHP
									}
								?>
							  </div>
							</td>
						  </tr>
						</tbody>
					  </table>	
		<?PHP
				}
			}
			else
			{
				echo '<span style="color:red;">Seda toodet pole arvustuste poes.</span>';
			}
		?>
					</div>
					<div class="text-right"></div>
				  </div>
				  <h2>Kirjuta arvustus</h2>
				  <div class="form-group required">
					<div class="col-sm-12">
					  <label for="input-name" class="control-label">Sinu nimi</label>
					  <input type="text" class="form-control" value="" name="txtName" required>
					</div>
				  </div>
				  <div class="form-group required">
					<div class="col-sm-12">
					  <label for="input-review" class="control-label">Teie arvustus</label>
					  <textarea class="form-control" rows="5" name="txtComment" required></textarea>
					</div>
				  </div>
				  <div class="form-group required">
					<div class="col-sm-12">
					  <label class="control-label">Hinnang</label>
					  <fieldset class="starability-basic">
					   <input type="radio" id="rate1" name="txtStar" value="1" required />
					   <label for="rate1">1 star.</label>
					   <input type="radio" id="rate2" name="txtStar" value="2" required />
					   <label for="rate2">2 stars.</label>
					   <input type="radio" id="rate3" name="txtStar" value="3" required />
					   <label for="rate3">3 stars.</label>
					   <input type="radio" id="rate4" name="txtStar" value="4" required />
					   <label for="rate4">4 stars.</label>
					   <input type="radio" id="rate5" name="txtStar" value="5" required />
					   <label for="rate5">5 stars.</label>
					  </fieldset>
					</div>
				  </div>
				  <div class="buttons">
					<div class="pull-right">
					  <button class="btn btn-primary" name="btnSubmit" type="submt">Esita</button>
					</div>
				  </div>
				</form>
			  </div>
            </div>
			<div class="col-md-12">&nbsp;</div>
			
                  
            <h3 class="subtitle" style="display:none">Seotud tooted</h3>
            <div class="owl-carousel related_pro" style="display:none">
    <?PHP
		$proSql = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE status=:status ORDER BY rand() LIMIT 0, 4", array(':status'=>1), 2);
		
		if(empty($proSql))
		{
			foreach($proSql as $proReVal)
			{
				$wishList = $general_cls_call->select_query("*", WISHLIST, "WHERE pro_id=:pro_id AND user_id=:user_id", array(':pro_id'=>$proReVal->id, ':user_id'=>$_SESSION['FRONT_USER_ID']), 1);
	?>
                <div class="product-thumb clearfix">
                  <!-- <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proReVal->page_url.'/'.$proReVal->id; ?>"><div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;"><img src="<?PHP echo $proReVal->image1; ?>" alt="<?PHP echo $proReVal->name; ?>" style="width:100%;height:100%;" /></div></a> -->
				  <a href="<?PHP echo DOMAIN_NAME.'product_details.php?product_id='.$proReVal->id; ?>"><div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;"><img src="<?php echo 'http://makelikethis.ee/'.explode("/",$proReVal->image1)[3]."/".explode("/",$proReVal->image1)[4]?>" alt="<?PHP echo $proReVal->name; ?>" style="width:100%;height:100%;" /></div></a> 
				  
				  <div class="caption">
                    <h4><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proReVal->page_url.'/'.$proReVal->id; ?>"><?PHP echo $proReVal->name; ?></a></h4>
                    <p class="price"><span class="price-new"><?PHP echo $general_cls_call->price_format($proReVal->price); ?></span> <span class="price-old"><?PHP echo $general_cls_call->price_format($proReVal->list_price); ?></span><span class="saving">-<?PHP echo $proReVal->discount; ?>%</span></p>
                  </div>
                  <div class="button-group">
					<a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proReVal->page_url.'/'.$proReVal->id; ?>"><button class="btn-primary" type="button"><span>View Details</span></button></a>
			<?PHP
				if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID'] !='')
				{
					if($wishList->pro_id != $proReVal->id)
					{
			?>
                    <a href="javascript:void(0);" onclick="return wishlist('<?php echo $proReVal->id; ?>','<?PHP echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>')"><button class="btn-success" type="button"><span>WISH LIST</span></button></a>
			<?PHP
					}
				}
				else
				{
			?>
                    <a href="javascript:void(0);" onclick="return doLogin();"><button class="btn-success" type="button"><span>WISH LIST</span></button></a>
			<?PHP
				}
			?>
                    <div class="add-to-links" style="color:red;">No Delivery in P.O. Box</div>
				  </div>
                </div>
	<?PHP
			}
		}
	    else
	    {
			//echo '<span style="color:red;">No product found!!!</span>';
	    }
	?>
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
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.elevateZoom-3.0.8.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/swipebox/src/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	var allids = [];
	$(".addon-data").click(function(e) {
		$(".haddons").val($(this).val());
		//console.log($(".haddons").val());
		allids.push($(".haddons").val());
		//$(".haddons").attr("value", $(allids).append(allids + ", "))
		$(".haddons").val(allids.toString());
		console.log($(".haddons").val());
	});
});

// Elevate Zoom for Product Page image
$("#zoom_01").elevateZoom({
	gallery:'gallery_01',
	cursor: 'pointer',
	galleryActiveClass: 'active',
	imageCrossfade: true,
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 500,
	lensFadeIn: 500,
	lensFadeOut: 500,
	loadingIcon: 'image/progress.gif'
	}); 
//////pass the images to swipebox
$("#zoom_01").bind("click", function(e) {
  var ez =   $('#zoom_01').data('elevateZoom');
	$.swipebox(ez.getGalleryList());
  return false;
});

$(document).ready(function() {
	$("#delvaddress").focusout(function() {
		console.log("F OUT ... " + $(this).val());
		var delvaddress = { "delvadd" : $("#delvaddress").val() }
		$.ajax({
		type: "POST",
		dataType: "json",
		url: "https://ramadhee.ee/ziticity_delv_quote.php",
		data: delvaddress,
		success: function(response) {
				$("#courierprice").val(response);
			},
		});
	});
});

</script>
<style>
#swipebox-top-bar {
  display:block !important;
}
</style>
</body>
</html>


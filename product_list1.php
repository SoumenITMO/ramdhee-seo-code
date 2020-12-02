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
		
	$getArray_ = explode("/",$_GET["q"]);
	$countArray = sizeof($getArray_);
	
	$lastPosation = $getArray_[$countArray - 1];
	
	if($countArray == '2')
	{
		$catName = $general_cls_call->select_query("name", CATEGORY, "WHERE id=:id", array(':id'=>$lastPosation), 1);
	}
	
	if($countArray == '3')
	{
		$subCatName = $general_cls_call->select_query("name,cat_id", SUB_CATEGORY, "WHERE id=:id", array(':id'=>$lastPosation), 1);
		$catName = $general_cls_call->select_query("name", CATEGORY, "WHERE id=:id", array(':id'=>$subCatName->cat_id), 1);
	}
	
	if($countArray == '4')
	{
		$subSubCatName = $general_cls_call->select_query("name,sub_cat_id", SUB_SUB_CATEGORY, "WHERE id=:id", array(':id'=>$lastPosation), 1);
		$subCatName = $general_cls_call->select_query("name,cat_id", SUB_CATEGORY, "WHERE id=:id", array(':id'=>$subSubCatName->sub_cat_id), 1);
		$catName = $general_cls_call->select_query("name", CATEGORY, "WHERE id=:id", array(':id'=>$subCatName->cat_id), 1);
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title> Tasty and Delicious Food with free delivery across Tallinn </title>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />

<?php

$current_uri = $_SERVER['REQUEST_URI'];

if($current_uri=='/products/men/t-shirt/hooded-t-shirt/42'){
	$heading_txt = "Buy Hooded T Shirts Online";
	?>
	<title>Buy Hooded T Shirts Online USA | Hooded T Shirts for Sale Online - Makelikethis</title>
	<meta name="description" content="Check out Makelikethis collection to buy Hooded T Shirts online in USA that is a perfect mix of fashion and stimulation. Visit us now to place order!">
	<?php 
}
elseif($current_uri=='/products/women/clothing/tops-,-tees-&-shirts/73'){
	$heading_txt = "Buy Women Top Online";
	?>
	<title> Buy Tops for Women's Online USA | Tops for Women's Online - Makelikethis</title>
	<meta name="description" content="If you are looking to buy tops for women's online in USA that is the preeminent essence of trend and affordable price. Browse through collection of Makelikethis!">
	<?php 
}

elseif($current_uri=='/products/men/t-shirt/round-neck-t-shirt/45'){
	$heading_txt = "Round Neck T Shirts Online";
	?>
	<title>Buy Round Neck T Shirts Online USA | Round Neck T Shirts Online - Makelikethis</title>
	<meta name="description" content="Want to buy Round Neck T Shirts online in USA. No need to look further than Makelikethis. View our collection now to add your desirable item to cart!">
	<?php 
}

elseif($current_uri=='/products/women/foot-wear/heels/87'){
	$heading_txt = "Heels Shoes Online for Women";
	?>
	<title>Buy Heels Shoes Online for Women’s USA | Women’s Heels Shoes Online – Makelikethis</title>
	<meta name="description" content="Looking for best quality Heels Shoes to buy online for Women’s in USA. Check out our stylish collection of Heels Shoes at Makelikethis and place order!">
	<?php 
}
else{
?>
<title><?PHP echo $pageName->meta_title; ?></title>
<meta name="keywords" content="<?PHP echo $pageName->meta_key; ?>">
<meta name="description" content="<?PHP echo $pageName->meta_desc; ?>">
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<!--<link rel="stylesheet" type="text/css" href="revolution/css/settings.css">-->
<!--<link rel="stylesheet" type="text/css" href="revolution/css/layers.css">-->
<!--<link rel="stylesheet" type="text/css" href="revolution/css/navigation.css">-->
<!--<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>-->

<script type="text/javascript">
<!--	
	function wishlist(itemID,link)
	{
		window.location.href="<?PHP echo DOMAIN_NAME; ?>product_list.php?mode=wish&itemID="+itemID+'&link='+link;
		return true;
	}
	function doLogin()
	{
		alert("Please login.");
		return true;
	}
//-->
</script> 

<script type="text/javascript" src="https://webpjs.appspot.com/js/webpjs-0.0.2.min.js"></script>
<script>
(function()
{var WebP=new Image();WebP.onload=WebP.onerror=function(){
if(WebP.height!=2){var sc=document.createElement('script');sc.type='text/javascript';sc.async=true;
var s=document.getElementsByTagName('script')[0];sc.src='js/webpjs-0.0.2.min.js';s.parentNode.insertBefore(sc,s);}};
WebP.src='data:<?php echo FRONT_IMAGES_FOLDER; ?>webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';})();</script>

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
		<li><a href="#"><?PHP echo $catName->name; ?></a></li>
	<?PHP
		if($subCatName->name != '')
		{
	?>
		<li><a href="#"><?PHP echo $subCatName->name; ?></a></li>
	<?PHP
		}
		if($subSubCatName->name != '')
		{
	?>
		<li><a href="#"><?PHP echo $subSubCatName->name; ?></a></li>
	<?PHP
		}
	?>
	  </ul>
	  <div class="row">
		<div id="content" class="col-sm-12">
		  <h1 class="title" style="font-size:18px;"><?php echo $heading_txt; ?></h1>
		  <h3 class="title"><?PHP echo $catName->name; ?></h3>
		  <div class="row products-category" style="text-align:center;">
	<?PHP
		
		if($countArray == '2')
			$proSql = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE status=:status AND customized_platform=:customized_platform AND cat_id=:cat_id ORDER BY id DESC", array(':status'=>1, ':customized_platform'=>0, ':cat_id'=>$lastPosation), 2);
		
		if($countArray == '3')
			$proSql = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE status=:status AND customized_platform=:customized_platform AND sub_cat_id=:sub_cat_id ORDER BY id DESC", array(':status'=>1, ':customized_platform'=>0, ':sub_cat_id'=>$lastPosation), 2);
		
		if($countArray == '4')
			$proSql = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE status=:status AND customized_platform=:customized_platform AND sub_sub_cat_id=:sub_sub_cat_id ORDER BY id DESC", array(':status'=>1, ':customized_platform'=>0, ':sub_sub_cat_id'=>$lastPosation), 2);
			
			foreach($proSql as $keys_=>$ex_value)
			{
	?>
				<div class="product-layout product-grid col-lg-3 col-md-3 col-sm-3 col-xs-12">  
					<div class="product-thumb">
					  
					  <a href="<?PHP echo DOMAIN_NAME.'seo/'.'productdetails.php?product_id='.$ex_value->id; ?>"> 
					  
					  <div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;">
							<img src="<?php echo 'https://ramadhee.ee/upload_images./'.$ex_value->image1 ?>" width="200" height="200">
					
					  </div>
					  </a>
					  
					  <div class="caption">
						<h4 style="min-height:38px;">
						<a href="<?PHP echo DOMAIN_NAME.'productdetails.php?product_id='.$ex_value->id; ?>">
						<?PHP echo $ex_value->name; ?></a></h4>
						<p class="price"><span class="price-new"><?PHP echo "&euro;".number_format($ex_value->price, 2, ',', ','); ?></span> 
						
						
						<span class="saving" style="display:none">-<?PHP echo $ex_value->discount; ?>%</span></p>
					  </div>
					  
					  <div class="button-group">
						<!-- <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$ex_value->page_url.'/'.$ex_value->id; ?>"><button class="btn-primary" type="button"><span>View Details</span></button></a> -->
						<a href="<?PHP echo DOMAIN_NAME.'seo/'.'productdetails.php?product_id='.$ex_value->id; ?>"><button class="btn-primary" type="button"><span>Vaata detaile</span></button></a>
						
						<div class="add-to-links" style="color:red;">No Delivery in P.O. Box</div>
					  </div>
					  
					</div>
				</div>
	<?php
			}
			
			
		if(!empty($proSql))
		{
			foreach($proSql as $proVal)
			{		
	?>
			<div class="product-layout product-grid col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none">  
			  <div class="product-thumb">
				  
				  <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>">
				  
				  <div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;">
					<img src="<?PHP echo $proVal->image1; ?>" alt="<?PHP echo $proVal->name; ?>" style="width:100%;height:100%;" />
				  </div>
				  </a>
				  
				  <div class="caption">
					<h4 style="min-height:38px;"><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>"><?PHP echo $proVal->name; ?></a></h4>
					<p class="price"><span class="price-new"><?PHP echo $general_cls_call->price_format($proVal->price); ?></span> <span class="price-old"><?PHP echo $general_cls_call->price_format($proVal->list_price); ?></span><span class="saving">-<?PHP echo $proVal->discount; ?>%</span></p>
				  </div>
				  
				  <div class="button-group">
					<a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>"><button class="btn-primary" type="button"><span>View Details</span></button></a>
                    <div class="add-to-links" style="color:red;">No Delivery in P.O. Box</div>
				  </div>
				  
			  </div>
			</div>
	<?PHP
			$i++;
			if($i%4==0) echo '<div style="clear:both;"></div>';
			}
		}
	    else
	    {
			echo '<span style="color:red;">No product found!!!</span>';
	    }
	?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  
  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>

</body>
</html>

<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>
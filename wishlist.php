<?PHP	
	include_once 'init.php';
	
	/*=========== DELETE START ================*/
		if(isset($_GET['mode']) && $_GET['mode'] == 'del')
		{
			$general_cls_call->delete_query(WISHLIST, "WHERE id=:id", array(':id'=>$_GET['id']));
			header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(9));
		}
	/*=========== DELETE END ================*/	
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
<script type="text/javascript">
<!--
	function del(uid)
	{
		if(confirm('Are you sure to delete?'))
		{
		   window.location.href='wishlist.php?mode=del&id='+uid;
		}
	}
//-->
</script>
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
		<li><a href="#">Wishlist</a></li>
	  </ul>
	  <div class="row">
		<div id="content" class="col-sm-12">
		  <h3 class="title">Wishlist</h3>
		  <div class="row products-category" style="text-align:center;">
	<?PHP
		$wishSql = $general_cls_call->select_query("*", WISHLIST, "WHERE user_id=:user_id", array(':user_id'=>$_SESSION['FRONT_USER_ID']), 2);
		
		if(!empty($wishSql))
		{
			foreach($wishSql as $wishVal)
			{
				$proVal = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE id=:id", array(':id'=>$wishVal->pro_id), 1);
	?>
			<div class="product-layout product-grid col-lg-3 col-md-3 col-sm-3 col-xs-12">
			  <div class="product-thumb">
				<a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>">
				  <div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;">
				  <img src="<?PHP echo $proVal->image1; ?>" alt="<?PHP echo $proVal->name; ?>" style="width:auto;max-height:100%;width: 100%;" /></div></a>
				  <div class="caption">
					<h4><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>"><?PHP echo $proVal->name; ?></a></h4>
                    <p class="price"><span class="price-new"><?PHP echo $general_cls_call->price_format($proVal->price); ?></span> 
					<span class="price-old" style="display:none"><?PHP echo $general_cls_call->price_format($proVal->list_price); ?></span>
					<span class="saving" style="display:none">-<?PHP echo $proVal->discount; ?>%</span></p>
				  </div>
				  <div class="button-group">
					<a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$proVal->page_url.'/'.$proVal->id; ?>"><button class="btn-primary" type="button"><span>View Details</span></button></a>
                    <a href="javascript:void(0);" onclick="return del('<?php echo $wishVal->id; ?>')"><button class="btn-danger" type="button"><span>Remove</span></button></a>
                    <div class="add-to-links" style="color:red;">No Delivery in P.O. Box</div>
				  </div>
			  </div>
			</div>
	<?PHP
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
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>
</body>
</html>
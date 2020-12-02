 <?PHP	
	include_once 'init.php';
	
	/////  INSERT VISITOR DETAILS 
	  $num_vis_ = 0;
                                                
                                                $field = "id, pro_id, ip_address, geoplugin_countryCode, geoplugin_city, date_";
                                                $value = ":id, :pro_id, :ip_address, :geoplugin_countryCode, :geoplugin_city, :date_";
                                                
                                                $g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
                                                
                                                $addExecute = array(
                                                    ':id'                       =>0,
                                                    ':pro_id'                   =>0,
                                                    ':ip_address'               =>$_SERVER['REMOTE_ADDR'],
                                                    ':geoplugin_countryCode'    =>$g["geoplugin_countryCode"],
                                                    ':geoplugin_city'           =>$g["geoplugin_city"],
                                                    ':date_'                    =>date("Y-m-d H:i:s")
                                                );
                                                
                                                $userVal = $general_cls_call->select_query("*", LOCATION, "WHERE ip_address=:ip_address", array(':ip_address'=>$_SERVER['REMOTE_ADDR']), 1);
                                                $userVis = $general_cls_call->select_query("*", LOCATION, "WHERE ip_address=:ip_address", array(':ip_address'=>$_SERVER['REMOTE_ADDR']), 2);
                                                $num_vis_ = sizeof($userVis);
                                                

	if(empty($userVal))
	{
		$num_vis_ ++;
		$general_cls_call->insert_query(LOCATION, $field, $value, $addExecute);
	}

	
	
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
		header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(1));
	}
	/* ============== WISHLIST END ================== */

?> 


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo FRONT_IMAGES_FOLDER; ?>favicon.png" rel="icon" />
<title> Tasty and Delicious Food with free delivery across Tallinn </title>
<meta name="keywords" content="<?PHP echo $pageName->meta_key; ?>">
<meta name="description" content="<?PHP echo $pageName->meta_desc; ?>">
<link rel="canonical" href="https://ramadhee.ee/"/>

<!--<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
 --><link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" /> 
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" /> 
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<!-- <link rel="stylesheet" type="text/css" href="revolution/css/settings.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="revolution/css/layers.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css"> -->
<!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'> -->
<script type="text/javascript">
	
	function wishlist(itemID)
	{
		window.location.href="home.php?mode=wish&itemID="+itemID;
		return true;
	}
	function doLogin()
	{
		alert("Please login.");
		return true;
	}

</script>





</head>
<body>
<div class="wrapper-wide">

  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->
   
   
   <div id="carouselExampleIndicators" class="carousel banner slide" data-ride="carousel">
  
 
  <?php
  	///$feSql = $general_cls_call->select_query("id,banner_title,banner_image", BANNER, " ORDER BY rand() DESC LIMIT 0, 10", array(), 2);
		$feSql = $general_cls_call->select_query("*", BANNER, "WHERE 1 ORDER BY id DESC", array(), 2);
		//echo "<pre>"; print_r($feSql); echo "</pre>";
		if(!empty($feSql))
		{ $i=0;
			foreach($feSql as $feVal)
			{
  ?>
    <li class="carousel-item <?php echo ($i==0)?'active':''; ?>">
      <img width="100%" class="d-block w-100" src="<?PHP echo DOMAIN_NAME.'uploads/banner/'.$feVal->banner_image; ?>" alt="First slide">
    </li>
		<?php $i++; }} ?>
    


</div>
   
   
   
   
   
  <div id="container" style="display:none">
    <div class="container">
      <div class="row">
        <div id="content" class="col-xs-12">
		
          <div class="marketshop-banner">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><!--<a href="javascript:;<?PHP //echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/mens/1'; ?>"><img src="<?php echo FRONT_IMAGES_FOLDER; ?>men.jpg" alt="2 Block Banner" title="2 Block Banner" /></a>--></div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><!--<a href="javascript:;<?PHP //echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/women/2'; ?>"><img src="<?php echo FRONT_IMAGES_FOLDER; ?>women.jpg" alt="2 Block Banner 1" title="2 Block Banner 1" /></a>--></div>
            </div>
          </div>
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <li><a href="#tab-featured">Featured</a></li>
            </ul>
            <div id="tab-featured" class="tab_content">
              <div class="owl-carousel product_carousel_tab">
	<?PHP
		$feSql = $general_cls_call->select_query("id,name,image1,price,discount,page_url,list_price", PRODUCT, "WHERE status=:status ORDER BY rand() DESC LIMIT 0, 10", array(':status'=>1), 2);
		if(empty($feSql))
		{
			foreach($feSql as $feVal)
			{
				$wishList = $general_cls_call->select_query("*", PRODUCT, "WHERE pro_id=:pro_id AND user_id=:user_id", array(':pro_id'=>$feVal->id, ':user_id'=>$_SESSION['FRONT_USER_ID']), 1);
	?>
                <div class="product-thumb clearfix">
                  <!-- <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$feVal->page_url.'/'.$feVal->id; ?>"><div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;"> --> 
				  <a href="<?PHP echo DOMAIN_NAME.'product_details.php?product_id='.$feVal->id; ?>"><div class="image" style="padding:6px;display: flex;align-items: center;justify-content: center;border: solid 1px #f0f0f0;">
				  <img src="<?php echo 'https://www.makelikethis.com/'.explode("/",$feVal->image1)[3]."/".explode("/",$feVal->image1)[4]?>" alt="<?PHP echo $feVal->name; ?>" style="width:100%;height:100%;" /></div></a>
				  
				  <div class="caption">
                    <h4><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$feVal->page_url.'/'.$feVal->id; ?>"><?PHP echo $feVal->name; ?></a></h4>
                    <p class="price"><span class="price-new"><?="&euro;".$general_cls_call->price_format($feVal->price); ?></span> <span class="price-old"><?PHP echo $general_cls_call->price_format($feVal->list_price); ?></span><span class="saving">-<?PHP echo $feVal->discount; ?>%</span></p>
                  </div>
                  <div class="button-group">
                    <!-- <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(8).'/'.$feVal->page_url.'/'.$feVal->id; ?>"> -->
					<a href="<?PHP echo DOMAIN_NAME.'product_details.php?product_id='.$feVal->id; ?>">
					
					<button class="btn-primary" type="button"><span>Vaata detaile</span></button></a>

			<?PHP
				if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID'] !='')
				{
					if($wishList->pro_id != $feVal->id)
					{
			?>
                    <a href="javascript:void(0);" onclick="return wishlist('<?php echo $feVal->id; ?>')"><button class="btn-success" type="button"><span>WISH LIST</span></button></a>
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
	?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
<!-- Services section -->
	<!-- <section id="what-we-do">
		<div class="container">
		    <h3><strong>What we do</strong></h3>
        <div class="seprator"></div>
			
			<div class="row mt-5">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-1">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-2">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-3">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-4">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-5">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
					<div class="card">
						<div class="card-block block-6">
							<h3 class="card-title">Special title</h3>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="javascript:void();" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section> -->
	<!-- /Services section --> 
 

<!-- Testimonial section -->
<!-- <div class="container">
	<div class="row">
		<div class="col-sm-12">
        <h3><strong>Testimonial</strong></h3>
        <div class="seprator"></div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              
              <div class="carousel-inner">
                <div class="item active">
                  <div class="row" style="padding: 20px">
                    <button style="border: none;"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>
                    <p class="testimonial_para">The food was Amazing, one of the best Biriyani I have ever had. and the price is also cheap and reasonable. Highly recommend this to everyone. 5/5</p><br>
                    <div class="row">
                    <div class="col-sm-2">
                        <img src="<?PHP echo DOMAIN_NAME; ?>image/client1.jpg" class="img-responsive" style="width: 80px">
                        </div>
                        <div class="col-sm-10">
                        <h4><strong>Nomin Jayawickrama </strong></h4>
                      
                    </div>
                    </div>
                  </div>
                </div>
               <div class="item">
                   <div class="row" style="padding: 20px">
                    <button style="border: none;"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>
                    <p class="testimonial_para">I loved their delivered food. A large, tasty portion of Biryani, made to accommodate my eating regime.</p><br>
                    <div class="row">
                    <div class="col-sm-2">
                        <img src="<?PHP echo DOMAIN_NAME; ?>image/client2.jpg" class="img-responsive" style="width: 80px">
                        </div>
                        <div class="col-sm-10">
                        <h4><strong>Luca Benegiamo</strong></h4>
                        
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="controls testimonial_control pull-right">
                <a class="left fa fa-chevron-left btn btn-default testimonial_btn" href="#carousel-example-generic"
                  data-slide="prev"></a>

                <a class="right fa fa-chevron-right btn btn-default testimonial_btn" href="#carousel-example-generic"
                  data-slide="next"></a>
              </div>
        </div>
	</div>
</div> -->


 <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->
<script>


</script>
</div>
</body>
</html>
<html lang="et">
<head>
<link rel="icon" type="image/png" href="https://ramadhee.ee/favicon.ico" sizes="196x196" />
<meta http-equiv="Estonian" content="et">
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<div id="header" class="style2">
    <nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
                <li class="email"><a href="mailto:<?PHP echo "support@ramadhee.ee"; ?>"><i class="fa fa-envelope"></i><?PHP echo "support@ramadhee.ee"; ?></a></li>
              </ul>
            </div>
            <div id="currency" class="btn-group" style="display:none">
              <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> 
			    <?PHP	
					if($_SESSION['CURRENCY'] == 1) { echo '$ USD'; }
					if($_SESSION['CURRENCY'] == 2) { echo '&euro; Euro'; }
					if($_SESSION['CURRENCY'] == 3) { echo '&pound; Pound'; }
				?>
			  <i class="fa fa-caret-down"></i></span></button>
			  <form name="curfrm" method="post" action="">
              <ul class="dropdown-menu">
                <li><button class="currency-select btn btn-link btn-block" type="submit" name="btnCurr" value="2">&euro; Euro</button></li>
                <li><button class="currency-select btn btn-link btn-block" type="submit" name="btnCurr" value="3">&pound; Pound</button></li>
                <li><button class="currency-select btn btn-link btn-block" type="submit" name="btnCurr" value="1">$ US Dollar</button></li>
              </ul>
			  </form>
            </div>
          </div>
          <div id="top-links" class="nav pull-right flip">
            <ul>
              <li style="padding:0 10px;">
			    <div id="google_translate_element"></div>
				<script type="text/javascript">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'et', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
				}
				</script>
				<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
			  </li>
		<?PHP
			if(isset($_SESSION['FRONT_USER_ID']) && $_SESSION['FRONT_USER_ID']!='')
			{
		?>
              <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(11); ?>">Minu konto</a></li>
              <li><a href="logout.php">Logi välja</a></li>
		<?PHP
			}
		else
			{
		?>
              <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(2); ?>">Logi sisse</a></li>
              <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(3); ?>">Registreeri</a></li>
		<?PHP
			}
		?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="<?PHP echo DOMAIN_NAME; ?>"><img class="img-responsive" src="<?PHP echo DOMAIN_NAME; ?>image/logo5.jpg" title="" alt="" width="100" height="200" /></a></div>
          </div>
          <div class="col-table-cell col-lg-1 col-md-1 col-sm-12 col-xs-12 inner"></div>
   <?PHP
		if((isset($_SESSION["SESS_CART"]) && $_SESSION["SESS_CART"] != "") && count($_SESSION["SESS_CART"][0])!=0)
		{
			$ShoppingCart = new ShoppingCart;
			$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');

			if((isset($_SESSION["SESS_CART"]) && $_SESSION["SESS_CART"] != "") && count($_SESSION["SESS_CART"][0])!=0)
			{
				$cart_items_ = 0;
				foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
				{
					$itemH = $general_cls_call->select_query("price", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
					$ProductTotalH = $ShoppingCart->arrayCartProductQuantity[$key]*$itemH->price;
					$ProductQnH += $ShoppingCart->arrayCartProductQuantity[$key];
					$orderTotalH += $ProductTotalH;
					$cart_items_++;
				}	 			
			}
		}
	?>
          <div class="col-table-cell col-lg-1 col-md-1 col-sm-12 col-xs-12 inner"></div>
          <div class="col-table-cell col-lg-2 col-md-2 col-sm-12 col-xs-12 inner">
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total"><?PHP echo ($cart_items_ !='' ? $cart_items_ : '0'); ?> esemed - <?PHP echo number_format($orderTotalH, 2, ',', ','); ?></span></button>
	<?PHP
		if((isset($_SESSION["SESS_CART"]) && $_SESSION["SESS_CART"] != "") && count($_SESSION["SESS_CART"][0])!=0)
		{
	?>
              <ul class="dropdown-menu">
                <li>
                  <table class="table">
                    <tbody>
			<?PHP
				$orderTotal = 0;
				$ProductTotal = 0;
				$totalProductsQuantity = 0;
				$i=1;
				foreach($ShoppingCart->arrayCartProductCode AS $key=>$ProductCode)
				{
					$itemHl = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ProductCode), 1);
					$ProductTotalHl = $ShoppingCart->arrayCartProductQuantity[$key]*$itemHl->price;
					$orderTotalHl += $ProductTotalHl;
			?>
                      <tr>
                        <td class="text-center">
							<a href="<?PHP echo "https://ramadhee.ee/product_details.php?product_id=".$itemHl->id."/"; ?>"><img height="30" width="30" src="<?php echo "https://ramadhee.ee/upload_images./".$itemHl->image1; ?>" alt="<?php echo $itemHl->name; ?>" class="img-thumbnail" /></a>
		
						</td>
                        <td class="text-left"><a href="<?PHP echo "https://ramadhee.ee/product_details.php?product_id=".$itemHl->id; ?>">
						<?php 
						
								$addons = "";
								$extraAddonsPrice = "";
								foreach(explode(",", $ShoppingCart->arrayCartProductAddOn[$key]) as $key=>$addonVal) {
									$addOnProduct = explode("-", $addonVal);
									if($addOnProduct[0] != null) {
										// $addons .= $addOnProduct[0] . "  €" . $addOnProduct[1]."</br>";	
										$addons .= "</br>" . $addOnProduct[0];
										$extraAddonsPrice .= "</br>" . "  €" . $addOnProduct[1];
									}
									$addOnPrice += number_format($addOnProduct[1], 2);
								}
							    $ShoppingCart->arrayCartProductAddOn[$key] = null;
								if($addons != "") {
									echo $itemHl->name . "</br> <b> Lisa : </b> " . $addons;
								}
						        else {
									echo $itemHl->name;
								}
						?>
						</a></td>
                        <td class="text-right" width="15%">Kogus. <?PHP echo $ShoppingCart->arrayCartProductQuantity[$key]; ?></td>
                        <td class="text-right"><?PHP echo number_format($ProductTotalHl, 2, ',',',') . " </br></br> " . $extraAddonsPrice; ?></td>
                      </tr>
			<?PHP
				}
			?>
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right" width="70%"><strong>Kokku</strong></td>
                          <td class="text-right"><?php echo number_format($orderTotalHl + $addOnPrice,2,',',','); ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <p class="checkout"><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(5); ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Vaata ostukorvi</a>&nbsp;&nbsp;&nbsp;<a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(6); ?>" class="btn btn-primary"><i class="fa fa-share"></i> Kassa</a></p>
                  </div>
                </li>
              </ul>
	<?PHP
		}
	?>
            </div>
          </div>
        </div>
      </div>
    </header>
	
      <nav id="menu" class="navbar center">
		
        <div class="navbar-header"> <span class="visible-xs visible-sm"> Menüü <b></b></span></div>
        <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
			 <li><a class="home_link" title="Home" href="<?php echo DOMAIN_NAME; ?>">Kodu</a></li>
			 
			 <?php
	$catSql = $general_cls_call->select_query("*", CATEGORY, "WHERE status=:status ORDER BY name ASC", array(':status'=>1), 2);
	if(!empty($catSql))
	{
		foreach($catSql as $catVal)
		{
?>
			<li class="dropdown mega-dropdown">
			
				<a href="<?php echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$catVal->id.'/'; ?>"><?php echo $catVal->name; ?></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
				
						<?php
			$subCatSql = $general_cls_call->select_query("*", SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id), 2);
			if(!empty($subCatSql))
			{
				foreach($subCatSql as $subCatVal)
				{
		?>
					<li>
							<ul>
								<li class=""><b><a href="<?php echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$subCatVal->page_url.'/'.$subCatVal->id."/"; ?>" style="color:#000;"><?PHP echo strtoupper($subCatVal->name); ?></a></b></li>
								
								<?php
								$subSubCatSql = $general_cls_call->select_query("*", SUB_SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id AND sub_cat_id=:sub_cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id, ':sub_cat_id'=>$subCatVal->id), 2);
								if(!empty($subSubCatSql))
								{
									foreach($subSubCatSql as $subSubCatVal)
									{
							?>
								 <li><a href="<?php echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$subCatVal->page_url.'/'.$subSubCatVal->page_url.'/'.$subSubCatVal->id."/"; ?>"><?PHP echo $subSubCatVal->name; ?></a></li>
							<?php
									}
								}
							?>  
							
							</ul>
					</li>
					<?php
					}
				}
						?>  
				
				</ul>				
			</li>
			<?php
			}
		}
		
						?>  
			</ul>
			<script>
			$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
			</script>
			<style>
			
			.mega-dropdown {
  position: static !important;
}
.mega-dropdown-menu {
    padding: 20px 0px;
    width: 100%;
    box-shadow: none;
    -webkit-box-shadow: none;
}
.mega-dropdown-menu > li > ul {
  padding: 0;
  margin: 0;
}
.mega-dropdown-menu > li > ul > li {
  list-style: none;
}
.mega-dropdown-menu > li > ul > li > a {
  display: block;
  color: #222;
  padding: 3px 5px;
}
.mega-dropdown-menu > li ul > li > a:hover,
.mega-dropdown-menu > li ul > li > a:focus {
  text-decoration: none;
}
.mega-dropdown-menu .dropdown-header {
  font-size: 18px;
  color: #ff3546;
  padding: 5px 60px 5px 5px;
  line-height: 30px;
}

.carousel-control {
  width: 30px;
  height: 30px;
  top: -35px;

}
.left.carousel-control {
  right: 30px;
  left: inherit;
}
.carousel-control .glyphicon-chevron-left, 
.carousel-control .glyphicon-chevron-right {
  font-size: 12px;
  background-color: #fff;
  line-height: 30px;
  text-shadow: none;
  color: #333;
  border: 1px solid #ddd;
}

.txt-sty {
	position:relative;
	left:120%;
}

</style>
<?php /*         
		 <ul class="nav navbar-nav">
            <li><a class="home_link" title="Home" href="<?PHP echo DOMAIN_NAME; ?>">Home</a></li>
<?PHP
	$catSql = $general_cls_call->select_query("*", CATEGORY, "WHERE status=:status ORDER BY name ASC", array(':status'=>1), 2);
	if(!empty($catSql))
	{
		foreach($catSql as $catVal)
		{
?>
            <li class="mega-menu dropdown"><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$catVal->id.'/'; ?>"><?PHP echo $catVal->name; ?></a>
              <div class="dropdown-menu">
		<?PHP
			$subCatSql = $general_cls_call->select_query("*", SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id), 2);
			if(!empty($subCatSql))
			{
				foreach($subCatSql as $subCatVal)
				{
		?>
                <div class="column col-lg-2 col-md-3"><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$subCatVal->page_url.'/'.$subCatVal->id."/"; ?>" style="color:#FFF;"><?PHP echo strtoupper($subCatVal->name); ?></a>
                  <div>
                   <ul>
				<?PHP
					$subSubCatSql = $general_cls_call->select_query("*", SUB_SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id AND sub_cat_id=:sub_cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id, ':sub_cat_id'=>$subCatVal->id), 2);
					if(!empty($subSubCatSql))
					{
						foreach($subSubCatSql as $subSubCatVal)
						{
				?>
					 <li><a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(7).'/'.$catVal->page_url.'/'.$subCatVal->page_url.'/'.$subSubCatVal->page_url.'/'.$subSubCatVal->id."/"; ?>"><?PHP echo $subSubCatVal->name; ?></a></li>
				<?PHP
						}
					}
				?>              
				   </ul>
                  </div>
                </div>  
		<?PHP
				}
			}
		?>              
              </div>
            </li>
<?PHP
		}
	}
?>
		  <!--<li><a class="customize" title="Home" href="<?PHP echo DOMAIN_NAME; ?>customize3D"> Customize T Shirt </a></li>-->
          </ul><? */?>
        </div>
        </div>
      </nav>
  </div>
   
  
  <script>
  $(document).ready(function()
  {
	 $("#cart").hover(function()
	 {
		 $("#cart").toggleClass("open");
		 // window.location = "https://ramadhee.ee/cart"; 
	 });
	 
	 $(".cart-icon").click(function()
	 {
		 window.location = "https://ramadhee.ee/cart"; 
	 });
  });
  </script>
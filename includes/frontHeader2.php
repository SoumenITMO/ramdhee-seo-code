<html lang="et">
<head>
<title> Maitsev ja maitsev toit </title>
<link rel="icon" type="image/png" href="https://ramadhee.ee/favicon.ico" sizes="196x196" />
<meta http-equiv="Estonian" content="et">
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

.navbar1 {
  overflow: hidden;
  background-color: #333; 
  width: auto;
}

.navbar1 a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.subnav1 {
  float: left;
  overflow: hidden;
}

.subnav1 .subnavbtn1 {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar1 a:hover, .subnav1:hover .subnavbtn1 {
  background-color: red;
}

.subnav-content {
  display: none;
  position: absolute;
  width: 44%;
  z-index: 2;
}

.subnav-content1 {
  display: none;
  position: absolute;
  left: 0;
  background-color: red;
  //width: 50%;
  z-index: 1;
}

.subnav-content a {
  float: left;
  color: white;
  text-decoration: none;
}

.subnav-content1 a {
  float: left;
  color: white;
  text-decoration: none;
}

.subnav-content a:hover {
  background-color: #eee;
  color: black;
}

.subnav-content1 a:hover {
  background-color: #eee;
  color: black;
}

.subnav1:hover .subnav-content {
  display: block;
}

.subnav1:hover .subnav-content1 {
  display: block;
}
</style>
<body>

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
              <li><a href="<?PHP echo DOMAIN_NAME.'seo/login.php'?>">Logi sisse</a></li>
              <li><a href="<?PHP echo DOMAIN_NAME.'seo/register.php'?>">Registreeri</a></li>
		<?PHP
			}
		?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
</div>
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
							<a href="<?PHP echo "https://ramadhee.ee/seo/product_details.php?product_id=".$itemHl->id."/"; ?>"><img height="30" width="30" src="<?php echo "https://ramadhee.ee/upload_images./".$itemHl->image1; ?>" alt="<?php echo $itemHl->name; ?>" class="img-thumbnail" /></a>
		
						</td>
                        <td class="text-left"><a href="<?PHP echo "https://ramadhee.ee/seo/product_details.php?product_id=".$itemHl->id; ?>">
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
		<div class="navbar1">
  <a class="home_link" title="Home" href="<?php echo DOMAIN_NAME; ?>">Kodu</a>
 
 <?php
	$catSql = $general_cls_call->select_query("*", CATEGORY, "WHERE status=:status ORDER BY name ASC", array(':status'=>1), 2);
	if(!empty($catSql))
	{
		foreach($catSql as $catVal)
		{
			
 ?>
			<div class="subnav1">
			<button class="subnavbtn1"><?=$catVal->name?>&nbsp;<i class="fa fa-caret-down"></i></button>
				<div class="subnav-content">
 <?php
			$subCatSql = $general_cls_call->select_query("*", SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id), 2);
			if(!empty($subCatSql))
			{
				foreach($subCatSql as $subCatVal)
				{
 ?>	
					<!-- <div class="subnav-content1">
					 <a href="#bring"><?=strtoupper($subCatVal->name)?></a> 
					</div>-->
					<div class="subnav-content1">
					 <!-- <div class="subnav-content1">-->
								
  <?php
					$subSubCatSql = $general_cls_call->select_query("*", SUB_SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id AND sub_cat_id=:sub_cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$catVal->id, ':sub_cat_id'=>$subCatVal->id), 2);
					if(!empty($subSubCatSql))
					{
						foreach($subSubCatSql as $subSubCatVal)
						{
  ?>
								<a href="<?php echo DOMAIN_NAME."seo/products1".'/'.$catVal->page_url.'/'.$subCatVal->page_url.'/'.$subSubCatVal->page_url.'/'.$subSubCatVal->id."/"; ?>"><?PHP echo $subSubCatVal->name; ?></a>
							
  <?php
						}
  ?>
				     
  <?php
					}
  ?>
					</div>
  <?php
				}
			}
  ?>
				</div>
			</div> 
 <?php
		}
	}
 ?>
</div>
      </div>
    </header>
<?PHP	
	include_once 'init.php';
	$rand = substr(number_format(time() * rand(),0,'',''),0,6);

	/* ============== SHOPPING CART START ================== */
	if(isset($_GET['mode']) && $_GET['mode'] == "buy")
	{		
		$ShoppingCart = new ShoppingCart;
		$ShoppingCart->Initialize(isset($_SESSION["SESS_CART"]) ? $_SESSION["SESS_CART"] : '');
		$Quantity = 1;
		
		$key = array_search($_GET['num'], $ShoppingCart->arrayCartProductDetails); 
		$ShoppingCart->Add($_GET['num'],$Quantity,$_POST['txtBLength'],$_POST['txtHLength'],'custom');

		$_SESSION["SESS_CART"] = $ShoppingCart->CartValues();	
		header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(5));
	}

	/* ============== SHOPPING CART END ================== */
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

<link rel="canonical" href="https://www.makelikethis.com/customize" />
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<script type="text/javascript">
<!--
	function captureCurrentDiv(num)
	{						
		$('.cart_img').css('border','');
		$('#body_text').css('border','');
		$("#back").hide();
		if(document.frm.txtBLength.value == '')
		{
			alert("Select Body Length.");
			return false;
		}
		else if(document.frm.txtHLength.value == '')
		{
			alert("Select Sleev Length.");
			return false;
		}
		else
		{
			html2canvas([document.getElementById('html-content-holder')], {   
				onrendered: function(canvas)  
				{
					var img = canvas.toDataURL()
					$.post("save.php", {data: img, num:num}, function (file) {
					});   
					document.frm.action="<?PHP echo DOMAIN_NAME; ?>customize.php?mode=buy&num="+num;
					document.frm.submit();
					return true;
				}
			});
		}
	}
	function backView()
	{
		$("#back").hide();
		$("#font").show();
		$("#back_view").show();
		$("#font_view").hide();
	}
	function fontView()
	{
		$("#back").show();
		$("#font").hide();
		$("#back_view").hide();
		$("#font_view").show();
	}
//-->
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script src="<?PHP echo JS_PATH; ?>jquery.ui.touch-punch.min.js"></script>
  <script>
	  $(function() {
		//$('#draggableImg').draggable();
		//$('#image').resizable();
		//$('#draggableText').draggable();
	  });
  </script>
<script type="text/javascript">
<!--
	(function($) {
    $.fn.extend( {
        limiter: function(limit, elem) {
            $(this).on("keyup focus", function() {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                elem.html( limit - chars );
            }
            setCount($(this)[0], elem);
        }
    });
})(jQuery);

//-->
</script>
<script src="<?PHP echo JS_PATH; ?>cropbox.js"></script>

<script type="text/javascript">
    window.onload = function() {
        var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'avatar.png'
        }
        var cropper = new cropbox(options);
        document.querySelector('#file').addEventListener('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })
        document.querySelector('#btnCrop').addEventListener('click', function(){
            var img = cropper.getDataURL();
            //document.querySelector('.cart_img').innerHTML += '<img src="'+img+'">';
			$(".cart_img").attr("src",img);
        })
        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        })
        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        })
    };
</script>

<script>
$(document).ready( function() {
	//var elem = $("#chars");
	//$("#clipa_art").limiter(20, elem);
});
</script>
<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Alex+Brush|Allura|Amatic+SC|Audiowide|Bad+Script|Berkshire+Swash|Cabin+Sketch|Caveat|Ceviche+One|Chicle|Cookie|Courgette|Covered+By+Your+Grace|Damion|Dancing+Script|Eagle+Lake|Fascinate+Inline|Faster+One|Gloria+Hallelujah|Great+Vibes|Homemade+Apple|IBM+Plex+Mono|Indie+Flower|Jim+Nightshade|Just+Another+Hand|Kaushan+Script|Limelight|Lobster|Lobster+Two|Macondo|Marck+Script|Monoton|Montserrat|Nanum+Brush+Script|Nothing+You+Could+Do|Open+Sans+Condensed:300|Oswald|Pacifico|Permanent+Marker|Pinyon+Script|Playball|Reenie+Beanie|Rock+Salt|Sacramento|Satisfy|Shadows+Into+Light|Shrikhand|Tangerine|Yellowtail" rel="stylesheet"> 
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
		<li><a href="#">Product Details</a></li>
      </ul>
      <div class="row">
	  <form name="frm" method="post" action="" enctype="multipart/form-data">
        <div id="content" class="col-sm-12">
          <div>
            <h1 class="title" itemprop="name" style="font-size:20px;">Custom Digital Print T Shirts</h1>
			<h2 style="font-size: 14px;margin-top: -5px!important;">Make Your Own Design Printed T-Shirts</h2>
			<br/>
            <div class="row product-info">
			  
			  <div class="col-sm-6" id="html-content-holder" style="padding:0;">
				
				<div id="font_view" style="float:left;">
				  <div class="cus_left"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/left_E4E5E7.png" style="width:100%;height:100%;" id="left_img"></div>
				  <div class="cus_body_img"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/body_E4E5E7.png" style="width:100%;height:100%;" id="body_img"></div>
				  <div class="cus_body">
					<div class="parent">
					  <div id="draggableImg" style="display: flex;align-items: center;justify-content: center;">
						<div id="image"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/graphis/blank.png" class="cart_img" style="width:100%;height:100%;border: dotted 1px #FFF;" /></div>
					  </div>
					  <div id="draggableText" style="display: flex;align-items: center;justify-content: center;">
						<div style="width:auto;text-align:center;color:#000;font-size:18px;font-family:verdana;border: dotted 1px #FFF;padding:5px;" id="body_text"></div>
					  </div>
					</div>
				  </div>
				  <div class="cus_right"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/right_E4E5E7.png" style="width:100%;height:100%;" id="right_img"></div>
				</div>
				
				<canvas id="img-out"> </canvas>
				
				<div id="3d_view" style="float:left;">
					 
					 
					
				</div>
				
				
				<div id="back_view" style="display:none;float:left;">
					<div class="col-md-2 cus_left_back"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/left_E4E5E7_back.png" style="width:100%;height:100%;" id="left_img_back"></div>
					<div class="col-md-8 cus_body_img_back"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/body_E4E5E7_back.png" style="width:100%;height:100%;" id="body_img_back"></div>
					<div class="col-md-2 cus_right_back"><img src="<?PHP echo DOMAIN_NAME; ?>customize_image/right_E4E5E7_back.png" style="width:100%;height:100%;" id="right_img_back"></div>
				</div>
				
				<div style="clear:both;"></div>
				<div class="col-sm-12">&nbsp;</div>
				
				<div class="col-sm-10" id="back" style="text-align:center;">
					<a href="Javascript:backView();"><button class="btn-danger" type="button" style="padding:11px;"><span>BACK VIEW</span></button></a>
				</div>
				
				<div class="col-sm-10" id="font" style="text-align:center;display:none;">
					<a href="Javascript:fontView();"><button class="btn-info" type="button" style="padding:11px;"><span>FRONT VIEW</span></button></a>
				</div>
				</br>
				
				<div class="col-sm-10" id="3d_view" style="text-align:center;">
					<div id='custom-3d-move'>
							
					</div>
					
					<!--
					<div id="product" style="width: 640px; height: 480px; overflow: hidden;"> 
						<img src="image/blue_shirt/1.jpg" /> 
						<img src="image/blue_shirt/2.jpg" /> 
						<img src="image/blue_shirt/3.jpg" /> 
						<img src="image/blue_shirt/4.jpg" /> 
						<img src="image/blue_shirt/5.jpg" /> 
						<img src="image/blue_shirt/6.jpg" /> 
						<img src="image/blue_shirt/7.jpg" /> 
						<img src="image/blue_shirt/8.jpg" /> 
						<img src="image/blue_shirt/9.jpg" /> 
						<img src="image/blue_shirt/10.jpg" /> 
					</div>
					-->
					<a href="Javascript:view_3d();"><button class="btn-danger" type="button" style="padding:11px;"><span class="btn-name">3D VIEW</span></button></a>
				</div>
				<div style="clear:both;"></div>
			  </div>
			  
              <div class="col-sm-6" style="padding:0px;"> 
                <div class="col-sm-12" style="padding:0px;"> 
				    <div class="col-sm-6"> 
					  <label class="control-label lebel_top">Body Color</label>
					  <div style="clear:both;"></div>
					  <div class="color_design" onclick="doBody('E4E5E7');"><div class="color_design_middle" style="background:#E4E5E7;"></div></div>
					  <div class="color_design" onclick="doBody('BFB2A2');"><div class="color_design_middle" style="background:#BFB2A2;"></div></div>
					  <div class="color_design" onclick="doBody('567C8A');"><div class="color_design_middle" style="background:#567C8A;"></div></div>
					  <div class="color_design" onclick="doBody('6A6B6F');"><div class="color_design_middle" style="background:#6A6B6F;"></div></div>
					  <div class="color_design" onclick="doBody('18214C');"><div class="color_design_middle" style="background:#18214C;"></div></div>
					  <div class="color_design" onclick="doBody('000000');"><div class="color_design_middle" style="background:#000000;"></div></div>
					  <div class="color_design" onclick="doBody('3ED0A4');"><div class="color_design_middle" style="background:#3ED0A4;"></div></div>
					  <div class="color_design" onclick="doBody('17ABAB');"><div class="color_design_middle" style="background:#17ABAB;"></div></div>
					  <div class="color_design" onclick="doBody('518C48');"><div class="color_design_middle" style="background:#518C48;"></div></div>
					  <div class="color_design" onclick="doBody('8B5E3D');"><div class="color_design_middle" style="background:#8B5E3D;"></div></div>
					  <div class="color_design" onclick="doBody('A37CB1');"><div class="color_design_middle" style="background:#A37CB1;"></div></div>
					  <div class="color_design" onclick="doBody('C96B8A');"><div class="color_design_middle" style="background:#C96B8A;"></div></div>
					  <div class="color_design" onclick="doBody('FEEA7A');"><div class="color_design_middle" style="background:#FEEA7A;"></div></div>
					  <div class="color_design" onclick="doBody('F8B7C4');"><div class="color_design_middle" style="background:#F8B7C4;"></div></div>
					  <div class="color_design" onclick="doBody('F4774B');"><div class="color_design_middle" style="background:#F4774B;"></div></div>
					  <div class="color_design" onclick="doBody('F7546C');"><div class="color_design_middle" style="background:#F7546C;"></div></div>
					  <div class="color_design" onclick="doBody('E20C2A');"><div class="color_design_middle" style="background:#E20C2A;"></div></div>
					  <div class="color_design" onclick="doBody('226BC7');"><div class="color_design_middle" style="background:#226BC7;"></div></div>					  
					  <div style="clear:both;"></div>
					</div>
					<div class="col-sm-6"> 
					  <label class="control-label lebel_top">Sleev Color</label> 
					  <div style="clear:both;"></div>
					  <div class="color_design" onclick="doHand('E4E5E7');"><div class="color_design_middle" style="background:#E4E5E7;"></div></div>
					  <div class="color_design" onclick="doHand('BFB2A2');"><div class="color_design_middle" style="background:#BFB2A2;"></div></div>
					  <div class="color_design" onclick="doHand('567C8A');"><div class="color_design_middle" style="background:#567C8A;"></div></div>
					  <div class="color_design" onclick="doHand('6A6B6F');"><div class="color_design_middle" style="background:#6A6B6F;"></div></div>
					  <div class="color_design" onclick="doHand('18214C');"><div class="color_design_middle" style="background:#18214C;"></div></div>
					  <div class="color_design" onclick="doHand('000000');"><div class="color_design_middle" style="background:#000000;"></div></div>
					  <div class="color_design" onclick="doHand('3ED0A4');"><div class="color_design_middle" style="background:#3ED0A4;"></div></div>
					  <div class="color_design" onclick="doHand('17ABAB');"><div class="color_design_middle" style="background:#17ABAB;"></div></div>
					  <div class="color_design" onclick="doHand('518C48');"><div class="color_design_middle" style="background:#518C48;"></div></div>
					  <div class="color_design" onclick="doHand('8B5E3D');"><div class="color_design_middle" style="background:#8B5E3D;"></div></div>
					  <div class="color_design" onclick="doHand('A37CB1');"><div class="color_design_middle" style="background:#A37CB1;"></div></div>
					  <div class="color_design" onclick="doHand('C96B8A');"><div class="color_design_middle" style="background:#C96B8A;"></div></div>
					  <div class="color_design" onclick="doHand('FEEA7A');"><div class="color_design_middle" style="background:#FEEA7A;"></div></div>
					  <div class="color_design" onclick="doHand('F8B7C4');"><div class="color_design_middle" style="background:#F8B7C4;"></div></div>
					  <div class="color_design" onclick="doHand('F4774B');"><div class="color_design_middle" style="background:#F4774B;"></div></div>
					  <div class="color_design" onclick="doHand('F7546C');"><div class="color_design_middle" style="background:#F7546C;"></div></div>
					  <div class="color_design" onclick="doHand('E20C2A');"><div class="color_design_middle" style="background:#E20C2A;"></div></div>
					  <div class="color_design" onclick="doHand('226BC7');"><div class="color_design_middle" style="background:#226BC7;"></div></div>					  
					  <div style="clear:both;"></div>
					</div>
				    <div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
                <div class="col-sm-12" style="padding:0px;">
				  <div class="col-sm-6">
				      <div class="col-sm-6 half_mobile">
						<label class="control-label lebel_top">Body Length</label>         
						  <select  class="form-control" name="txtBLength" required>
							<option value="">Select...</option>
					<?php 
						for($s=60; $s<=120; $s++) 
						{ 
					?>
							<option value="<?PHP echo $s; ?>"><?PHP echo $s; ?>cm.</option>
					<?PHP				
						}
					?>
						  </select> 
					  </div> 
					  <div class="col-sm-6 half_mobile">  
						 <label class="control-label lebel_top">Sleev Length</label>         
						  <select class="form-control" name="txtHLength" required>
							<option value="">Select...</option>
					<?php 
						for($s=60; $s<=120; $s++) 
						{ 
					?>
							<option value="<?PHP echo $s; ?>"><?PHP echo $s; ?>cm.</option>
					<?PHP				
						}
					?>
						  </select> 
					  </div> 
					  <div class="col-sm-12" style="padding:0;margin-top:12px;">  
						<label class="control-label lebel_top">Body Text</label>         
						<textarea name="" id="clipa_art" class="form-control" maxlength="20" style="height:50px;" placeholder="Clip Art" onKeyUp="clip();" onKeyDown="clip();" onClick="clip();"></textarea>
						<div class="bottom-control clearfix">
							<h5><div id="chars" style="float:left;width:16px;text-align:right;">20</div><span style="float:left;">&nbsp;characters left.</span></h5>
						</div>
					  </div>
					  <div class="col-sm-12" style="padding:0;margin-top:12px;"> 
						<div class="font-style" style="padding:0;">
							<select name="txtFont" id="txtFont" class="form-control" style="width:85%;float:right;border:none;padding:0;" onClick="fontFamily(this.value);" onChange="fontFamily(this.value);">							
								<option value="verdana" >Verdana</option>
								<option value="'Oswald', sans-serif">Oswal</option>
								<option value="'Montserrat', sans-serif">Montserrat</option>
								<option value="'IBM Plex Mono', monospace">IBM Plex Mono, monospace</option>
								<option value="'Chicle', cursive" >Chicle</option>
								<option value="'Open Sans Condensed', sans-serif" >Open Sans Condensed</option>
								<option value="'Indie Flower', cursive" >Indie Flower</option>
								<option value="'Lobster', cursive" >Lobster</option>
								<option value="'Pacifico', cursive" >Pacifico</option>
								<option value="'Abril Fatface', cursive" >Abril Fatface</option>
								<option value="'Shadows Into Light', cursive" >Shadows Into Light</option>
								<option value="'Dancing Script', cursive" >Dancing Script</option>
								<option value="'Gloria Hallelujah', cursive" >Gloria Hallelujah</option>
								<option value="'Amatic SC', cursive" >Amatic SC</option>
								<option value="'Berkshire Swash', cursive" >Berkshire Swash</option>
								<option value="'Great Vibes', cursive" >Great Vibes</option>
								<option value="'Fascinate Inline', cursive" >Fascinate Inline</option>
								<option value="'Kaushan Script', cursive" >Kaushan Script</option>
								<option value="'Permanent Marker', cursive" >Permanent Marker</option>
								<option value="'Shrikhand', cursive" >Shrikhand</option>
								<option value="'Courgette', cursive" >Courgette</option>
								<option value="'Cookie', cursive" >Cookie</option>
								<option value="'Satisfy', cursive" >Satisfy</option>
								<option value="'Macondo', cursive" >Macondo</option>
								<option value="'Lobster Two', cursive" >Lobster Two</option>
								<option value="'Sacramento', cursive" >Sacramento</option>
								<option value="'Nanum Brush Script', cursive" >Nanum Brush Script</option>
								<option value="'Caveat', cursive" >Caveat</option>
								<option value="'Tangerine', cursive" >Tangerine</option>
								<option value="'Monoton', cursive" >Monoton</option>
								<option value="'Audiowide', cursive" >Audiowide</option>
								<option value="'Faster One', cursive" >Faster One</option>
								<option value="'Marck Script', cursive" >Marck Script</option>
								<option value="'Covered By Your Grace', cursive" >Covered By Your Grace</option>
								<option value="'Yellowtail', cursive" >Yellowtail</option>
								<option value="'Cabin Sketch', cursive" >Cabin Sketch</option>
								<option value="'Bad Script', cursive" >Bad Script</option>
								<option value="'Playball', cursive" >Playball</option>
								<option value="'Damion', cursive" >Damion</option>
								<option value="'Homemade Apple', cursive" >Homemade Apple</option>
								<option value="'Alex Brush', cursive" >Alex Brush</option>
								<option value="'Nothing You Could Do', cursive" >Nothing You Could Do</option>
								<option value="'Rock Salt', cursive" >Rock Salt</option>
								<option value="'Just Another Hand', cursive" >Just Another Hand</option>
								<option value="'Jim Nightshade', cursive" >Jim Nightshade</option>
								<option value="'Allura', cursive" >Allura</option>
								<option value="'Ceviche One', cursive" >Ceviche One</option>
								<option value="'Pinyon Script', cursive" >Pinyon Script</option>
								<option value="'Limelight', cursive" >Limelight</option>
								<option value="'Eagle Lake', cursive" >Eagle Lake</option>
								<option value="'Reenie Beanie', cursive" >Reenie Beanie</option>
							</select>
						</div>
						<div class="col-sm-4 font-size" style="padding-right:0;">
							<select name="txtSize" id="txtSize" class="form-control" style="width:85%;float:right;border:none;padding:0;" onClick="fontSize(this.value);" onChange="fontSize(this.value);">
								<option value="13px" >13</option>
								<option value="14px" >14</option>
								<option value="15px" >15</option>
								<option value="16px" >16</option>
								<option value="17px" >17</option>
								<option value="18px" selected>18</option>
								<option value="19px" >19</option>
								<option value="20px">20</option>
								<option value="21px" >21</option>
								<option value="22px" >22</option>
								<option value="23px" >23</option>
								<option value="24px" >24</option>
								<option value="25px" >25</option>
								<option value="26px" >26</option>
								<option value="27px" >27</option>
								<option value="28px" >28</option>
								<option value="29px" >29</option>
								<option value="30px" >30</option>
								<option value="31px" >31</option>
								<option value="32px" >32</option>
								<option value="33px" >33</option>
								<option value="34px" >34</option>
								<option value="35px" >35</option>
								<option value="36px" >36</option>
							</select>
						</div>
					  </div> 					  
					  <div style="clear:both;"></div>
					  <div class="col-sm-12" style="padding:0;margin-top:12px;">
						<div class="font-col"><a href="Javascript:void(0);" onClick="doTheamColor();"><img src="<?PHP echo DOMAIN_NAME; ?>image/font-color.png" alt="">&nbsp;<img src="<?PHP echo DOMAIN_NAME; ?>image/color.png" alt=""></a></div>
						<div id="bold" class="bold-italic "><a href="Javascript:void(0);" onClick="fontWeight('bold');"><img src="<?PHP echo DOMAIN_NAME; ?>image/bold.png" alt=""></a></div>
						<div id="italic" class="bold-italic "><a href="Javascript:void(0);" onClick="fontStyle('italic');"><img src="<?PHP echo DOMAIN_NAME; ?>image/italic.png" alt=""></a></div>
						<div id="underline" class="bold-italic "><a href="Javascript:void(0);" onClick="fontDecoration('underline');"><img src="<?PHP echo DOMAIN_NAME; ?>image/underline.png" alt=""></a></div>
						  <div class="theam-color" id="theam_id" style="display:none;">
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#262626'), doTheamColor();" onMouseOver="changeColor('#262626')"><li style="background:#262626;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ffffff'), doTheamColor();" onMouseOver="changeColor('#ffffff')"><li style="background:#ffffff;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#eeece1'), doTheamColor();" onMouseOver="changeColor('#eeece1')"><li style="background:#eeece1;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#c6d9f0'), doTheamColor();" onMouseOver="changeColor('#c6d9f0')"><li style="background:#c6d9f0;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#dbe5f1'), doTheamColor();" onMouseOver="changeColor('#dbe5f1')"><li style="background:#dbe5f1;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#f2dcdb'), doTheamColor();" onMouseOver="changeColor('#f2dcdb')"><li style="background:#f2dcdb;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ebf1dd'), doTheamColor();" onMouseOver="changeColor('#ebf1dd')"><li style="background:#ebf1dd;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#e5e0ec'), doTheamColor();" onMouseOver="changeColor('#e5e0ec')"><li style="background:#e5e0ec;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#dbeef3'), doTheamColor();" onMouseOver="changeColor('#dbeef3')"><li style="background:#dbeef3;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#fdeada'), doTheamColor();" onMouseOver="changeColor('#fdeada')"><li style="background:#fdeada;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#7f7f7f'), doTheamColor();" onMouseOver="changeColor('#7f7f7f')"><li style="background:#7f7f7f;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#f2f2f2'), doTheamColor();" onMouseOver="changeColor('#f2f2f2')"><li style="background:#f2f2f2;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ddd9c3'), doTheamColor();" onMouseOver="changeColor('#ddd9c3')"><li style="background:#ddd9c3;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#8db3e2'), doTheamColor();" onMouseOver="changeColor('#8db3e2')"><li style="background:#8db3e2;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#b8cce4'), doTheamColor();" onMouseOver="changeColor('#b8cce4')"><li style="background:#b8cce4;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#e5b9b7'), doTheamColor();" onMouseOver="changeColor('#e5b9b7')"><li style="background:#e5b9b7;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#d7e3bc'), doTheamColor();" onMouseOver="changeColor('#d7e3bc')"><li style="background:#d7e3bc;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ccc1d9'), doTheamColor();" onMouseOver="changeColor('#ccc1d9')"><li style="background:#ccc1d9;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#b7dde8'), doTheamColor();" onMouseOver="changeColor('#b7dde8')"><li style="background:#b7dde8;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#fbd5b5'), doTheamColor();" onMouseOver="changeColor('#fbd5b5')"><li style="background:#fbd5b5;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#3f3f3f'), doTheamColor();" onMouseOver="changeColor('#3f3f3f')"><li style="background:#3f3f3f;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#d8d8d8'), doTheamColor();" onMouseOver="changeColor('#d8d8d8')"><li style="background:#d8d8d8;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#c4bd97'), doTheamColor();" onMouseOver="changeColor('#c4bd97')"><li style="background:#c4bd97;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#548dd4'), doTheamColor();" onMouseOver="changeColor('#548dd4')"><li style="background:#548dd4;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#95b3d7'), doTheamColor();" onMouseOver="changeColor('#95b3d7')"><li style="background:#95b3d7;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#d99694'), doTheamColor();" onMouseOver="changeColor('#d99694')"><li style="background:#d99694;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#c3d69b'), doTheamColor();" onMouseOver="changeColor('#c3d69b')"><li style="background:#c3d69b;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#b2a2c7'), doTheamColor();" onMouseOver="changeColor('#b2a2c7')"><li style="background:#b2a2c7;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#92cddc'), doTheamColor();" onMouseOver="changeColor('#92cddc')"><li style="background:#92cddc;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#fac08f'), doTheamColor();" onMouseOver="changeColor('#fac08f')"><li style="background:#fac08f;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#000000'), doTheamColor();" onMouseOver="changeColor('#000000')"><li style="background:#000000;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#bfbfbf'), doTheamColor();" onMouseOver="changeColor('#bfbfbf')"><li style="background:#bfbfbf;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#938953'), doTheamColor();" onMouseOver="changeColor('#938953')"><li style="background:#938953;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#1f497d'), doTheamColor();" onMouseOver="changeColor('#1f497d')"><li style="background:#1f497d;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#4f81bd'), doTheamColor();" onMouseOver="changeColor('#4f81bd')"><li style="background:#4f81bd;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#c0504d'), doTheamColor();" onMouseOver="changeColor('#c0504d')"><li style="background:#c0504d;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#9bbb59'), doTheamColor();" onMouseOver="changeColor('#9bbb59')"><li style="background:#9bbb59;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#8064a2'), doTheamColor();" onMouseOver="changeColor('#8064a2')"><li style="background:#8064a2;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#4bacc6'), doTheamColor();" onMouseOver="changeColor('#4bacc6')"><li style="background:#4bacc6;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#f79646'), doTheamColor();" onMouseOver="changeColor('#f79646')"><li style="background:#f79646;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#0c0c0c'), doTheamColor();" onMouseOver="changeColor('#0c0c0c')"><li style="background:#0c0c0c;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#a5a5a5'), doTheamColor();" onMouseOver="changeColor('#a5a5a5')"><li style="background:#a5a5a5;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#494429'), doTheamColor();" onMouseOver="changeColor('#494429')"><li style="background:#494429;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#17365d'), doTheamColor();" onMouseOver="changeColor('#17365d')"><li style="background:#17365d;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#366092'), doTheamColor();" onMouseOver="changeColor('#366092')"><li style="background:#366092;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#953734'), doTheamColor();" onMouseOver="changeColor('#953734')"><li style="background:#953734;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#76923c'), doTheamColor();" onMouseOver="changeColor('#76923c')"><li style="background:#76923c;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#5f497a'), doTheamColor();" onMouseOver="changeColor('#5f497a')"><li style="background:#5f497a;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#31859b'), doTheamColor();" onMouseOver="changeColor('#31859b')"><li style="background:#31859b;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#e36c09'), doTheamColor();" onMouseOver="changeColor('#e36c09')"><li style="background:#e36c09;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#595959'), doTheamColor();" onMouseOver="changeColor('#595959')"><li style="background:#595959;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#7f7f7f'), doTheamColor();" onMouseOver="changeColor('#7f7f7f')"><li style="background:#7f7f7f;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#1d1b10'), doTheamColor();" onMouseOver="changeColor('#1d1b10')"><li style="background:#1d1b10;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#0f243e'), doTheamColor();" onMouseOver="changeColor('#0f243e')"><li style="background:#0f243e;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#244061'), doTheamColor();" onMouseOver="changeColor('#244061')"><li style="background:#244061;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#632423'), doTheamColor();" onMouseOver="changeColor('#632423')"><li style="background:#632423;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#4f6128'), doTheamColor();" onMouseOver="changeColor('#4f6128')"><li style="background:#4f6128;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#3f3151'), doTheamColor();" onMouseOver="changeColor('#3f3151')"><li style="background:#3f3151;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#205867'), doTheamColor();" onMouseOver="changeColor('#205867')"><li style="background:#205867;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#974806'), doTheamColor();" onMouseOver="changeColor('#974806')"><li style="background:#974806;"></li></a>
							</ul>
							<ul>
							  <a href="Javascript:void(0);" onClick="changeColor('#ff0000'), doTheamColor();" onMouseOver="changeColor('#ff0000')"><li style="background:#ff0000;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#c00000'), doTheamColor();" onMouseOver="changeColor('#c00000')"><li style="background:#c00000;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ffc000'), doTheamColor();" onMouseOver="changeColor('#ffc000')"><li style="background:#ffc000;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#ffff00'), doTheamColor();" onMouseOver="changeColor('#ffff00')"><li style="background:#ffff00;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#92d050'), doTheamColor();" onMouseOver="changeColor('#92d050')"><li style="background:#92d050;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#00b050'), doTheamColor();" onMouseOver="changeColor('#00b050')"><li style="background:#00b050;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#00b0f0'), doTheamColor();" onMouseOver="changeColor('#00b0f0')"><li style="background:#00b0f0;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#0070c0'), doTheamColor();" onMouseOver="changeColor('#0070c0')"><li style="background:#0070c0;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#002060'), doTheamColor();" onMouseOver="changeColor('#002060')"><li style="background:#002060;"></li></a>
							  <a href="Javascript:void(0);" onClick="changeColor('#7030a0'), doTheamColor();" onMouseOver="changeColor('#7030a0')"><li style="background:#7030a0;"></li></a>
							</ul>
						  </div>
					  </div>
					  <div style="clear:both;"></div>
				  </div>
				  <div class="col-sm-6">
					  <label class="control-label lebel_top">Graphis Design</label>
					  <div style="clear:both;"></div>
				<?PHP
					for($d=1; $d<=11; $d++)
					{
				?>
					  <div class="grap_design" onclick="doCart('<?PHP echo $d; ?>');" style="display:none;">
						<img src="<?PHP echo DOMAIN_NAME; ?>customize_image/graphis/cart<?PHP echo $d; ?>.png" style="width:auto;max-height:100%;">
					  </div>
				<?PHP
					}
				?>
					  <div class="grap_design">
						<img src="<?PHP echo DOMAIN_NAME; ?>image/upload.png" style="width:auto;max-height:100%;" data-toggle="modal" data-target="#myModalUpload">
					  </div>
				  </div>
				</div>
				
				<div style="clear:both;"></div>
                <div class="col-sm-12">&nbsp;</div> 
                <div class="col-sm-12" style="padding:0px;"> 
				  <div class="col-sm-6">
				    <ul class="price-box">
				      <li class="price">Price <span itemprop="price"><?PHP echo $general_cls_call->price_format('9.99'); ?></span></li>
				    </ul>
				  </div>
				  <div class="col-sm-6">
					  <button type="button" id="button-cart" class="btn btn-primary btn-lg" onclick="return captureCurrentDiv('<?PHP echo $rand; ?>');">Add to Cart</button>&nbsp;&nbsp;
					  <button class="btn-success" type="button" id="btn-Preview-Image" style="padding:11px;" data-toggle="modal" data-target="#myModal"><span>CLICK TO PREVIEW</span></button>
				  </div>
				</div>
								  
				<div style="clear:both;"></div>	


              </div> <!-- Not Delete -->
            </div>


          </div>
        </div>
	   </form>
      </div>
    </div>
  </div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg m_all0">
          <div class="modal-content modal_adjust">
            <div class="modal-header bdr_none">
              <button type="button" class="close close_hover" id="close_pop" data-dismiss="modal">&times;</button>
              <h3 class="modal-title text-center">Preview</h3>
            </div>			
			<div id="previewImage" style="margin:20px;"></div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModalUpload" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg m_all0" style="width:300px;">
          <div class="modal-content modal_adjust">
            <div class="modal-header bdr_none">
              <button type="button" class="close close_hover" id="close_pop" data-dismiss="modal">&times;</button>
              <h3 class="modal-title text-center">Upload Image</h3>
            </div>
			<div class="col-sm-12">
			    <div class="img_container">
				  <div class="imageBox">
					<div class="thumbBox"></div>
					<div class="spinner" style="display: none">Loading...</div>
				  </div>
				  <div class="action">
					<input type="file" id="file" style="float:left; width: 150px">
				  </div>
				  <div class="action">
					<input type="button" id="btnCrop" value="Crop" style="float: right" data-dismiss="modal">
					<input type="button" id="btnZoomIn" value="+" style="float: right">
					<input type="button" id="btnZoomOut" value="-" style="float: right">
					<br><br>
				  </div>
				  <div class="cropped"></div>
				</div>
			</div>			
				<div style="clear:both;"></div>	
          </div>
        </div>
      </div>

  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>

<div id="custom_shirt" style="width:999px;height:669px;display:none;">
</div>


<!-- <script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery-2.1.1.min.js"></script>
-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/bootstrap/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.easing-1.3.min.js"></script> -->
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/swipebox/src/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/custom.js"></script>
<!-- <script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/j360.js"></script> -->

<script type="text/javascript" src='https://unpkg.com/spritespin@4.0.3/release/spritespin.js' type='text/javascript'></script>

<script type="text/javascript">
<!--
	var click_ = 0;
	function doBody(name)
	{
		var imgName = '<?PHP echo DOMAIN_NAME; ?>customize_image/body_'+name+'.png';
		//$('#body_img').css('background-image', 'url(' + imgName + ')');
		$("#body_img").attr("src",imgName);

		var imgNameBack = '<?PHP echo DOMAIN_NAME; ?>customize_image/body_'+name+'_back.png';
		//$('#body_img_back').css('background-image', 'url(' + imgNameBack + ')');
		$("#body_img_back").attr("src",imgNameBack);
	}
	function doHand(name)
	{
		var leftImgName = '<?PHP echo DOMAIN_NAME; ?>customize_image/left_'+name+'.png';
		$("#left_img").attr("src",leftImgName);

		var rightImgName = '<?PHP echo DOMAIN_NAME; ?>customize_image/right_'+name+'.png';
		$("#right_img").attr("src",rightImgName);

		var leftImgNameBack = '<?PHP echo DOMAIN_NAME; ?>customize_image/left_'+name+'_back.png';
		$("#left_img_back").attr("src",leftImgNameBack);

		var rightImgNameBack = '<?PHP echo DOMAIN_NAME; ?>customize_image/right_'+name+'_back.png';
		$("#right_img_back").attr("src",rightImgNameBack);
	}
	function doCart(name)
	{
		$("#image").width(100).height(100);
		var imgCart = '<?PHP echo DOMAIN_NAME; ?>customize_image/graphis/cart'+name+'.png';
		$(".cart_img").attr("src",imgCart);
	}
	function clip()
	{
		var selection = document.getElementById("clipa_art").value.replace(/\n/g,'<br />');
		document.getElementById('body_text').innerHTML = selection;
	}
	function clipColor(val)
	{
		document.getElementById('body_text').style.color = val;
	}	
	function fontSize(size)
	{
		document.getElementById('body_text').style.fontSize = size;
		document.getElementById('body_text').style.lineHeight = size;
	}
	function fontFamily(family)
	{
		document.getElementById('body_text').style.fontFamily = family;
	}
	function changeColor(color)
	{
		document.getElementById('body_text').style.color = color;
	}
	
	function doTheamColor()
	{
		if(document.getElementById('theam_id').style.display == "none")
		{
			document.getElementById('theam_id').style.display = "block";
		}
		else
		{
			document.getElementById('theam_id').style.display = "none";
		}
	}
	
	function fontWeight(weight)
	{
		if(document.getElementById('body_text').style.fontWeight == "bold")
		{
			document.getElementById('body_text').style.fontWeight = '';
			document.getElementById('bold').className = "bold-italic";
		}
		else
		{
			document.getElementById('body_text').style.fontWeight = weight;
			document.getElementById('bold').className = "bold-italic selected";
		}
	}
	
	function fontStyle(style)
	{
		if(document.getElementById('body_text').style.fontStyle == "italic")
		{
			document.getElementById('body_text').style.fontStyle = '';
			document.getElementById('italic').className = "bold-italic";
		}
		else
		{
			document.getElementById('body_text').style.fontStyle = style;
			document.getElementById('italic').className = "bold-italic selected";
		}
	}
	function fontDecoration(decoration)
	{
		if(document.getElementById('body_text').style.textDecoration == "underline")
		{
			document.getElementById('body_text').style.textDecoration = '';
			document.getElementById('underline').className = "bold-italic";
		}
		else
		{
			document.getElementById('body_text').style.textDecoration = decoration;
			document.getElementById('underline').className = "bold-italic selected";
		}
	}
	
	function view_3d()
	{
		if(click_ == 0)
		{
			$("#font_view").hide();
			$(".cus_body").hide();
			
			$("#custom-3d-move").spritespin(
			{
				// path to the source images.
				source: [
							/*
							"image/3d_blue/1.png",
							"image/3d_blue/2.png",
							"image/3d_blue/3.png",
							"image/3d_blue/4.png",
							"image/3d_blue/5.png",
							"image/3d_blue/6.png",
							"image/3d_blue/7.png",
							"image/3d_blue/8.png",
							"image/3d_blue/9.png",
							"image/3d_blue/10.png",
							"image/3d_blue/11.png",
							"image/3d_blue/12.png",
							"image/3d_blue/13.png",
							"image/3d_blue/14.png",
							"image/3d_blue/15.png",
							"image/3d_blue/16.png",
							"image/3d_blue/17.png",
							"image/3d_blue/18.png",
							"image/3d_blue/19.png",
							"image/3d_blue/20.png",
							*/
							
							
							"image/blue_shirt/1.png",
							"image/blue_shirt/2.png",
							"image/blue_shirt/3.png",
							"image/blue_shirt/4.png",
							"image/blue_shirt/5.png",
							"image/blue_shirt/6.png",
							"image/blue_shirt/7.png",
							"image/blue_shirt/8.png",
							"image/blue_shirt/9.png",
							"image/blue_shirt/10.png",
							
				],
				width   : 480,  // width in pixels of the window/frame
				height  : 327,  // height in pixels of the window/frame
				animate : false,
			});
			
		}
		
		if(click_ == 1)
		{
			$('#3d_view').hide();
			$("#font_view").show();
			$(".cus_body").show();
			$("#custom-3d-move").hide();
			$("#custom-3d-move").spritespin("destroy");
			$(".btn-name").text("2D View");
			click_ = 0;
		}
		click_++;
	}
	
	//jQuery('#product').j360();
	
	
//-->
</script>
<script>
$(document).ready(function()
{
	
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
 
    $("#btn-Preview-Image").on('click', function () {	
		$('#html-content-holder').removeClass('col-sm-6').addClass('col-sm-12');
		$('.cart_img').css('border','');
		$('#body_text').css('border','');
		$("#back_view").show();
		$("#back").hide();
                $("#previewImage").html('');
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });

	$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
	});


    $("#close_pop").on('click', function () {	
		$('#html-content-holder').removeClass('col-sm-12').addClass('col-sm-6');
		$("#back_view").hide();
		$('.cart_img').css('border','1px dotted #FFF');
		$('#body_text').css('border','1px dotted #FFF');
		$("#back").show();
	});
	
	$(".btn-danger-save").on("click",function()
	{
		// font_view
		//console.log("Save Image ... ");
		html2canvas($("#font_view"),
		{
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);
                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("#img-out").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
	});
});

</script>
</body>
</html>


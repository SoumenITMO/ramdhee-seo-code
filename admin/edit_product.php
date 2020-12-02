<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== SELECT QUERY START ===========*/
	$proVal = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$_GET['LinkID']), 1);
/*=========== SELECT QUERY END ===========*/

/*=========== UPDATE PRODUCT START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])))
	{
		extract($_POST);
		$sliderCheck = $general_cls_call->select_query("name", PRODUCT, "WHERE id!=:id", array('id'=>$_GET['LinkID']), 1);
		//$sliderCheck = $general_cls_call->select_query("pro_number", PRODUCT, "WHERE id!=:id", array('id'=>$_GET['LinkID']), 1);
		//echo"<pre>"; print_r($sliderCheck);
		if($sliderCheck=='')
		{
			$erMsg = 'Name can not blank.';
		}
		else
		{
			$catName = $general_cls_call->select_query("name", CATEGORY, "WHERE id=:id", array(':id'=>$txtCategory), 1);
			$categoryName = substr($catName->name,0,2);
			$sub_catName = $general_cls_call->select_query("name", SUB_CATEGORY, "WHERE id=:id", array(':id'=>$txtSubCategory), 1);
			$sub_categoryName = substr($sub_catName->name,0,2);
			$sub_sub_catName = $general_cls_call->select_query("name", SUB_SUB_CATEGORY, "WHERE id=:id", array(':id'=>$txtSubSubCategory), 1);
			$sub_sub_categoryName = substr($sub_sub_catName->name,0,2);
			$proName = substr($txtName,0,3);

			$proNumber = 'MLT'.$categoryName.$sub_categoryName.$sub_sub_categoryName.$proName.rand(10000,99999);
			$PostURL = strtolower(preg_replace('~[\\\\/:*?"_<>|() ]~','-',$_POST['txtName']));

			$setValues = "pro_number=:pro_number, cat_id=:cat_id, sub_cat_id=:sub_cat_id, sub_sub_cat_id=:sub_sub_cat_id, brand=:brand, name=:name, page_url=:page_url, size=:size, color=:color, sku=:sku, description=:description, list_price=:list_price, discount=:discount, price=:price, stock=:stock, image1=:image1, image2=:image2, image3=:image3, image4=:image4, image5=:image5";
			$updateExecute=array(
				':pro_number'		=>strtoupper($proNumber),
				':cat_id'			=>$general_cls_call->specialhtmlremover($txtCategory),
				':sub_cat_id'		=>$general_cls_call->specialhtmlremover($txtSubCategory),
				':sub_sub_cat_id'	=>$general_cls_call->specialhtmlremover($txtSubSubCategory),
				':brand'			=>$general_cls_call->specialhtmlremover($txtBrand),
				':name'				=>$general_cls_call->specialhtmlremover($txtName),
				':page_url'			=>$PostURL,
				':size'				=>$general_cls_call->specialhtmlremover($txtSize),
				':color'			=>$general_cls_call->specialhtmlremover($txtColor),
				':sku'				=>$general_cls_call->specialhtmlremover($txtNumber),
				':description'		=>$general_cls_call->specialhtmlremover($txtDesc), 
				':list_price'		=>$general_cls_call->specialhtmlremover($txtLPrice), 
				':discount'			=>$general_cls_call->specialhtmlremover($txtDiscount),  
				':price'			=>$general_cls_call->specialhtmlremover($txtPrice),
				':stock'			=>$general_cls_call->specialhtmlremover($txtStock), 
				':image1'			=>$general_cls_call->specialhtmlremover($txtImage1),
				':image2'			=>$general_cls_call->specialhtmlremover($txtImage2),
				':image3'			=>$general_cls_call->specialhtmlremover($txtImage3),
				':image4'			=>$general_cls_call->specialhtmlremover($txtImage4),
				':image5'			=>$general_cls_call->specialhtmlremover($txtImage5)
			);
			$whereClause=" WHERE id=".$_GET['LinkID'];
			$general_cls_call->update_query(PRODUCT, $setValues, $whereClause, $updateExecute);

			header("location:".ADMIN_SITE_URL."product_list.php");
		}
	}
/*=========== UPDATE PRODUCT END ===========*/

if(!isset($_POST['txtCategory'])) { $_POST['txtCategory'] =				$proVal->cat_id; }
if(!isset($_POST['txtSubCategory'])) { $_POST['txtSubCategory'] =		$proVal->sub_cat_id; }
if(!isset($_POST['txtSubSubCategory'])) { $_POST['txtSubSubCategory'] =	$proVal->sub_sub_cat_id; }
if(!isset($_POST['txtBrand'])) { $_POST['txtBrand'] =					$proVal->brand; }
if(!isset($_POST['txtName'])) { $_POST['txtName'] =						$proVal->name; }
if(!isset($_POST['txtSize'])) { $_POST['txtSize'] =						$proVal->size; }
if(!isset($_POST['txtColor'])) { $_POST['txtColor'] =					$proVal->color; }
if(!isset($_POST['txtNumber'])) { $_POST['txtNumber'] =					$proVal->sku; }
if(!isset($_POST['txtLPrice'])) { $_POST['txtLPrice'] =					$proVal->list_price; }
if(!isset($_POST['txtDiscount'])) { $_POST['txtDiscount'] =				$proVal->discount; }
if(!isset($_POST['txtPrice'])) { $_POST['txtPrice'] =					$proVal->price; }
if(!isset($_POST['txtStock'])) { $_POST['txtStock'] =					$proVal->stock; }
if(!isset($_POST['txtImage1'])) { $_POST['txtImage1'] =					$proVal->image1; }
if(!isset($_POST['txtImage2'])) { $_POST['txtImage2'] =					$proVal->image2; }
if(!isset($_POST['txtImage3'])) { $_POST['txtImage3'] =					$proVal->image3; }
if(!isset($_POST['txtImage4'])) { $_POST['txtImage4'] =					$proVal->image4; }
if(!isset($_POST['txtImage5'])) { $_POST['txtImage5'] =					$proVal->image5; }
if(!isset($_POST['txtDesc'])) { $_POST['txtDesc'] =						$proVal->description; }


ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="iso-8859-1">
<title><?PHP echo ADMIN_TITLE; ?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<style type="text/css">
	.section_part {width:46%;margin:0 2%; float:left;}
</style>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
</head>
<body>

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminHeader.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminMenu.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### BODY START ############### -->
<div id="main" role="main">
  <div id="ribbon"><span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i></span></span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Product</li>
      <li>Edit Product</li>
    </ol>
  </div>
  <div id="content">
	<?PHP
		if(isset($erMsg) && $erMsg != '')
		{
	?>
		<div class="alert alert-danger fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-times"></i><strong>Error!</strong> <?PHP echo $erMsg; ?>
		</div>
	<?PHP
		}
	?>
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-1"> </article>
      <article class="col-sm-12 col-md-12 col-lg-10" style="margin: 2% 0;">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Edit Product</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" name="frm" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Category<span style="color:red;">*</span></label>
                      <div class="select">
						<select name="txtCategory" id="category">
					<?PHP
						$catSql = $general_cls_call->select_query("*", CATEGORY, "WHERE status=:status ORDER BY name ASC", array(':status'=>1), 2);
					?>
							<option value="">Select</option>
					<?PHP
						foreach($catSql as $catValue)
						{
					?>
							<option value="<?PHP echo $catValue->id; ?>" <?PHP echo($_POST['txtCategory'] == $catValue->id ? 'selected' : ''); ?>><?PHP echo $catValue->name; ?></option>
					<?PHP
						}
					?>
						</select>
						<i></i>
					 </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Sub Category</label>
                      <div class="select">
						<select name="txtSubCategory" id="sub_category">
					<?PHP
						$subcatSql = $general_cls_call->select_query("*", SUB_CATEGORY, "WHERE status=:status AND cat_id=:cat_id ORDER BY name ASC", array(':status'=>1, ':cat_id'=>$_POST['txtCategory']), 2);
					?>
							<option value="">Select</option>
					<?PHP
						foreach($subcatSql as $subcatValue)
						{
					?>
							<option value="<?PHP echo $subcatValue->id; ?>" <?PHP echo($_POST['txtSubCategory'] == $subcatValue->id ? 'selected' : ''); ?>><?PHP echo $subcatValue->name; ?></option>
					<?PHP
						}
					?>
						</select>
						<i></i>
					 </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Sub Sub Category</label>
                      <div class="select">
						<select name="txtSubSubCategory" id="sub_sub_category">
					<?PHP
						$sub_subcatSql = $general_cls_call->select_query("*", SUB_SUB_CATEGORY, "WHERE status=:status AND sub_cat_id=:sub_cat_id ORDER BY name ASC", array(':status'=>1, ':sub_cat_id'=>$_POST['txtSubCategory']), 2);
					?>
							<option value="">Select</option>
					<?PHP
						foreach($sub_subcatSql as $sub_subcatValue)
						{
					?>
							<option value="<?PHP echo $sub_subcatValue->id; ?>" <?PHP echo($_POST['txtSubSubCategory'] == $sub_subcatValue->id ? 'selected' : ''); ?>><?PHP echo $sub_subcatValue->name; ?></option>
					<?PHP
						}
					?>
						</select>
						<i></i>
					 </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Brand</label>
                      <div class="input">
                        <input type="text" name="txtBrand" value="<?PHP echo $_POST['txtBrand']; ?>" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Name<span style="color:red;">*</span></label>
                      <div class="input">
                        <input type="text" name="txtName" value="<?PHP echo $_POST['txtName']; ?>" required>
                      </div>
                    </section>	
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Size</label>
                      <div class="input">
                        <input type="text" name="txtSize" value="<?PHP echo $_POST['txtSize']; ?>" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Color</label>
                      <div class="input">
                        <input type="text" name="txtColor" value="<?PHP echo $_POST['txtColor']; ?>" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">SKU Number</label>
                      <div class="input">
                        <input type="text" name="txtNumber" value="<?PHP echo $_POST['txtNumber']; ?>" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">List Price</label>
                      <div class="input">
                        <input type="text" name="txtLPrice" value="<?PHP echo $_POST['txtLPrice']; ?>" class="numeric" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Discount(%)</label>
                      <div class="input">
                        <input type="text" name="txtDiscount" value="<?PHP echo $_POST['txtDiscount']; ?>" class="numeric">
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Price</label>
                      <div class="input">
                        <input type="text" name="txtPrice" value="<?PHP echo $_POST['txtPrice']; ?>" class="numeric" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Stock</label>
                      <div class="input">
                        <input type="text" name="txtStock" value="<?PHP echo $_POST['txtStock']; ?>" class="numeric" required>
                      </div>
                    </section>
					<div style="clear:both;"></div>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Image 1 Link</label>
                      <div class="input">
                        <input type="text" name="txtImage1" value="<?PHP echo $_POST['txtImage1']; ?>" required>
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Image 2 Link</label>
                      <div class="input">
                        <input type="text" name="txtImage2" value="<?PHP echo $_POST['txtImage2']; ?>">
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Image 3 Link</label>
                      <div class="input">
                        <input type="text" name="txtImage3" value="<?PHP echo $_POST['txtImage3']; ?>">
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Image 4 Link</label>
                      <div class="input">
                        <input type="text" name="txtImage4" value="<?PHP echo $_POST['txtImage4']; ?>">
                      </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Image 5 Link</label>
                      <div class="input">
                        <input type="text" name="txtImage5" value="<?PHP echo $_POST['txtImage5']; ?>">
                      </div>
                    </section>
					<div style="clear:both;"></div>
                    <section class="col-lg-12 col-lg-offset-11" style="width:96%;">
                      <label class="label">Description<span style="color:red;">*</span></label>
                      <div class="textarea textarea-resizable">
						  <textarea name="txtDesc" style="height:200px;"><?PHP echo stripslashes($_POST['txtDesc']); ?></textarea>
						</div>
                    </section>
                </fieldset>
                <footer>
						<input type="submit" name="btnSubmit" value="SAVE" class="btn btn-success">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-1 hidden-xs hidden-sm">&nbsp;</article>
	  

    </div>
  </div>
</div>
<!-- ######### BODY END ############### -->

<!-- ######### FOOTER START ############### -->
	<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->

<!-- END PAGE FOOTER -->
<!-- END SHORTCUT AREA -->
<!--================================================== -->
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="js/jquery.min.js"></script>
<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>
<script src="js/jquery-ui.min.js"></script>
<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
<!-- IMPORTANT: APP CONFIG -->
<script src="js/app.config.js"></script>
<!-- CUSTOM NOTIFICATION -->
<script src="js/notification/SmartNotification.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- JQUERY VALIDATE -->
<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>
<!-- JQUERY MASKED INPUT -->
<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<!-- JQUERY SELECT2 INPUT -->
<script src="js/plugin/select2/select2.min.js"></script>
<!-- JQUERY UI + Bootstrap Slider -->
<script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- browser msie issue fix -->
<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<!-- FastClick: For mobile devices -->
<script src="js/plugin/fastclick/fastclick.min.js"></script>
<!-- MAIN APP JS FILE -->
<script src="js/app.min.js"></script>
<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
	// Key re-stick
	$(document).ready(function(){ 
		$('.numeric').on('input', function (event) { 
			this.value = this.value.replace(/[^.0-9]/g, '');
		});
	});			
	$(document).ready(function(){
		$('#category').on('change',function(){
			var catID = $(this).val();
			$('#sub_sub_category').html('');
			if(catID){
				$.ajax({
					type:'POST',
					url:'../ajax.php',
					data:{
							action: 'category',
							id:catID
						},
					success:function(html){
						$('#sub_category').html(html);
					}
				}); 
			}
		});
	});
	$(document).ready(function(){
		$('#sub_category').on('change',function(){
			var sub_catID = $(this).val();
			if(sub_catID){
				$.ajax({
					type:'POST',
					url:'../ajax.php',
					data:{
							action: 'sub_category',
							id:sub_catID
						},
					success:function(html){
						$('#sub_sub_category').html(html);
					}
				}); 
			}
		});
	});

		$(document).ready(function() {			
			pageSetUp();					
			var $registerForm = $("#smart-form-register").validate({	
				// Rules for form validation
				rules : {
					txtCategory : {
						required : true
					},
					txtSubCategory : {
						required : true
					},
					txtSubSubCategory : {
						required : true
					},
					txtBrand : {
						required : true
					},
					txtName : {
						required : true
					},
					txtPrice : {
						required : true
					},
					txtImage1 : {
						required : true
					},
					txtDesc : {
						required : true
					}
				},	
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});		
		})
</script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script type="text/javascript">			
	$(document).ready(function() {
		pageSetUp();
		var responsiveHelper_dt_basic = undefined;		

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});	
	})
</script>
</body>
</html>
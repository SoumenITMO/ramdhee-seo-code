<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== INSERT PRODUCT START ===========*/
	$file_uploaded_txt = "";
	$index = 0;
	
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])))
	{
		extract($_POST);
		
		if($_FILES['txtCsv']['tmp_name']!='' && $_FILES['txtCsv']) 
		{
			$file = $_FILES['txtCsv']['tmp_name']; 
			$handle = fopen($file, "r");   
	   
			if ( $handle !== FALSE) 
			{
				$n=1;
				while ($data = fgetcsv($handle, 1024, ",")) 
				{
					if($n >=1 )
					{            
						if($data[0]!='')
						{							
							$catName = $general_cls_call->select_query("name", CATEGORY, "WHERE id=:id", array(':id'=>$txtCategory), 1);
							$categoryName = substr($catName->name,0,2);
							$sub_catName = $general_cls_call->select_query("name", SUB_CATEGORY, "WHERE id=:id", array(':id'=>$txtSubCategory), 1);
							$sub_categoryName = substr($sub_catName->name,0,2);
							$sub_sub_catName = $general_cls_call->select_query("name", SUB_SUB_CATEGORY, "WHERE id=:id", array(':id'=>$txtSubSubCategory), 1);
							$sub_sub_categoryName = substr($sub_sub_catName->name,0,2);
							$proName = substr($data[0],0,3);

							$proNumber = 'MLT'.$categoryName.$sub_categoryName.$sub_sub_categoryName.$proName.rand(10000,99999);
							$PostURL = strtolower(preg_replace('~[\\\\/:*?"_<>|() ]~','-',$data[0]));

							$field = "pro_number, cat_id, sub_cat_id, sub_sub_cat_id, name, page_url, size, color, sku, brand, stock, description, list_price, discount, price, weight, courier, courier_price, deliv_time, image1, image2, image3, image4, image5, created_date, status";
							$value = ":pro_number, :cat_id, :sub_cat_id, :sub_sub_cat_id, :name, :page_url, :size, :color, :sku, :brand, :stock, :description, :list_price, :discount, :price, :weight, :courier, :courier_price, :deliv_time, :image1, :image2, :image3, :image4, :image5, :created_date, :status";
							
							$addExecute=array(
								':pro_number'		=>strtoupper($proNumber),
								':cat_id'			=>$general_cls_call->specialhtmlremover($txtCategory),
								':sub_cat_id'		=>$general_cls_call->specialhtmlremover($txtSubCategory),
								':sub_sub_cat_id'	=>$general_cls_call->specialhtmlremover($txtSubSubCategory),
								':name'				=>$general_cls_call->specialhtmlremover($data[0]),
								':page_url'			=>$PostURL,
								':size'				=>$general_cls_call->specialhtmlremover($data[1]),
								':color'			=>$general_cls_call->specialhtmlremover($data[2]),
								':sku'				=>$general_cls_call->specialhtmlremover($data[3]),
								':brand'			=>$general_cls_call->specialhtmlremover($data[4]), 
								':stock'			=>$general_cls_call->specialhtmlremover($data[5]), 
								':description'		=>$general_cls_call->specialhtmlremover($data[6]), 
								':list_price'		=>$general_cls_call->specialhtmlremover(number_format($data[7], 2 , '.','.')), 
								':discount'			=>$general_cls_call->specialhtmlremover($data[8]), 
								':price'			=>$general_cls_call->specialhtmlremover(number_format($data[9], 2, '.','.')),
								':weight'			=>$general_cls_call->specialhtmlremover($data[10]),
								':courier'			=>$general_cls_call->specialhtmlremover($data[11]),
								':courier_price'	=>$general_cls_call->specialhtmlremover($data[12]),
								':deliv_time'		=>$general_cls_call->specialhtmlremover($data[13]),
								':image1'			=>$general_cls_call->specialhtmlremover($data[14]),
								':image2'			=>$general_cls_call->specialhtmlremover($data[15]),
								':image3'			=>$general_cls_call->specialhtmlremover($data[16]),
								':image4'			=>$general_cls_call->specialhtmlremover($data[17]),
								':image5'			=>$general_cls_call->specialhtmlremover($data[18]),
								':created_date'		=>date("Y-m-d H:i:s"),
								':status'			=>1
							);
							
							/*if(isset($data[15])){
								$productIngredient = array(
								':product_id'				=>$general_cls_call->specialhtmlremover($data[15]),
								':ingredient_name'			=>$general_cls_call->specialhtmlremover($data[15]),
								':qnt'						=>$general_cls_call->specialhtmlremover($data[15]));
							}*/
							
							$general_cls_call->insert_query(PRODUCT, $field, $value, $addExecute);
						}           
					}
				$n++;
				}
			fclose($handle);
			}
			
			header("location:".ADMIN_SITE_URL."product_list.php");
		} 
	}
/*=========== INSERT PRODUCT END ===========*/


ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en-us">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
      <li>Add Product</li>
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
            <h2>Add Product</h2>
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
						</select>
						<i></i>
					 </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Sub Sub Category</label>
                      <div class="select">
						<select name="txtSubSubCategory" id="sub_sub_category">
						</select>
						<i></i>
					 </div>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label">Upload CSV<span style="color:red;">*</span></label>
                      <div class="input">
                        <input type="file" name="txtCsv" value="" required>
                      </div>
                    </section>	
                </fieldset>
                <footer>
						<input type="submit" name="btnSubmit" value="ADD" class="btn btn-success">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-1 hidden-xs hidden-sm">&nbsp;</article>
	  

    </div>
  </div>
  <span style="color:red;position: relative;left: 50%;font-size: 23px;"> <?=$file_uploaded_txt?> </span>
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
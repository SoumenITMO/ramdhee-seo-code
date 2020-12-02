<?PHP
	include_once '../init.php';
	$general_cls_call->validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL);		// VALIDATION CHEK
	ob_start();

	$proValue = $general_cls_call->select_query("*", PRODUCT_INVENTORY, "WHERE bill_no=:bill_no", array(':bill_no'=>$_GET['LinkID']), 1);

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
      <li>Order Product</li>
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
      <article class="col-md-11 " style="margin: 2%;">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Order Product</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" name="frm" method="post" action="" enctype="multipart/form-data">

                <fieldset>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label"><strong>Bill Number</strong></label><?PHP echo $proValue->bill_no; ?>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label"><strong>Supplier</strong></label>
                      <?PHP echo $proValue->supplier; ?>
                    </section>
                    <section class="col-lg-52 col-lg-offset-11">
                      <label class="label"><strong>Bill</strong></label>
				<?PHP
					if($proValue->bill!='')
					{
				?>
						<a href="<?PHP echo DOMAIN_NAME.'images/admin_order_bill/'.$proValue->bill; ?>"><?PHP echo $proValue->bill; ?></a>
				<?PHP
					}	
				?>
                    </section>
                </fieldset>
	<?PHP
		$ordSql = $general_cls_call->select_query("*", PRODUCT_INVENTORY, "WHERE bill_no=:bill_no", array(':bill_no'=>$_GET['LinkID']), 2);
		if($ordSql[0] != '')
		{
			foreach($ordSql as $ordValue)
			{
				$proVal = $general_cls_call->select_query("*", PRODUCT, "WHERE id=:id", array(':id'=>$ordValue->pro_id), 1);
	?>
                <fieldset>
                    <section class="col-lg-11 col-lg-offset-11">
                      <label class="label"><strong>Product Name</strong></label>
                      <div class="select">
						<?PHP echo $proVal->name; ?>
					 </div>
                    </section>
					<div style="clear:both;"></div>
                    <section class="col-lg-12 col-lg-offset-11" style="width:96%;">
						 <label class="label"><strong>Attributes</strong></label>
						 <div class="inline-group">					
					<?PHP
						$rel=explode(',', $proVal->attributes);
						$attSql = $general_cls_call->select_query("*", ATTRIBUTES, "WHERE status=:status", array(':status'=>1), 2);
						if($attSql[0] != '')
						{
							foreach($attSql as $attriVal)
							{
					?>
							<label class="checkbox"><input type="checkbox" name="chkAttribute[]" id="chkAttribute" value="<?PHP echo $attriVal->id; ?>" <?PHP echo(in_array($attriVal->id,$rel) ? 'checked' : ''); ?> disabled><i></i><?PHP echo $attriVal->name; ?></label>
					<?PHP
							}
						}
					?>
						 </div>
					  </section>
					<div style="clear:both;"></div>

                    <section class="col-lg-12 col-lg-offset-11" style="width:100%;margin:0 !important;">
                      
					  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border: solid 0px #7A439A" bordercolor="#7A439A" width="100%"  height="1">
			<?PHP
				$proSql = $general_cls_call->select_query("*", PRODUCT_VARIATIONS_INVENTORY, "WHERE pro_id=:pro_id", array(':pro_id'=>$proVal->id), 2);
				if($proSql[0] != '')
				{
			?>
						<tr style="background:#EEEEEE">
						  <td align="left" height="25" width="5%" class="big_text">&nbsp;<strong>No.</strong></td>
						  <td align="left" width="13%" class="big_text">&nbsp;<strong>Pro. Number</strong></td>
						  <td align="left" width="12%" class="big_text">&nbsp;<strong>Variations</strong></td>
						  <td align="left" width="15%" class="big_text">&nbsp;<strong>Sell Price</strong></td>
						  <td align="left" width="15%" class="big_text">&nbsp;<strong>Offer Price</strong></td>
						  <td align="left" width="15%" class="big_text">&nbsp;<strong>Purchase Price</strong></td>
						  <td align="left" width="15%" class="big_text">&nbsp;<strong>Expiry Date</strong></td>
						  <td align="left" width="10%" class="big_text" style="background:#17A707;color:#FFF;text-align:center;">&nbsp;<strong>Add Stock</strong></td>
						</tr>
				<?php 
					$i = 1;
					foreach($proSql as $varaVal)
					{			
						$attShowVal = $general_cls_call->select_query("*", ATTRIBUTES, "WHERE id=:id", array(':id'=>$varaVal->name), 1);
						//$expVal = $general_cls_call->select_query("stock,alert_number", PRODUCT_VARIATIONS, "WHERE variations=:variations", array(':variations'=>$varaVal->variations), 1);
						$proValue = $general_cls_call->select_query("pro_number", PRODUCT_INVENTORY, "WHERE id=:id", array(':id'=>$varaVal->inv_id), 1);
				?>

						<tr>
						  <td align="left" height="25" class="small_text">&nbsp;<?PHP echo $i; ?></td>
						  <td><?PHP echo $proValue->pro_number; ?></td>
						  <td align="left" class="small_text">&nbsp;<?PHP echo stripslashes(str_replace('~',' = ',$varaVal->variations)); ?></td>
						  <td align="left" class="small_text">&nbsp;<i class="fa fa-inr" style="font-size: 15px;"></i><?PHP echo $varaVal->price; ?></td>
						  <td align="left" class="small_text">&nbsp;<?PHP echo ($varaVal->offer_price !='' ? '<i class="fa fa-inr" style="font-size: 15px;"></i>' : ''); ?><?PHP echo $varaVal->offer_price; ?></td>
						  <td align="left" class="small_text">&nbsp;<i class="fa fa-inr" style="font-size: 15px;"></i><?PHP echo $varaVal->purchase_price; ?></td>
						  <td align="left" class="small_text">&nbsp;<?PHP echo ($varaVal->expiry_date != '0000-00-00' ? $varaVal->expiry_date : ''); ?></td>
						  <td align="center" class="small_text">&nbsp;<?PHP echo $varaVal->stock; ?></td>
						</tr>
			<?PHP
						$i++;
					}
				}
				else
				{
			?>
						<tr>
						  <td height="25" align="center" colspan="5" class="big_text" style="color:red">No Record Found!!!</td>
						</tr>
			<?PHP
				}	
			?>

					  </table>

                    </section>
                </fieldset>
	<?PHP
			}
		}
	?>
              </form>
            </div>
          </div>
        </div>
      </article>
	  

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

		$(document).ready(function() {			
			pageSetUp();					
			var $registerForm = $("#smart-form-register").validate({	
				// Rules for form validation
				rules : {
					txtCategory : {
						required : true
					},
					/*txtBrand : {
						required : true
					},*/
					txtName : {
						required : true
					},
					txtStock : {
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
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap-datepicker.js" charset="UTF-8"></script>
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
<script type="text/javascript">
			
		// START AND FINISH DATE
			
		$( function() {
			$(".expDate").datepicker({
				format: "yyyy-mm-dd",
				showMeridian: true,
				autoclose: true,
				todayBtn: false,
				startDate: new Date(),
				pickerPosition: "top-down",
				orientation: "auto"
			});
		});

</script>
</body>
</html>
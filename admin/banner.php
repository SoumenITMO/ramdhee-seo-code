<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== INSERT SLIDER START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])))
	{
		extract($_POST);
		//echo "<pre>";	print_r($_POST); echo "</pre>"; 
		//echo "<pre>";	print_r($_FILES); echo "</pre>"; 
		
		$target_dir = dirname(dirname(__FILE__))."/uploads/banner/";
					$img = explode('.', $_FILES['banner_image']['name']);
					$imgs = end($img);			
					$extension = strtolower($imgs);
					$new_name ='_image'.time().'.'.$extension;	
		
		$target_file = $target_dir.$new_name;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$erMsg = "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$erMsg = "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$erMsg = "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		/* if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		} */
		// Allow certain file formats

		if($extension != "jpg" && $extension != "png" && $extension != "jpeg"
		&& $extension != "gif" ) {
			$erMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			
			$erMsg = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_file)) {
				$PostURL = strtolower(preg_replace('~[\\\\/:*?"_<>|() ]~','-',$_POST['txtName']));
				$field = "banner_title,banner_image";
				$value = ":banner_title, :banner_image";
				$addExecute=array(
					':banner_title'				=>$general_cls_call->specialhtmlremover($txtName),
					':banner_image'			=>$new_name
					
				);
				$general_cls_call->insert_query(BANNER, $field, $value, $addExecute);
				header("location:".ADMIN_SITE_URL."banner.php");
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				$erMsg = "Sorry, there was an error uploading your file.";
			}
		}
		
	

		
	}
/*=========== INSERT SLIDER END ===========*/

/*=========== EDIT SLIDER START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnEdit'])))
	{	
		extract($_POST);
		$sliderCheck = $general_cls_call->select_query("*", BANNER, "WHERE banner_title=:name AND id!=:id", array('id'=>$_GET['LinkID']), 1);
		if($sliderCheck!='')
		{
			$erMsg = 'Name already exists.';
		}
		else
		{
			$PostURL = strtolower(preg_replace('~[\\\\/:*?"_<>|() ]~','-',$_POST['txtName']));
			$setValues="name=:name, page_url=:page_url";
			$updateExecute=array(
				':name'				=>$general_cls_call->specialhtmlremover($txtName),
				':page_url'			=>$general_cls_call->specialhtmlremover($PostURL)
			);
			$whereClause=" WHERE id=".$_GET['LinkID'];
			$update_deal_city=$general_cls_call->update_query(BANNER, $setValues, $whereClause, $updateExecute);
			header("location:".ADMIN_SITE_URL."banner.php");
		}
	}
/*=========== EDIT SLIDER END ===========*/

/*=========== SELECT QUERY START ===========*/
	$sliderVal = $general_cls_call->select_query("*", BANNER, "WHERE id=:id", array(':id'=>$_GET['LinkID']), 1);
/*=========== SELECT QUERY END ===========*/

/*=========== STATUS CHANGE START ================*/
	if(isset($_GET['mode']) && ($_GET['mode'] == '1' || $_GET['mode'] == '0'))
	{		
		$setValues="status=:status";
		$updateExecute=array(':status'=>$general_cls_call->specialhtmlremover($_GET['mode']));
		$whereClause=" WHERE id=".$_GET['staID'];
		$update_deal_city=$general_cls_call->update_query(BANNER, $setValues, $whereClause, $updateExecute);
		header("location:".ADMIN_SITE_URL."banner.php");
	}
/*=========== STATUS CHANGE END ================*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{
		$general_cls_call->delete_query(BANNER, "WHERE id=:id", array(':id'=>$_GET['id']));
		header("location:".ADMIN_SITE_URL."banner.php");
	}
/*=========== DELETE END ================*/	


if(!isset($_POST['txtName'])) { $_POST['txtName'] =	$sliderVal->name; }

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

<script type="text/javascript">
<!--
	function del(uid)
	{
		if(confirm('Are you sure to delete?'))
		{
		   document.frm.action='banner.php?mode=del&id='+uid;
		   document.frm.submit();
		}
	}
//-->
</script>
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
      <li>Banner</li>
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
		if(isset($sucMsg) && $sucMsg != '')
		{
	?>
		<div class="alert alert-success fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-check"></i><strong>Success</strong> <?PHP echo $sucMsg; ?>
		</div>
	<?PHP
		}
	?>
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-3"> </article>
      <article class="col-sm-12 col-md-12 col-lg-6" style="margin: 2% 0;">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2><?PHP echo ($_GET['LinkID']!='' ? 'Edit' : 'Add'); ?> Banner</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" name="frm" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <section class="col-lg-8 col-lg-offset-11">
                      <label class="label">Name</label>
                      <div class="input">
                        <input type="text" name="txtName" value="<?PHP echo $_POST['txtName']; ?>">
                      </div>
                    </section>	
					
                  <section class="col-lg-8 col-lg-offset-11">
                      <label class="label">Upload Image</label>
                      <div class="input">
                         <input type="file" name="banner_image" id="banner_image">
                      </div>
                    </section>					
					  
                </fieldset>
                <footer>
				<?PHP
					if(isset($_GET['LinkID']) && $_GET['LinkID']!='')
					{
				?>
						<input type="submit" name="btnEdit" value="SAVE" class="btn btn-success">
				<?PHP
					}
					else
					{
				?>
						<input type="submit" name="btnSubmit" value="ADD" class="btn btn-success">
				<?PHP
					}	
				?>
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-3 hidden-xs hidden-sm">&nbsp;</article>

	  <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Banner List</h2>
            </header>
            <div>
              <div class="jarviswidget-editbox"></div>
              <div class="widget-body no-padding">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
		<?PHP
			$sqlQuery = $general_cls_call->select_query("*", BANNER, "WHERE 1 ORDER BY id DESC", array(), 2);
			if($sqlQuery[0] != '')
			{
		?>
                    <tr>
                      <th data-hide="phone">SL NO</th> 
                      <th data-class="expand"><i class="fa fa-tag text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;NAME</th>
					 <th data-class="expand"><i class="fa fa-tag text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Image</th>
					 <th data-hide="phone,tablet">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
			<?php 
				$i = 1;
				foreach($sqlQuery as $selectValue)
				{	
			?>
                    <tr>
                      <td><?PHP echo $i; ?></td>
                      <td><?PHP echo $selectValue->banner_title; ?></td>
					   <td><img src="<?PHP echo DOMAIN_NAME.'uploads/banner/'.$selectValue->banner_image; ?>" height="125px"  width="200px"></td>
                      <td>				  
						&nbsp;<a href="javascript: del('<?php echo $selectValue->id; ?>')" title="Click Delete"><i class="fa fa-trash-o" style="color:red;"></i></a>
					  </td>
                    </tr>
			<?PHP
					$i++;
				}
			}
			else
			{
			?>
                    <tr>
                      <td height="25" align="center" colspan="4" class="tableText" style="color:red">No Record Found !!!</td>
					</tr>
		<?PHP
			}	
		?>
                  </tbody>
                </table>
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
		$(document).ready(function() {			
			pageSetUp();					
			var $registerForm = $("#smart-form-register").validate({	
				// Rules for form validation
				rules : {
					txtName : {
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
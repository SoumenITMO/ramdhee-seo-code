<?PHP
  include_once '../init.php';
  $general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
  ob_start();
  
  /*===========  UPDATE QUERY START ===========*/
  
  if(isset($_POST['btnEdit']))
  {	
  	extract($_POST);
  	$sliderCheck = $general_cls_call->select_query("page_name", SITE_LINK, "WHERE page_name=:page_name AND id<>:id", array(':page_name'=>$txtUrl,'id'=>$_GET['LinkID']), 1);
  	if($sliderCheck!='')
  	{
  		$erMsg = 'Page URL already exists.';
  	}
  	else
  	{
		$PostURL = strtolower(preg_replace('~[\\\\/:*?"_<>|() ]~','-',$txtUrl));
  		$setValues = "page_url=:page_url, page_title=:page_title, meta_title=:meta_title, meta_key=:meta_key, meta_desc=:meta_desc";
  		$updateExecute=array(
  			':page_url'		=>$general_cls_call->specialhtmlremover($PostURL),
  			':page_title'	=>$general_cls_call->specialhtmlremover($txtName),
  			':meta_title'	=>$general_cls_call->specialhtmlremover($txtTitle),
  			':meta_key'		=>$general_cls_call->specialhtmlremover($txtKey),
  			':meta_desc'	=>$general_cls_call->specialhtmlremover($txtDesc)
  		);
  		$whereClause=" WHERE id=".$_GET['LinkID'];
  		$update_deal_city=$general_cls_call->update_query(SITE_LINK, $setValues, $whereClause, $updateExecute);
  		header("location:link.php");
  	}
  }
  
  /*===========  UPDATE QUERY START ===========*/
  
  if(isset($_GET['LinkID']) && $_GET['LinkID']!='')
  {
  	  $showVal = $general_cls_call->select_query("*", SITE_LINK, "WHERE id=:id", array(':id'=>$_GET['LinkID']), 1);
  }  
  
  
  
  ?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="ISO-8859-2">
    <title><?PHP echo ADMIN_TITLE; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
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
      <div id="ribbon">
        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i> </span> </span>
        <ol class="breadcrumb">
          <li>Home</li>
          <li>SEO Link</li>
        </ol>
      </div>
      <div id="content">
        <section id="widget-grid" class="">
          <div class="row">

	<?PHP
		if($_GET['LinkID'] != '')
		{
	?>
            <article class="col-md-1"></article>
            <article class="col-md-10">
              <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                  <h2>Edit Seo Link</h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox"></div>
                  <div class="widget-body no-padding">
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
                    <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
                      <header><span style="font-size:13x;color:red;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
                      <fieldset>
                        <section class="col-md-4 col-lg-offset-11">
                          <label class="label">Page Url &nbsp;&nbsp;&nbsp;(<?PHP echo DOMAIN_NAME; ?>)</label>
                          <div class="input"><input type="text" name="txtUrl" placeholder="Page Url" value="<?PHP echo $showVal->page_url; ?>" required></div>
                        </section>
                        <section class="col-md-3 col-lg-offset-11">
                          <label class="label">Page Title</label>
                          <div class="input"><input type="text" name="txtName" placeholder="Page Title" value="<?PHP echo $showVal->page_title; ?>" required></div>
                        </section>
                        <section class="col-md-4">
                          <label class="label">Meta Title</label>
                          <div class="input"><input type="text" name="txtTitle" placeholder="Meta Title" value="<?PHP echo $showVal->meta_title; ?>" required></div>
                        </section>
                        <section class="col-md-11 col-lg-offset-11">
                          <label class="label">Meta Keyword</label>
                          <div class="textarea textarea-resizable">
                            <textarea id="txtDesc" class="custom-scroll" placeholder="Meta Keyword" name="txtKey" rows="4"><?PHP echo $showVal->meta_key; ?></textarea>
                          </div>
                        </section>
                        <section class="col-md-11 col-lg-offset-11">
                          <label class="label">Meta Description</label>
                          <div class="textarea textarea-resizable">
                            <textarea id="txtDesc" class="custom-scroll" placeholder="Meta Description" name="txtDesc" rows="4"><?PHP echo $showVal->meta_desc; ?></textarea>
                          </div>
                        </section>
                      </fieldset>
                      <footer>	
                        <input type="submit" name="btnEdit" value="SAVE" class="btn btn-danger">
                      </footer>
                    </form>
                  </div>
                </div>
              </div>
            </article>
	<?PHP
		}
	?>
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                  <h2>Seo Link / Title List</h2>
                </header>
                <div>
                  <div class="jarviswidget-editbox"></div>
                  <div class="widget-body no-padding">
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
			  <?PHP	
				$sqlQuery = $general_cls_call->select_query("*", SITE_LINK, "WHERE 1", array(), 2);
				if($sqlQuery[0] != '')
				{
			  ?>
                      <thead>
                        <tr>
                          <th data-hide="phone">SL. NO.</th>
                          <th data-class="expand"><i class="fa fa-tag text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Page Name</th>
                          <th data-class="expand"><i class="fa fa-tag text-muted hidden-md hidden-sm hidden-xs"></i>&nbsp;&nbsp;Page URL</th>
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
                          <td><?PHP echo $selectValue->page_name; ?></td>
                          <td><?PHP echo DOMAIN_NAME.$selectValue->page_url; ?></td>
                          <td><a href="<?PHP echo ADMIN_SITE_URL; ?>link.php?LinkID=<?php echo $selectValue->id; ?>" title="Click Here To Edit"><i class="fa fa-pencil" style="color: #3E79BA;"></i></a></td>
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
        </section>
      </div>
    </div>
    <!-- ######### BODY END ############### -->
    <!-- ######### FOOTER START ############### -->
    <?PHP include_once("../includes/adminFooter.php"); ?>
    <!-- ######### FOOTER END ############### -->
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
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="js/plugin/jquery-form/jquery-form.min.js"></script>
    <script type="text/javascript">		
      $(document).ready(function() {
      	pageSetUp();				
      
      	var $registerForm = $("#smart-form-register").validate({
      		rules : {
      
      			txtName : {
      
      				required : true
      
      			}
      
      		},
      
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


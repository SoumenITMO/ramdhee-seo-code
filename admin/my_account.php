<?PHP
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK
	ob_start();

/*=========== ACCOUNT SETTINGS START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnUser'])))
	{	
		extract($_POST);
		if($txtUsername!='')
		{
			if($txtNewPassword==$txtConfirmPassword)
			{
				$password=isset($txtNewPassword) && $txtNewPassword != "" ? stripslashes(trim($txtNewPassword)) : $hidPassword; 

				$setValues="username=:username, password=:password";
				$updateExecute=array(
					':username'=>$general_cls_call->specialhtmlremover($txtUsername),
					':password'=>$general_cls_call->specialhtmlremover($password)
				);
				$whereClause=" WHERE id=".$_SESSION['ADMIN_USER_ID'];
				$update_deal_city=$general_cls_call->update_query(ADMIN_MASTER, $setValues, $whereClause, $updateExecute);
				$sucMsg = 'Your data has been updated successfully.';
			}
			else
			{
				$erMsg = 'Confirm password does not match with new password.';
			}
		}
		else
		{
			$erMsg = 'Please enter your username.';
		}
	}
/*=========== ACCOUNT SETTINGS END ===========*/

/*=========== OTHER SETTINGS START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnOther'])))
	{	
		extract($_POST);
		$setValues="phone=:phone, email=:email";
		$updateExecute=array(
			':phone'	=>$general_cls_call->specialhtmlremover($txtPhone),
			':email'	=>$general_cls_call->specialhtmlremover($txtEmail)
		);
		$whereClause=" WHERE id=".$_SESSION['ADMIN_USER_ID'];
		$update_deal_city=$general_cls_call->update_query(ADMIN_MASTER, $setValues, $whereClause, $updateExecute);
		$sucMsg = 'Your data has been updated successfully.';
	}
/*=========== OTHER SETTINGS END ===========*/


/*=========== SELECT QUERY START ===========*/
	$adminVal=$general_cls_call->select_query("*", ADMIN_MASTER, "WHERE id=:id", array(':id'=>$_SESSION['ADMIN_USER_ID']), 1);
/*=========== SELECT QUERY END ===========*/


if(!isset($_POST['txtUsername'])) { $_POST['txtUsername'] =			$adminVal->username; }
if(!isset($_POST['hidPassword'])) { $_POST['hidPassword'] =			$adminVal->password; }

if(!isset($_POST['txtPhone'])) { $_POST['txtPhone'] =				$adminVal->phone; }
if(!isset($_POST['txtEmail'])) { $_POST['txtEmail'] =				$adminVal->email; }

/* ==== MEMBER COUNT ====== */

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
      <li>Dashboard</li>
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
      <article class="col-sm-12 col-md-12 col-lg-2"> </article>
      <article class="col-sm-12 col-md-12 col-lg-8" style="margin: 2% 0;">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Manage Your Account Settings</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" method="post">
                <fieldset>
                  <section class="col-lg-51 col-lg-offset-11">
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                      <input type="text" name="txtUsername" value="<?php echo $_POST['txtUsername']; ?>" placeholder="Username">
                    </label>
                  </section>
                  <section style="clear:both"></section>
                  <section class="col-lg-51 col-lg-offset-11">
                    <label class="input"> <i class="icon-append fa fa-key"></i>
                      <input type="password" name="txtNewPassword" placeholder="New Password" id="password"><input type="hidden" name="hidPassword" value="<?PHP echo $_POST['hidPassword']; ?>">
                    </label>
                  </section>
                  <section class="col-lg-51 col-lg-offset-11">
                    <label class="input"> <i class="icon-append fa fa-key"></i>
                      <input type="password" name="txtConfirmPassword" placeholder="Confirm Password">
                    </label>
                  </section>
                </fieldset>
                <footer>
                  <input type="submit" name="btnUser" value="SAVE" class="btn btn-success" onClick="return docheck();">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-2 hidden-xs hidden-sm">&nbsp;</article>  
		<div style="clear:both;"></div>

      <article class="col-sm-12 col-md-12 col-lg-2"> </article>
      <article class="col-sm-12 col-md-12 col-lg-8">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Manage Other Settings</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" method="post">
                <fieldset>
                  <section class="col-lg-5 col-lg-offset-11">
				    <label class="label">Header Phone Number</label>
				    <div class="input">
                      <input type="text" name="txtPhone" value="<?php echo $_POST['txtPhone']; ?>" class="numeric">
                    </div>
                  </section>
                  <section class="col-lg-5 col-lg-offset-11">
				    <label class="label">Email Address</label>
				    <div class="input">
                      <input type="text" name="txtEmail" value="<?php echo $_POST['txtEmail']; ?>">
                    </div>
                  </section>
                </fieldset>
                <footer>
                  <input type="submit" name="btnOther" value="SAVE" class="btn btn-success">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
      <article class="col-sm-12 col-md-12 col-lg-2 hidden-xs hidden-sm">&nbsp;</article>

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
	$(document).ready(function(){ 
		$('.numeric').on('input', function (event) { 
			this.value = this.value.replace(/[^.0-9]/g, '');
		});
	});		
		
		$(document).ready(function() {
			
			pageSetUp();
					
			var $registerForm = $("#smart-form-register").validate({
	
				// Rules for form validation
				rules : {
					txtUsername : {
						required : true
					},
					txtEmail : {
						required : true,
						email : true
					}
				},
	
				// Messages for form validation
				messages : {
					email : {
						required : 'Please enter your email address',
						email : 'Please enter a VALID email address'
					},
					password : {
						required : 'Please enter your password'
					},
					passwordConfirm : {
						required : 'Please enter your password one more time',
						equalTo : 'Please enter the same password as above'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});		
		})

		</script>
</body>
</html>
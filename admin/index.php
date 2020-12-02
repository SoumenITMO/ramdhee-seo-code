<?PHP
	include_once '../init.php';
	ob_start();

/*=========== LOGIN QUERY START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnLogin'])))
	{
		extract($_POST);
		$login = $general_cls_call->select_query("username,password,id", ADMIN_MASTER, "WHERE username=:username AND password=:password", array(':username'=>$general_cls_call->specialhtmlremover($txtUser),':password'=>$general_cls_call->specialhtmlremover($txtPassword)), 1);
		if($login) 
		{	
			$_SESSION['ADMIN_USER_ID'] = $login->id;
			$_SESSION['ADMIN_USER_NAME'] = $login->username;
			if($_REQUEST['rem'] == "ON")
			{
				if ($txtUser != "")
				{
				  setcookie ('userid1', " ",time()-(60*60*24*30));    //delete old cookies 58281044
				  setcookie ('userid1', $txtUser,time()+(60*60*24*30));  // "update" by adding a new 
				}
				if ($txtPassword != "")
				{
				  setcookie ('password1', " ",time()-(60*60*24*30));    //delete old cookies
				  setcookie ('password1', $txtPassword,time()+(60*60*24*30));  // "update" by adding 
				}
			}
			else
			{
			   setcookie ('userid1', " ",time()-(60*60*24*30));
			   setcookie ('password1', " ",time()-(60*60*24*30));   
			}
				header("location:https://ramadhee.ee/seo/admin/dashboard.php");
		}  
		else
		{
			$msg= 'Invalid username or password.';
		}
	}

	if($_COOKIE['userid1'] 	!= "")
	{
		$txtusername1 = $_COOKIE['userid1'];
		$strchked1 = "CHECKED";
	}
	else
	{
		$txtusername1 = "";
	}

	if($_COOKIE['password1'] != "")
	{
		$txtpassword1 = $_COOKIE['password1'];
		$strchked1 = "CHECKED";
	}
	else
	{
		$txtpassword1 = "";
	}
/*=========== LOGIN QUERY END ===========*/

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en-us" id="extr-page">
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
<link rel="shortcut icon" href="https://ramadhee.ee/favicon.ico">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>
<body class="animated fadeInDown">
<header id="header">
  <div id="logo-group"> <span id="logo"> <a href="http://ramadhee.ee/"> <img src="https://ramadhee.ee/favicon.ico" alt="SmartAdmin"> </a> </span> </div>
  <span id="extr-page-header-space"></span> </header>
<div id="main" role="main">
  <!-- MAIN CONTENT -->
  <div id="content" class="container">
	<?PHP
		if(isset($msg) && $msg != '')
		{
	?>
		<div class="alert alert-danger fade in">
		  <button class="close" data-dismiss="alert">X</button>
		  <i class="fa-fw fa fa-times"></i><strong>Error!</strong> <?PHP echo $msg; ?>
		</div>
	<?PHP
		}
	?>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"> </div>
      <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
        <div class="well no-padding">
          <form action="" id="login-form" class="smart-form client-form" method="post">
            <header>Logi sisse</header>
            <fieldset>
              <section>
                <label class="label">Kasutajanimi</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="txtUser" value="<?PHP echo $txtusername1; ?>">
                  <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Sisestage kasutajanimi</b></label>
              </section>
              <section>
                <label class="label">Parool</label>
                <label class="input"> <i class="icon-append fa fa-key"></i>
                  <input type="password" name="txtPassword" value="<?PHP echo $txtpassword1; ?>">
                  <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> Palun sisesta parool</b> </label>
              </section>
              <section>
                <label class="checkbox">
                  <input type="checkbox" id="rem" name="rem" value="ON" <?PHP echo $strchked1; ?>>
                  <i></i>Püsi sisse logituna</label>
              </section>
            </fieldset>
            <footer>
			  <input type="submit" value="Logi sisse" class="btn btn-success" name="btnLogin" />
            </footer>
          </form>
        </div>
      </div>	  
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"> </div>
    </div>
  </div>
</div>
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
			
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						txtUser : {
							required : true
						},
						txtPassword : {
							required : true,
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your username'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});	
		})

		</script>
</body>
</html>
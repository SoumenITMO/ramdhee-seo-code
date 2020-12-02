<?PHP	
	include_once 'init.php';

/*=========== LOGIN QUERY START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnLogin']))
	{
		extract($_POST);
		$login = $general_cls_call->select_query("email,password,id", MEMBER, "WHERE email=:email AND password=:password", array(':email'=>$general_cls_call->specialhtmlremover($txtEmail),':password'=>$general_cls_call->specialhtmlremover($txtPassword)), 1);
		if($login) 
		{	
			if($login->status == '0')
			{
				$erMsg = 'Your account has been deactivated. Please contact us if you have any questions or concerns regarding your account. Thank you.';
			}
			else
			{
				$_SESSION['FRONT_USER_ID'] = $login->id;
				if($_REQUEST['rem'] == "ON")
				{
					if ($txtEmail != "")
					{
					  setcookie ('userid1', " ",time()-(60*60*24*30));    //delete old cookies 58281044
					  setcookie ('userid1', $txtEmail,time()+(60*60*24*30));  // "update" by adding a new 
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
				header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(11));
			}
		}  
		else
		{
			$erMsg = 'Invalid login details. Please try again to reset your password.';
		}
	}

	if($_COOKIE['userid1'] != "")
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<meta name="keywords" content="<?PHP echo $pageName->meta_key; ?>">
<meta name="description" content="<?PHP echo $pageName->meta_desc; ?>">
<title>Logi sisse</title>
<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>
</head>
<body>
<div class="wrapper-wide">

  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->

  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Logi sisse</a></li>
      </ul>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="title">Konto sisselogimine</h1>
		   <?PHP
				if(isset($erMsg) && $erMsg != '')
				{
			?>
				<div class="alert alert-danger fade in">
				  <button class="close" data-dismiss="alert">X</button><i class="fa fa-exclamation-triangle"></i><strong>Error</strong><br /><ul><?PHP echo $erMsg; ?></ul> 
				</div>
			<?PHP
				}
			?>
		</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
          <form name="frm" method="post" action="" class="form-horizontal">
            <fieldset id="account">
              <legend>Tagasipöörduv klient</legend>
              <div class="form-group required">
                <label for="input-email" class="col-sm-3 control-label">E-post</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" placeholder="Sisesta e-posti aadress" value="<?PHP echo $txtusername1; ?>" name="txtEmail" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-3 control-label">Parool</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" placeholder="Sisestage parool" value="<?PHP echo $txtpassword1; ?>" name="txtPassword" required>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
			    <input type="checkbox" id="rem" name="rem" value="ON" <?PHP echo $strchked1; ?>>&nbsp;Hoidke mind logis in.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(12); ?>">Unustasid parooli?</a> &nbsp;
                <input type="submit" class="btn btn-primary" name="btnLogin" value="Logi sisse">
              </div>
            </div>
          </form>
		</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <fieldset id="account">
              <legend>Uus klient</legend>
              <p>Konto loomisega saate kiiremini sisseoste teha, olla kursis tellimuse olekuga ja jälgida varem tehtud tellimusi.</p>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <a href="<?PHP echo DOMAIN_NAME.'seo/register.php'; ?>"><input type="button" class="btn btn-primary" value="Registreeri"></a>
              </div>
            </div>
		</div>
        <div class="col-sm-1"></div>
      </div>
    </div>
  </div>

  <!-- ################## FOOTER START ################## -->
  <?PHP include_once('includes/frontFooter.php'); ?>
  <!-- ################## FOOTER END ################## -->

</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
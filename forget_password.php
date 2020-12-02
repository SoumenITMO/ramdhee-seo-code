<?PHP	
	include_once 'init.php';
	ob_start();
	@session_start();

	if(isset($_POST['btnSubmit']))
	{
		extract($_POST);
		$loginrec = $general_cls_call->select_query("email,password,name", MEMBER, "WHERE email=:email", array(':email'=>$txtEmail), 1);
		if($loginrec!='')
		{
			$mail_subject = 'Your password '.SITE_TITLE;
			$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #000000">					
							<tr>
							  <td align="left" valign="middle" width="100%" style="background-color:#FFFFFF;padding:20px;border-bottom: solid 5px #E33C3D"><img src="'.DOMAIN_NAME.'image/logo.jpg" alt="makelikethis"></td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center">
							   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>'.$Dear.' '.ucfirst($loginrec->name).'</b>,</td>
								 </tr>
								 <tr>
								   <td align="right" width="5%">&nbsp;</td>
								   <td align="left" width="95%" style="font-family: Arial;font-size:13px;color:#69676A;">You have requested your login details. The following describes your login information.</td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25">&nbsp;</td>
								 </tr>
								 <tr>
								   <td align="right" width="5%">&nbsp;</td>
								   <td align="center" width="95%" style="font-family: Arial;font-size:13px;color:#69676A;">
									 <table width="96%" border="0" align="center" cellpadding="0" cellspacing="4">
									   <tr>
										 <td align="right" width="25%" style="font-family: Arial;font-size:13px;color:#000;font-weight:bold">Email:&nbsp;&nbsp;</td>
										 <td align="left" width="75%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$loginrec->email.'</td>
									   </tr>
									   <tr>
										 <td align="right" style="font-family: Arial;font-size:13px;color:#000;font-weight:bold">Password:&nbsp;&nbsp;</td>
										 <td align="left" style="font-family: Arial;font-size:13px;color:#69676A;">'.$loginrec->password.'</td>
									   </tr>
									 </table>
								   </td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25">&nbsp;</td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000;"><b>Thanks,<br/>Administrator</b></td>
								 </tr>
							   </table>
							  </td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center" width="100%" height="25" style="background-color:#4E4E4E;font-family:arial;font-size:11px;color:#FFFFFF">Copyright &copy; '.date('Y').' . All Rights Reserved.</td>
							</tr>
						  </table>';

			$mail_to = $loginrec->email;

			/*echo($mailBody)."<br>";
			echo "Mail Subject :".($mail_subject)."<br>";
			echo "Mail CC :".($mailcc)."<br>";
			echo "Mail From :".($mail_from)."<br>";
			echo "Mail To :".($mail_to);*/
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=UTF-8\r\n";
			$headers.= "From: ".SITE_TITLE."<noreply@makelikethis.com>\r\n";
			$headers.= "X-Sender: <www.makelikethis.com> \n";	
			mail($mail_to,$mail_subject,$mailBody,$headers);

			$sucMsg = '<li>Please check our reply in your \'Inbox\' or in your \'Spam\' mailbox.</li>';
		}
		else
		{
			$erMsg = '<li>Sorry, that e-mail address doesn\'t exist in our database. Please try again.</li>';
		}
	}
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

<link rel="stylesheet" type="text/css" href="<?PHP echo JS_PATH; ?>bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>responsive.css" />
<link rel="stylesheet" type="text/css" href="<?PHP echo CSS_PATH; ?>stylesheet-skin4.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway' type='text/css'>
</head>
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
        <li><a href="#">Forget Password</a></li>
      </ul>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="title">Forget Password</h1>
			<?PHP
				if(isset($erMsg) && $erMsg != '')
				{
			?>
				<div class="alert alert-danger fade in">
				  <button class="close" data-dismiss="alert">X</button><i class="fa-fw fa fa-exclamation-triangle"></i><strong>Error</strong><br /><ul><?PHP echo $erMsg; ?></ul> 
				</div>
			<?PHP
				}
				if(isset($sucMsg) && $sucMsg != '')
				{
			?>
				<div class="alert alert-success fade in">
				  <button class="close" data-dismiss="alert">X</button><i class="fa-fw fa fa-check"></i><strong>Success</strong><br /><ul><?PHP echo $sucMsg; ?></ul> 
				</div>
			<?PHP
				}
			?>
		</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
          <form name="frm" method="post" action="" class="form-horizontal">
            <fieldset id="account">
              <legend>Please put your register email address.</legend>
              <div class="form-group required">
                <label for="input-email" class="col-sm-3 control-label">E-Mail</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" placeholder="Enter e-mail address" value="<?PHP echo $_POST['txtEmail']; ?>" name="txtEmail" required>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Send">
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <fieldset id="account">
              <legend>Returning Users</legend>
              <p>If you already have an account with us, please login at the Login Page.</p>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(2); ?>"><input type="button" class="btn btn-primary" value="Login"></a>
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
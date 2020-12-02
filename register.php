<?PHP	
	include_once 'init.php';
	ob_start();
	@session_start();

	/*=========== REGISTRATION START ===========*/
	if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['btnSubmit'])))
	{
		extract($_POST);
		$docCheck = $general_cls_call->select_query("id,email", MEMBER, "WHERE email=:email", array(':email'=>$txtEmail), 1);
		
		$g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		
		if($docCheck!='')
		{
			$erMsg = '<li> Email address already exists.</li>';
		}
		
		else
		{
			$field = "name, email, password, address, city, state, postal_code, country, phone, created_date, ip_address, country_code, city_, status";
			$value = ":name, :email, :password, :address, :city, :state, :postal_code, :country, :phone, :created_date, :ip_address, :country_code, :city_, :status";
			
			$addExecute = array(':name' 			=>$general_cls_call->specialhtmlremover($txtName),
							    ':email'			=>$general_cls_call->specialhtmlremover($txtEmail),
							    ':password'   		=>$general_cls_call->specialhtmlremover($txtPassword),
							    ':address'	    	=>$general_cls_call->specialhtmlremover($txtAddress),
							    ':city'		    	=>$general_cls_call->specialhtmlremover($txtCity),
							    ':state'			=>$general_cls_call->specialhtmlremover($txtState),
							    ':postal_code'	    =>$general_cls_call->specialhtmlremover($txtZip),
							    ':country'	    	=>$general_cls_call->specialhtmlremover($txtCountry),
							    ':phone'			=>$general_cls_call->specialhtmlremover($txtPhone),
							    ':created_date'	    =>date("Y-m-d H:i:s"),
							    ':ip_address'		=>$_SERVER['REMOTE_ADDR'],
							    ':country_code'  	=>$g["geoplugin_countryCode"],
							    ':city_'			=>$g["geoplugin_city"],
							    ':status'			=>0);
			
			$id = $general_cls_call->insert_query(MEMBER, $field, $value, $addExecute); 
			
			$_SESSION['FRONT_USER_ID'] = $id; 
			$regMailContent			   = $general_cls_call->select_query("*", CMS_MASTER, "WHERE id=:id", array(':id'=>8), 1);
			$mailBodyContent 		   = str_replace('[NAME]', $txtName, $regMailContent->description);
			$mailBodyContent1 		   = str_replace('[USERNAME]', $txtEmail, $mailBodyContent);
			$mailBodyContent2 		   = str_replace('[PASSWORD]', $txtPassword, $mailBodyContent1);
			$mail_subject 			   = $regMailContent->subject;
			
			$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #000000;">					
							<tr>
							  <td align="left" valign="middle" width="100%" style="background-color:#000000;padding:20px;border-bottom: solid 5px #E33C3D"><img src="'.DOMAIN_NAME.'image/logo.png" alt="makelikethis"></td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center">
							   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
								 <tr>
								   <td align="left" width="100%" style="font-family: Arial;font-size:13px;color:#000000;">'.$mailBodyContent2.'</td>
								 </tr>
							   </table>
							  </td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center" width="100%" height="25" style="font-family:arial;font-size:11px;color:#4E4E4E">&copy; Copyright '.SITE_TITLE.'</td>
							</tr>
						  </table>';

			$mail_to = $txtEmail;
			$headers  = "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=UTF-8\r\n";
			$headers.= "From: ".SITE_TITLE."<noreply@makelikethis.co.uk>\r\n";
			$headers.= "X-Sender: <www.makelikethis.co.uk> \n";	
			
			//mail($mail_to,$mail_subject,$mailBody,$headers);
			mail($general_cls_call->specialhtmlremover($txtEmail), $mail_subject, $mailBody, $headers);
			
			//echo "Mail To: ".$mail_to.'<br/>';
			//echo "Mail Subject: ".$mail_subject.'<br/>';
			//echo "Mail Body: ".$mailBody.'<br/>';
			
			header("location:".DOMAIN_NAME.$general_cls_call->pageUrl(11));
		}
	}
	/*=========== REGISTRATION END ===========*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.png" rel="icon" />
<title>Registreerimine</title>
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
<body>
<div class="wrapper-wide">

  <!-- ################## HEADER START ################## -->
  <?PHP include_once('includes/frontHeader2.php'); ?>
  <!-- ################## HEADER END ################## -->

  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="<?PHP echo DOMAIN_NAME; ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Registreeri</a></li>
      </ul>
      <div class="row">
        <div class="col-sm-12">
          <h1 class="title">Registreerige konto</h1>
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
              <legend>Loo uus konto</legend>
			  
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-3 control-label">Nimi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage täisnimi" value="<?PHP echo $_POST['txtName']; ?>" name="txtName" required>
                </div>
              </div>
              
			  <div class="form-group required">
                <label for="input-email" class="col-sm-3 control-label">E-post</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" placeholder="Sisesta e-posti aadress" value="<?PHP echo $_POST['txtEmail']; ?>" name="txtEmail" required>
                </div>
              </div>
			  
              
			  <div class="form-group required">
                <label for="input-email" class="col-sm-3 control-label">Parool</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" placeholder="Sisestage parool" value="" name="txtPassword" required>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label for="input-address" class="col-sm-3 control-label">Aadress</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage aadress" value="" name="txtAddress" required>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label for="input-city" class="col-sm-3 control-label">Linn</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage linn" value="" name="txtCity" required>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label for="input-state" class="col-sm-3 control-label">Osariik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage olek" value="" name="txtState" required>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label for="input-zip" class="col-sm-3 control-label">Zip</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage ZIP" value="" name="txtZip" required>
                </div>
              </div>
			  
			  <div class="form-group required">
                <label for="input-country" class="col-sm-3 control-label">Riik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage riik" value="" name="txtCountry" required>
                </div>
              </div>
              
			  <div class="form-group required">
                <label for="input-telephone" class="col-sm-3 control-label">Telefon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Sisestage telefoninumber" value="<?PHP echo $_POST['txtPhone']; ?>" name="txtPhone" required>
                </div>
              </div>
            
			</fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="checkbox" value="1" name="agree" required>
                &nbsp;Olen lugenud ja nõustun dokumendiga <a class="agree" href="privacy-policy"><b>Privaatsuspoliitika</b></a> &nbsp;
                <input type="submit" name="btnSubmit" class="btn btn-primary" value="Registreeri">
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <fieldset id="account">
              <legend>Logi sisse</legend>
              <p>Kui teil on juba meie juures konto, logige sisse sisselogimislehel.</p>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <a href="<?PHP echo DOMAIN_NAME.$general_cls_call->pageUrl(2); ?>"><input type="button" class="btn btn-primary" value="Logi sisse"></a>
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
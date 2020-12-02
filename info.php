<?php
	  //echo date_default_timezone_get();
	  
	  $paypal_file_content = file_get_contents("paypal.txt");
	  $paypal_file_content = json_decode($paypal_file_content );
	  
	  echo "<pre>";
	  print_r($paypal_file_content);
	  echo "</pre>";
	  exit;
	  
	  echo date('Y-m-d H:i:s');
	  localtime();
	  exit;
	  
	  include_once 'init.php';
	  $g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
	  
	  echo $g["geoplugin_city"];
	  echo "</br>";
	  echo $g["geoplugin_countryCode"];
	  $host_    = "www.makelikethis.ee";
	  
	  $headers  = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
	  //$headers.= "From: ".SITE_TITLE."<noreply@makelikethis.com>\r\n";
	  //$headers.= "From: makelikethis.ee<no-reply@makelikethis.ee>\r\n";
	  //$headers.= "X-Sender: <www.makelikethis.ee> \n";

	  $headers 	   .= "From: no-reply@makelikethis.ee\r\n";
	  $headers 	   .= "Reply-To: no-reply@makelikethis.ee\r\n";
	  $headers     .= "Return-Path: no-reply@makelikethis.ee\r\n";
	  $headers     .= "CC: alexwillson19872000@gmail.com\r\n";
	  //$headers   .= "BCC: hidden@example.com\r\n";
	  $headers     .= "X-Priority: 3\r\n";
	  $headers     .= "X-Mailer: PHP". phpversion() ."\r\n";
 
	  $mailBody     = file_get_contents("http://makelikethis.ee/basic_email_template/index.html");
	  //echo $mailBody;
	  //$mailBody = "<b> Notification </b>"; 
	  
	  $mail_subject = 'Newsletter From Makelikethis.';
	  
	  
	  /////  INSERT VISITOR DETAILS 
	  $num_vis_ = 0;
	  $field = "id, pro_id, ip_address, geoplugin_countryCode, geoplugin_city";
	  $value = ":id, :pro_id, :ip_address, :geoplugin_countryCode, :geoplugin_city";
	
	  $g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
	  
	  $prod_id = 918;
	  
	  $addExecute = array(
							':id'						=>0,
							':pro_id'					=>$prod_id,
							':ip_address'				=>$_SERVER['REMOTE_ADDR'],
							':geoplugin_countryCode'	=>$g["geoplugin_countryCode"],
							':geoplugin_city'			=>$g["geoplugin_city"]
					     );

	  $userVal = $general_cls_call->select_query("*", LOCATION, "WHERE pro_id=:pro_id AND ip_address=:ip_address", array(':pro_id'=>$prod_id, ':ip_address'=>$_SERVER['REMOTE_ADDR']), 1);
	  $userVis = $general_cls_call->select_query("*", LOCATION, "WHERE pro_id=:pro_id AND ip_address=:ip_address", array(':pro_id'=>$prod_id, ':ip_address'=>$_SERVER['REMOTE_ADDR']), 2);
	  $num_vis_ = sizeof($userVis);
	
	  echo "<pre>";
	  print_r($userVal);
	  echo "</pre>";
	  
	  if(empty($userVal))
	  {
		 $num_vis_ ++;
		// $general_cls_call->insert_query(LOCATION, $field, $value, $addExecute);
	  }
	  
	  echo "Product Visitor : $num_vis_";
	  
	  //////////////////////////
	  
	  
	  $array__ = (object)array("name"=>"Soumen Banerjee", "email"=>"soumenbanerjeenik@gmail", "phone"=>"+372 5363 8362");
	  
	  print_r($array__->name);
	  
	  //mail($userVal->email,$mail_subject,$mailBody,$headers);
	 //mail("soumenbanerjeenik@gmail.com", $mail_subject, "Hello How are you ?? "); 
	 //mail("alexwillson19872000@gmail.com",$mail_subject,$mailBody,$headers);	
?>
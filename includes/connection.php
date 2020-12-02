<?php
	/* This is for Pre defineing database name,server name ,tables,user name, password so that change in one place can change all the location where using those */

	/* database configuration "" */
	if($_SERVER['HTTP_HOST']=='localhost')
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","root");
		define("PASSWORD","");
		define("DATABASE_NAME","pds_makelikethis");
	}
	
	/*else
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","makelikethis");
		//define("USER_NAME","devmakelikethis");
		define("PASSWORD","pds@12345");
		define("DATABASE_NAME","pds_makelikethis");
	}
	*/
	
	/*
	else
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","makelike_test");
		//define("USER_NAME","devmakelikethis");
		define("PASSWORD","#$FWERpds@12345");
		define("DATABASE_NAME","makelike_pds_makelikethis");
	}
	*/
	
	else
	{
		define("SERVER_NAME","localhost");
		define("USER_NAME","makelike_user_ee_makelikethis");
		define("PASSWORD",",McDkc#0{JKK");
		//define("USER_NAME","devmakelikethis");
		define("DATABASE_NAME","makelike_ee_makelikethis");
		//$con = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
	}
	
	
	
	$database_connection="mysql:host=".SERVER_NAME.";dbname=".DATABASE_NAME;	/* This is the first parameter for establishing a database connection */
	try 
	{
		$db = new PDO('mysql:host=localhost;dbname=makelike_ee_makelikethis', 'makelike_user_ee_makelikethis', PASSWORD, array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		
		//$db = new PDO($database_connection, USER_NAME, PASSWORD);
		
   		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) 
	{
    	die($e->getMessage());													/* This will make a database connection and if not connected it will give error */
	}

			
	//Domain URL
	define("FOLDER_PATH", "makelikethis/");
	//define("DOMAIN_NAME", "http://".$_SERVER['HTTP_HOST']."/".FOLDER_PATH);
	//define("DOMAIN_NAME", "https://".$_SERVER['HTTP_HOST']."/");
	define("DOMAIN_NAME", "https://ramadhee.ee/");
	
	
	define("ADMIN_SITE_URL", DOMAIN_NAME."admin/");

	define("IMAGE_FOLDER", "images/");
	define("IMG_PATH", DOMAIN_NAME."img/");
	define("IMAGE_PATH", DOMAIN_NAME."images/");

	define("USER_IMAGE", "images/user_image/");
	define("ADMIN_USER_IMAGE", "../images/user_image/");

	define("SLIDER_IMAGE", "images/slider/");
	define("ADMIN_SLIDER_IMAGE", "../images/slider/");

	define("BRAND_IMAGE", "images/brand/");
	define("ADMIN_BRAND_IMAGE", "../images/brand/");

	define("PRODUCT_IMAGE", "images/product/");
	define("ADMIN_PRODUCT_IMAGE", "../images/product/");

	define("ADMIN_ORDER_BILL", "../images/admin_order_bill/");

	define("JS_PATH", DOMAIN_NAME."js/");
	define("CSS_PATH", DOMAIN_NAME."css/");
	define("ADMIN_LANGUAGE_PATH", "../lang/");
	define("FRONT_LANGUAGE_PATH", "lang/");

	define("ADMIN_TITLE", ".::. Ramadhee juhtpaneel .::.");
	define("SITE_TITLE", "Ramadhee ");
	define("SITE_ADDRESS", "ramadhee.ee");
	define("FRONT_IMAGES_FOLDER", "image/");
	
?>
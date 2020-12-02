<?php
	#######################################################################################
	## THIS FILE IS THE COMMON FILE. THIS FILE INCLUDES ALL THE COMMON FILES REQUIRED IN YOUR WEBSITE. PLEASE INCLUDE THIS FILE IN ALL PAGES. SESSION HAS ALREADY STARTED IN THIS PAGE YOU DO NOT HAVE START SESSION IN THOSE PAGES WHERE YOU HAVE ALREADY INCLUDED THIS PAGE.
	## Created By Exalted Solution
	## Open Source Beta Version
	#######################################################################################

	session_start();
	include_once("includes/connection.php");			/* This is for includeing the all predefine name of database,tables,user,password and database connection*/
	error_reporting(null);
	include_once("includes/queryFunction.php");			/* This is for includeing the all query function */
	include_once("includes/databaseTable.php");			/* This is for includeing the all query function */
	include_once("includes/shoppingcart.php");

	$general_cls_call=new general($db);
	$_SESSION['CURRENCY'] = 2;
	/*
	if(isset($_POST['btnCurr']))
	{			
		$_SESSION['CURRENCY'] = $_POST['btnCurr'];
		$_SESSION['SET_CURR'] = 1;
	}
	else
	{
		if(!isset($_SESSION['SET_CURR']) && $_SESSION['SET_CURR'] == '')
		{
			$_SESSION['CURRENCY'] = 2;
		}
	}
	*/
	
	$adminVal = $general_cls_call->select_query("*", ADMIN_MASTER, "WHERE 1", array(), 1);
?>
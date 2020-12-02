<?php
	include_once '../init.php';
	$general_cls_call->admin_validation_check($_SESSION['ADMIN_USER_ID'], ADMIN_SITE_URL.'index.php', array('0'));		// VALIDATION CHEK

	/*===========  INSERT QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		if($_FILES['txtImage']['tmp_name']!='') 
		{
			$output['status']=FALSE;
			set_time_limit(0);
			$allowedImageType = array("image/gif",   "image/jpeg",   "image/JPG",   "image/jpg",   "image/png",   "image/x-png"  );
			
			if ($_FILES['txtImage']["error"] > 0) 
			{
				$erMsg= 'Error in File';
			}
			elseif (!in_array($_FILES['txtImage']["type"], $allowedImageType))
			{
				$erMsg= 'You can only upload JPG, PNG and GIF file';
			}
			elseif (round($_FILES['txtImage']["size"] / 1024) > 4096) 
			{
				$erMsg= 'You can upload file size up to 4 MB';
			} 
			else 
			{
				$rand = substr(number_format(time() * rand(),0,'',''),0,6);
				$file_name=$_FILES['txtImage']['name'];
				$explode = explode(".",$file_name);
				$filename=$rand.".".strtolower($explode[count($explode)-1]);
				move_uploaded_file($_FILES['txtImage']['tmp_name'], ADMIN_PRODUCT_IMAGE.$filename);

				$field = "pro_id, image";
				$value = ":pro_id, :image";
				$addExecute=array(
					':pro_id'		=>$_GET['pro_id'],
					':image'		=>$filename
				);
				$general_cls_call->insert_query(PRODUCT_GALLERY_IMAGE, $field, $value, $addExecute);
				header("location:gallery.php?pro_id=".$_GET['pro_id']);
			}
		}
	}
/*===========  INSERT QUERY END ===========*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{		
		$photoVal = $general_cls_call->select_query("image", PRODUCT_GALLERY_IMAGE, "WHERE id=:id", array(':id'=>$_GET['id']), 1);
		if($photoVal->image!='')
		{	
			$unlink_photo_path1 = ADMIN_PRODUCT_IMAGE.$photoVal->image;	
			if(file_exists($unlink_photo_path1)){ unlink($unlink_photo_path1); }
		}
		$general_cls_call->delete_query(PRODUCT_GALLERY_IMAGE, "WHERE id=:id", array(':id'=>$_GET['id']));
		header("location:gallery.php?pro_id=".$_GET['pro_id']);
	}
/*=========== DELETE END ================*/	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
.button{
	border: solid 0px #69CCEB; 
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	color:#FFFFFF;
	width:15%;
	height:30px;
	background-color:#F10F24;
	cursor:pointer;
	margin:0px 10px;border-radius: 3px;
}
.button_upload{
	border: solid 0px #69CCEB; 
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	color:#FFFFFF;
	width:auto;
	height:30px;
	background-color:#7A439A;
	cursor:pointer;
	margin:0px 10px;
}	
.home_text {
	font-family:arial;
	color:#FFF;
	font-size:16px; 
	line-height:21px; 
	font-weight:bold; 
	font-style:normal;
}
#imgChange {border: medium none;border-radius: 3px; color: #ffffff; display: block;height: 30px;left: 0;line-height: 32px; position: absolute;text-align: center;top: -14px; width: 100%;}
#imgChange input[type="file"] {bottom: 0;cursor: pointer;height: 100%;left: 0;margin: 0;opacity: 0;padding: 0;position: absolute;width: 100%;z-index: 0;}

	</style>
<script type="text/javascript">
<!--
	function del(pro_id,id)
	{
		if(confirm('Are you sure to delete the image?'))
		{
		   document.frm.action="gallery.php?mode=del&pro_id="+pro_id+"&id="+id;
		   document.frm.submit();
		}
	}
//-->
</script>
</head>
<body style="margin:0px;background-color:#FFF">
  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 0px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
	<tr>
	  <td width="100%" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp;&nbsp;GALLERY IMAGE</td>
	</tr>
	<tr>
	  <td width="100%" class="home_text">
		<div style="height:430px;overflow:auto;">
		<form enctype="multipart/form-data" action="" method="post" name="frm">
		  <table border="0" cellpadding="4" cellspacing="3" style="border-collapse: collapse;" width="100%"  height="1">
			<tr>
			  <td width="60%" align="right" height="50">
				<div style=" width:45%;position: relative;">
				  <div id="imgChange" class="button_upload">UPLOAD PRODUCT GALLERY IMAGE
					<input type="file" name="txtImage">
				  </div>
                </div>
			  </td>
			  <td width="40%" align="left"><input type="submit" value="SAVE" name="btnSubmit" class="button"></td>
			</tr>
			<tr>
			  <td width="100%" colspan="2">
		<?PHP
			$proSql = $general_cls_call->select_query("*", PRODUCT_GALLERY_IMAGE, "WHERE pro_id=:pro_id", array(':pro_id'=>$_GET['pro_id']), 2);
			if($proSql[0] != '')
			{
				$i = 1;
				foreach($proSql as $galleryVal)
				{
		?>
					<div style="float:left; width:23%;height:156px;margin:8px;border: solid 1px #7A439A;position: relative;"><img src="<?PHP echo ADMIN_PRODUCT_IMAGE.$galleryVal->image; ?>" style="width:230px;height:156px;" alt="" />
					
					  <div style="position: absolute;top:5px;left:5px;width:20px;height:20px;"><a href="javascript: del('<?php echo $_GET['pro_id']; ?>','<?php echo $galleryVal->id; ?>')" title="Click Here To Delete"><img src="img/delete.png" alt="Click Here To Delete" /></a></div>
					</div>
		<?PHP
				}
			}
			else
			{
				echo '<font style="text-align:center;color:red;padding-left:400px;">No image found!!!</font>';
			}
		?>
			  </td>
			</tr>
		  </table>
		</div>
	  </td>
	</tr>
  </table>
</body>
</html>

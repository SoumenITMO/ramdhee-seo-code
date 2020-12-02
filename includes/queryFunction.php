<?php
	class general
	{ 
		private $db;
		//Connect to DB when the class construct
		public function __construct($database)
		{
	    		$this->db = $database;
		}
		public function select_query_count($tables,$where,$data_array)
		{
			$query_string="SELECT COUNT(*) FROM ".$tables." ".$where;
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$num_rows = $query->fetchColumn();
					return $num_rows;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_count_distinct($tables,$where,$data_array,$fieldName)
		{
			$query_string="SELECT COUNT(DISTINCT (".$fieldName.")) FROM ".$tables." ".$where;
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$num_rows = $query->fetchColumn();
					return $num_rows;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_random($fields,$tables,$where,$data_array)
		{
			$query_string="SELECT ".$fields." FROM ".$tables." ".$where." ORDER BY rand() LIMIT 0, 1";
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $query->fetch(PDO::FETCH_ASSOC);
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_sum($table,$where,$data_array,$field)
		{
			$query_string="SELECT SUM(".$field.") as price FROM ".$table." ".$where." ";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $query->fetch(PDO::FETCH_OBJ);
					return $result;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		
		public function select_query_1($fields,$tables,$where,$data_array,$mode)
		{
			$query_string="SELECT ".$fields." FROM ".$tables." ".$where." ";
			//echo $query_string."</br>";
			
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($mode == 1)
					{	
						/*
						fetch single record from database
						Fetch single dataset in default way
						mixed PDOStatement::fetch(
							int$mode=PDO_FETCH_BOTH,
							int$orientation=PDO_FETCH_ORI_NEXT,
							int$offset=0)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetch(PDO::FETCH_ASSOC);
					}
					else if($mode == 2)
					{
						/*
						fetch multiple record from database
						Fetch all rows at once in default way
						array PDOStatement::fetchAll(
							int$mode=PDO_FETCH_BOTH,
							string$class_name=NULL,
							array$ctor_args=NULL)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetchAll(PDO::FETCH_OBJ);
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		public function select_query($fields,$tables,$where,$data_array,$mode)
		{
			$query_string="SELECT ".$fields." FROM ".$tables." ".$where." ";
			
			//echo $query_string."</br>";
			
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($mode == 1)
					{	
						/*
						fetch single record from database
						Fetch single dataset in default way
						mixed PDOStatement::fetch(
							int$mode=PDO_FETCH_BOTH,
							int$orientation=PDO_FETCH_ORI_NEXT,
							int$offset=0)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetch(PDO::FETCH_OBJ);
					}
					else if($mode == 2)
					{
						/*
						fetch multiple record from database
						Fetch all rows at once in default way
						array PDOStatement::fetchAll(
							int$mode=PDO_FETCH_BOTH,
							string$class_name=NULL,
							array$ctor_args=NULL)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetchAll(PDO::FETCH_OBJ);
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_distinct($tables,$where,$data_array,$fieldname)
		{
			$query_string="SELECT DISTINCT (".$fieldname.") FROM ".$tables." ".$where." ";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $query->fetchAll(PDO::FETCH_OBJ);
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_pro_count($tables,$where,$data_array)
		{
			$query_string="SELECT COUNT(DISTINCT (pro_id)) FROM ".$tables." ".$where." ";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$num_rows = $query->fetchColumn();
					return $num_rows;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_most_selling($table,$table2,$limit=null,$where)
		{
			if($limit == 5)
			{
				$query_string="SELECT SUM(price) as price,product_id,order_number FROM ".$table." GROUP BY product_id ORDER BY price DESC LIMIT 0, 5";
			}
			else
			{
				$query_string="SELECT SUM(".$table.".price) as price,".$table.".product_id,".$table.".order_number FROM ".$table." INNER JOIN ".$table2." ON ".$table.".order_number = ".$table2.".order_number ".$where." GROUP BY product_id ORDER BY price DESC";
			}
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $query->fetchAll(PDO::FETCH_OBJ);
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function insert_query($table, $fields, $values, $data_array)
		{
			$result = false;
			$query_string = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $this->db->lastInsertId();
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function update_query($table, $update_field_values, $where, $data_array)
		{
			$result = false;
			$query_string = "UPDATE ".$table." SET ".$update_field_values."  ".$where."";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$affected_rows=$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($affected_rows===0)
					{
						$result=true;
					}
					else if($affected_rows>0)
					{
						$result=$affected_rows;
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function delete_query($table, $where, $data_array)
		{
			$result = false;
			$query_string = "DELETE FROM ".$table."  ".$where."";
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$affected_rows=$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($affected_rows===0)
					{
						$result=true;
					}
					else if($affected_rows>0)
					{
						$result=$affected_rows;
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}

		
		public function empty_query($table)
		{
			$query_string = "TRUNCATE TABLE ".$table;
			$this->db->query($query_string);
		}

		public function specialhtmlremover($string)
		{
			return $string;
		}
		
		public function validation_check($checkingVariable, $destinationPath)
		{
			if($checkingVariable == '')
			{
				echo "<script language='javaScript' type='text/javascript'>
					window.location.href='".$destinationPath."';
				</script>";
			}
		}

		public function request_uri()
		{
			if($_SERVER['REQUEST_URI'])
			{
				return $_SERVER['REQUEST_URI'];
			}   
			if($_SERVER['HTTP_X_REWRITE_URL'])
			{
				return;
			}
			$P=$_SERVER['SCRIPT_NAME'];
			if($_SERVER['QUERY_STRING'])
			{
				$P.='?'.$_SERVER['QUERY_STRING'];
				return $P;
			}
		}
		public function pageLink()
		{
			preg_match('`/'.FOLDER_PATH.'(.*)(.*)$`',$this->request_uri(),$matches);
			$tabletype=(!empty($matches[1])?($matches[1]):'');
			$url_array=explode('/',$tabletype);

			return($url_array);
		}
		public function pageName($fastPosation,$lastPosation,$countArray)
		{
			if($lastPosation == '') {$lastPosation = 'home';}
			if($countArray == '2') {$lastPosation = $fastPosation;}
			if($countArray == '3') {$lastPosation = $fastPosation;}
			if($countArray == '4') {$lastPosation = $fastPosation;}
			if($countArray == '5') {$lastPosation = $fastPosation;}

			$pageName = $this->select_query("*", SITE_LINK, "WHERE page_url=:page_url", array(':page_url'=>$lastPosation), 1);
			return($pageName);
		}
		public function pageUrl($id)
		{
			$urlName = $this->select_query("*", SITE_LINK, "WHERE id=:id", array(':id'=>$id), 1);
			return($urlName->page_url);
		}	// Seo function.


		public function admin_validation_check($checkingVariable, $destinationPath, $role=array())
		{
			//if(!in_array($_SESSION['USER_ROLE'], $role) || $checkingVariable == '')
			if($checkingVariable == '')
			{
				echo "<script language='javaScript' type='text/javascript'>
					window.location.href='".$destinationPath."';
				</script>";
			}
		}

		public function createThumbs($file, $dir, $size, $imgName)
		{
			$img_fileName = str_replace(' ','_',$file['name']);
			$fileData  = pathinfo(basename($img_fileName));
			$ext = $fileData['extension'];
			//$ext = explode('.', $img_fileName);
			//Thumbnail file name File
			$image_filePath=str_replace(' ','_',$file['tmp_name']);
			$img_thumb = $dir .'thumb/'. $imgName;
			$extension = strtolower($ext);
							
			//Check the file format before upload
			if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp')))
			{
				//Find the height and width of the image
				list($gotwidth, $gotheight, $gottype, $gotattr)= getimagesize($image_filePath); 	
				
				//---------- To create thumbnail of image---------------
				if($extension=="jpg" || $extension=="jpeg" ){
					$src = imagecreatefromjpeg($image_filePath);
				}
				else if($extension=="png"){
					$src = imagecreatefrompng($image_filePath);
				}
				else
				{
					$src = imagecreatefromgif($image_filePath);
				}
				list($width,$height)=getimagesize($image_filePath);
		
				if($gotwidth>=$size)
				{
					$newwidth=$size;
				}
				else
				{
					$newwidth=$gotwidth;
				}
				//Find the new height
				$newheight=round(($gotheight*$newwidth)/$gotwidth);
				//Creating thumbnail
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255));  // white background;
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
				//Create thumbnail image
				$createImageSave=imagejpeg($tmp,$img_thumb,$size);
				move_uploaded_file($image_filePath,$dir.$imgName);	
			}
		}

		public function price_format($price)
		{
			$curPrice = $this->select_query("*", CURRENCY, "WHERE id=:id", array(':id'=>1), 1);	

			//$adminSql = mysql_query("select currenc from admin_master where id = 1");
			//$adminCur = mysql_fetch_object($adminSql);
			if($_SESSION['CURRENCY'] == 1) { $curr = '$'; $currPri = $curPrice->usd; }
			if($_SESSION['CURRENCY'] == 2) { $curr = '&euro;'; $currPri = $curPrice->eur; }
			if($_SESSION['CURRENCY'] == 3) { $curr = '&pound;'; $currPri = $curPrice->gbp; }			
			return number_format($price * $currPri, 2);
			//return $curr.number_format($price * $currPri, 2);
		}


	}
?>
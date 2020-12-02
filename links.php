<?php
		echo "PICTURE LINK ...";
		echo "</br>";
		echo "</br>";
		
		$f_     = 1;
		$handle = 	  opendir('img/re');
		$fp 	= 	  fopen('output.csv', 'wb');
		
		while (false !== ($entry = readdir($handle))) 
		{
			if($entry != '.ftpquota' and $entry != '..' and $entry != '02.zip' and $entry != '' and !is_dir($entry))
			{
				if(isset(explode(".",$entry)[1]))
				{
					//echo '<a href=http://makelikethis.co.uk/img/re/'.$entry.'> Pic Link </a></br>';
					fputcsv($fp, array($f_, 'http://makelikethis.ee/img/re/'.$entry));
					echo 'http://makelikethis.ee/img/re/'.$entry."</br>";
					$f_++;
				}
			}
		}
		
		fclose($fp);
?>

<a href="output.csv"> Download File </a>
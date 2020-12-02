<?php
// get the tmp url
$photo_src = $_FILES['photo']['tmp_name'];
// test if the photo realy exists
if (is_file($photo_src)) 
{
	// photo path in our example
	$photo_dest = 'texture_white.jpg';
	
	// copy the photo from the tmp path to our path
	copy($photo_src, $photo_dest);
	
	// call the show_popup_crop function in JavaScript to display the crop popup
	echo '<script type="text/javascript">window.top.window.show_popup_crop("'.$photo_dest.'")</script>';
}
//////////////////////////////


	
?>
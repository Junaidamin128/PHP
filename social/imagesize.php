<?php

$image = "./images/1.jpg";

$im_php = imagecreatefromjpeg($image);
$im_php = imagescale($im_php, 100);


$new_name = "1small.jpg";
// imagejpeg($im_php, $new_name);
ob_start();
imagejpeg($im_php);
$image_data = ob_get_contents (); 
ob_end_clean(); 
$image_data_base64 = "data:image/jpeg;base64,".base64_encode ($image_data);

?>
<img src="<?= $image_data_base64?>" />
<img src="<?= $image?>" />

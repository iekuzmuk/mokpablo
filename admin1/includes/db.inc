<?php

$hostname = "localhost";
$username = "adminmo";
$password = "admin_2019_10";
$databasename = "mokphpdb";

function showerror($str){
  die("Error " . $str);
}

function mysqlclean($array, $index, $maxlength, $connection){
  if (isset($array["{$index}"])){
    $input = substr($array["{$index}"], 0, $maxlength);
    $input = mysqli_real_escape_string( $connection,$input);
    return ($input);
  }
  return NULL;
}

function str_split_iv($str) {
          $arr = array();
          if (is_string($str)) {for ($i = 0; $i < strlen($str); $i++) {array_push($arr, $str[$i]);}}
          return $arr;
}

function resample_picfile($src, $dst,$scale, $w, $h){
	//if(file_exists($dst)) unlink($dst);
    // If distortion stretching is within the range below,
    // then let image be distorted.
    $lowend = 0.8;
    $highend = 1.25;
	
	$system=explode(".",$src);
	if (preg_match("/jpg|jpeg/",$system[1])){$src_img=imagecreatefromjpeg($src);}
	if (preg_match("/gif/",$system[1])){$src_img=imagecreatefromgif($src);}
	if (preg_match("/png/",$system[1])){$src_img=imagecreatefrompng($src);}
	
    if($src_img)
    {
        $dst_img = ImageCreateTrueColor($w, $h);
        /* if you don't want aspect-preserved images 
to have a black bkgnd, fill $dst_img with the color of your choice here. 
        */

        if($dst_img)
        {
            $src_w = imageSX($src_img);
            $src_h = imageSY($src_img);

            $scaleX = (float)$w / $src_w;
            $scaleY = (float)$h / $src_h;
            $scale = min($scaleX, $scaleY);

            $dstW = $w;
            $dstH = $h;
            $dstX = $dstY = 0;

            $scaleR = $scaleX / $scaleY;
            if($scaleR < $lowend || $scaleR > $highend)
            {
                $dstW = (int)($scale * $src_w + 0.5);
                $dstH = (int)($scale * $src_h + 0.5);

                // Keep pic centered in frame.
                $dstX = (int)(0.5 * ($w - $dstW));
                $dstY = (int)(0.5 * ($h - $dstH));
            }
            
            imagecopyresampled(
                $dst_img, $src_img, $dstX, $dstY, 0, 0, 
                $dstW, $dstH, $src_w, $src_h); 
            
			if (preg_match("/png/",$system[1])) imagepng($dst_img, $dst);
			else if (preg_match("/gif/",$system[1])) imagegif($dst_img, $dst);
			else imagejpeg($dst_img, $dst);
            imagedestroy($dst_img);
        }
        imagedestroy($src_img);
        return file_exists($dst);
    }
    return false;
}

?>

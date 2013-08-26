<?php
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   public static $full_path;

   private $image;
   private $image_info;
   private $new_image;
   private $ff;
 
   function __construct($filename) {
      $this->ff = $filename;
      self::$full_path = path('public')."albums";

      // Get image info, and create from it's type an image
      $this->image_info = getimagesize($filename);
      if( $this->image_info[2] == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_info[2] == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_info[2] == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
      /////////////////////////////////////////////////////
   }

   function save($file_name, $image_type=IMAGETYPE_JPEG, $compression=95, $permissions=null) {
 
      $path = self::$full_path.DS.$file_name;

      if(!isset($this->new_image))$this->new_image = $this->image;

      if( $image_type == IMAGETYPE_JPEG ) {

         ImageJPEG($this->new_image,$path,$compression); 

      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->new_image,$path);

      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->new_image,$path);

      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }

   }



   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }


   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }


   function resize_crop($nw, $nh)
   {
         //VARIABLES

         $w=$this->image_info[0];
         $h=$this->image_info[1];
         ////////////////////////

         $thumb = ImageCreateTrueColor($nw,$nh);
            
         $wm = $w/$nw;
         $hm = $h/$nh;
            
         $h_height = $nh/2;
         $w_height = $nw/2;
            
         $img = $this->image;

         if($w > $h){
            // PROBLEM IS HERE
            $adjusted_width = $w / $hm;  
            $tmp_nh = $nh;
            if($adjusted_width < $nw) {

               $ratio          = $nw / $adjusted_width;
               $adjusted_width = $adjusted_width * $ratio;
               $nh             = $nh * $ratio;

            }
            $half_height = ($nh - $tmp_nh) / 2;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            
            ImageCopyResampled($thumb, $img, -$int_width, -$half_height, 0, 0, $adjusted_width, $nh, $w, $h);
            
         }elseif(($w < $h) || ($w == $h)){

            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            
            ImageCopyResampled($thumb, $img, 0, -$int_height, 0, 0, $nw, $adjusted_height,$w,$h);
            
         }else{
            ImageCopyResampled($thumb,$img,0,0,0,0,$nw,$nh,$w,$h);  
         }
         $this->new_image = $thumb;
   }
 
}
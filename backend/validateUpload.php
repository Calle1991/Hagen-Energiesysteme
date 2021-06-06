<?php

if(isset($_FILES['file']['name'])){

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "uploads/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   $response = 1;

   // Check if file already exists
   if (file_exists($location)) {
      $response = "Sorry, file already exists.";
   }

   // Check file size
   if ($_FILES['file']["size"] > 5000000) {
      $response = "Die Dateigröße darf 5 MB nicht überschreiten";
   }

   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      $response = "Entschuldigung, es sind nur JPG, JPEG, PNG & GIF Dateien erlaubt.";
   }

   echo $response;
   exit;
}
echo 0;
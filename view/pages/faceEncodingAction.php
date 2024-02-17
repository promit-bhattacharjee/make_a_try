<?php
$userImage=$_FILES['userImage'];
 $imageCurrentPath= $userImage["tmp_name"];
 $imageTargetPath="assets/tryoutImage/".$userImage['name'];
 $uploadImage= move_uploaded_file($imageCurrentPath,$imageTargetPath);
 $filePath=$imageTargetPath;
$pythonSrc = "C:\\xampp\\htdocs\\makeATry\\faceEncoding.py";
$filePath=escapeshellarg($filePath);
$encoding =shell_exec("python "." ". escapeshellarg($pythonSrc) . " ". $filePath);
echo "<pre>";
print_r($encoding);
echo "</pre>";
?>


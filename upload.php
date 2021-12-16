<?php
$target_dir = "uploads/";
if(!is_dir('uploads')){
	if(file_exists('uploads'))
		unlink('uploads');
    mkdir('uploads', 0777, true);
}
if(!is_dir('result')){
	if(file_exists('result'))
		unlink('result');
    mkdir('result', 0777, true);
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])){
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > 5000000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
if($uploadOk == 0){
	echo "Sorry, your file was not uploaded.";
}else{
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		header("Location: ocr3.php?name=".htmlspecialchars(basename($_FILES["fileToUpload"]["name"])));
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
?>
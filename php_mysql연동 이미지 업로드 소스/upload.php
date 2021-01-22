<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		/*database에 업로드 정보를 기록하자.
		- 파일이름(혹은 url)
		- 파일사이즈
		- 파일형식
		*/
		$filename = $_FILES["fileToUpload"]["name"];
		$imgurl = "http://110.165.19.50/uploads/". $_FILES["fileToUpload"]["name"];
		$size = $_FILES["fileToUpload"]["size"];

		//include_once 'config.php';
		//$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $conn = mysqli_connect('db-5ecg7.vpc-cdb.ntruss.com', 'test01', 'ncp!@#123', 'test01');
		//images 테이블에 이미지정보를 저장하자.
		$sql = "insert into images(filename, imgurl, size) values('$filename','$imgurl','$size')";
		mysqli_query($conn,$sql);
		mysqli_close($conn);

        echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
		echo "<br><img src=uploads/". basename( $_FILES["fileToUpload"]["name"]). " width=400>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    }
}
?>

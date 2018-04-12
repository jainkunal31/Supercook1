<?php

session_start();
$host = 'localhost';
$user = 'root';
$password = 'kunal@123';
$dbname='test';


$conn = new mysqli($host,$user,$password,$dbname);
if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    die();
}

                                

 	
 				$rName = $_POST['rName'];
			//	$rDesc = $_POST['rDesc'];
                                $user = $_SESSION['email'];
                               //  echo $rName;
					$sql = "INSERT INTO recipe (r_name,user) VALUES ('$rName','$user')";

if (mysqli_query($conn,$sql) === TRUE) {


$target_dir = "uploads/";
if(isset($_FILES['fileToUpload']))
{
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo $target_dir;
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
if ($_FILES["fileToUpload"]["size"] > 2000000) {
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
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                                                         $dataTime = date("Y-m-d H:i:s");
							$image = $_FILES['fileToUpload']['tmp_name'];
                                                        $imgContent = addslashes(file_get_contents($image));
                                                        $sql = "Select max(r_id) as rid from recipe ";
                                                        $res=mysqli_query($conn,$sql);
                                                        $r = mysqli_fetch_assoc($res);

                                                        $sql = "INSERT into images (r_id,image, created,user) VALUES (".$r['rid'].",'$imgContent', '$dataTime','$user')";
							     mysqli_query($conn,$sql);
        echo '<a  href ="main.php" ><h1>Back to main page</h1></a>';
                                   
    }
}


   
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
					//mysqli_query($conn,$sql);






?>
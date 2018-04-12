<?php
require 'db.php';
session_start();

//$data = [];
$json = file_get_contents("tp.json"); 

//$data = json_decode($json,true);
// remove the ,true so the data is not all converted to arrays


$data = json_decode($json);
if($data)
echo 444444;
else echo 3333333;
// Now process the array of objects

foreach ( $data as $inv ) {

   echo 'success';

    $name = $inv->name;
    $imageURL =     $inv->imageURL;
    $originalURL=    $inv->originalURL;
   
    $sql = "INSERT INTO recipe 
             (r_name,r_imageurl,r_originalurl) 
            VALUES
             ('$name','$imageURL','$originalURL')";
    $res = mysqli_query($mysqli,$sql);

    if(!$res){
        $result = new stdClass();
        $result->status = false;
        $result->msg = mysqli_error($mysqli);
        echo json_encode($result);
        exit;
    }
}


/*if(mysqli_query($mysqli,$sql))
echo 'success';
else
echo mysqli_error($mysqli);*/
if(isset($_POST["search"]))
{

$length=count($_SESSION["ingredients"]);
echo $length;
echo '<br>';
for($x=0;$x<$length;$x++)
{
echo $_SESSION["ingredients"][$x].'<br>';
}
}





?>



<!DOCTYPE html>
<html>
<title></title>
<meta charset="UTF-16">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">


<?php

    //DB details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'kunal@123';
    $dbName     = 'test';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    
    //Get image data from database
    $result = mysqli_query($db,"SELECT * FROM images WHERE isapproved = 0 AND isrejected=0");
$rows = $result->num_rows;

if ($rows > 0) {    
while($r = mysqli_fetch_assoc($result))
{
//echo $r['user'];

?>
<a href="javascript:void(0)" class="w3-hover-opacity" onclick="document.getElementById('<?php echo $r['id']; ?>').style.display='block'"> 





<?php
echo '

<tr>

<td>

<img src="data:image/jpeg;base64,'.base64_encode($r['image']).'" height="200" width="400" />
</td>

</tr>


';
?>
</a>

<div id="<?php echo $r['id']; ?>" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('<?php echo $r['id']; ?>').style.display='none'" class="fa fa-remove w3-button w3-right w3-transparent w3-xxlarge"></i>
      <div style="width:100%;height:300px;">
<?php

echo '
<img src="data:image/jpeg;base64,'.base64_encode($r['image']).'" style="float:center;height:300px;">
'
;
?>
      </div>
<br>
<br>
      <p><a href="approve.php?id=<?php echo $r['id']; ?>" class="w3-button w3-padding-large w3-red w3-margin-bottom" role="button">Approve</a></p>
        <p><a href="reject.php?id=<?php echo $r['id']; ?>" class="w3-button w3-padding-large w3-red w3-margin-bottom" role="button">Reject</a></p>
     </div>
  </div>
</div>
<?php

echo $r['user'];
echo '<br>';       
} 
        //Render image
      //  header("Content-type: image/jpg"); 
      //  echo $imgData['image']; 
    }else{
        echo 'Image not found...';
    }

?>



<!-- img1 Modal -->


</body>
</html>
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
    $result = $db->query("SELECT image FROM images WHERE id = 23");
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();


echo '

<tr>

<td>
<img src="data:image/jpeg;base64,'.base64_encode($imgData['image']).'" height="500" width="800" />
</td>

</tr>

';
        
        //Render image
      //  header("Content-type: image/jpg"); 
      //  echo $imgData['image']; 
    }else{
        echo 'Image not found...';
    }

?>
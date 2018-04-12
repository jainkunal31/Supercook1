<?php
//session_start();
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<style>
input[type=text], textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0 
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>

   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<body>


 <ul class="nav navbar-nav navbar-centre">
      <?php

   if(isset($_SESSION['logged_in'])){
      if($_SESSION['logged_in']==true)
     {


      ?>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Welcome <?php echo $_SESSION['first_name']; ?></a></li>
        <li><a href="Login/logout.php">Logout</a></li>
        <li><a href = "main.php">Back to main page</a></li>
</ul>

<br>
<br>
       


<div>
  <form action="upload.php" method="POST"  enctype="multipart/form-data">
    <label for="rName">Recipe Name</label>
    <input type="text" id="rName" name="rName" placeholder="Enter title.." required>

   
	<br> <p>Select image of recipe details to upload:</p><br>
        <input type="file" name="fileToUpload" id="fileToUpload"/ required>
  <br> <p>Select image of recipe details to upload:</p><br>
        <input type="file" name="fileToUpload" id="fileToUpload"/ required>
 
    <input type="submit" name="submit" value="Upload Image">
  </form>
</div>

<br>
<br>


<?php
//echo $email;
if(!strcmp($_SESSION['email'],'admin@gmail.com'))
{




?>
           <a href="connect_admin.php"><button class="button button-block" name="logout"/>You have recipes pending for approval</button></a>
<?php
}else{
$email=$_SESSION['email'];

$sql="SELECT * from images WHERE user='$email' order by id desc";
$result=mysqli_query($mysqli,$sql);
?>
<h1>Notifications</h1>
<?php

while($r = mysqli_fetch_assoc($result))
{
if($r['isaprroved'])
{
?>
<div>Your recipe dated <?php echo $r['created']; ?> has been approved</div>
<br>
<?php

}else if($r['isrejected'])
{
?>
<div>Your recipe dated <?php echo $r['created']; ?> has been rejected</div>
<br>
<?php
}
else{

?>
<div>Your recipe dated <?php echo $r['created']; ?> has not been approved</div>
<br>
<?php
}



}
}
?>



<br>
<br>
<br>
<br>




		
<?php }} else {?>
 <ul class="nav navbar-nav navbar-centre">
      <h1>You have to be logged in to upload</h1>
      <h1><li><a href="Login/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li></h1>
    
       <?php } ?>

   </ul>


</body>
</html>

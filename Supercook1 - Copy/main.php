<?php 
session_start();
include 'db.php';
include 'feedback/comments.php';	
?>

<html>
<head></head>

   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href='feedback/style.css' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
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
</ul>

<br>
<br>
<?php
echo "<h2>Notifications</h2><br><br>";
getnotifications($mysqli);


 }} else {?>
 <ul class="nav navbar-nav navbar-centre">
      
      <h1><li><a href="Login/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li></h1>
 </ul>
    
       <?php } ?>
       <br>
       <br>
	
<ul>
	<li><a>Search</a></li>
	<ol>
		<li><a href="hi.php">By ingredients</a></li>
		<li><a href="hiname.php">By name</a></li>
		<li><a href="himenu.php">Entire menu</a></li>
	</ol>
	<li>
		<a href="connect.php">Upload recipe</a>
	</li>





</body>
</html>
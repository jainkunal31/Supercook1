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
$ingredients_done =0;
$steps_done=0;


if(isset($_GET['id']) && !empty($_GET['id'])) {






$items = $_GET['id'];
}
//echo $items;
$flag=1;



if($_SERVER["REQUEST_METHOD"]=="POST")
{

if(isset($_POST["more_ingredients"]))
{

if(isset($_POST["ingredient"]))
{
  $x=$_POST["ingredient"];

    if(!isset($_SESSION["ingredients_upload"]))
    {
      $_SESSION["ingredients_upload"][0]=$x;

    }
    else
    {
      $n = count($_SESSION["ingredients_upload"]);

      for($i=0;$i< $n;$i++)
      {

        if(!strcmp($x,$_SESSION["ingredients_upload"][$i]))
        {
          $flag=0;
          break;
        }
      }
      if($flag)
      {
          array_push($_SESSION["ingredients_upload"],$x);

//print_r($_SESSION["ingredients"]);
//$count= sizeof($_SESSION("ingredients"));
      }

    }
  

  if(isset($_SESSION['ingredients_upload']))
{
 $n = count($_SESSION["ingredients_upload"]);


//$count = sizeof($_SESSION("ingredients"));

for($i=0;$i< $n;$i++)
{
echo '<ul><li> '. $_SESSION["ingredients_upload"][$i] . '</li></ul>';
}
}



}


}


if(isset($_POST["ingredients_done"]))
{
	if(!isset($_SESSION['flag']))
	$_SESSION['flag'] = 1;
    $ingredients_done=1;
	echo "ingredients selected";
}

if(isset($_POST["more_steps"]) && $_SESSION['flag'])
{ 
	$ingredients_done=1;
	echo "ingredients selected";

if(isset($_POST["step"]))
{
  $x=$_POST["step"];
  $y=$_POST["time"];
  //echo $y;

    if(!isset($_SESSION["step_upload"]))
    {
      $_SESSION["step_upload"][0]=$x;
     if(!isset($_SESSION["time_upload"]))
      $_SESSION["time_upload"][0]=$y;
      //echo $_SESSION["time_upload"][0];


    }
    else
    {
      $n = count($_SESSION["step_upload"]);

      for($i=0;$i< $n;$i++)
      {

        if(!strcmp($x,$_SESSION["step_upload"][$i]))
        {
          $flag=0;
          break;
        }
      }
      if($flag)
      {
          array_push($_SESSION["step_upload"],$x);
          array_push($_SESSION["time_upload"],$y);  
//print_r($_SESSION["ingredients"]);
//$count= sizeof($_SESSION("ingredients"));
      }

    }
  

  if(isset($_SESSION['step_upload']))
{
 $n = count($_SESSION["step_upload"]);
// echo $n;


//$count = sizeof($_SESSION("ingredients"));

for($i=0;$i< $n;$i++)
{
echo '<ul><li> '. $_SESSION["step_upload"][$i] .'    ' . $_SESSION["time_upload"][$i] .'</li></ul>';
}
}



}

}


if(isset($_POST["steps_done"]))
{
	$ingredients_done=1;
	$steps_done=1;
	echo "Steps selected";

	
}


}

?>



<html> 
<head>
 <title> My search engine </title> 


<style>


*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 100%;
  background: #ffffff;
  -webkit-font-smoothing: antialiased;
}

#page-wrapper {
  width: 640px;
  background: #FFFFFF;
  padding: 1em;
  margin: 1em auto;
  border-top: 5px solid #69c773;
  box-shadow: 0 2px 10px rgba(0,0,0,0.8);
}

h1 {
  margin-top: 0;
}

label {
  display: block;
  margin-top: 2em;
  margin-bottom: 0.5em;
  color: #999999;
}

input {
  width: 100%;
  padding: 0.5em 0.5em;
  font-size: 1.2em;
  border-radius: 3px;
  border: 1px solid #D9D9D9;
}

button {
  display: inline-block;
  border-radius: 3px;
  border: none;
  font-size: 0.9rem;
  padding: 0.5rem 0.8em;
  background: #69c773;
  border-bottom: 1px solid #498b50;
  color: white;
  -webkit-font-smoothing: antialiased;
  font-weight: bold;
  margin: 0;
  width: 100%;
  text-align: center;
}

button:hover, button:focus {
  opacity: 0.75;
  cursor: pointer;
}

button:active {
  opacity: 1;
  box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1) inset;
}



</style>



</head> 
<body> 

<?php

if($ingredients_done == 0 && $steps_done==0)
{


?>




<form method="post" action="">  
<div id="page-wrapper">
  <h1>Enter the ingredients</h1>
    
  <label for="ajax">Enter an ingredient</label>
  <input type="text" name="ingredient" id="ajax" placeholder="e.g. datalist" autocomplete="off" required>
  <input type="submit" value="Add more ingredients"  name = "more_ingredients" >
  <br>
  <br>
  <br>
</div>
</form>
<form method="post" action="" >
<!-- <div id="page-wrapper"> -->
  <input type="submit" value="Ingredients done"  name = "ingredients_done" >


</div>
</form>

<?php
}

else if($ingredients_done && $steps_done==0)
{


?>

<form method="post" action="">  
<div id="page-wrapper">
  <h1>Enter then steps</h1>
    
  <label for="ajax">Enter a step</label>
  <input type="text" name="step" id="ajax" placeholder="e.g. datalist" autocomplete="off" required>
  <label for="timer">Enter time in minutes</label>
  <input type="number" id="timer" name ="time" placeholder="e.g. 100" autocomplete="off" required>
  <input type="submit" value="Add more steps"  name = "more_steps" >
  <br>
  <br>
  <br>
</div>
</form>

<form method="post" action="" >
<!-- <div id="page-wrapper"> -->
  <input type="submit" value="Steps done"  name = "steps_done" >


<!-- </div> -->
</form>

<?php
}

else if($steps_done)
{
$sql = "UPDATE images set isapproved=1 where id=$items";


if (mysqli_query($conn,$sql) === TRUE) {

$sql="Select r_id from images where id=$items";
$res = mysqli_query($conn,$sql);
$r=mysqli_fetch_assoc($res);
$r_id=$r['r_id'];
$sql = "UPDATE recipe set isapproved=1 where r_id=$r_id";

mysqli_query($conn,$sql);

$i=count($_SESSION['ingredients_upload']);
for($j=0;$j<$i;$j++)
{
	$sql = "Insert into ingredients (r_id,r_ingredients) values ($r_id,'".$_SESSION['ingredients_upload'][$j]."')";
	mysqli_query($conn,$sql);
}

$i=count($_SESSION['step_upload']);
for($j=0;$j<$i;$j++)
{
	$sql = "Insert into steps (r_id,r_step_number,r_step,r_step_time) values ($r_id,$j+1,'".$_SESSION['step_upload'][$j]."',".$_SESSION['time_upload'][$j].")";
	echo $sql;
	mysqli_query($conn,$sql);
}





$handle = @fopen("recipes.json", 'r+');
if($handle)
{
	 // seek to the end
    fseek($handle, 0, SEEK_END);

    // are we at the end of is the file empty
    if (ftell($handle) > 0)
    {
        // move back a byte
        fseek($handle, -1, SEEK_END);

        // add the trailing comma
        fwrite($handle, ',{', 2);
        $name="name";
       // $someArray=[];
       
        //fwrite($handle, )

        // add the new json string
         fwrite($handle, json_encode($name).':' );
         $sql = "Select r_name from recipe where r_id =$r_id";
$res=mysqli_query($conn,$sql);
$r=mysqli_fetch_assoc($res);
 // array_push($someArray, [
 //      'name'   => $r['r_name'] ]);
$event = $r['r_name'];
//echo $event;
        fwrite($handle, json_encode($event) . ',');
         $ingredients="ingredients";
        fwrite($handle, json_encode($ingredients).':');
          $sql = "Select r_ingredients from ingredients where r_id =$r_id";
 $res=mysqli_query($conn,$sql);
$someArray=[];
//$row=mysqli_fetch_assoc($res);
        while ($row = mysqli_fetch_assoc($res)) {
    array_push($someArray, [
      'name'   => $row['r_ingredients'],'quantity'   => '4' ]);
  }
  fwrite($handle, json_encode($someArray) . '}]');

  // Convert the Array to a JSON String and echo it
 

    }
}



  //header('Location:connect.php?success ' );
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//mysqli_close($conn);
}

?>

</body>
</html>
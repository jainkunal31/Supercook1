<?php

session_start();
include 'db.php';


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
<form method="post" action="">  
<div id="page-wrapper">
  <h1>Select the ingredients</h1>
    
  <label for="ajax">Pick an ingredient</label>
  <input type="text" name="ingredient" id="ajax" list="json-datalist" placeholder="e.g. datalist" autocomplete="off" required>
  <datalist id="json-datalist"></datalist>

  
<input type="submit" value="Add more ingredients"  name = "more_ingredients" >

</div>
</form>


<?php
$n=0;
$flag=1;

if($_SERVER["REQUEST_METHOD"]=="POST")
{

if(isset($_POST["more_ingredients"]))
{

if(isset($_POST["ingredient"]))
{
  $x=$_POST["ingredient"];


  
  $sql = "Select r_id from ingredients where r_ingredients='$x'";
  if($res = mysqli_query($mysqli,$sql))
    if($r=mysqli_fetch_assoc($res))
  {



    if(!isset($_SESSION["ingredients"]))
    {
      $_SESSION["ingredients"][0]=$x;

    }
    else
    {
      $n = count($_SESSION["ingredients"]);

      for($i=0;$i< $n;$i++)
      {

        if(!strcmp($x,$_SESSION["ingredients"][$i]))
        {
          $flag=0;
          break;
        }
      }
      if($flag)
      {
          array_push($_SESSION["ingredients"],$x);
//print_r($_SESSION["ingredients"]);
//$count= sizeof($_SESSION("ingredients"));
      }

    }
  }
    else
{
  echo "Select something from the options !";
}



if(isset($_SESSION['ingredients']))
{
 $n = count($_SESSION["ingredients"]);


//$count = sizeof($_SESSION("ingredients"));

for($i=0;$i< $n;$i++)
{
echo '<ul><li> '. $_SESSION["ingredients"][$i] . '</li></ul>';
}
}




}


}
}

?>
<br>
<br>
<br>
<br>
<br>
<div id='page-wrapper'>
<form method = "post" action = "searchByIngredients.php">

<input type="submit" name="search" value="search">
</form>
</div>
<script>

// Get the <datalist> and <input> elements.
var dataList = document.getElementById('json-datalist');
var input = document.getElementById('ajax');

// Create a new XMLHttpRequest.
var request = new XMLHttpRequest();

// Handle state changes for the request.
request.onreadystatechange = function(response) {
  if (request.readyState === 4) {
    if (request.status === 200) {
      // Parse the JSON
      var jsonOptions = JSON.parse(request.responseText);
    
  
      // Loop over the JSON array.
      jsonOptions.forEach(function(item) {

 
        // Create a new <option> element.


        for(var i = 0;i<item.ingredients.length;i++){
   
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = item.ingredients[i].name;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);}
      });
      
      // Update the placeholder text.
      input.placeholder = "e.g. beef";
    } else {
      // An error occured :(
      input.placeholder = "Couldn't load datalist options :(";
    }
  }
};

// Update the placeholder text.
input.placeholder = "Loading options...";

// Set up and make the request.
request.open('GET', 'recipes.json', true);
request.send();


</script>


</body > 
</html > 


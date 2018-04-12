<?php
session_start();
include 'db.php';
include 'feedback/comments.php';															

if(isset($_GET['r_id']))
{
	$_SESSION['r'] = $_GET['r_id'];

}

if($_SERVER['REQUEST_METHOD']!='POST'){
	//ECHO 44;
if ( !isset( $_SESSION["origURL2"] ) ){
	//ECHO 55;
    $_SESSION["origURL2"] = $_SERVER["HTTP_REFERER"];
}
}

// echo $_SERVER['PHP_SELF'];
// echo $_SERVER['HTTP_REFERER'];


$r_id = $_SESSION['r'];
if(isset($_SESSION['u_id']))
 $u_id=$_SESSION['u_id'];

?>



<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link href='feedback/style.css' rel='stylesheet' type='text/css'>
</head>

<style>
body {
	background-color: #ffffff
}
</style>
<body >



<?php




if($_SERVER['REQUEST_METHOD']=='POST')
{


	 // $u_id=$_SESSION['u_id'];
	//  echo 44;
	  if(isset($_POST["like"]))
	 	{
	 		
			$like_query = "Update recipe set r_likes = r_likes+1 where r_id=".$r_id  ;
			//echo $like_query;
			$res=mysqli_query($mysqli,$like_query);
			if(!$res)
				echo mysqli_error($mysql);
			$like_query = "Insert into like_dislike(user_id,r_id,likes) values ($u_id,$r_id,1)";
			$res=mysqli_query($mysqli,$like_query);
			if(!$res)
				echo mysqli_error($mysql);
			$msg= "Likes your recipe-";
			setnotifications($mysqli,$r_id,$msg);
	    //$notification_query="Insert into notifications"
	    }
	  else if(isset($_POST['dislike']))
		{
			$dislike_query = "Update recipe set r_dislikes = r_dislikes+1 where r_id=".$r_id ;
			$res=mysqli_query($mysqli,$dislike_query);
			if(!$res)
				echo mysqli_error($mysql);
			$dislike_query = "Insert into like_dislike(user_id,r_id,dislikes) values ($u_id,$r_id,1)";
			$res=mysqli_query($mysqli,$dislike_query);
			if(!$res)
				echo mysqli_error($mysql);
			$msg= "Dislikes your recipe-";
			setnotifications($mysqli,$r_id,$msg);
		    //$notification_query="Insert into notifications"
		}
	  else if(isset($_POST['like_afterdislike']))
		{
			$like_query = "Update recipe set r_dislikes = r_dislikes-1,r_likes = r_likes+1 where r_id=".$r_id ;
			$res=mysqli_query($mysqli,$like_query);
			if(!$res)
				echo mysqli_error($mysql);
			$like_query = "Update like_dislike set likes=1,dislikes=0 where user_id = $u_id and r_id = $r_id";
			$res=mysqli_query($mysqli,$like_query);
			if(!$res)
				echo mysqli_error($mysql);
			$msg= "Likes your recipe-";
			setnotifications($mysqli,$r_id,$msg);
		    //$notification_query="Insert into notifications"
		}
	  else if(isset($_POST['dislike_afterlike']))
		{
			$dislike_query = "Update recipe set r_likes = r_likes-1,r_dislikes = r_dislikes+1 where r_id=".$r_id ;
			$res=mysqli_query($mysqli,$dislike_query);
			if(!$res)
				echo mysqli_error($mysql);
			$dislike_query = "Update like_dislike set likes=0,dislikes=1 where user_id = $u_id and r_id = $r_id";
			$res=mysqli_query($mysqli,$dislike_query);
			if(!$res)
				echo mysqli_error($mysql);
			$msg= "Dislikes your recipe-";
			setnotifications($mysqli,$r_id,$msg);
		    //$notification_query="Insert into notifications"
		}
	}





   $recipe_query = " Select r.r_id,r.r_name,r.r_likes,r.r_dislikes,r.r_imageurl,r.user from recipe r where r.r_id = ".$r_id  ;

 $ingredient_query = "Select r_ingredients from ingredients where r_id=$r_id";
 $step_query = "Select s.r_step_number,s.r_step,s.r_step_time from steps s where s.r_id = ". $r_id ;
 $comment_query = " Select c.cid,c.uid,c.date,c.message from comments c where c.r_id = ".$r_id  ;

 if(($res=mysqli_query($mysqli,$recipe_query)) )
 {
 	

	 	if($r=mysqli_fetch_assoc($res))
	 	{
	 		echo '<h1>'.$r['r_name'].'</h1>';

	 		echo '<img src=" '.$r['r_imageurl'].' "  height=350px width =550px ></img>';

	 		echo '<h4>Likes :'.$r['r_likes']. '</h4>';

	 		echo '<h4>Dislikes :'.$r['r_dislikes']. '</h4>';

	 		echo '<h4>User :'.$r['user']. '</h4>';
	 	}



 }


if(!isset($_SESSION['logged_in']))
echo '<a href="Login/index.php"> You need to be logged in to like or comment</a>';
else
{

	$u_id = $_SESSION['u_id'];
	$sql = "Select * from like_dislike where user_id = $u_id and r_id = $r_id";
	$res = mysqli_query($mysqli,$sql);
	echo "<form method='POST' action=''>";
	if($r=mysqli_fetch_assoc($res))
	{
		if($r['likes'] == 1)
		{
			echo "You have liked this recipe";
			echo "<input type='submit' name='dislike_afterlike' value='dislike'><br>";


		}
		else
		{
			echo "You have disliked this recipe";
			echo "<input type='submit' name='like_afterdislike' value='like'><br>";
		}
	}

	else
	{
		echo "<input type='submit' name='like' value='like'><br>";
echo "<input type='submit' name='dislike' value='dislike'><br>";
	}
	echo "</form><br>";


    echo "<hr>";
    echo "<h2>Comments</h2>";

    echo "<form method='post' action='".setComments($mysqli)."'>
		<input type='hidden' name='uid' value='".$u_id."'>
		<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
		<textarea name='message'></textarea><br>
		<button type='submit' name='commentSubmit'> Comment </button>
	    </form> <br>";

}


echo "<hr>";
echo "<h2>Comments</h2>";

// echo "<form method='post' action='".setComments($db)."'>
// 		<input type='hidden' name='uid' value='".$u_id."'>
// 		<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
// 		<textarea name='message'></textarea><br>
// 		<button type='submit' name='commentSubmit'> Comment </button>
// 	  </form> <br>";


getcomments($mysqli);



echo "<hr>";

echo "<h2>Ingredients</h2>";

if($res=mysqli_query($mysqli,$ingredient_query))
{
	while($r=mysqli_fetch_assoc($res))
	{
		echo $r['r_ingredients']."<br>";
	}
}

echo "<hr>";
echo "<h2>Steps</h2>";

if($res=mysqli_query($mysqli,$step_query))
{
	while($r=mysqli_fetch_assoc($res))
	{
		echo "<h3>".$r['r_step_number']."...".$r['r_step']."<br>Time required : ".$r['r_step_time'] ;
	}
}


echo "<br><br>";
echo "<a href = '".$_SESSION["origURL2"]."'>Back</a>";

echo "<br><br>";
echo "<a href = 'main.php'>Back to main page</a>";




?>


</body>
</html>
 	   <!-- 
 	   	<form  method = "post" action=''>
  <input type='submit' name="like" value='like'> Like<br>
  <input type='submit' name='dislike' value='dislike'> Dislike<br>
  
</form> <br> -->
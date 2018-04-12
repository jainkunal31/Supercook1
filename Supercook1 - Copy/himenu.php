<?php
require 'db.php';
session_start();
include 'feedback/comments.php';

?>

<html>
<head></head>
<body >

<?php


// if(isset($_POST["search"]))
// {
//     $name=$_SESSION['recipe'];
// }






    // // $sql = "Select r.r_id,r.r_name,r.r_imageurl,i.r_ingredients,s.r_step_number,s.r_step,s.r_step_time from recipe r";
        $sql = "Select r_id as id from recipe where isapproved=1";
     $res = mysqli_query($mysqli,$sql);
     $x=0;
    // $flag=0;
    // $ingredient_query = [];
    // $step_query = [];
     while($r = mysqli_fetch_assoc($res))
     {
       // if($r['id']<8)
        
           $ingredient_query[$x] = " Select r.r_id,r.r_name,r.r_likes,r.r_dislikes,r.r_imageurl,i.r_ingredients from recipe r inner join ingredients i on r.r_id = i.r_id where r.r_id = ".$r['id'] ;

           // $step_query[$x]="Select r.r_id,s.r_step_number,s.r_step,s.r_step_time from recipe r inner join steps s on r.r_id = s.r_id where r.r_id = ". $r['id'] ;
           //  $comment_query[$x] = " Select r.r_id,c.cid,c.uid,c.date,c.message from recipe r inner join comments c on r.r_id = c.r_id where r.r_id = ".$r['id']  ;
            //echo '<br>'.$ingredient_query[$x].'<br>';
           //  echo '<br>'.$step_query[$x].'<br>';
            $x++;
        
     }

    if(!$res)
    {
        $result = new stdClass();
        $result->status = false;
        $result->msg = mysqli_error($mysqli);
        echo json_encode($result);
        exit;
    }



      echo '  <table cellpadding="10">

            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th>Ingredients</th>
                
            </tr> ';

        
    //echo $x;
     for($i=0;$i<$x;$i++)
     {
        $sql_ingredient = $ingredient_query[$i];
        // $sql_step = $step_query[$i];
        // $sql_comment = $comment_query[$i];
        $res_ingredient= mysqli_query($mysqli,$sql_ingredient);
        // $res_step= mysqli_query($mysqli,$sql_step);
        // $res_comment= mysqli_query($mysqli,$sql_comment);
        $rows = $res_ingredient->num_rows;
        $flag=0;
        // $rows_step = $res_step->num_rows;
        // $rows=$rows_ingredient>$rows_step?$rows_ingredient:$rows_step;
      
        //echo $rows;
       // $flag=$rows;
        //echo $flag;



    //     while($r = mysqli_fetch_assoc($res_ingredient))
    //     {

    //     for($j=0;$j<$length;$j++)
    //     {
    //         if($_SESSION['ingredients'][$j]==$r['r_ingredients'])
    //         {
    //             $flag--;

    //             break;
    //         }
    //     }
    // }
    //echo $flag;
    
    // if($flag)
    //     continue;
   
   // $res_ingredient= mysqli_query($mysqli,$sql_ingredient);

        while($r = mysqli_fetch_assoc($res_ingredient))
        {
            

              //$flag=0;

            if($flag==0)
            {


            echo '

                                        <tr >
                                            <th rowspan=" '. ($rows+1) .' " >
                                                <a href="recipeDetail.php?r_id='.$r['r_id'].' ">
                                                    <img src=" '.$r['r_imageurl'].' "  height=150px width =150px>
 
                                               </a>

                                            </th>

                                            <td rowspan="'.( $rows+1 ).'" align="center"> ';
                                                
                                         echo $r['r_name'];
                                                        
                                                
                                           echo ' </td>

                                             <td rowspan="'.( $rows+1 ).'" align="center"> ';
                                                
                                         echo $r['r_likes'];
                                                        
                                                
                                           echo ' </td>

                                             <td rowspan="'.( $rows+1 ).'" align="center"> ';
                                                
                                         echo $r['r_dislikes'];
                                                        
                                                
                                           echo ' </td>
                                        </tr>';

       
        $flag = 1;
        
         } 
                                   echo '  <tr>

                                            <td colspan = "1" align = "center">
                                                ' . $r['r_ingredients'] . ' 
                                            </td>
                                            
                                        </tr> ';





 } 

}


   //getcomments($mysqli);




        


    

    ?>
        </table>
    </body>
    </html>


    




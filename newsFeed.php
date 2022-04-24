<?php 
session_start();
    require ("object.php");
        require('head.html');
        require("nav.php");
if(empty( $_SESSION['name']))
{
    header("Location:index.php"); 
}
    $_SESSION['error_while_posting_feed'] = "<i style='color:green; font-size:13px;'>Post a news feed</i>";
       
        $get_current_user = $_SESSION['name'];

        $get_object_properties = new Database_object_oriented_index();
        $get_connection_to_database = $get_object_properties->connect_to_database_function();
        if ($get_connection_to_database)
        {
            if ($_SERVER["REQUEST_METHOD"] =  "POST" &&  isset($_POST["sendFeed"]))
            {
                 $get_image_source = $_FILES['news_Feed_image']['tmp_name'];
                       $get_image_destination = 'feedImage/'.  $_FILES['news_Feed_image']['name'];
                          $get_image_size = $_FILES['news_Feed_image']['size'];
                       $get_status = $_POST['status'];
                       $get_date_posted = date("d-m-y");
                     $connect_to_add_new_feed = $get_object_properties->news_feed($get_current_user, $get_status, $get_image_destination,  $get_image_size, $get_image_source, $get_date_posted);
                     if($connect_to_add_new_feed = false)
                     {
                         echo $connect_to_add_new_feed;
                        
                        echo "<script>
                        alert('Something went wrong')
                        
                               </script>";
                     }
                   


            }
            elseif ($_SERVER["REQUEST_METHOD"] = "POST" && isset($_POST["sendCoomment"]) ) 
            {
            //     # code...
                      $get_comment = $_POST["comment"];
                    $get_commentor = $_SESSION['name'];
                   $get_feed = $_GET["feed_id"];
                $feeder = $_GET['feeder'];
           
               $sql = "INSERT INTO `comment` (`comment`, `commentor`,`feed`, `feeder`)
               VALUES ('$get_comment', '$get_commentor', '$get_feed', '$feeder')";
               $result = $get_connection_to_database->query($sql);
               if (!$result) {
                  echo 'an error has occured';
                   
               }
               else {
                   echo '<script>
                   alert("commented successfully")
                   
                          </script>';
               }

            }
         
        }


?>
<style>
  #takeNav{
  display: block;
  padding:20px 30px 50px 10px;
}
@media (max-width: 520px) {
  #takeNav{
  display: none;
}
}
</style>
<div class = "row bg-light" style = "border-color:2px solid" >
    <div class = "col-sm-12 col-md-4 col-lg-4 " style = "border-color:2px solid" id = 'takeNav'>
    <strong style = 'margin-left:20%'>Friends</strong>
    <?php 

   $callingObjectClass = new  Database_object_oriented_index();
   $connect = $callingObjectClass->connect_to_database_function();
   if ($connect){
    $user =  $_SESSION['name'];

      $sql = "SELECT DISTINCT `receiver` FROM `messages`  WHERE  `sender` = '$user'  AND  `receiver` != '$user' ";
      $result = $connect->query($sql);
      if ($result->num_rows > 0)
      {

                while($row = $result->fetch_assoc())
                {

                        $chatted =   $row['receiver'];
                        $sql = "SELECT `id`,`email` FROM `users` WHERE `username` = '$chatted' ";
                        $innerResult = $connect->query($sql);
                        if($innerResult-> num_rows > 0)
                        {
                            while ($innerRow = $innerResult->fetch_assoc()) 
                            {
                                //get last chatted id number to get new messages
                                $sql = "SELECT `id`, `message` from `messages` WHERE `sender` = '$chatted' AND `receiver` = '$user'  ORDER BY `id` DESC LIMIT 1";
                                $idResult = $connect->query($sql);
                                if($idResult->num_rows > 0){
                                    while ($idRow = $idResult->fetch_assoc()) {
                                        # code...
                                        $sendingId = $idRow['id'];
                                        $getMessage = $idRow['message'];
                                    

                                    }
                                }

                                        $userId = $innerRow['id'];
                                        $email = $innerRow['email'];
                                        
                                        $sql = "SELECT `message`, `id` FROM `messages` WHERE `receiver` = '$chatted' AND `sender` = '$user' ORDER BY `id` DESC LIMIT 1";
                                        $innestResult = $connect->query($sql);
                                        if ($innestResult ->num_rows > 0)
                                        {
                                            while ($innestRow = $innestResult->fetch_assoc()) 
                                            {
                                                    $message =  $innestRow['message'];
                                                    $myLastTextId = $innestRow['id'];


                                                    $sql = "SELECT  `image` from `profile` WHERE `username` = '$chatted' ";
                                           
                                                $innerResult = $connect->query($sql);
                                                if($innerResult->num_rows > 0)
                                                {
                                                        while ($innerRow  = $innerResult->fetch_assoc()) 
                                                        {
                                                            $get_current_user_image = $innerRow['image'];
                                                            if ( isset($sendingId ) )
                                                             {
                                                                # code...
                                                                 if ($sendingId > $myLastTextId )
                                                                 {
                                                                        $newMessage = $sendingId - $myLastTextId;
                                                                           $lastMessage = $getMessage;
                                                                 }elseif($sendingId < $myLastTextId)
                                                                 {
                                                                     $lastMessage = $message;
                                                                        $newMessage = null;
                                                                        $sendingId = null; 
                                                            }
                                                            }
                                                       
                                                       
                                                            echo "
                                                            
                                                            <div id = 'friendList' >
                                                            <div id = 'imgIcon'>
                                                                    <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                                    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                            </div>
                                                            <div id = 'sep' >
                                                                <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                                <p style = 'font-size:10px;'>"; 
                                                                if(isset($lastMessage)) echo $lastMessage;
                                                                echo "</p>
                                                            </div>
                                                            <div id = 'info' style = 'float:right;'>";
                                                            if ($newMessage) {
                                                                # code...
                                                                echo "
                                                           
                                                                <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;font-size:13px;color:white'></p> </center>";
                                                           
                                                            }
                                                            echo " </div>
                                                         </div>
                                                         <center> <hr></center> ";
                                                        
                                                        }
                                                }
                                                else
                                                {if ( isset($sendingId ) )
                                                    {
                                                       # code...
                                                        if ($sendingId > $myLastTextId )
                                                        {
                                                               $newMessage = $sendingId - $myLastTextId;
                                                                  $lastMessage = $getMessage;
                                                        }elseif($sendingId < $myLastTextId)
                                                        {
                                                            $lastMessage = $message;
                                                               $newMessage = null;
                                                               $sendingId = null; 
                                                   }
                                                   }
                                              
                                                    echo "
                                                    <div id = 'friendList'>
                                                    <div id = 'imgIcon'>
                                                            <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                            <img src='images/user.png' alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                    </div>
                                                    <div id = 'sep' >
                                                        <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                      
                                                    </div>
                                                 
                                            </div>
                                        <center> <hr></center> ";  
                                                }
                                      
                                                   
                                            }
                                        }
                                    

                            }
                        }
        
                }
      
          }
          else
          {
              echo 'Your chats would be displayed here';
          }
         
       
      }
?>

    </div>

    <div class = "col-sm-12 col-md-4 col-lg-4" style = "border-color:2px solid">
    <center>
     
     <form method ="post" action ="newsFeed.php" enctype ='multipart/form-data'> 
     <div style = "width:100%;margin-top:10px; background-color:white;border-radius:20px; padding:20px 15px 15px 10px;">
         <label style = 'border-radius:50%; width:10%; height :28px;margin-top:10px;float:left; margin-right:10px;'>
                                     <img alt = 'icon' src = 'images/file.png' width = '100%' height = '25px' required>
                                     <input required type = 'file' name = 'news_Feed_image' style = 'display:none';/>
                                   </label>
                                   <input class = 'form-control bg-light' placeholder = 'Whats on your mind' required type = 'status' name = 'status' value 
                                             style = ' width:60%;float:left;border-radius:30px;' />
                                   <input class = 'btn btn-primary' type="submit" value = 'Upload'  name = 'sendFeed' 
                                   style="font-size:15px;margin-top:0px;width :20%; height:40px;float:right;" /><br><br>
                                  <i style='color:red; font-size:13px;;margin-top:-30px;'><?php 
                    if (isset($_SESSION['error_while_posting_feed']))
                        {
                              echo $_SESSION['error_while_posting_feed'];
                        }                                                                            
                        else
                        {
                             echo"  <i style='color:green; font-size:13px;'>Post a news feed</i>";
                        }
                      ?>
                     
                     
              </i>
                                  
     </div>
                              
 
 
     </form>
     
     
     <div  id = 'fetch_news_feed'>
         
         <p>News Feed Would Be Displayed Here.</p>
     
 
 </div>
 </center>   
       
    </div>


    <div class = "col-sm-12 col-md-4 col-lg-4 " style = "border-color:2px solid" id = 'takeNav'>
         
    
    <?php  
  
  $sender = $_SESSION["name"];
          $Object_oriented_index = new Database_object_oriented_index();


 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
              $group_name = $Object_oriented_index->test_data($_POST["group_name"]);
              $group_desc  = $Object_oriented_index->test_data($_POST["group_desc"]);
              
                if (!preg_match("/^[a-zA-Z ]*$/",$group_name)) 
                {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                }

                   if (!preg_match("/^[a-zA-Z ]*$/",$group_desc)) 
                   {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                   }

                $source = $_FILES['profile_pic']['tmp_name'];
                $destination =  'images/'.  $_FILES['profile_pic']['name'];
                $imageSize =  $_FILES['profile_pic']['size'];
                   $filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));

              if($_FILES['profile_pic']['size'] > 400000)
              {
                  $_SESSION['errForGroup'] = "file too large";
              }

              else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg")
              {
                $_SESSION['errForGroup'] = "";
              }

              else
              {
                 $_SESSION['errForGroup'] = "Failed";
              }    
    if(empty($_SESSION['errorForGroup']))
    {      
                  $check_connection_to_create_group = $Object_oriented_index->connect_to_database_function();
        if($check_connection_to_create_group == true)
        {
                    if(file_exists($destination))
                    {
                      $_SESSION['errForGroup'] = "Choose another image ";
                    }

                    else if( file_exists("groups/$group_name.txt"))
                    {
                      $_SESSION['errForGroup'] = "Group Name already exist ";
                    }

                    else
                    {
                          if(move_uploaded_file($source,$destination))
                          {
                                      $uploaded_image = $destination;
                                             $sql = "INSERT INTO `groups` (`name`,`description`,`img`,`creator`) 
                                             VALUES ('$group_name','$group_desc','$uploaded_image' ,'$sender')";
                                      $result = $check_connection_to_create_group->query($sql);
                            if($result > 0){
                              echo'<script>alert("Your group has been created successfully")</script>';
                              $f_myfile =   fopen("groups/$group_name.txt", "a+");
                              fclose($f_myfile);
                        
                            }

                            else
                            {
                               $_SESSION["errForGroup"]= "Image cannot be saved";
                            }

                        }
                    }
                  
    
     }


    }

  }




?>


                   
                <div id = "grouparea" style = 'width:75%;margin-left:13%;' >
                      <div id = "available_groups" style= 'height:350px'>
                      </div>
                          
                    
                     

                </div>
      
          
<?php

include("footer.php")
?>
    </div>


</div>

  

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
<center>
    <form method ="post" action ="newsFeed.php" enctype ='multipart/form-data'> 
    <div style = "width:380px;margin-top:10px;">
        <label style = 'border-radius:50%; width:35px; height :28px;margin-top:10px;float:left; margin-right:10px;'>
                                    <img alt = 'icon' src = 'images/file.png' width = '30px' height = '25px' required>
                                    <input required type = 'file' name = 'news_Feed_image' style = 'display:none';/>
                                  </label>
                                  <input class = 'form-control' placeholder = 'Whats on your mind' required type = 'status' name = 'status' value 
                                            style = 'margin-right:0px; width:250px;float:left; border-top:none;border-right:none;border-left:none' />
                                  <input class = 'btn btn-light' type="submit" value = 'Upload'  name = 'sendFeed' 
                                  style="font-size:15px;margin-top:0px;width :80px; height:40px;float:right;margin-left:-10px;padding-bottom:15px;" /><br><br>
                                  <i style='color:red; font-size:13px;margin-left:-50px;margin-top:-30px;'><?php 
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
        <center>
            <p>News Feed Would Be Displayed Here.</p>
        </center>
        

    </div>
</center>   
<?php 
    require ("object.php");
        require('head.php');
if(empty($_SESSION['name']))
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
            elseif($_SERVER["REQUEST_METHOD"] = "POST" && isset($_POST["sendFeedback"])){
             $username = $_SESSION["name"];
              $feedback = $_POST['feedback'];
              if (!preg_match("/^[a-zA-Z ]*$/",$feedback)) 
                          {
                              $_SESSION["feedbackError"] = "<span style='color:red;'>Only letters and white space allowed for feedback</span>";
                          }else{
                            $sql = "INSERT INTO `websiteComment` (`username`, `comment`) VALUES ('$username','$feedback')";
                            $result = $get_connection_to_database->query($sql);
                            if(!$result){
                              $_SESSION["feedbackError"] = "<span style='color:red;'>Feedback not sent</span>";
                            }else{
                              $_SESSION["feedbackError"] = "";
                            }
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
<div class = "row ">
  <div class = "col-sm-12 col-md-4 col-lg-4" " id = 'takeNav'>
            <!-- this is the block of code for friends in the newsfeed page -->
           <?php require('queryFriends.php'); require('commentToWeb.php') ?>
    </div>

    <div class = "col-sm-12 col-md-4 col-lg-4">
     <!-- this is the block of code for newsfeed in the newsfeed page!-->
     <?php require('queryFeeds.php') ?>
       
    </div>

    <div class = "col-sm-12 col-md-4 col-lg-4 " id = 'takeNav'>
          <!-- this is the block of code for groups in the newsfeed page!-->
          <?php require('queryGroups.php') ?>
    </div>


</div>

<?php

include("footer.php")
?>

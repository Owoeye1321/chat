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
<?php    
require('head.php');
require('object.php');             
// $_SESSION["error_while_sending_file"] = "An error has occured";
      
      $callingObjectClass = new  Database_object_oriented_index();
      $check_connection_to_database = $callingObjectClass->connect_to_database_function();

         
            if(isset($_GET["userId"]))
            {
                    $userId = $_GET['userId'];  
                    if ($check_connection_to_database == true){
                    $sql = "SELECT `username` FROM `users` WHERE `id` = $userId";
                    $result = $check_connection_to_database->query($sql);
                     if($result->num_rows > 0)
                      {      

                          //Output data of each rows
                          while($row = $result->fetch_assoc())
                          {
                          $_SESSION["friendUsername"] = $row["username"];
                          }
                      }                                               
                    }
            }
                if(isset($_SESSION["friendUsername"]))
                {                                                                         
                $friendUsername = $_SESSION["friendUsername"];
                }
                    if(isset($_SESSION["name"]))
                    {
                      $username = $_SESSION['name'];
                    }

        if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["submit_messages"]))
        {
          //echo'<script>alert("Working on both image and messages")</script>';
          $get_image_source = $_FILES['message_with_a_file']['tmp_name'];
                   $get_image_destination = 'SentImage/'.  $_FILES['message_with_a_file']['name'];
                      $get_image_size = $_FILES['message_with_a_file']['size'];
                      $sender = $username;
                      $receiver = $friendUsername;
                         $message = $_POST["chat"];
                      if(!$get_image_source && $message){

                         $send_message_to_database = $callingObjectClass->send_message_to_database($sender,$receiver,$message);
                         if($send_message_to_database == true){
                          echo'<script>alert("Message going good")</script>';
                         }
                                      
                      }else if($get_image_source && !$message){
                              $send_image_to_database = $callingObjectClass->send_message_file_to_database($sender,$receiver,$get_image_destination, $get_image_size, $get_image_source);
                          if($send_image_to_database == true){
                            echo'<script>alert("Image going good")</script>';
                          }

                      }else if(!$get_image_source && !$message){
                        echo'<script>alert("No message sent or file attached")</script>';


                      }else if($get_image_source && $message){
                       echo'<script>alert("Both messages for sending has been received")</script>';


                       echo $get_image_source;
                       echo $message;
                      }
                            
                        
           
              
        }
  



       
        $sql = "SELECT DISTINCT `status` FROM `users` WHERE `username` = '$friendUsername'";
           $result = $check_connection_to_database->query($sql);
             if($result->num_rows > 0 )  { while ($row = $result->fetch_assoc()) { $friendStatus =  $row['status'];} }    
        

?>
    <body>
    <div class = 'row bg-dark'>

<div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;' >
   <!-- this is the block of code for mychat in the mychat page!-->
   <div class = " p-2 " style="border-radius: 20px;">
              <p style = "color:white;">
                <?php echo "Dear  $username" ;?>
              </p>
                          
                <div id = "chatarea" class = 'bg-white p-4' style= 'width:100%;padding-bottom:10px;'>
                    
                          <strong onClick = getUserProfile() ><?php echo $friendUsername?></strong><br>
                       
                      <i style = 'font-size:13px;margin-bottom:20px;color:green'>
                      <?php if ($friendStatus == "Online") echo $friendStatus; echo "<i style = 'color:black;'>"?> <?php echo $friendStatus; echo  "</i>" ?></i>

                        <div class = 'bg-dark' id = "mainchat" style = 'width:100%;margin-top:10px;padding-right:8px;'>
                                  <p >Chat Interface </p>
                                  <p >Chat Interface</p>
                        </div>
                      
                          <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype ="multipart/form-data">
                          <div style = "margin-left:10px">
                            <!-- <i style="color:red; font-size:13px;"> <?php //if (isset($_SESSION["error_while_sending_file"])) {
               //   echo $_SESSION["error_while_sending_file"];}?>
                </i> -->
                          <input class="form-control my-2" name = "chat" placeholder= "Chat here" style="border-radius:30px; width:65%;margin-left:10px;float:left;margin-right:10px;"/>
                          <label style = 'border-radius:50%; width:10%; height :28px;margin-top:5px;float:left; margin-right:3px;'>
                                     <img alt = 'icon' src = 'images/file.png' width = '100%' height = '40px' >
                                     <input  type = 'file' name = 'message_with_a_file' style = 'display:none;'/>
                                   </label>
                          <input class = 'btn btn-primary' name='submit_messages' type="submit" value = 'Send' style="margin-top:5px; height:40px; float:left;" />
                         
                          </div>
                                  
                          </form> 
                </div> 
                
                
            
          </div>
          <!-- <div class = "takeWheneverOnMobile" style = "display:none">
               <?php  //require('queryFriends.php'); ?>
          </div> -->

</div>

      <div class = "col-sm-12 col-md-4 col-lg-4"  id = 'takeNav'>
         <!-- this is the block of code for newsfeed in the mychat page!-->
         <?php require('queryFeeds.php') ?>
      </div>

<div class = "col-sm-12 col-md-4 col-lg-4" id = 'takeNav' >
   <!-- this is the block of code for mychat in the mychat page!-->
   <?php require('queryGroups.php') ?>
</div>

</div>

         
         
          
          
 <?php


          include("footer.php")
?>
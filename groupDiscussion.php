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
    $callingObjectClass = new  Database_object_oriented_index();
        $check_connection_to_database = $callingObjectClass->connect_to_database_function();
 if(isset($_GET["userId"]))
 {
        $userId = $_GET['userId'];  
      if ($check_connection_to_database == true)
      {
          $sql = "SELECT * FROM `groups` WHERE `id` = $userId";
           $result = $check_connection_to_database->query($sql);
          if($result->num_rows > 0)
          {              
            //Output data of each rows
            while($row = $result->fetch_assoc())
            {
              $_SESSION["group_name"] = $row["name"];
              $_SESSION["group_desc"] = $row["description"];
            }
          }                                               
      }
 }
      if(isset($_SESSION["group_name"]))
      {                                                                         
        $group_name = $_SESSION["group_name"];
      }
      if(isset($_SESSION["group_desc"]))
      {                                                                         
        $group_desc = $_SESSION["group_desc"];
      }
      if(isset($_SESSION["name"])){
        $username = $_SESSION['name'];
      }



if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["submit_group_messages"]))
{
        $sender = $username;
        
        $message = $_POST["groupchat"];   

        if($check_connection_to_database == true)
        {
              if($message)
              {
                    $sql = "INSERT INTO `GroupMessages` (`GroupName`,`sender`,`message`,`image`) VALUES ('$group_name','$sender','$message','')";
                       $result = $check_connection_to_database->query($sql);
                    if($result > 0)
                    {                                                  
                    // echo "success";     
                    }

                    else
                    {
                      echo "unable to save message";
                      echo $sender ,$group_name,$message;
                    
                    }

              }
              else
              {
              header("location:groupDiscussion.php");
              }
            
            }
            
        else
        {
          echo "unable to load database";
        }
 
}

?>
      

    <body>
    <div class = 'row bg-dark'>

<div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;' id = 'takeNav' >
   <!-- this is the block of code for mychat in the mychat page!-->
              <div class = ' p-3 my-3 border  bg-white' style='border-radius: 20px;'>
                                <strong style ='color:black;margin-left:10px;'margin-bottom:20px;'> Find Friends, <?php echo $username ?></strong> 
                                  <div id = 'formDiv' style = 'height:600px'>

                                          <div id = 'formScroll' ' style = 'height:600px'>
                                                  <div style = 'margin-top:10px;width:100%;margin-left:0%;' id = 'demo'>
                                                  
                                                  </div>
                                            </div>
                                      </div>
                        </div>

                
</div>

      <div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;'  id = 'takeNav'>
         <!-- this is the block of code for newsfeed in the mychat page!-->
         <?php require('queryFeeds.php') ?>
      </div>

<div class = "col-sm-12 col-md-4 col-lg-4">
   <!-- this is the block of code for mychat in the mychat page!-->
  
<div class = "container p-3 my-3 " style="border-radius: 20px;">
                <p style="color:white;"><?php 
                 echo "Dear  $username";?>
                </p>
            
             <div id = "grouparea" class= 'bg-white' style = 'width:100%;margin-left:0%;height:580px;'>
                        <h3>
                              <?php echo $group_name; ?>
                        </h3>
                        <p><?php echo $group_desc;?>
                        </p>
                    <div id = "groupChatMessage" style = 'background-color:black;width:100%;padding-top:10px;margin-left:-5px;height:380;margin-bottom:30px;'>
                         <p >Your group messages would be displayed here. </p>

                    </div>
                  <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                     <!-- <input class="form-control" name = "groupchat" placeholder= "Chat here" style="margin-top: 5px; width:70%;margin-left:20px;float:left;border-radius:20px;"/>
                         <input  class = 'btn btn-primary' type="submit" value = 'Send' style="margin-top:1px; height:40px;" /> -->

                         <input class="form-control my-2" name = "groupchat" placeholder= "Chat here" style="border-radius:30px; width:65%;margin-left:10px;float:left;margin-right:10px;"/>
                          <label style = 'border-radius:50%; width:10%; height :28px;margin-top:5px;float:left; margin-right:3px;'>
                                     <img alt = 'icon' src = 'images/file.png' width = '100%' height = '40px' >
                                     <input  type = 'file' name = 'message_group_with_a_file' style = 'display:none;'/>
                                   </label>
                          <input class = 'btn btn-primary' name='submit_group_messages' type="submit" value = 'Send' style="margin-top:5px; height:40px; float:left;" /><br>
                       
   
                  </form> 
            </div> 
   
  
    
 </div>
    
</div>

</div>

     
          
          
 <?php

          include("footer.php")
?>
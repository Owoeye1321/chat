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



if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["groupchat"]))
{
        $sender = $username;
        
        $message = $_POST["groupchat"];   

        if($check_connection_to_database == true)
        {
              if(!empty($message))
              {
                    $sql = "INSERT INTO `GroupMessages` (`GroupName`,`sender`,`message`) VALUES ('$group_name','$sender','$message')";
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
    <div class = 'row' '>

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

<div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;'  >
   <!-- this is the block of code for mychat in the mychat page!-->
  
<div class = "container p-3 my-3 border" style="border-radius: 20px;">
                <p style="color:black;"><?php 
                 echo $username;?>
                </p>
            
             <div id = "grouparea" class= 'bg-white' style = 'width:100%;margin-left:0%;'>
                        <h3>
                              <?php echo $group_name; ?>
                        </h3>
                        <p><?php echo $group_desc;?>
                        </p>
                    <div id = "groupChatMessage" style = 'background-color:black;width:100%;padding-top:10px;margin-left:-5px'>
                         <p >Your group messages would be displayed here. </p>

                    </div>
                  <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                     <input class="form-control" name = "groupchat" placeholder= "Chat here" style="margin-top: 5px; width:70%;margin-left:20px;float:left;border-radius:20px;"/>
                         <input type="image" src = "images/send-icon.png" style=";margin-top:1px;width :40px; height:40px;" />
   
                  </form> 
            </div> 
   
  
    
 </div>
    
</div>

</div>

     
          
          
 <?php

          include("footer.php")
?>
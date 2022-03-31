<?php          
session_start();         
if (empty($_SESSION["name"]))
{                           
  header("Location:index.php");                          

}
    require('nav.php');
    require('head.html');
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
<div class = "container p-3 my-3 border bg-primary" style="border-radius: 20px;">
                <p style="color:white;"><?php 
                 echo $username;?>
                </p>
            
             <div id = "grouparea">
                        <h3>
                              <?php echo $group_name; ?>
                        </h3>
                        <p><?php echo $group_desc;?>
                        </p>
                    <div id = "groupChatMessage">
                         <p >Your group messages would be displayed here. </p>

                    </div>
                  <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                     <input class="form-control" name = "groupchat" placeholder= "Chat here" style="margin-top: 5px; width:65%;margin-left:20px;float:left;border-radius:20px;"/>
                         <input type="image" src = "images/send-icon.png" style=";margin-top:1px;width :40px; height:40px;" />
   
                  </form> 
            </div> 
   
  
    
 </div>
         
          
          
 <?php

          include("footer.php")
?>
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

        if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["chat"]))
        {
                $sender = $username;
                $receiver = $friendUsername;
                $message = $_POST["chat"];  

                      if(!empty($message))
                      {
                        $send_message_to_database = $callingObjectClass->send_message_to_database($sender,$receiver,$message);
                      
                      }
                        else
                        {
                        
                        header("location:home.php");
                        }
              
        }

       
        $sql = "SELECT DISTINCT `status` FROM `users` WHERE `username` = '$friendUsername'";
           $result = $check_connection_to_database->query($sql);
             if($result->num_rows > 0 )  { while ($row = $result->fetch_assoc()) { $friendStatus =  $row['status'];} }    
        

?>
    <body>
          <div class = "container p-3 my-3 border bg-primary" style="border-radius: 20px;">
              <p style = "color:white;">
                <?php echo $username;?>
              </p>
                          
                <div id = "chatarea" class = 'bg-light'>
                    
                          <strong onClick = getUserProfile() ><?php echo $friendUsername?></strong><br>
                       
                      <i style = 'font-size:13px;margin-bottom:20px;color:green'>
                      <?php if ($friendStatus == "Online") echo $friendStatus; echo "<i style = 'color:black;'>"?> <?php echo $friendStatus; echo  "</i>" ?></i>

                        <div id = "mainchat" style = 'background-color:black;width:100%;margin-top:10px;padding-right:8px;'>
                                  <p >Chat Interface </p>
                                  <p >Chat Interface</p>
                        </div>

                          <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <div style = "margin-left:10px">
                         
                                  
                          <input class="form-control" name = "chat" placeholder= "Chat here" style="margin-top: 5px;border-radius:30px; width:70%;margin-left:10px;float:left;margin-right:10px;"/>
                                   <input type="image" src = "images/send-icon.png" style=";margin-top:1px;width :40px; height:40px;" />
                          </div>
                                  
                          </form> 
                </div> 
                
                
            
          </div>
         
          
          
 <?php


          include("footer.php")
?>
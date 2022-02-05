<?php          
session_start();         
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}

 require('head.html');
 require('object.php');
 $callingObjectClass = new  Database_object_oriented_index();
 $check_connection_to_database = $callingObjectClass->connect_to_database_function();
 if(isset($_GET["userId"])){
 $userId = $_GET['userId'];  
  if ($check_connection_to_database == true){
   $sql = "SELECT `username` FROM `users` WHERE `id` = $userId";
   $result = $check_connection_to_database->query($sql);
   if($result->num_rows > 0){              
     //Output data of each rows
     while($row = $result->fetch_assoc()){
     $_SESSION["friendUsername"] = $row["username"];
     }
   }                                               
  }
 }
  if(isset($_SESSION["friendUsername"])){                                                                         
    $friendUsername = $_SESSION["friendUsername"];
  }
  if(isset($_SESSION["name"])){
    $username = $_SESSION['name'];
  }
require('nav.php');


if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["chat"])){
  $sender = $username;
  $receiver = $friendUsername;
  
  $message = $_POST["chat"];  

  if($check_connection_to_database == true){
  $sql = "INSERT INTO `messages` (`sender`,`receiver`,`message`) VALUES ('$sender','$receiver','$message')";
  $result = $check_connection_to_database->query($sql);
  if($result > 0){                                                  
   // echo "success";     
  }else{
    echo "unable to save message";
    echo $sender ,$receiver,$message;
  
  }
  }else{
    echo "unable to load database";
  }
 
}

?>
      

    <body>
         <div class = "container p-3 my-3 border " style="border-radius: 20px;background-color:pink;">
          <h3><?php 
     echo $username;
     ?></h3>
            
    <div id = "chatarea">
     <h3><?php  
     echo $friendUsername;
     ?></h3>
      <div id = "mainchat">
        <p >Chat Interface </p>
        <p >Chat Interface</p>

      </div>
        <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input class="form-control" name = "chat" placeholder= "Chat here" style="margin-top: 5px; width:65%;margin-left:20px;float:left;"/>
      <input class="btn btn-success" name ="submit" type="submit" value="send" style="float: right;margin-top: 5px;margin-right:5%;" />
    </form>
    </div> 
   
  
   
          </div>
       
          
          
 <?php

          include("footer.php")
?>
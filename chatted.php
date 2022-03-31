<?php 
session_start();    
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}
require('head.html');
    include ("object.php");
   $callingObjectClass = new  Database_object_oriented_index();
   $connect = $callingObjectClass->connect_to_database_function();
   if ($connect){
    $user =  $_SESSION['name'];

      $sql = "SELECT DISTINCT `receiver` FROM `messages`  WHERE    `sender` = '$user'  AND  `receiver` != '$user' ";
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
                                        $userId = $innerRow['id'];
                                        $email = $innerRow['email'];
                                        
                                        $sql = "SELECT `message` FROM `messages` WHERE `receiver` = '$chatted' ORDER BY `id` DESC LIMIT 1";
                                        $innestResult = $connect->query($sql);
                                        if ($innestResult ->num_rows > 0)
                                        {
                                            while ($innestRow = $innestResult->fetch_assoc()) 
                                            {
                                                    $message =  $innestRow['message'];


                                                    $sql = "SELECT  `image` from `profile` WHERE `username` = '$chatted' ";
                                           
                                                $innerResult = $connect->query($sql);
                                                if($innerResult->num_rows > 0)
                                                {
                                                        while ($innerRow  = $innerResult->fetch_assoc()) 
                                                        {
                                                            $get_current_user_image = $innerRow['image'];
                                                            echo "
                                                            <div id = 'friendList'>
                                                            <div id = 'imgIcon'>
                                                                    <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                                    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:35px;border-radius:20%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                            </div>
                                                            <div id = 'sep' >
                                                                <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                                <p style = 'font-size:10px;'>$message</p>
                                                            </div>
                                                            <div id = 'info'>
                                                                <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;'>!</p> </center>
                                                            </div>
                                                         </div>
                                                         <center> <hr></center> ";
                                                        
                                                        }
                                                }
                                                else
                                                {
                                                    echo "
                                                    <div id = 'friendList'>
                                                    <div id = 'imgIcon'>
                                                            <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                            <img src='images/user.png' alt='icon' style = 'width:30px;height:35px;border-radius:20%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                    </div>
                                                    <div id = 'sep' >
                                                        <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                        <p style = 'font-size:10px;'>$message</p>
                                                    </div>
                                                    <div id = 'info'>
                                                        <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;'>!</p> </center>
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
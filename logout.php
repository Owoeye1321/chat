<?php
session_start();
require('object.php');
$conn = new Database_object_oriented_index();
$username = $_SESSION["name"];
    $conn = $conn->connect_to_database_function();
       $sql = "SELECT DISTINCT `password` FROM `users` WHERE `username` = '$username'";
       $result = $conn->query($sql);
       if($result->num_rows > 0 )
       {
          while ($row = $result->fetch_assoc()) { $password =  $row['password'];}
              $sql = "UPDATE `users` SET `status` = 'Offline' WHERE `username` = '$username' AND `password` = '$password'";
                  $innerResult = $conn->query($sql);
                         if($innerResult > 0 ){ unset($_SESSION["name"]); $_SESSION["err_log"] = ""; header("location:index.php");}; 
       }    
       

           


?>
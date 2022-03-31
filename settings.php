   
<?php  
session_start();    
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}
require('head.html');
require('nav.php');
require('object.php'); 

 ?>
     
 <?php

          include("footer.php")
?>
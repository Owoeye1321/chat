<?php   
session_start();                                                                                                   
require('head.html');

if(isset($_SESSION["name"]))
{
   require('nav.php');
      if(isset($_SESSION["name"]))
      {
         $username = $_SESSION["name"];
       echo "
         
            <div class = 'container p-3 my-3 border  bg-primary'' style='border-radius: 20px;'>
                     <strong style ='color:white;margin-left:10px;'margin-bottom:20px;'>     Welcome, $username</strong> 
                     <div style = 'margin-top:10px;' id = 'fetch_chat'>
                     
                     </div>
            </div>
                           
         ";
      }
      else
      {
      echo "
         <script>     
               alert('Please login to our site');
                  window.location='index.php';
         </script>
      "; 
      }   
}
else
{
   header("Location:index.php");
}      
include("footer.php")
?>
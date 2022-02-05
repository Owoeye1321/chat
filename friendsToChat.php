<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
require('head.html');
?>
<body>
<?php  
session_start();  
if($_SESSION["name"]){

require('nav.php');
if(isset($_SESSION["name"])){
    $username = $_SESSION['name'];
    echo "
    
      <div class = 'container p-3 my-3 border' style='border-radius: 20px;background-color:pink;' id = 'demo'>
    <strong style ='font-size:20px;margin-left:10px;'>     Dear  $username</strong> 
           
             
       </div>
                      
   ";
}else{
    echo "
    <script>     
         alert('Please login to our site');
            window.location='index.php';
   </script>
"; 
}   
}else{
   header("Location:index.php");
}      
include("footer.php")
?>
<?php  
session_start();
require('head.html');
require('nav.php');
$username = $_SESSION['name'];
?>

<body>
<div class ='container'>
    <center ><marquee><p>Hello world,contact the admistrator to create a new group for your association.However groups administered would be available in the next 72 hours</p> </marquee></center>
</div>


         <div class = "container p-3 my-3 border " style="border-radius: 20px;background-color:pink;">
          <h3><?php 
     echo $username;
     ?></h3>
            
    <div id = "chatarea">
     <h3>Groups</h3>
      <div id = "groupchat">
        <p >Chat Interface </p>
        <p >Chat Interface</p>
        <button class ="btn btn-success" onClick = reqGroupForm()> Create Group</button>

      </div>
      
    </div> 
   
  
   
          </div>
       
          
          
<?php

include("footer.php")
?>
<?php  
session_start();
require('head.html');
require('nav.php');
require('object.php');
 $sender =  $_SESSION["name"];



?>

<body>
<div class ='container'>
    <center ><marquee><p>Hello world,contact the admistrator to create a new group for your association.However groups administered would be available in the next 72 hours</p> </marquee></center>
</div>


         <div class = "container p-3 my-3 border " style="border-radius: 20px;background-color:pink;">
          <h3><?php 
     echo $sender;
     ?></h3>
            
    <div id = "grouparea">
      <div id = "available_groups" >
        <h3>Groups</h3>
      </div>
     
      <div id = "groupchat">
        <Strong >The group you created would be displyed here</Strong><br>
        <div id = "fetch">
          <button class ="btn btn-success" onClick = reqGroupForm()> Create Group</button>

        </div>

        

      </div>
      
    </div> 
   
  
   
          </div>
       
          
          
<?php

include("footer.php")
?>
<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
require('head.html');
?>
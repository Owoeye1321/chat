<?php  
session_start();    
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}
require('head.html');
require('nav.php');
require('object.php'); 
$monitor_username = $_SESSION["name"];
$Object = new Database_object_oriented_index();
$check_connection_to_database = $Object->connect_to_database_function();
if($check_connection_to_database)
{
  $sql = "SELECT * FROM  `profile` where `username` = '$monitor_username'";
      $result = $check_connection_to_database->query($sql);
  if($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {  
         $username = $row["username"];
         $password = $row["password"];
         $email = $row["email"];    
         $bio = $row["bio"];
         $image = $row["image"];
         $temprament = $row["temprament"];
    }
    echo
    "
    <body>
    <div class = 'row'>
      <div class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding-top:150px; '>
                 
<form method = 'POST' action='profile.php' enctype ='multipart/form-data'> 
                 <center>
                          <label style = 'border-radius:50%; width:200px; height :200px;'>
                            <img alt = 'icon' src = '$image' width = '200px' height = '200px' required style = 'border-radius:50%; width:200px; height :200px;'>  
                            <input required type = 'file' name = 'profile_image' style = 'display:none';/>
                          </label><br>
                       <input class = 'form-control' value ='$bio' type = 'text' name = 'bio' required style = ' width:200px;'/>

                 </center>      
     </div>
      <div  class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding:160px 0px 0px 10px; '>
         <center>
            <input class = 'form-control'  required value ='$temprament' type = 'text' name = 'temprament' style = ' width:200px;' /><br>
            <input class = 'form-control' required type = 'text' name = 'username' value ='$username' style = ' width:200px;' /><br>
            <input class = 'form-control' required type = 'email' name = 'email' value =' $email' style = ' width:200px;' /><br>
           <input class = 'form-control' required type = 'password' name = 'password' value =' $password' style = ' width:200px;' />
         </center>   
     </div>
      

     
    
    </div>

     <input class='btn btn-outline-primary' name ='update_profile' type = 'submit' value = 'Update profile'  style = ' width:70%; margin-top:50px;margin-left:15%;margin-bottom:0px;' /><br>
       <center>

     <i style='color:red; font-size:13px;'>";
           if (isset($_SESSION['err_to_update']))
               {
                     echo $_SESSION['err_to_update'];
               }
              elseif(isset($_SESSION['updated']))
               {
                 echo $_SESSION['updated'];
               }
            
             echo "
     </i>
       </center>
    <br>
   
       


</form>




  </body>
    ";
  }
  else
  {
        $sql = "SELECT * FROM  `users` where `username` = '$monitor_username'";
              $result = $check_connection_to_database->query($sql);
          if($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
            {  
                $username = $row["username"];
                $password = $row["password"];
                $email = $row["email"];    
            }
            echo
            "
            <body>
            <div class = 'row'>
              <div class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding-top:150px; '>
                         
        <form method = 'POST' action='profile.php' enctype ='multipart/form-data'> 
                         <center>
                                  <label style = 'border-radius:50%; width:200px; height :200px;'>
                                    <img alt = 'icon' src = 'images/book.png' width = '200px' height = '200px' required>
                                    <input required type = 'file' name = 'profile_image' style = 'display:none';/>
                                  </label>
                                   <input class = 'form-control' placeholder ='bio' type = 'text' name = 'bio' required style = ' width:200px;' />
        
                         </center>      
             </div>
              <div  class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding:160px 0px 0px 10px; '>
                 <center>
                    <input class = 'form-control'  required placeholder ='Temprament' type = 'text' name = 'temprament' style = ' width:200px;' /><br>
                    <input class = 'form-control' required type = 'text' name = 'username' value =' $username'style = ' width:200px;' /><br>
                    <input class = 'form-control' required type = 'email' name = 'email' value =' $email'style = ' width:200px;' /><br>
                   <input class = 'form-control' required type = 'password' name = 'password' value =' $password'style = ' width:200px;' />
                 </center>   
             </div>
              
        
             
            
            </div>
        
             <input class='btn btn-outline-primary' name ='submit_profile' type = 'submit' value = 'Create profile'  style = ' width:70%; margin-top:50px;margin-left:15%;margin-bottom:0px;' /><br>
               <center>
        
             <i style='color:red; font-size:13px;'>";
                   if (isset($_SESSION['err_to_create']))
                       {
                             echo $_SESSION['err_to_create'];
                       }
                      elseif(isset($_SESSION['updated']))
                       {
                         echo $_SESSION['updated'];
                       }
                    
                     echo "
             </i>
               </center>
            <br>
           
               
        
        
        </form>
        
        
        
        
          </body>
            ";
          }
  }


      
}
if($_SERVER["REQUEST_METHOD"] =  "POST" && isset($_POST["submit_profile"]))
{
        $get_image_source = $_FILES['profile_image']['tmp_name'];
        $get_image_destination = 'images/'.  $_FILES['profile_image']['name'];
        $get_image_size = $_FILES['profile_image']['size'];
        $get_bio = $_POST["bio"];
        $get_temprament = $_POST["temprament"];
        $get_username = $_POST["username"];
        $get_password = $_POST["password"];
        $get_email = $_POST["email"];
    $connect_to_insert_database = $Object->create_database_profile
    (
      $get_bio, $get_username, $get_email, $get_temprament, $get_image_destination, $get_image_size, $get_image_source, $get_password)
    ;
    if($connect_to_insert_database  = true)
    {
      echo'<script>alert("Your profile has been created successfully")</script>';
    }
      else
      {
        echo'<script>alert("Something occured")</script>';
      }

}
if($_SERVER["REQUEST_METHOD"] =  "POST" && isset($_POST["update_profile"]))
{
        $get_image_source = $_FILES['profile_image']['tmp_name'];
        $get_image_destination = 'images/'.  $_FILES['profile_image']['name'];
        $get_image_size = $_FILES['profile_image']['size'];
        $get_bio = $_POST["bio"];
        $get_temprament = $_POST["temprament"];
        $get_username = $_POST["username"];
        $get_password = $_POST["password"];
        $get_email = $_POST["email"];
        $name_to_update = $monitor_username;
    $connect_to_update_database = $Object->update_database_profile
    (
      $get_bio, $get_username, $get_email, $get_temprament, $get_image_destination, $get_image_size, $get_image_source, $get_password, $name_to_update)
    ;
 

}

 ?>
     
    
 <?php

          include("footer.php")
?>
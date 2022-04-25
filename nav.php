<?php 


 $servername = "Localhost";
 $username ="root"; 
 $password ="";
 $database_name="chatroom";  
$connect = new mysqli($servername,$username,$password,$database_name);
if ($connect->connect_error)
{
    die($connect->connect_error);
} 
  if(isset($_SESSION['name']))
  {
    $get_current_user = $_SESSION['name'];    
  }
  else
  {
      header('location:index.php');
  }
    
  $sql = "SELECT  `image` from `profile` WHERE `username` = '$get_current_user' ";
        if($connect)
        {
              $result = $connect->query($sql);
              if($result->num_rows > 0)
              {
                      while ($row  = $result->fetch_assoc()) 
                      {
                          $get_current_user_image = $row['image'];
                         
                      
                      }
              }
        }
         
 ?>
<style>
  #takeNav{
  display: block;
}
#makeIt{
  display: none;
}
@media (max-width: 520px) {
  #takeNav{
  display: none;
}
#makeIt{
  display: block;
}
}
</style>


<div id = 'makeIt' style = "width:100%;height:50px;padding:5px 5px 5px 5px;"> 
<?php
  if (isset($get_current_user_image)) {
    echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left;height:30px;width:39px;margin-right:10px'>
    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:30px;border-radius:50%;margin:1px 10px 5px 4px;margin-top:5px;'>
    </a>  ";
  } else {
    echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left; ' >
    <img src='images/user.png' alt='icon' style = 'width:30px;height:30px;border-radius:20%;margin:1px 10px 5px 4px;margin-top:5px;'>
    </a>  ";  
  }
  
  
?>
<form action = "search.php" method = "post"> 
     <input name = "search" class = "form-control bg-light" required placeholder ="Search" 
     style = "width:75%;height:35px;text-align:center;border-radius:30px;float:left;"/>

   </form>   
</div>
<div style = "width:100%;height:50px;box-shadow: 2px 3px 3px 3px lightgray;"> 

<div style ="padding:7px 20px 0px 0px;margin-bottom:-60px;width:35%;float:left; height:50px;" id = "takeNav" >
<?php
  if (isset($get_current_user_image)) {
    echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left;height:30px;width:39px;margin-right:10px;' id = 'takeNav'>
    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:30px;border-radius:50%;margin:1px 10px 5px 4px;margin-top:-17px;'>
    </a>  ";
  } else {
    echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left; ' id = 'takeNav'>
    <img src='images/user.png' alt='icon' style = 'width:30px;height:30px;border-radius:20%;margin:1px 10px 5px 4px;margin-top:-17px;'>
    </a>  ";  
  }
  
?>
   <form action = "search.php" method = "post"> 
     <input name = "search" class = "form-control bg-light" required placeholder ="Search" 
     style = "width:45%;height:35px;text-align:center;border-radius:30px;float:left;"/>

   </form>             
      </div>
      <div style = "width:&0%;margin-right:auto;">
  <nav class="nav nav-tabs  navbar-expand-xl justify-content-center navbar-dark" style = "border-bottom:none;padding:5px 0px 5px 0px ">
  <!-- Brand -->
  <a class="nav-link nav-item" id ="navLink" href="newsFeed.php" style = "color:black;font-size:14px;">
        <img src='images/news-icon.png' alt='icon' style = 'width:25px;height:25px;border-radius:20%;margin:1px 10px 0px 4px;'>

      </a>
  <a class="nav-link nav-item" id ="navLink"  href="mychat.php" style = "color:black;font-size:15px;">
   <img src='images/chat.png' alt='icon' style = 'width:30px;height:25px;border-radius:20%;margin:1px 10px 0px 4px;'> </a>  
  </a>
  <a class="nav-link nav-item"  id ="navLink" href="friendsToChat.php" style = "color:black;font-size:15px;">
   <img src='images/friends.png' alt='icon' style = 'width:25px;height:25px;border-radius:20%;margin:1px 10px 0px 4px;'> </a>  
  </a>
    
        <a class="nav-link nav-item" id ="navLink" href="group.php" style = "color:black;font-size:15px;"> 
        <img src='images/groups.png' alt='icon' style = 'width:25px;height:25px;border-radius:20%;margin:1px 10px 0px 4px;'> </a>  
  </a>

        <a class="nav-link nav-item" id ="navLink" href="logout.php" style = "color:black;font-size:14px;">
        <img src='images/logout.png' alt='icon' style = 'width:25px;height:25px;border-radius:20%;margin:1px 10px 0px 4px;'>

      </a>
      
 
</nav>
<div>
</div>
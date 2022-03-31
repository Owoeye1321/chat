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
                         echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left;'>
                          <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:35px;border-radius:50%;margin:1px 10px 0px 4px;margin-top:15px;'>
                          </a>  ";
                      
                      }
              }
              else
              {
                  echo " <a href = 'profile.php' style = 'text-decoration:none;color:black;float:left;'>
                  <img src='images/user.png' alt='icon' style = 'width:30px;height:35px;border-radius:20%;margin:1px 10px 0px 4px;margin-top:15px;'>
                  </a>  ";  
              }
        }
         
 ?>


<div id = '' style ="padding:10px 20px 30px 10px;margin-bottom:-60px;">
   <form action = "search.php" method = "post"> 
     <input name = "search" class = "form-control" required placeholder ="Search" 
     style = "width:80%;height:40px;border-top:none;border-left:none;border-right:none;text-align:center;"/>

     <input class = "btn btn-primary" type = "submit" value = "Search" 
     style = "float:right;margin-top:-40px;width:10%;font-size:12px;height:40px;padding:2px 2px 2px 2px;"/>
   </form>             
 </div><br>   
<div>

  <nav class="nav nav-tabs  navbar-expand-xl justify-content-center  bg-light navbar-dark" style = "border-bottom:none;padding:5px 0px 5px 0px ">
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
</div>
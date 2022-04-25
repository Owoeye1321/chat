<style>
  #takeNav{
  display: block;
  padding:20px 30px 50px 10px;
}
@media (max-width: 520px) {
  #takeNav{
  display: none;
}
}
</style>
<?php    
require('head.php');
require('object.php');             

      
      $callingObjectClass = new  Database_object_oriented_index();
      $check_connection_to_database = $callingObjectClass->connect_to_database_function();

         
            if(isset($_GET["userId"]))
            {
                    $userId = $_GET['userId'];  
                    if ($check_connection_to_database == true){
                    $sql = "SELECT `username` FROM `users` WHERE `id` = $userId";
                    $result = $check_connection_to_database->query($sql);
                     if($result->num_rows > 0)
                      {              
                          //Output data of each rows
                          while($row = $result->fetch_assoc())
                          {
                          $_SESSION["friendUsername"] = $row["username"];
                          }
                      }                                               
                    }
            }
                if(isset($_SESSION["friendUsername"]))
                {                                                                         
                $friendUsername = $_SESSION["friendUsername"];
                }
                    if(isset($_SESSION["name"]))
                    {
                      $username = $_SESSION['name'];
                    }

        if($_SERVER["REQUEST_METHOD"] ==  "POST" && isset($_POST["chat"]))
        {
                $sender = $username;
                $receiver = $friendUsername;
                $message = $_POST["chat"];  

                      if(!empty($message))
                      {
                        $send_message_to_database = $callingObjectClass->send_message_to_database($sender,$receiver,$message);
                      
                      }
                        else
                        {
                        
                        header("location:home.php");
                        }
              
        }

       
        $sql = "SELECT DISTINCT `status` FROM `users` WHERE `username` = '$friendUsername'";
           $result = $check_connection_to_database->query($sql);
             if($result->num_rows > 0 )  { while ($row = $result->fetch_assoc()) { $friendStatus =  $row['status'];} }    
        

?>
    <body>
    <div class = 'row' '>

<div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;' >
   <!-- this is the block of code for mychat in the mychat page!-->
   <div class = " p-2 border" style="border-radius: 20px;">
              <p style = "color:black;">
                <?php echo $username;?>
              </p>
                          
                <div id = "chatarea" class = 'bg-white' style= 'width:100%;margin-left:0%;'>
                    
                          <strong onClick = getUserProfile() ><?php echo $friendUsername?></strong><br>
                       
                      <i style = 'font-size:13px;margin-bottom:20px;color:green'>
                      <?php if ($friendStatus == "Online") echo $friendStatus; echo "<i style = 'color:black;'>"?> <?php echo $friendStatus; echo  "</i>" ?></i>

                        <div id = "mainchat" style = 'background-color:black;width:100%;margin-top:10px;padding-right:8px;'>
                                  <p >Chat Interface </p>
                                  <p >Chat Interface</p>
                        </div>

                          <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <div style = "margin-left:10px">
                         
                                  
                          <input class="form-control" name = "chat" placeholder= "Chat here" style="margin-top: 5px;border-radius:30px; width:70%;margin-left:10px;float:left;margin-right:10px;"/>
                                   <input type="image" src = "images/send-icon.png" style=";margin-top:1px;width :40px; height:40px;" />
                          </div>
                                  
                          </form> 
                </div> 
                
                
            
          </div>
</div>

      <div class = "col-sm-12 col-md-4 col-lg-4"  id = 'takeNav'>
         <!-- this is the block of code for newsfeed in the mychat page!-->
         <?php require('queryFeeds.php') ?>
      </div>

<div class = "col-sm-12 col-md-4 col-lg-4" id = 'takeNav' >
   <!-- this is the block of code for mychat in the mychat page!-->
   <?php require('queryGroups.php') ?>
</div>

</div>

         
         
          
          
 <?php


          include("footer.php")
?>
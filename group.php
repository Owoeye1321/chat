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
      $_SESSION['errForGroup'] = "";

        require('head.php');
        require('object.php');

  $sender = $_SESSION["name"];
          $Object_oriented_index = new Database_object_oriented_index();


 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitForm']))
 {
              $group_name = $Object_oriented_index->test_data($_POST["group_name"]);
              $group_desc  = $Object_oriented_index->test_data($_POST["group_desc"]);
              
                if (!preg_match("/^[a-zA-Z ]*$/",$group_name)) 
                {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                }

                   if (!preg_match("/^[a-zA-Z ]*$/",$group_desc)) 
                   {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                   }

                $source = $_FILES['profile_pic']['tmp_name'];
                $destination =  'images/'.  $_FILES['profile_pic']['name'];
                $imageSize =  $_FILES['profile_pic']['size'];
                   $filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));

              if($_FILES['profile_pic']['size'] > 400000)
              {
                  $_SESSION['errForGroup'] = "file too large";
              }

              else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg")
              {
                $_SESSION['errForGroup'] = "";
              }

              else
              {
                 $_SESSION['errForGroup'] = "Failed";
              }    
    if(empty($_SESSION['errorForGroup']))
    {      
                  $check_connection_to_create_group = $Object_oriented_index->connect_to_database_function();
        if($check_connection_to_create_group == true)
        {
                    if(file_exists($destination))
                    {
                      $_SESSION['errForGroup'] = "Choose another image ";
                    }

                    else if( file_exists("groups/$group_name.txt"))
                    {
                      $_SESSION['errForGroup'] = "Group Name already exist ";
                    }

                    else
                    {
                          if(move_uploaded_file($source,$destination))
                          {
                                      $uploaded_image = $destination;
                                             $sql = "INSERT INTO `groups` (`name`,`description`,`img`,`creator`) 
                                             VALUES ('$group_name','$group_desc','$uploaded_image' ,'$sender')";
                                      $result = $check_connection_to_create_group->query($sql);
                            if($result > 0){
                              echo'<script>alert("Your group has been created successfully")</script>';
                              $f_myfile =   fopen("groups/$group_name.txt", "a+");
                              fclose($f_myfile);
                        
                            }

                            else
                            {
                               $_SESSION["errForGroup"]= "Image cannot be saved";
                            }

                        }
                    }
                  
    
     }


    }

  }




?>

<body>
<div class = 'row bg-dark' '>

<div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;'  id = 'takeNav' >
   <!-- this is the block of code for mychat in the mychat page!-->
   <div class = 'container p-3 my-3 border  bg-white' style='border-radius:20px;margin-top:20px;'>
   <div id = 'formDiv' style = 'height:500px'>

    <div id = 'formScroll' ' style = 'height:500px'>
            <strong style ='color:black;margin-left:10px;'>     Welcome, <?php echo $sender ?> </strong> 
            <div style = 'margin-top:10px;' id = 'fetch_chat'>
            
            </div>
    </div>
    </div>
   </div>
</div>

      <div class = "col-sm-12 col-md-4 col-lg-4"  id = 'takeNav'>
         <!-- this is the block of code for newsfeed in the mychat page!-->
         <?php require('queryFeeds.php') ?>
      </div>

<div class = "col-sm-12 col-md-4 col-lg-4"  style = 'padding-top:20px;'>

 <!-- this is the block of code for groups in the newsfeed page!-->
 <div class = "p-3 my-3 border  bg-white" style="border-radius: 20px;">
                       
                            
                <div id = "grouparea" style = 'width:95%;margin-left:0%; height: 500px;' >
                      <div id = "available_groups">
                      </div>
                          
                    
                      <div id = "groupchat" style ="margin-left:-20px;">
                                  <div id = "fetch">
                                        <button class ="btn btn-primary" onClick = reqGroupForm() > Create Group</button>
                                          <br><i style="color:red; font-size:13px;">
                                          <?php if (isset($_SESSION["errForGroup"])) {
                                            echo $_SESSION["errForGroup"];}
                                          ?></i>
                                  </div>
                      </div>

                </div>
      
        </div> 

</div>

</div>


       
          
<?php

include("footer.php")
?>
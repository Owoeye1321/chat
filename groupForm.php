
<?php
session_start();
require('head.html');
require('object.php');
 $sender =  $_SESSION["name"];

$Object_oriented_index = new Database_object_oriented_index();


    if($_SERVER["REQUEST_METHOD"] == "POST"){
                $group_name = $Object_oriented_index->test_data($_POST["group_name"]);
                $group_desc  = $Object_oriented_index->test_data($_POST["group_desc"]);
                
                if (!preg_match("/^[a-zA-Z ]*$/",$group_name)) {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                  }
                   if (!preg_match("/^[a-zA-Z ]*$/",$group_desc)) {
                    $_SESSION["errForGroup"] = "<span style='color:red;'>Invalid name or description</span>";
                   }
             $source = $_FILES['profile_pic']['tmp_name'];
             $destination =  'images/'.  $_FILES['profile_pic']['name'];
             $imageSize =  $_FILES['profile_pic']['size'];
$filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));
 if($_FILES['profile_pic']['size'] > 400000){

    $_SESSION['errForGroup'] = "file too large";
}else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg"){
  $_SESSION['errForGroup'] = "";
}else{
  $_SESSION['errForGroup'] = "Failed";
  
    }    
    if(empty($_SESSION['errorForGroup'])){      
     $check_connection_to_create_group = $Object_oriented_index->connect_to_database_function();
     if($check_connection_to_create_group == true){
       if(file_exists($destination)){
        $_SESSION['errForGroup'] = "Choose another image ";
       }else if( file_exists("groups/$group_name.txt")){
        $_SESSION['errForGroup'] = "Group Name already exist ";
       }else{
           if( move_uploaded_file($source,$destination)){
    $uploaded_image = $destination;
    $sql = "INSERT INTO `groups` (`name`,`description`,`img`,`creator`) VALUES ('$group_name','$group_desc','$uploaded_image' ,'$sender')";
    $result = $check_connection_to_create_group->query($sql);
    if($result > 0){
      echo'<script>alert("Your group has been created successfully")</script>';
      $f_myfile =   fopen("groups/$group_name.txt", "a+");
      fclose($f_myfile);
 
    }
}
       }
     
    
     }


    }


}


echo '
<div id = "groupchat"> 
<center style = "margin-top:60px";>

<form method = "POST" action='; echo htmlspecialchars($_SERVER["PHP_SELF"]); echo' enctype ="multipart/form-data">
      <input style="width:200px;margin-bottom: 10px;" required name = "group_name"  class="form-control" placeholder="Group name" type = "text"/>
      
      <input style="width:200px;margin-bottom: 10px;"required name = "group_desc"  class="form-control" placeholder="Description" type = "text"/>

      <input type = "file" style="width:200px;margin-bottom: 10px;" required name = "profile_pic"  /><br>
      <i style="color:red; font-size:13px;">'; if (isset($_SESSION["errForGroup"])) {
        echo $_SESSION["errForGroup"];}
echo '</i>
      <input class="btn btn-success" name ="submitForm" type="submit" value="Finish" style="margin-top: 5px;width:200px;" />
    

    </form>

    </center>
</div>

';


?>

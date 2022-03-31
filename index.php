<?php 
require('head.html');
require ('object.php');
session_start();

$Object_oriented_index = new Database_object_oriented_index();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $check_connection_to_login = $Object_oriented_index->connect_to_database_function();
        if($check_connection_to_login == true){
            $username = $Object_oriented_index->test_data($_POST["username"]);
            $password  = $Object_oriented_index->test_data($_POST["password"]);
            $sql = "SELECT `id` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
        $result = $check_connection_to_login->query($sql);
        if($result->num_rows > 0 ){  
            $_SESSION["name"] = $_POST["username"];
          echo "
          <script>       
               alert('Logged in successfully');
                  window.location='friendsToChat.php';
         </script>
     "; 
        } else {
       $_SESSION["Logged in"] = "Invalid details";
     }
     
                 
    
        } else {
            $_SESSION["err_log"] = "Server issues";
           }      
    
            
      

}

?>

<center>  
<div class="animate animated animate zoomInUp">
  
<div class ="bg-light" style="width:270px; height: 270px;padding-top: 20px;border-radius: 10px;margin-top:100px"><p style="color:#000000;">Login to chat</p>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <input style="width:200px;margin-bottom: 10px; border-radius:5px;" class="form-control" type="text" required placeholder="Username" name="username" >
                                        <input style="width:200px; border-radius:5px;" class="form-control" type="password" required placeholder="Password" name="password">
                                        <i style="color:red; font-size:13px;"><?php if (isset($_SESSION["err_log"])) {
                                               echo $_SESSION["err_log"];
                                        } elseif(isset($_SESSION["Logged in"])){echo $_SESSION["Logged in"];}
                                         ?></i><br>
                                        <input class="btn btn-outline-primary" type="submit" value="Submit" style="width: 195px;border-radius:5px;"><br>
                                        <a style="text-decoration:none;margin-left:70px;" href="#">Forget password?</a>
                                        
                                      


                        </form>
                      
                </div>
                <div style="border:1px solid; border-radius: 5px; margin-top: 9px; width: 270px; padding: 2px 0px 2px 0px;">
                    <span style="font-size: 13px;">New to My Profile?</span> <a id="sign_up" href="signup.php">Create an account</a><br></div>
                </center>  

                
<?php
include("footer.php")
?>
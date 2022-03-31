<?php 
require('head.html');
require ('object.php');
session_start();

$Object_oriented_index = new Database_object_oriented_index();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
             $check_connection_to_signup = $Object_oriented_index->connect_to_database_function();
             if ($check_connection_to_signup == true)
            {
               $username = $Object_oriented_index->test_data($_POST["username"]);
               $password = $Object_oriented_index->test_data($_POST["password"]  );
               $email = $Object_oriented_index->test_data( $_POST["email"]   );
               if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
                 $_SESSION["err"] = "<span style='color:red;'>Only letters and white space allowed for Company name</span>";
               }  
              else if(strlen($password) < 8){
                 $_SESSION["err"] = "<span style='color:red;'>Password must be at least 8 character</span>";        
               }  
              else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $_SESSION["err"] = "<span style='color:red;'>Invalid email format</span>";
               }else{
                 $_SESSION["err"] = null;
               }
               if (empty($_SESSION["err"]) & isset($username) & isset($password) & isset($email) ) {
                 $sql = "SELECT `username`,`email` FROM `users` WHERE `username` == '$username' or `email` == '$email' ";
                 $result = $check_connection_to_signup->query($sql);
                 if ($result == true) {
                   $_SESSION["err"] = "User already exist";
                 } else {          
                $sql = "INSERT INTO `users` (`username`,`password`,`email`) VALUES ('$username','$password','$email');";
                $result = $check_connection_to_signup->query($sql);
                if ($result > 0) {  
                    $_SESSION["name"] = $_POST["username"];
                  // $_SESSION["signed up"] = "<span style = 'color:green;'>Signed up successfully</span>";
                      echo "
                     <script>
                      
                          alert('Signed up successfully');
                             window.location='friendsToChat.php';                            
                    </script>
                "; 
                  } else {
                  $_SESSION["signed up"] = "Unable to sign up ";
                }
                
                      }                                                                                    
              
               } 
             } else {
                 $_SESSION["err"] = "Server issues";                                  
                }                                                
      

}

?>

<div class = "container p-3 my-3 text-white" style="border-radius: 20px;">
<center>
                   <div class = "bg-light" style="width:270px; height: 270px;padding-top: 20px;border-radius: 10px;margin-top:70px"><p style="color:#000000;">Sign in to chat</p>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <input class="form-control" type="text" required placeholder="Username" name="username" style="margin-bottom: 10px; border-radius:5px;width:200px">
                                        <input class="form-control" type="email" required placeholder="Email" name="email" style="margin-bottom: 10px; border-radius:5px;width:200px">
                                        <input class="form-control" type="password" required placeholder="Password" name="password" style = " border-radius:5px;width:200px" >
                                        <i style="color:red; font-size:13px;"><?php if (isset($_SESSION["err"])) {
                                               echo $_SESSION["err"];
                                        } elseif(isset($_SESSION["signed up"])){echo $_SESSION["signed up"];}
                                         ?></i><br>
                                        <input class="btn btn-outline-primary" type="submit" value="Submit" style="width: 195px;  border-radius:5px;"><br>
                        </form>                    
          
                    </div>
                     <div style="border:1px solid; border-radius: 5px; margin-top: 9px; width: 270px; padding: 2px 0px 2px 0px;color:#000000">
                    <span style="font-size: 13px;">Already have an account?</span> <a id="sign_up" href="index.php">Sign in</a><br>
                </div>                     

                    </center>

</div>
<?php
include("footer.php")
?>?>
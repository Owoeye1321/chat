<?php 
require('head.html');
require ('object.php');
session_start();

$Object_oriented_index = new Database_object_oriented_index();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"]; 
        $password = $_POST["password"];      
        $Object_oriented_index->login($username,$password);
        
             $_SESSION["name"] = $_POST["username"]; 
      

}

?>

<center>  
<div class="animate animated animate zoomInUp">
  
<div style="width:270px; height: 270px;padding-top: 20px;background-color: #ffc8f8f8;border-radius: 10px;margin-top:100px"><p style="color:#000000;">Login to chat</p>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <input style="width:200px;margin-bottom: 10px; border-radius:5px;" class="form-control" type="text" required placeholder="Username" name="username" >
                                        <input style="width:200px; border-radius:5px;" class="form-control" type="password" required placeholder="Password" name="password">
                                        <i style="color:red; font-size:13px;"><?php if (isset($_SESSION["err"])) {
                                               echo $_SESSION["err"];
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
?>?>
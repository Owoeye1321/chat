<?php 
require('head.html');
require ('object.php');
session_start();

$Object_oriented_index = new Database_object_oriented_index();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"]; 
        $password = $_POST["password"];        
        $email = $_POST["email"];
        $Object_oriented_index->signUp($username,$password,$email);
        
             $_SESSION["name"] = $_POST["username"]; 
      

}

?>

<div class = "container p-3 my-3 text-white" style="border-radius: 20px;">
<center>
                   <div style="width:270px; height: 270px;padding-top: 20px;background-color: #ffc8f8f8;border-radius: 10px;margin-top:70px"><p style="color:#000000;">Sign in to chat</p>
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
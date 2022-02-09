
<?php
session_start();
require('head.html');
 $sender =  $_SESSION["name"];
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "chatroom";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($conn){
    

}else{
    echo "Unable to connect to database";
};


echo "<center style = margin-top:60px;>
<form method = 'POST' action='>"; echo htmlspecialchars($_SERVER['PHP_SELF']);echo "'>
      <input style='width:200px;margin-bottom: 10px;'  class='form-control' placeholder='Group name' type = 'text'/>
      
      <input style='width:200px;margin-bottom: 10px;'  class='form-control' placeholder='Description' type = 'text'/>

      <input style='width:200px;margin-bottom: 10px;' class='form -control' type = 'file'/><br>
      <input class='btn btn-success' name ='submit' type='submit' value='Finish' style='margin-top: 5px;margin-right:5%;' />
    

    </form>
    </center>
";


?>

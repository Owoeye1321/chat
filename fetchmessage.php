
<?php
session_start();
require('head.html');
 $receiver =  $_SESSION["friendUsername"];
 $sender =  $_SESSION["name"];
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "chatroom";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($conn){
    $sql = "SELECT `message` FROM  `messages` WHERE `sender` = '$sender' AND `receiver` = '$receiver' OR `sender` = '$receiver' AND `receiver` = '$sender'  ";
    $result = $conn->query($sql);
    if($result->num_rows > 0 ){
        //output data of each row
        while($row = $result->fetch_assoc()){
            $message  = $row["message"];          
            echo "  <p style ='margin-bottom:4px;background-color:lightgreen;padding:2px 4px 4px 4px;border-radius:10px;width:fit-content;'> $message </p>  ";

        }
    }

}else{
    echo "Unable to connect to database";
}

?>
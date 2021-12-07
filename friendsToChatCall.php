
<?php
require('head.html');

$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "chatroom";

$conn = new mysqli($servername,$username,$password,$databaseName);

if ($conn){
    $sql = "SELECT * FROM  `users`";
    $result = $conn->query($sql);
    if($result->num_rows > 0 ){
        //output data of each row
        while($row = $result->fetch_assoc()){
            $username = $row["username"];
            $email = $row["email"];
            $userId = $row["id"];
            echo "
            <div id = 'friendList'>
            <div id = 'imgIcon'>
            <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
            <img src='images/index.jpg' alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'> </a>               
            </div>
            <div id = 'sep' >
            <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$username</a></strong>
                <p style = 'font-size:10px;'>$email</p>
                </div>
            <div id = 'info'>
                <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;'>!</p> </center>
            </div>
        </div>
        <center> <hr></center>
        ";

        }
    }

}else{
    echo "Unable to connect to database";
}

?>
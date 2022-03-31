
<?php
session_start();    
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}
require('head.html');

       
include ("object.php");
$callingObjectClass = new  Database_object_oriented_index();
$conn = $callingObjectClass->connect_to_database_function();
 $exit_username = $_SESSION["name"];

if ($conn)
{
    $sql = "SELECT * FROM  `users` WHERE `username` != '$exit_username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0 )
    {
                        //output data of each row
                        while($row = $result->fetch_assoc())
                        {
                            
                                    $username = $row["username"];
                                    $email = $row["email"];
                                    $userId = $row["id"]; 
                                            $sql = "SELECT  `image` from `profile` WHERE `username` = '$username' ";
                                           
                                                $innerResult = $conn->query($sql);
                                                if($innerResult->num_rows > 0)
                                                {
                                                        while ($innerRow  = $innerResult->fetch_assoc()) 
                                                        {
                                                            $get_current_user_image = $innerRow['image'];
                                                            echo "
                                                            <div id = 'friendList'>
                                                            <div id = 'imgIcon'>
                                                                    <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                                    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:35px;border-radius:20%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                            </div>
                                                            <div id = 'sep' >
                                                                <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$username</a></strong>
                                                                <p style = 'font-size:10px;'>$email</p>
                                                            </div>
                                                            <div id = 'info'>
                                                                <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;'>!</p> </center>
                                                            </div>
                                                    </div>
                                                <center> <hr></center> ";
                                                        
                                                        }
                                                }
                                                else
                                                {
                                                    echo "
                                                    <div id = 'friendList'>
                                                    <div id = 'imgIcon'>
                                                            <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                            <img src='images/user.png' alt='icon' style = 'width:30px;height:35px;border-radius:20%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                    </div>
                                                    <div id = 'sep' >
                                                        <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$username</a></strong>
                                                        <p style = 'font-size:10px;'>$email</p>
                                                    </div>
                                                    <div id = 'info'>
                                                        <center>   <p style='background-color:Lightgreen;border-radius:50%;width: 20px;height: 20px;margin-top:10px;'>!</p> </center>
                                                    </div>
                                            </div>
                                        <center> <hr></center> ";  
                                                }
                                      

                        }
    }
    else
    {
        trigger_error('Invalid query: '.$conn-error);
    }

}
else
{
    echo "Unable to connect to database";
}

?>
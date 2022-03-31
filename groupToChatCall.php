
<?php
require('head.html');
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "chatroom";

$conn = new mysqli($servername,$username,$password,$databaseName);
echo "<h3>Groups</h3>";

if ($conn)
{
    $sql = "SELECT * FROM  `groups`";
         $result = $conn->query($sql);
    if($result->num_rows > 0 )
    {
        //output data of each row
        while($row = $result->fetch_assoc())
        {
                    $group_name = $row["name"];
                      $group_desc = $row["description"];
                         $group_admin = $row["creator"]; 
                      $group_id = $row["id"];
                    $group_image = $row["img"];
                            echo "  
                            <div id = 'groupList'
                            <div id = 'imgIcon'>
                            <a href = 'groupDiscussion.php?userId=$group_id '
                             style = 'text-decoration:none;color:black;'>

                            <img src='$group_image' alt='icon' 
                            style = 'width:30px;height:35px;border-radius:50%;
                            float:left;margin:1px 10px 4px 4px;'> 
                            </a>
                            <strong ><a href = 'groupDiscussion.php?userId=$group_id '
                                 style = 'text-decoration:none;color:black;'>$group_name</a>
                            </strong> 

                                <p style = 'font-size:10px;'>$group_desc</p>          
                            </div>
                        
                        <center> <hr style ='width:100%'></center>
                        ";

        }
    }

}
else
{
    echo "Unable to connect to database";
}

?>
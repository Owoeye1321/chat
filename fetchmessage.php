
<?php
session_start();

        require('head.html');
        $receiver =  $_SESSION["friendUsername"];
        if(isset($_SESSION['name']))
        {
          $sender = $_SESSION['name'];    
        }
        else
        {
            header('location:index.php');
        }
                
            include ("object.php");
            $callingObjectClass = new  Database_object_oriented_index();
            $conn = $callingObjectClass->connect_to_database_function();
if ($conn)
{
            $sql = "SELECT * FROM  `messages` 
            WHERE `sender` = '$sender' 
            AND `receiver` = '$receiver' 
            OR `sender` = '$receiver' 
            AND `receiver` = '$sender'";
        $result = $conn->query($sql);
                if($result->num_rows > 0 )
                {
                    //output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        $message  = $row["message"];
                        $getSenderDifferenceMessageColor = $row['sender'];
                        if($sender ==  $getSenderDifferenceMessageColor)
                        {
                            echo "  <p style ='margin-bottom:4px;background-color:lightblue;padding:5px 15px 10px 10px ;border-radius:10px;width:fit-content;margin-left:auto;'> $message </p>  ";                
                        }
                        elseif ($getSenderDifferenceMessageColor !== $sender)
                        {
                            echo "  <p style ='margin-bottom:4px;background-color:lightgreen;padding:5px 15px 10px 10px ;border-radius:10px;width:fit-content;margin-left:-5px;'> $message </p>  "; 
                        }         

                    }
                }
                else
                {
                echo "  <p>Your message would be displayed here</p>";
                }

}
else
{
    echo "Unable to connect to database";
}

?>

<?php
     session_start();    
     if (empty($_SESSION["name"])){                           
       header("Location:index.php");                          
     
     }
         require('head.html');
            $sender =  $_SESSION["name"];
         
            include ("object.php");
            $callingObjectClass = new  Database_object_oriented_index();
            $conn = $callingObjectClass->connect_to_database_function();


        $get_group_name = $_SESSION["group_name"] ;

if ($conn)
{
            $sql = "SELECT * FROM  `GroupMessages` WHERE `GroupName` = '$get_group_name'";
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
                echo " 
                 <div style ='background-color:lightblue;padding:9px 15px 0px 12px; border-radius:10px;width:fit-content;margin-left:auto;  '>
                <span style = 'font-size:10px;float:right'>You</span>
                <br>
                <p style = 'margin-top:-9px;font-size:13px;padding-bottom:5px;'> $message </p> 
                </div> ";                
            }
            elseif ($sender !== $getSenderDifferenceMessageColor)
            {
                echo "  <div style ='background-color:lightgreen;padding:9px 15px 0px 12px ;border-radius:10px;width:fit-content;'>
                <span style = 'font-size:10px;'>$getSenderDifferenceMessageColor</span>
                <br>
                <p style = 'margin-top:-2px;font-size:13px;padding-bottom:5px;'> $message </p> 
                </div> ";
             }         

        }
    }

}
else
{
    echo "Unable to connect to database";
}

?>
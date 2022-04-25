<html>
    <head>
      <meta charset="UTF-8"/>
        <title>Chat Me</title>
        <meta name="keyword" content="profile" />
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name = "viewport" content="width=device-width,initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>  
        <link rel="stylesheet" href="css/bootstrap.min.css" />  
       <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script type="text/javascript" src="js/jsfile.js"></script> 
        <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
        <link rel="stylesheet" src = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
   
        <title>Chat Me</title>
              </head>
              <body class = "bg-light">
<?php
        session_start();
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
                 <div style ='background-color:lightblue;padding:9px 5px 0px 12px; border-radius:10px;width:fit-content;margin-left:auto;  '>
                <span style = 'font-size:10px;float:right'>You</span>
                <br>
                <p style = 'margin-top:-9px;font-size:13px;padding-bottom:5px;'> $message </p> 
                </div> ";                
            }
            elseif ($sender !== $getSenderDifferenceMessageColor)
            {
                echo "  <div style ='background-color:lightgreen;padding:2px 15px 0px 5px ;border-radius:10px;width:fit-content;'>
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
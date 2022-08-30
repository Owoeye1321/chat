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
            $sql = " SELECT * FROM  `messages` 
            WHERE `sender` = '$sender' 
            AND `receiver` = '$receiver' 
            OR `sender` = '$receiver' 
            AND `receiver` = '$sender' ";
        $result = $conn->query($sql);
                if($result->num_rows > 0 )
                {
                    //output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        $message  = $row["message"];
                        $image = $row['image'];
                        $getSenderDifferenceMessageColor = $row['sender'];
                        if($sender ==  $getSenderDifferenceMessageColor)
                        {
                            if($message !== ''){
                                echo "<p style ='margin-bottom:4px;background-color:
                            lightblue;padding:5px 15px 10px 10px ;border-radius:10px;
                            width:fit-content;margin-left:auto;'> $message </p>  ";   
                                if($image){
                                  echo $image;
                                }else{
                                    echo "";
                                }
                          
                            }            

                        }
                        elseif ($getSenderDifferenceMessageColor !== $sender)
                        {
                            if($message){
                                echo "<p style ='margin-bottom:4px;background-color:
                                lightgreen;padding:5px 15px 10px 10px ;border-radius:
                                10px;width:fit-content;margin-left:5px;'> $message </p> "; 
                                if($image){
                                   echo $image;
                                }else{
                                    echo "";
                                }
                            }
                            
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
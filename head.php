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
if (empty($_SESSION["name"]))
{                           
  header("Location:index.php");                          

}    
require('nav.php');
?>

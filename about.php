   
<?php  
session_start();    
if (empty($_SESSION["name"]))
{                           
  header("Location:index.php");                          
}
    require('head.html');
    require('nav.php');
    require('object.php'); 

 ?>
     <body>
          <center>
            <div style = " margin-top:50px; height:500px; width:500px;box-shadow:5px 5px 5px 5px grey; border-radius:20px;padding:  40px 10px 10px 10px;" >
                  <p>
                    Hello there,i pretty dont know what to write overhere;although i just enjoy doing stuffs on here.
                    However doing what i love best is something really interesting that really make sense to me at anytime.
                    its really a good idea if everyone could learn how to code,the world would be a better place if everyone could actually learn how to code.
                    i really enjoy writing pretty much code on here expecially i actually know what i am actually doing.
                    I am an undergraduate with terrific interest in web techologies in particular and software development generally.
                    All big thanks to big bro for the carrer intro few years ago.
                    There is actually alot to say actually,although just to make a content about this page .
                    This site is an interactivee i just did out of curiosity of how two clients could actually talk to eachother and having an interactive session with friends.
                    I have always wanted to do this since when i was little as a developer.i truely desire to know how stuffs works with just couple of syntax.
                    However as i began to learn and develop myself as a developer ,i began to learn how things works actually.
                  </p>
            </div>
          </center>
     </body>
 <?php

          include("footer.php")
?>
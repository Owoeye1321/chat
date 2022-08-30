<?php                                                                                                    
require('head.php');
require ("object.php");
if (empty($_SESSION["name"]))
{header("Location:index.php");}
         $username = $_SESSION["name"];
?>
<style>
  #takeNav{
  display: block;
  padding:20px 30px 50px 10px;
}
@media (max-width: 520px) {
  #takeNav{
  display: none;
}
}
</style>
         <div class = 'row bg-dark' >

               <div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;' >
                  <!-- this is the block of code for mychat in the mychat page!-->
                  <div class = 'container p-3 my-3 border  bg-white' style='border-radius:20px;margin-top:20px;'>
                           <div id = 'formDiv' style = 'height:500px'>

                               <div id = 'formScroll' ' style = 'height:500px'>
                                 <strong style ='color:black;margin-left:10px;'>     Welcome, <?php echo $username ?> </strong> 
                                 <div style = 'margin-top:10px;' id = 'fetch_chat'>
                                 </div>
                              </div>
                           </div>
                  </div>
               </div>

                     <div class = "col-sm-12 col-md-4 col-lg-4"  id = 'takeNav'>
                        <!-- this is the block of code for newsfeed in the mychat page!-->
                        <?php require('queryFeeds.php') ?>
                     </div>

            <div class = "col-sm-12 col-md-4 col-lg-4" id = 'takeNav' >
                  <!-- this is the block of code for mychat in the mychat page!-->
                  <?php require('queryGroups.php') ?>
            </div>

         </div>
          
      
     
<?php
include("footer.php")
?>
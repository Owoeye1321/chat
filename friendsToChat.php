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
<?php   
require('head.php');
require('object.php');
if (empty($_SESSION["name"])){                           
  header("Location:index.php");                          

}
         $username = $_SESSION["name"];
       ?>
      <div class = 'row bg-dark' >

            <div class = "col-sm-12 col-md-4 col-lg-4" id = 'takeNav' >
                  <!-- this is the block of code for mychat in the mychat page!-->
                  <?php require('queryGroups.php') ?>
            </div>

            <div class = "col-sm-12 col-md-4 col-lg-4"  id = 'takeNav'>
            <!-- this is the block of code for newsfeed in the mychat page!-->
            <?php require('queryFeeds.php') ?>
            </div>

            <div class = "col-sm-12 col-md-4 col-lg-4"  style = 'padding-top:20px;'>

            <!-- this is the block of code for groups in the newsfeed page!-->
            <div class = ' p-3 my-3 border  bg-white' style='border-radius: 20px;'>
                     <strong style ='color:black;margin-left:10px;'margin-bottom:20px;'> Find Friends, <?php echo $username ?></strong> 
                     <div id = 'formDiv' style = 'height:600px'>

                        <div id = 'formScroll' ' style = 'height:600px'>
                          <div style = 'margin-top:10px;width:100%;margin-left:0%;' id = 'demo'>
                          
                          </div>
                          </div>
                        </div>
            </div>

            </div>

      </div>
         
            
<?php
include("footer.php")
?>
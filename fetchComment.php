<?php
require ('head.php');
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
         <div class = 'row' '>

               <div class = "col-sm-12 col-md-4 col-lg-4" style= 'padding-top:20px;' >
                  <!-- this is the block of code for mychat in the mychat page!-->
                  <?php require('comment.php') ?>
               </div>

                     <div class = "col-sm-4 col-md-4 col-lg-4"  id = 'takeNav'>
                        <!-- this is the block of code for newsfeed in the mychat page!-->
                        <?php require('queryFeeds.php') ?>
                     </div>

            <div class = "col-sm-12 col-md-4 col-lg-4" id = 'takeNav' >
                  <!-- this is the block of code for mychat in the mychat page!-->
                  <?php require('queryGroups.php') ?>
            </div>

         </div>

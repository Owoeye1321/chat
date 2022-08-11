<div class = 'bg-white' style = 'padding:10px 20px 30px 40px;margin-top:20px;border-radius:30px;'>
<p>Feedback</p>
<div style ='height:200px;' id = 'formDiv'>
<div id = 'formScroll' style ='height:200px;' className = "feedback" >
<?php require('fetchFeedback.php') ?>

</div>   

</div>
 <div  style ='height:40px;'>
 <form method = 'post' action = 'newsfeed.php'>
                <input class = 'form-control bg-light' placeholder = 'Comment Here' required type = 'status' name = 'feedback'  
                                             style = ' width:60%;float:left;border-radius:30px;margin-right:10px;' />
               <input class = 'btn btn-primary' type="submit" value = 'Upload'  name = 'sendFeedback' 
                                         style="font-size:15px;margin-top:0px;width:20%; height:40px;float:left;margin-left:0%;" />  <br>  <br>
                                         <i style="color:red; font-size:13px;">
                                          <?php if (isset($_SESSION["feedbackError"])) {
                                            echo $_SESSION["feedbackError"];}
                                          ?></i>
</form>

 </div>
</div>
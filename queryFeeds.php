<center>
               
     <form method ="post" action ="newsFeed.php" enctype ='multipart/form-data'> 
     <div style = "width:100%;margin-top:20px; background-color:white;border-radius:20px; padding:20px 15px 15px 10px;">
         <label style = 'border-radius:50%; width:10%; height :28px;margin-top:10px;float:left; margin-right:10px;'>
                                     <img alt = 'icon' src = 'images/file.png' width = '100%' height = '25px' required>
                                     <input required type = 'file' name = 'news_Feed_image' style = 'display:none';/>
                                   </label>
                                   <input class = 'form-control bg-light' placeholder = 'Whats on your mind' required type = 'status' name = 'status' value 
                                             style = ' width:60%;float:left;border-radius:30px;' />
                                   <input class = 'btn btn-primary' type="submit" value = 'Upload'  name = 'sendFeed' 
                                   style="font-size:15px;margin-top:0px;width :20%; height:40px;float:right;" /><br><br>
                                  <i style='color:red; font-size:13px;;margin-top:-30px;'><?php 
                    if (isset($_SESSION['error_while_posting_feed']))
                        {
                              echo $_SESSION['error_while_posting_feed'];
                        }                                                                            
                        else
                        {
                             echo"  <i style='color:green; font-size:13px;'>Post a news feed</i>";
                        }
                      ?>
                     
                     
              </i>
                                  
     </div>
                              
 
 
     </form>
     <div id = "formDiv" style = 'width:100%;margin-left:0%; height: 600px;' >
     
     <div id = "formScroll" style = 'height:550px;'>
     <div  id = 'fetch_news_feed'>
         
         <p>News Feed Would Be Displayed Here.</p>
     
 
    </div>
 
    </div>
  </div>
 </center>   
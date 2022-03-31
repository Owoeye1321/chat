<?php 
    require('object.php');
    require('head.html');

            $sql = "SELECT * FROM `feed` ORDER BY `id` DESC";
            $get_object_class = new Database_object_oriented_index();
            $conn = $get_object_class->connect_to_database_function();
            $result = $conn->query($sql);
            if($result->num_rows > 0 )
            {
                while ($row = $result->fetch_assoc()) 
                {
                    # code...

                   $get_poster =  $row['sender'];
                   $get_feed_image = $row['image'];
                    $get_feed_status = $row['status'];
                   
                    $sql = "SELECT DISTINCT `image`,`username`,`email` FROM `profile` WHERE `username` = '$get_poster'";
                    $innerResult = $conn->query($sql);
                    if($innerResult ->num_rows > 0)
                    {
                        while ($innerRow = $innerResult->fetch_assoc()) {
                            # code...
                            
                        $get_poster_profile_image = $innerRow['image'];
                        $get_poster_profile_username= $innerRow['username'];
                        $get_poster_profile_email= $innerRow['email'];
                         $get_poster;
                         $get_feed_status;
                         $get_feed_image;


                            echo "
                                <center>
                                        <div style = 'margin-top:20px; height:360px;width:400px;border-radius:20px; padding:5px 15px 15px 10px;' class = 'bg-light'>
                                            <div style = 'margin-top:15px;margin-bottom:30px;'>
                                                    <img src='$get_poster_profile_image' alt='icon' style = 'width:40px;height:40px;border-radius:50%;margin:1px 10px 0px 4px;float:left;'>
                                                   
                                                    <div style = 'float:left;font-size:12px;margin-bottom:3px;text-align:left;'>$get_poster_profile_username <br>
                                            $get_poster_profile_email </div>

                                            </div>
                                            <div style = 'width:100%'>
                                                <img alt = 'icon' src = '$get_feed_image' style = 'width:330px;height:190px;border-radius:30px;'/>
                                                <p style = 'width:auto;font-size:12px;margin-top:20px;margin-left:auto;'>$get_poster : $get_feed_status </p>
                                                

                                            </div>
                                            <div>

                                                <form method = 'post' action='newsFeed.php'>
                                                    <div style = 'margin-left:10px'>
                                                
                                                                
                                                        <input class='form-control' name = 'chat' placeholder= 'Comment here' 
                                                                style='margin-top: 5px; width:66%;margin-left:10px;float:left;margin-right:-70px;border-radius:40px;'/>
                                                                <input type='image' name = 'send_comment_feed' src = 'images/feedSend.png' style=';margin-top:10px;width :30px; height:30px;' />
                                                    </div>
                                                        
                                                </form> 
                                            </div>
                                       


                                        </div>
                                </center>";
                         
                        }
                    }
                }
            }
            
?>

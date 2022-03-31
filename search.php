<?php 
session_start();
if(empty($_SESSION['name']))
{
        header('location:index.php');    
}
       include ("object.php");
        require('head.html');
        require("nav.php");

       if(isset($_POST['search']) )
       {
               $get_search_details = $_POST['search'];

                        $get_object_class = new Database_object_oriented_index();
                        $conn = $get_object_class->connect_to_database_function();
                        if($conn)
                        {
                                $sql =  "SELECT * FROM `profile` WHERE `username` = '$get_search_details' OR `email` = '$get_search_details'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0)
                                {
                                        while ($row = $result->fetch_assoc()) {
                                                # code...
                                                $username = $row["username"];
                                              //  $password = $row["password"];
                                                $email = $row["email"];    
                                                $bio = $row["bio"];
                                                $image = $row["image"];
                                                $temprament = $row["temprament"];
                                                
                                        }
                                        echo "
                                        <center>
                                       <br>
                                        <div  class = 'bg-light' style = 'width:400px;padding:20px 20px 20px 20px;border-radius:30px'>
                                        <div  style = ' padding-top:50px; '>
                                                 
                                        <center>
                                               <img alt = 'icon' src = '$image'  width = '200px' height = '200px'style = 'border-radius:50%;' />
                                               <p style = 'margin-top:20px;'> Bio :$bio</p>
                                       </center>      
                                            </div>
                                       <div style = ' padding:90px 0px 0px 10px; '>
                                       <center>
                                       <p style = 'margin-top:20px;'> Username :$username</p>
                                       <p style = 'margin-top:20px;'> Email :$email</p>
                                        <p style = 'margin-top:20px;'> Temprament :$temprament</p>
                                       </center>   
                                          </div>
                                        
                                  
                                       
                                      
                                      </div>
                                      </center>
                                        ";



                                      
                                }
                                else
                                {
                                        echo "
                                        <center>
                                                        <p style = 'font-size:50px; margin-top:50px;'>No data available</p>
                                                        <p style = 'font-size:18px; margin-top:10px;'>Try a valid username</p>

                                         </center>
                                          ";
                                }


                        }

                        $sql =  "SELECT * FROM `feed` WHERE `sender` = '$get_search_details' ORDER BY `id` DESC";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0 )
                         {
                                        while ($row = $result->fetch_assoc()) 
                                        {

                                                $get_poster =  $row['sender'];
                                                $get_feed_image = $row['image'];
                                                $get_feed_status = $row['status'];

                                                echo "
                                                <center>
                                                        <div style = 'margin-top:20px; height:360px;width:400px;border-radius:20px; padding:5px 15px 15px 10px;' class = 'bg-light'>
                                                            <div style = 'margin-top:15px;margin-bottom:30px;'>
                                                                    <a href = 'fetch_friend_profile.php' style = 'text-decoration:none;color:black;float:left;'>
                                                                    <img src='$image' alt='icon' style = 'width:40px;height:40px;border-radius:50%;margin:1px 10px 0px 4px;float:left;'>
                                                                    </a> 
                                                                    <div style = 'float:left;font-size:12px;margin-bottom:3px;text-align:left;'>$username <br>
                                                            $email </div>
                
                                                            </div>
                                                            <div style = 'width:100%'>
                                                                <img alt = 'icon' src = '$get_feed_image' style = 'width:330px;height:190px;border-radius:30px;'/>
                                                                <p style = 'width:100%;font-size:12px;float;left;margin-top:20px;margin-left:-120px'>$get_poster : $get_feed_status </p>
                                                                
                
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
                         else{
                                     echo "<center>
                                     <p style = 'font-size:50px; margin-top:50px;'>No feeds available for this user</p>
                                     <p style = 'font-size:18px; margin-top:10px;'>Available feeds would be displayed here</p>

                      </center>";

                         }


       }

?>
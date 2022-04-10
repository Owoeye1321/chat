
<?php
    session_start();    
    if (empty($_SESSION["name"])){                           
      header("Location:index.php");                          
    
    }
    require('head.html');
    require('object.php');
    $Object_oriented_index = new Database_object_oriented_index();
    $check_connection_to_database = $Object_oriented_index->connect_to_database_function();
if(isset($_SESSION["friendUsername"]))
{
            $friend_username = $_SESSION['friendUsername'];  
                    if($check_connection_to_database == true)
                    {
                                $sql = "SELECT * FROM `profile` WHERE `username` = '$friend_username'";
                                $result = $check_connection_to_database->query($sql);
                                if($result->num_rows > 0)
                                {              
                                    //Output data of each rows
                                    while($row = $result->fetch_assoc())
                                    { 
                                        $get_bio= $row["bio"];
                                        $get_username = $row["username"];
                                        $get_email = $row["email"];
                                        $get_image = $row["image"];
                                        $get_temprament = $row["temprament"];
                                    }
                                    echo
                                    "
                                    <body>
                                    <div id = 'mainchat'>
                                     <div class = 'row'>
                                      <div class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding-top:50px; '>
                                                 
                                                  <center>
                                                         <img alt = 'icon' src = '$get_image'  width = '200px' height = '200px'style = 'border-radius:50%;' />
                                                         <p style = 'margin-top:20px;color:white;'> Bio :$get_bio</p>
                                                 </center>      
                                     </div>
                                      <div  class = ' col-sm-12 col-md-6 col-lg-6 ' style = ' padding:90px 0px 0px 10px; '>
                                             <center>
                                             <p style = 'margin-top:20px;color:white;'> Username :$get_username</p>
                                             <p style = 'margin-top:20px;color:white;'> Email :$get_email</p>
                                              <p style = 'margin-top:20px;color:white;'> Temprament :$get_temprament</p>
                                             </center>   
                                     </div>
                                      
                                
                                     
                                    
                                    </div>
                             
                                
                
                                    </div>
                                   
                                
                                
                                  </body>";

                                    
                                }
                                else
                                {
                                    echo "No data available profile for this profile";
                                }                                               
                    }
                   
}

?>
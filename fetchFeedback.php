<?php 
    if($get_connection_to_database){
        $sql = "SELECT DISTINCT `comment`,`username`  FROM `websiteComment`";
        $result = $get_connection_to_database->query($sql);
        if ($result->num_rows > 0) {
            # code...
            while ($row = $result->fetch_assoc()) {
                # code...
                $username = $row['username'];
                $comment = $row['comment'];
                $innerSql = "SELECT `image` FROM `profile` WHERE `username` = '$username'";
                $innerResult = $get_connection_to_database->query($innerSql);
                if($innerResult->num_rows > 0 ){
                    while ($innerRow = $innerResult->fetch_assoc()) {
                        # code...
                        $image = $innerRow['image'];
                       echo "
                       <div id = 'friendList' style = 'margin-top:0px;margin-left:0%;width:100%;'>
                       <div id = 'imgIcon'>
                         <img src=$image  alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'>              
                       </div>
                       <div id = 'sep'  style = 'padding-top:7px'>
                           <p style = 'font-size:10px;' >$username: $comment</p>
                         
                       </div>
                    
               </div>
           
                       ";

                    }
                }
                
            }
        }
    }
?>
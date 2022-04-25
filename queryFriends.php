<div id = 'formDiv' style = 'height:600px'>

<div id = 'formScroll' ' style = 'height:600px'>
    <p style = 'margin-left:20%'><strong>Friends</strong></p>
    <?php 

   $callingObjectClass = new  Database_object_oriented_index();
   $connect = $callingObjectClass->connect_to_database_function();
   if ($connect){
    $user =  $_SESSION['name'];

      $sql = "SELECT DISTINCT `receiver` FROM `messages`  WHERE  `sender` = '$user'  AND  `receiver` != '$user' ";
      $result = $connect->query($sql);
      if ($result->num_rows > 0)
      {

                while($row = $result->fetch_assoc())
                {

                        $chatted =   $row['receiver'];
                        $sql = "SELECT `id`,`email` FROM `users` WHERE `username` = '$chatted' ";
                        $innerResult = $connect->query($sql);
                        if($innerResult-> num_rows > 0)
                        {
                            while ($innerRow = $innerResult->fetch_assoc()) 
                            {
                                //get last chatted id number to get new messages
                                $sql = "SELECT `id`, `message` from `messages` WHERE `sender` = '$chatted' AND `receiver` = '$user'  ORDER BY `id` DESC LIMIT 1";
                                $idResult = $connect->query($sql);
                                if($idResult->num_rows > 0){
                                    while ($idRow = $idResult->fetch_assoc()) {
                                        # code...
                                        $sendingId = $idRow['id'];
                                        $getMessage = $idRow['message'];
                                    

                                    }
                                }

                                        $userId = $innerRow['id'];
                                        $email = $innerRow['email'];
                                        
                                        $sql = "SELECT `message`, `id` FROM `messages` WHERE `receiver` = '$chatted' AND `sender` = '$user' ORDER BY `id` DESC LIMIT 1";
                                        $innestResult = $connect->query($sql);
                                        if ($innestResult ->num_rows > 0)
                                        {
                                            while ($innestRow = $innestResult->fetch_assoc()) 
                                            {
                                                    $message =  $innestRow['message'];
                                                    $myLastTextId = $innestRow['id'];


                                                    $sql = "SELECT  `image` from `profile` WHERE `username` = '$chatted' ";
                                           
                                                $innerResult = $connect->query($sql);
                                                if($innerResult->num_rows > 0)
                                                {
                                                        while ($innerRow  = $innerResult->fetch_assoc()) 
                                                        {
                                                            $get_current_user_image = $innerRow['image'];
                                                            if ( isset($sendingId ) )
                                                             {
                                                                # code...
                                                                 if ($sendingId > $myLastTextId )
                                                                 {
                                                                        $newMessage = $sendingId - $myLastTextId;
                                                                           $lastMessage = $getMessage;
                                                                 }elseif($sendingId < $myLastTextId)
                                                                 {
                                                                     $lastMessage = $message;
                                                                        $newMessage = null;
                                                                        $sendingId = null; 
                                                            }
                                                            }
                                                       
                                                       
                                                            echo "
                                                            
                                                            <div id = 'friendList' >
                                                            <div id = 'imgIcon'>
                                                                    <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                                    <img src='$get_current_user_image' alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                            </div>
                                                            <div id = 'sep' >
                                                                <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                                <p style = 'font-size:10px;'>
                                                               
                                                            </div>
                                                            <div id = 'info' style = 'float:right;'> </div>
                                                         </div>
                                                         <center> <hr></center> ";
                                                        
                                                        }
                                                }
                                                else
                                                {if ( isset($sendingId ) )
                                                    {
                                                       # code...
                                                        if ($sendingId > $myLastTextId )
                                                        {
                                                               $newMessage = $sendingId - $myLastTextId;
                                                                  $lastMessage = $getMessage;
                                                        }elseif($sendingId < $myLastTextId)
                                                        {
                                                            $lastMessage = $message;
                                                               $newMessage = null;
                                                               $sendingId = null; 
                                                   }
                                                   }
                                              
                                                    echo "
                                                    <div id = 'friendList' style = 'margin-top:10px;'>
                                                    <div id = 'imgIcon'>
                                                            <a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>
                                                            <img src='images/user.png' alt='icon' style = 'width:30px;height:35px;border-radius:50%;float:left;margin:1px 10px 4px 4px;'> </a>               
                                                    </div>
                                                    <div id = 'sep' >
                                                        <strong ><a href = 'home.php?userId=$userId ' style = 'text-decoration:none;color:black;'>$chatted</a></strong>
                                                      
                                                    </div>
                                                 
                                            </div>
                                        <center> <hr></center> ";  
                                                }
                                      
                                                   
                                            }
                                        }
                                    

                            }
                        }
        
                }
      
          }
          else
          {
              echo 'Your chats would be displayed here';
          }
         
       
      }
?>
</div>

</div>
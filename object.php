<?php
  class Database_object_oriented_index
  {
       
        public  $servername = "Localhost";
        public $username ="root"; 
        public $password ="";
        public $database_name="chatroom";  
      
        //connection to database function block of code
        //Connecting the keyword to the database 


      
        public function connect_to_database_function()
        {
            $servername =  $this->servername;
            $username = $this->username ;
            $password = $this->password ;
            $database_name = $this->database_name ;
            $connect = new mysqli($servername,$username,$password,$database_name);
        if ($connect->connect_error)
        {
            die($connect->connect_error);
        } 
            return $connect;
        }

            //clearing data inputs
        public function test_data($data)
        {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
            return $data;   
        }
        
        public function create_database_profile ($bio, $username, $email, $temprament, $destination, $image_size,$source,$password)
        {
                  $clean_bio = $this->test_data($bio);
                      $clean_username = $this->test_data($username);
                           $clean_email= $this->test_data($email);
                     $clean_temprament = $this->test_data($temprament);

                          if (!preg_match("/^[a-zA-Z ]*$/",$clean_bio)) 
                          {
                              $_SESSION["err_to_create"] = "<span style='color:red;'>Only letters and white space allowed for Company name</span>";
                          }
                                else if (!preg_match("/^[a-zA-Z ]*$/",$clean_username)) 
                                {
                                    $_SESSION["err_to_create"] = "<span style='color:red;'>Only letters and white space allowed for Company name</span>";
                                } 
                                      else if (!preg_match("/^[a-zA-Z ]*$/",$clean_temprament)) 
                                      {
                                          $_SESSION["err_to_create"] = "<span style='color:red;'>Only letters and white space allowed for Company name</span>";
                                      }     
                                          else if(strlen($password) < 8)
                                          {
                                            $_SESSION["err_to_create"] = "<span style='color:red;'>Password must be at least 8 character</span>";        
                                          }  
                                              else if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL)) 
                                              {
                                                $_SESSION["err_to_create"] = "<span style='color:red;'>Invalid email format</span>";
                                              }
                                                    else
                                                    {
                                                      $_SESSION["err_to_create"] = null;
                                                    }
                                                        $filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));
                                                        if($image_size > 400000)
                                                        {
                                                          $_SESSION['err_to_create'] = "<i style = 'color:green'>file too large</i>";
                                                        }
                                                    else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg")
                                                    {
                                                      $_SESSION['err_to_create'] = "";
                                                    }
                                            else
                                            {
                                              $_SESSION['err_to_create'] = "Failed";
                                              
                                            }    
                                      if(empty($_SESSION["err_to_create"]) && isset($bio) && isset($username) && isset($email) && isset($temprament))
                                      {
                                              if(file_exists($destination))
                                              {
                                                $_SESSION['err_to_create'] = "Choose another image ";
                                              }
                                                else
                                                {
                                                   if(move_uploaded_file($source,$destination))
                                                     {
                                                            $uploaded_image = $destination;
                                                            $check_conenection_again = $this->connect_to_database_function();

                                                        if ($check_conenection_again)
                                                        {
                                                          $sql = "INSERT INTO `profile` 
                                                          (`bio`, `username`,`password`, `email`, `image`, `temprament`) 
                                                          VALUES 
                                                          ( '$clean_bio', '$clean_username', '$password', '$clean_email', '$uploaded_image', '$clean_temprament' )";
                                                              $result = $check_conenection_again->query($sql);
                                                            if($result > 0)
                                                            {
                                                              $_SESSION["err_to_create"] = "  ";
                                                              return true;
                                                            }
                                                              else
                                                              {
                                                                return false;
                                                              }
                                                        }  
                                                            
                                                      }else{
                                          $_SESSION["err_to_create"] = "Image cannot be saved";
                                        }
                                        }
                                      
                                        
                                      }
              
        }
        public function update_database_profile( $bio, $username, $email, $temprament, $destination, $image_size,$source,$password,$name_to_update)
        {
                        $clean_bio = $this->test_data($bio);
                        $clean_username = $this->test_data($username);
                        $clean_email= $this->test_data($email);
                        $clean_temprament = $this->test_data($temprament);

                        if (!preg_match("/^[a-zA-Z ]*$/",$clean_bio)) 
                        {
                            $_SESSION["err_to_update"] = "<span style='color:red;'>Only letters and white space allowed for this space</span>";
                        }
                        else if (!preg_match("/^[a-zA-Z ]*$/",$clean_username)) 
                        {
                            $_SESSION["err_to_update"] = "<span style='color:red;'>Only letters and white space allowed for this space</span>";
                        } 
                                    else if (!preg_match("/^[a-zA-Z ]*$/",$clean_temprament)) 
                                    {
                                        $_SESSION["err_to_update"] = "<span style='color:red;'>Only letters and white space allowed for this space</span>";
                                    }     
                  else if(strlen($password) < 8)
                  {
                    $_SESSION["err_to_update"] = "<span style='color:red;'>Password must be at least 8 character</span>";        
                  }  
                          else if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL)) 
                          {
                            $_SESSION["err_to_update"] = "<span style='color:red;'>Invalid email format</span>";
                          }
                                  else
                                  {
                                    $_SESSION["err_to_update"] = null;
                                  }
                                  $filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));
                                  if($image_size > 400000)
                                  {
                                    $_SESSION['err_to_update'] = "file too large";
                                  }
                                        else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg")
                                        {
                                          $_SESSION['err_to_update'] = "";
                                        }
                                else
                                {
                                  $_SESSION['err_to_update'] = "Failed";
                                  
                                }    
                          if(empty($_SESSION["err_to_update"]) && isset($bio) && isset($username) && isset($email) && isset($temprament))
                          {
                                          if(file_exists($destination))
                                          {
                                            $_SESSION['err_to_update'] = "Choose another image ";
                                          }
                                          else
                                          {
                                                                  
                                                                          $uploaded_image = $destination;
                                                                          $check_conenection_again = $this->connect_to_database_function();

                                                                      if ($check_conenection_again)
                                                                      {
                                                                      // `bio`, `username`,`password`, `email`, `image`, `temprament`
                                                                              $sql = "UPDATE `profile` SET `bio` = '$clean_bio',
                                                                              `username` = '$clean_username', `password` = '$password',
                                                                              `email` = '$clean_email', `image` = '$uploaded_image', 
                                                                              `temprament` = '$clean_temprament' 
                                                                               WHERE  `username` = '$name_to_update' ";
                                                                          $result = $check_conenection_again->query($sql);
                                                                          if($result > 0)
                                                                          {
                                                                            if(move_uploaded_file($source,$destination))
                                                                            {
                                                                               echo'<script>alert("Your profile has been updated successfully")</script>';
                                                                          // $_SESSION["err_to_update"] = "updated successfully  ";
                                                                          
                                                                            }
                                                                           
                                                                          }
                                                                          else
                                                                          {
                                                                            echo'<script>alert("Something occured")</script>';
                                                                            $_SESSION["err_to_update"] = "server issues";
                                                                            
                                                                          }
                                                                      }  
                                                                          
                                                                    
                                                                    else
                                                                    {
                                                                      $_SESSION["err_to_update"] = "Image cannot be saved";
                                                                    }
                                        }
                          
                            
                          }
        }

        public function send_message_to_database($sender,$receiver,$message)
        {
              $conn = $this->connect_to_database_function();
              if($conn)
              {

                $sql = "INSERT INTO `messages` (`sender`,`receiver`,`message`) VALUES ('$sender','$receiver','$message')";
                $result = $conn->query($sql);
                if($result > 0)
                {            
                  $_SESSION['message status'] = 'logged in';                                      
                  // echo "<script> alert ('$receiver would receive your message')</script>";     
                }
                else
                {
                      echo "unable to save message";
                      echo $sender ,$receiver,$message;
                    
                }
              }
        }

        public function news_feed($sender, $status, $destination, $size, $source,$date)
        {
            $connect_to_database = $this->connect_to_database_function();

            $clean_Status = $this->test_data($status);
            $clean_sender = $this->test_data($sender);

            if (!preg_match("/^[a-zA-Z ]*$/",$clean_Status)) 
            {
                $_SESSION["error_while_posting_feed"] = "<span style='color:red;'>Only letters and white space allowed for status</span>";
            }
            $filetype = strtolower(pathinfo($destination,PATHINFO_EXTENSION));
            if($size > 400000)
            {
              $_SESSION['error_while_posting_feed'] = "file too large";
            }
                  else if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg")
                  {
                    $_SESSION['error_while_posting_feed'] = "";
                  }
          else
          {
            $_SESSION['error_while_posting_feed'] = "Failed";
            
          }  
          if(empty($_SESSION['error_while_posting_feed']) && isset($status) && isset($sender))
          {
            $_SESSION['error_while_posting_feed'] = "<i style='color:green; font-size:13px;'>Post a news feed</i>";
                      if(file_exists($destination))
                      {
                        $_SESSION['error_while_posting_feed'] = "Choose another image ";
                      }
                      else
                      {
                             $upload_image_feed= $destination;
                                $check_conenection_again = $this->connect_to_database_function();

                                $sql = "INSERT INTO `feed` (`status`, `image`, `sender`, `date`) 
                                        VALUES('$status', '$upload_image_feed', '$sender', '$date') ";
                                        $result = $connect_to_database->query($sql);
                                        if($result > 0)
                                        {
                                                                
                                            if(move_uploaded_file($source,$upload_image_feed))
                                            {
                                                echo'<script>alert("Your feed has been posted successfully")</script>';
                                          // $_SESSION["error_while_posting_feed"] = "updated successfully  ";
                                              
                                            }
                                                
                                        }
                                        else
                                        {
                                            echo'<script>alert("Something occured")</script>';
                                            $_SESSION["error_while_posting_feed"] = "server issues";
                                            
                                        }
                      }
                         

          }




        }

  }
    
  
 



?>
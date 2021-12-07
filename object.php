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
            if ($connect->connect_error) {
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

  public function signUp($username,$password,$email)
  {
    $check_connection_to_signup = $this->connect_to_database_function();
    if ($check_connection_to_signup == true)
   {
      $username = $this->test_data($username);
      $password = $this->test_data($password);
      $email = $this->test_data($email);
      if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
        $_SESSION["err"] = "<span style='color:red;'>Only letters and white space allowed for Company name</span>";
      }  
     else if(strlen($password) < 8){
        $_SESSION["err"] = "<span style='color:red;'>Password must be at least 8 character</span>";        
      }  
     else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["err"] = "<span style='color:red;'>Invalid email format</span>";
      }else{
        $_SESSION["err"] = null;
      }
      if (empty($_SESSION["err"]) & isset($username) & isset($password) & isset($email) ) {
        $sql = "SELECT `username`,`email` FROM `users` WHERE `username` == '$username' or `email` == '$email' ";
        $result = $check_connection_to_signup->query($sql);
        if ($result == true) {
          $_SESSION["err"] = "User already exist";
        } else {          
       $sql = "INSERT INTO `users` (`username`,`password`,`email`) VALUES ('$username','$password','$email');";
       $result = $check_connection_to_signup->query($sql);
       if ($result > 0) {
         //$_SESSION["signed up"] = "<span style = 'color:green;'>Signed up successfully</span>";
             echo "
            <script>
             
                 alert('Signed up successfully');
                    window.location='friendsToChat.php';  hhhh
           </script>
       "; 
         } else {
         $_SESSION["signed up"] = "Unable to sign up ";
       }
       
             }
     
      } 
    } else {
        $_SESSION["err"] = "Server issues";
       }

      


  }

  public function login($username,$password){
    $check_connection_to_login = $this->connect_to_database_function();
    if($check_connection_to_login == true){
      $get_username =$username;
      $get_password =$password;
    $sql = "SELECT `id` FROM `users` WHERE `username` = '$get_username' AND `password` = '$get_password'";
    $result = $check_connection_to_login->query($sql);
    if($result->num_rows > 0 ){
      echo "
      <script>       
           alert('Logged in successfully');
              window.location='friendsToChat.php';
     </script>
 "; 
   } else {
   $_SESSION["Logged in"] = "Invalid details";
 }
 
          

    } else {
        $_SESSION["err"] = "Server issues";
       }      


  }
    
  
 


}

?>
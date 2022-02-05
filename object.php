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


  }
    
  
 



?>
<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($uname,$umail,$upass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO USERS(uname,umail,upassword) 
                                                       VALUES(:u_name, :u_mail, :upass)");
              
           $stmt->bindparam(":u_name", $uname);
           $stmt->bindparam(":u_mail", $umail);
           $stmt->bindparam(":upass", $new_password); 
                    
           $stmt->execute(); 
           ///tesst
           echo "New record created successfully";
   
           return $stmt; 

         // $con= new PDO("mysql:host={$DB_host} ;dbname={$DB_name}", $uname, $upass);
         // set the PDO error mode to exception
         // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         // $sql = ("INSERT INTO USERS (uname,umail , email)
         //  VALUES(:u_name, :u_mail, :upass)");
         // use exec() because no results are returned
      //    $con->exec($sql);
      //    $last_id = $con->lastInsertId();
      //    echo "New record created successfully. Last inserted ID is: " . $last_id;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }


   
 
    public function  login($uname,$umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM USERS WHERE uname=:u_name OR umail=:u_mail LIMIT 1");
          $stmt->execute(array(':u_name'=>$uname, ':u_mail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['upassword']))
             {
                $_SESSION['user_session'] = $userRow['id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        header("Location:index.php");

        
   }


}

?>
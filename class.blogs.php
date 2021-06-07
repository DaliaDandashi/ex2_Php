<?php
class Blogs
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function blog($title,$overview,$content, $date)
    {
       try
       {
         
   
           $stmt = $this->db->prepare("INSERT INTO blogs(title,overview,content,date) 
                                                       VALUES(:B_title,:B_overview, :B_content, :B_date)");
            $stmt->bindparam(":title", $title);  
           $stmt->bindparam(":B_overview", $overview);
           $stmt->bindparam(":B_content", $content);
           $stmt->bindparam(":B_date", $date); 
                    
           $stmt->execute(); 
           ///tesst
           echo "New blog created successfully";
   
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
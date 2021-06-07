<?php
require_once 'connection.php';

if($user->is_loggedin()!="")
{
    $user->redirect('HomePage.php');
}

if(isset($_POST['register']))
{
   $uname = trim($_POST['txt_uname']);
   $umail = trim($_POST['txt_umail']);
   $upass = trim($_POST['txt_upass']); 
 
   if($uname=="") {
      $error[] = "provide username !"; 
   }
   else if($umail=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($upass=="") {
      $error[] = "provide password !";
   }
   else if(strlen($upass) < 8){
      $error[] = "Password must be atleast 8 characters"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT uname ,	umail  FROM USERS WHERE uname=:u_name OR umail=:u_mail");


         $stmt->execute(array(':u_name'=>$uname, ':u_mail'=>$umail));


         $row=$stmt->fetch(PDO::FETCH_ASSOC);

         
    
         if($row['uname']==$uname) {
            $error[] = "sorry username already taken !";
         }
         else if($row['umail']==$umail) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->register($uname,$umail,$upass)) 
            {
                $user->redirect('register.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
   
   


<!-- HTML -->

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>`

<body  class="D-body">
    <div style="  margin-top: 10.5rem; margin-left:25em;" class="D-div-container">
        <!-- <div style="display: inline-block; width: 40%; margin-left: 5%;"> -->
        <div>
        <form method="post" >
            <h1>Register</h1>

            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
          
            
                <table>

                    <tr>
                        <td><label for="username">Username :</label></td>
                        <td><input name="txt_uname" id="username" placeholder="UserName" required value="<?php if(isset($error)){echo $uname;}?>" /></td>
                    </tr>

                    <tr>
                        <td><label for="password">Password :</label></td>
                        <td><input type="password" name="txt_upass" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required ></td>
                    </tr>
                    <tr>
                        <td>
                            <abel for="email">Email :</label>
                        </td>
                        <td><input name="txt_umail" id="email" placeholder="Email" value="<?php if(isset($error)){echo $umail;}?>" /></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="register" value="register">&nbsp;SIGN UP</button></td>
                    </tr>
                    <br />
                    <tr>
                    <td><label>have an account ! <a href="index.php">Sign In</a></label></td>
                    </tr>

                </table>
            </form>
        </div>
     </div>
     </div>
    
</body>
</html>
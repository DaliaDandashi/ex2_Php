<?php
require_once 'connection.php';

if($user->is_loggedin()!="")
{
 $user->redirect('HomePage.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$umail,$upass))
 {
  $user->redirect('HomePage.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
?>
<!DOCTYPE html >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login : cleartuts</title>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body  class="D-body">
<div style="  margin-top: 13rem; margin-left:25em;" class=" D-div-container">
     <div class="form-container">
        <form method="post">
            <h2>Sign in.</h2>
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
            </div> </br>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
            </div><br />
            <div class="clearfix"></div>
            <div class="form-group">
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>
            </div>
            <br />
            <label>Don't have account yet ! <a href="register.php">Sign Up</a></label>
        </form>
       </div>
</div>

</body>
</html>

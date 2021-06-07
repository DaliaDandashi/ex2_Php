<?php
include_once 'connection.php';
include_once 'header.php';
include_once 'footer.php';

if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM USERS WHERE id=:usid");
$stmt->execute(array(":usid"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['umail']); ?></title>

</head>

<body>

<div class="header">
 <div class="left">
     <label><a href="http://www.codingcage.com/">Coding Cage - Programming Blog</a></label>
    </div>
    <div class="right">
    <!-- <form action="" method="post">
    <input type="submit" name="logout" value="logout" class="D_logout">
    </form> -->
    </div>
</div>
<div class="content">
welcome : <?php print($userRow['uname']); ?>
<!-- <?php 
if (isset($_POST['logout'])){
    $user->logout();



}

?> -->
</div>
</body>

</html>
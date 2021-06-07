 <?php 
 require_once 'connection.php';

 require_once 'class.blogs.php';


// if (isset($_POST['addblogs.php'])) {
//     $overview = trim($_POST['txt_overview']);
//     $content = trim($_POST['txt_content']);
//     $date = trim($_POST['txt_date']);



//     $stmt = $DB_con->prepare("SELECT  ,	umail  FROM USERS WHERE uname=:u_name OR umail=:u_mail");


//     $stmt->execute(array(':u_name' => $uname, ':u_mail' => $umail));


//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

 

//  if ($row['uname'] == $uname) {
//     $error[] = "sorry username already taken !";
// } else if ($row['umail'] == $umail) {
//     $error[] = "sorry email id already taken !";
// } else {
//     if ($user->register($uname, $umail, $upass)) {
//         $user->redirect('register.php?joined');
//     }
// }
// }

// echo $e->getMessage();




//  ?>






<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>`

<body class="D-body">
    <div style="  margin-top: 10.5rem; margin-left:25em;" class="D-div-container">
        <!-- <div style="display: inline-block; width: 40%; margin-left: 5%;"> -->
        <div>
            <form method="post">
                <h1>Register</h1>

                <input type="text" name="overview" />
                <input type="text" name="content" />

                <button type="submit" name="addblog" value="addblog">Save</button>



            </form>
        </div>
    </div>
    </div>

</body>

</html>
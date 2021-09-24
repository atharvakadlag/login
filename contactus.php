<?php
session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location:login.php');
        exit;
    }
    include('connection.php');
    $google_signin = $_SESSION['google_signin'];
    if($google_signin == 0){
         $username = $_SESSION['user2'];
        //to prevent from mysqli injection
        $username= stripcslashes($username);
        $username = mysqli_real_escape_string($con,$username);
        $sql = "select * from login_regular where rollnum = '$username'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $picture = $row['rollnum'];
      // $_SESSION['query'] = $query;
      //mysqli_close($con);
    }
    else {
	$email = $_SESSION['email'];
    $name = $_SESSION['g_name'];
        $sql = "select * from login_gmail where gmail = '$email'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $picture = $row['rollnum'];
    }
            //$_SESSION['query'] = $query;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="StudentPage.css">
    <link rel="stylesheet" href="ContactUs.css">
    <style>
    </style>
    <title> Contact Us! </title>
</head>
<body>
<div class="header">
<div class="header__container">
            <a href="/login/student_page.php">
                <div class="header__item aa_logo" >
                    <img src="images\icons\aa_logo.png" alt="AA_LOGO"  />
                </div>
            </a>
            <div class="header__item">
                <h1><?php if($google_signin == 0){  echo "Welcome, ".$row['name']."";} else{ echo "Welcome, ".$name."!!"; }?></h1>
            </div>
            <a href="http://iiitdm.ac.in/" target="_blank">
            <div class = "header__item" >
            
            <img src="images\icons\iiitdmlogo.png" alt="IIITDMK LOGO"  /> 
                
            </div>
            </a>
        </div>
</div>
    
      
<div class="form__container" align="center">
        <form name="f1" method = "POST" action="response.php" class="form">
            <label for="query" class="form__label">Type your Query Here:</label>
            <textarea rows="15" cols="40" name="query" class="form__textArea">
                
            </textarea>
            
            <input type="submit" value="Submit" class="form__submit button">
        </form> 
        <br>
                <div class="container__contactUs">

                        Mail us at : <br> alumni.affairs@iiitdm.ac.in <br> OR
                        <br> edm18b040@iiitdm.ac.in <br> OR
                        <br> ced19i027@iiitdm.ac.in 
 
                </div> 

</div>
</body>
</html>

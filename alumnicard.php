<?php
session_start();
    if(!isset($_SESSION['status']))
    {
        header('Location:index.php');
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

      mysqli_close($con);
    }
    else {
	$email = $_SESSION['email'];
    $name = $_SESSION['g_name'];
        $sql = "select * from login_gmail where gmail = '$email'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $picture = $row['rollnum'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StudentPage.css">
    <style>
</style>
    <title> Alumni Card </title>
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
    <div class="grid-container1">
        <div class="item11">
        <?php 
        $pic = "images"."\\"."alumni"."\\".$picture.".jpg" ;
        ?>
            <img src= "<?= $pic; ?>" alt="Collage" width="auto" height="500px" />
            <div class="middle">

            </div>
        </div>
        <div class="item31">
            <a href="<?= $pic; ?>" download target="_blank">
                <button class="button">
                    Download
                </button>
            </a>
        </div>
</body>
</html>
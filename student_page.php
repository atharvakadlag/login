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
        $sql = "select name from login_regular where rollnum = '$username'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
      mysqli_close($con); 
    }
    else {
	$email = $_SESSION['email'];
    $name = $_SESSION['g_name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="StudentPage.css">
    <style>
    </style>
    <title> <?php if($google_signin == 0){  echo $row['name']."";} else{ echo $name; } echo "'s Dashboard";?> </title>
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


    <div class="container">   
        <div class="container__logout">
            <a href="logout.php">
                <button class="button__logout">
                    Log out
                </button>
            </a>
        </div>  
        <div class="parent">
            <div class="div1"> 
                <div class="container__item">
                    <a href="collage.php">
                    <button class="button">
                        Class of 2021
                    </button>
                    </a>
                </div> 
            </div>
            <div class="div2"> 
                <div class="container__item">
                    <a href="alumnicard.php">
                    <button class="button">
                        Alumini Card
                    </button>
                    </a>
                </div>
            </div>
            <div class="div3">
                <div class="container__item">
                    <a href="https://iiitdm.almaconnect.com/contributions/sneak_peek" target = "_blank">
                        <button class="button">
                        Community Feed
                        </button>
                    </a>
                </div>
            </div>
            <div class="div4">
                <div class="container__item">
                    <a href="donate.html" target = "_blank">
                    <button class="button">
                    Donate Us!!
                    </button>
                    </a>
                </div>    
            </div>
            <div class="div5">
                <div class="container__contactUs">
                    <a href="contactus.php">
                        <button class="button">
                        Contact Us
                        </button>
                    </a>       
                </div> 
            </div>
        </div>
        
    
    <?php 
        if($google_signin == 1){
            if($email == 'alumni.affairs@iiitdm.ac.in' ){
                echo "<a href"."="."admin_control.php".">";
                echo "<button class". "=" ."button". ">";
                        echo "Admin Control";
                 echo "   </button>
                </a> ";
            }
        }
    ?>
</body>
</html>

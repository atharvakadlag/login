<?php
session_start();
    $query_receive = 0;
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
        $roll = $username;
      //mysqli_close($con); 
    }
    else {
	$email = $_SESSION['email'];
    $name = $_SESSION['g_name'];
        $email= stripcslashes($email);   
        $email = mysqli_real_escape_string($con,$email); 
        $sql1 = "select rollnum from login_gmail where gmail = '$email'";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $roll = $row1['rollnum'];
}
        $query = $_POST['query'];
        //to prevent from mysqli injection  
        $query= stripcslashes($query);   
        $query = mysqli_real_escape_string($con,$query);  


        $sql3 = "SELECT * FROM queries WHERE query ='$query' and roll_num = '$roll'";
        $result3 = mysqli_query($con, $sql3);
        if(mysqli_fetch_array($result3))
        {
        

        }
        else {
	        $sql2 ="insert into queries(roll_num, query) values('$roll','$query')";
            $result2 = mysqli_query($con, $sql2);
            echo "Your Query has been submitted";
            $query_receive = 1;
}

if($query_receive == 1)
{

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StudentPage.css">
    
</head>
<body>
<div class="header">
        <div class="header__container">
            <div class="header__item" >
                <img src="images\icons\iiitdmlogo.png" alt="IIITDMK LOGO"  />
            </div>
            <div class="header__item">
                <h1><?php if($google_signin == 0){  echo "Welcome, ".$row['name']."";} else{ echo "Welcome, ".$name."!!"; }?></h1>
            </div>
            <div class = "header__item aa_logo" >
                <img src="images\icons\aa_logo.png" alt="AA_LOGO"  />
            </div>
        </div>
    </div>
    
</body>
</html>
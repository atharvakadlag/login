<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Alumni Affairs | IIITDMK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="GlobalStyles.css">
	<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #efefef;
  text-align: center;
  padding: 10px 0;
}
</style>

</head>

<body>
<div class="header">
  <img src="images\icons\iiitdmlogo.png" alt="IIITDMK LOGO" />
</div>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form"  name="f1" action = "process.php"  method = "POST">
					<div class="form-container">
						<div class="form-container__loginTitle">
							<h1>Login</h1>
						</div>
						
						<div class="wrap-input100 validate-input" data-validate="Username is required">
							<input class="input100" type="text" placeholder="Roll Number"  id="user" name="user">
							<span class="focus-input100"></span>
						</div>

						
						<div class="wrap-input100 validate-input" data-validate="Password is required">
							<input class="input100" type="password" placeholder="Password"  id="pass" name="pass">
							<span class="focus-input100"></span>
						</div>
						<div class="container-login100-form-btn m-t-17">
							<button class="login100-form-btn" style="cursor: pointer">
								Sign In
							</button>
						</div>
						<div class="form-container__OR">
							<p>OR</p>
						</div>
					
					
<?php
require_once 'vendor/autoload.php';
$clientID = '207150863646-7gcucvchpnm04eg6rooelpmmk8hgdfa7.apps.googleusercontent.com';
$clientSecret = '4kyCs2sRQZx2_-a8cd70IKo9';
$redirectUrl = 'https://alumni-affairs-iiitdm.herokuapp.com/student_page.php';

//Create Client Request to google
$client = new Google_Client();
$client -> setClientId($clientID);
$client -> setClientSecret($clientSecret);
$client -> setRedirectUri($redirectUrl);
$client -> addScope('profile');
$client -> addScope('email');

if ( isset($_GET["code"]) ){
$token = $client -> fetchAccessTokenWithAuthCode($_GET["code"]);
$client -> setAccessToken($token);

//getting user profile
$gauth = new Google_Service_Oauth2($client);
$google_info = $gauth -> userinfo -> get();
$email = $google_info -> email;
$name = $google_info -> name;
    include('connection.php'); 
    session_start();  
    $sql = "select * from login_gmail where gmail = '$email'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
        
    if($count == 1){ 
	      session_start();
          $_SESSION['status']="active"; 
		  $google_signin = 1;
          $_SESSION['google_signin'] = $google_signin;
		  $_SESSION['email'] = $email;
		  $_SESSION['g_name'] = $name;
	      $google_signin = 1;
          header('Location: student_page.php');
          exit;
    }  
    else{  
          header('Location: login.php');
          exit;
        }
}
else {
	echo "<a href = '". $client -> createAuthUrl()."' class ='"." logoLink "."'><img src ="."images/icons/icon-google.png"." alt="."GOOGLE"."> <p>Sign-in With Google</p></a>";
}
?>
					</div> 
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
</body>
</html>

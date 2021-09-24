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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="compact-gallery.css">
    <link rel="stylesheet" href="horizontal.css">
    <style>
        .collage-image:hover{
            transform: scale(1.01);
            transition-duration: 100ms;
            cursor: pointer;
        }
        .grid-container1{
            display: grid;
            grid-template-areas: 'menul main main main main main main menur menur menur menur';
            grid-gap:0px;
            padding: 0px;
        }
        
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
    <title>Class of 2021</title>
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
                <h1>Class of 2021!!</h1>
       
            </div>
            <a href="http://iiitdm.ac.in/" target="_blank">
            <div class = "header__item" >
            
            <img src="images\icons\iiitdmlogo.png" alt="IIITDMK LOGO"  /> 
                
            </div>
            </a>
        </div>
    </div>
    <div class="grid-container1">
    <div class="row">
    <?php
             $batch = substr($picture, 0, 5);
             $sql1 = "SELECT rollnum from login_gmail where rollnum like '$batch%'";
             if ($batch == 'ESD16' or $batch == 'EVD16'){
                  $sql1 ="SELECT rollnum from login_gmail where rollnum like 'EVD16%' OR rollnum like 'ESD16%'";
             }
             else if ($batch == 'MFD16' or $batch == 'MPD16') {
                  $sql1 ="SELECT rollnum from login_gmail where rollnum like 'MFD16%' OR rollnum like 'ESD16%'";
             }
             $result1 = mysqli_query($con,$sql1);
             $row1 = mysqli_fetch_array($result1);

    ?>
    <?php 
        if(mysqli_num_rows($result1)>0)
        {
             $pic = "images"."\\"."collage"."\\".$row['rollnum'].".jpg" ; ?>
   <div class="column">
   <?php echo $pic; ?>
  <img src="<?= $pic; ?>" class="collage-image">
  
  </div>


<?php
        }
        while($row=mysqli_fetch_array($result1)):
    ?>
<?php

  $pic = "images"."\\"."collage"."\\".$row['rollnum'].".jpg" ;  ?>

   <div class="column">
     <?php echo $pic; ?>
  <img src="<?= $pic; ?>" class="collage-image" width="50%" height="auto">
  
  </div>

<?php

?>
<?php endwhile;?>
  
  </div> 
</div>
</div>


</body>
</html>

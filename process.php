<?php      
    include('connection.php'); 
    session_start();
    $_SESSION['status']="active"; 
    $_SESSION['user2']=$_POST['user'];  
    $username = $_POST['user'];  
    $password = $_POST['pass']; 
    $google_signin = 0;
    $_SESSION['google_signin'] = 0;
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  

        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
        
      
        $sql = "select name from login_regular where rollnum = '$username' and password = '$password' ";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 
        
        if($count == 1){  
              header('Location: student_page.php');
              exit;
        }  
        else{  
           echo "Login fail";
        }
?>
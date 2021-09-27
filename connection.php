<?php      
    $host = "us-cdbr-east-04.cleardb.com";  
    $user = "b54d61c78cc5f9";  
    $password = 'd186830e';  
    $db_name = "
heroku_08621bccaf9a332";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?> 

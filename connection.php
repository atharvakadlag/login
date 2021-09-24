<?php      
    $host = "us-cdbr-east-04.cleardb.com";  
    $user = "b0331734b14842";  
    $password = 'a8d8958b';  
    $db_name = "heroku_1761586faccbda9	";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?> 

<?php      
    $host = "localhost";  
    $user = "b54d61c78cc5f9";  
    $password = 'd186830e';  
    $db_name = "login";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?> 

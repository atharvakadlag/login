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
    <link rel="stylesheet" href="style.css">
    <style>
.item1{ grid-area: main;}
.item2{ grid-area: menul;}
.item3{ grid-area: menur;}
.grid-container{
    display:grid;
    grid-template-areas:
        'menul main menur';
    grid-gap: 20px;
   padding:10px;
}
        .header {
            text-align: right;
            background-color: #bbf1fa;
        }

        .header-left {
            float: left;
            font-size: 50px;
            color: black;
        }
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 15px;
  font-family: "Lucida Console", "Courier New", monospace;
}

#customers tr:hover {background-color: #ddd;}
tr
{
    background-color:#bfcba8;
    color:#464f41;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #464f41;
  color: white;
  font-family: "Lucida Console", "Courier New", monospace;
}
    </style>
</head>
<body>
    <div class="header">
        <a href="student_page.php">
            <div class="header-left">
                Home
            </div>
        </a>
        <img src="images\icons\Insignia.png" alt="IIITDMK LOGO" width="80px" height="auto" />
        <img src="images\icons\aa_logo.png" alt="AA_LOGO" width="80px" height="auto" />
    </div>
<?php 
        $sql = "select * from queries";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
?>
<form name="f3"  method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">
    <table id = customers>
    <thead>
    <?php 
        if(mysqli_num_rows($result)>0)
        {
            echo "<tr>";
            echo "<th></th>";
            echo "<th>Q.No </th>";
            echo "<th>Roll Number</th>";
            echo "<th>Query</th>";

            echo "</tr>";
        }
        else
        {
            echo "No questions!";
        }
        while($row=mysqli_fetch_array($result)):
    ?>
<tbody>
   <tr>
       <td><input type="radio" name="ticked[]" value="<?php echo $row["qno"];?>"></td> 
<?php
  
  echo "<td>". $row['qno']."</td>";  

  echo "<td>" . $row['roll_num'] . "</td>";

  echo "<td>" . $row['query'] . "</td>";
?>
    </tr><?php endwhile;?>
</tbody>
</table>    
</thead>
</br>


    <p>
        <input type =  "submit" id = "btn1" value = "Remove" />
    </p>
</form>
<?php
if(isset($_POST['ticked']))   
    {
       foreach ($_POST["ticked"] as $id)
       {
           if($id)
            { 
                echo $id;
                $sql = "delete from queries WHERE qno = '$id'";
               $result = mysqli_query($con,$sql);
            }
           else
               echo "ERROR: Select a query first!";
       }
    }

?>

</body>
</html>
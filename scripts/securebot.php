<?php session_start(); ?>


<?php

include '../connect.php';
$username=$_POST['username'];
$password=$_POST['password'];
//SQL Injection Guard
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($con, $_POST["username"] );
$password = mysqli_real_escape_string($con, $_POST["password"] );
echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>"
?>

<?php

$result = mysqli_query($con,"SELECT db_accounts.username, db_accounts.password FROM db_accounts
	WHERE db_accounts.username = '$username' AND db_accounts.password = '$password' ");
        
        
        $num=mysqli_num_rows($result);
    if ($num > 0) {

      if($row = mysqli_fetch_array($result)) {
        $username = $row['username'];
        $_SESSION['username']=$username;
        // Success? To the Dashboard!
	    echo "<script>location.href='../dashboard.php'</script>";
      }

     } else {
     // Invalid login? Try again!
     

     mysqli_close($con);
     session_destroy();
     echo "<script>location.href='../login.php'</script>";
     }
?>
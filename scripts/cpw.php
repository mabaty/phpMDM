<?php session_start(); ?>






<?php
include '../connect.php';
$username = $_SESSION['username'];
$password = $_POST['cpw1'];
?>

<?php

$check = mysqli_query($con,"SELECT * FROM db_accounts WHERE username = '$username' ");
        
        
        $num=mysqli_num_rows($check);
    if ($num > 0) {
	    mysqli_query($con, "UPDATE db_accounts SET db_accounts.password = '$password' WHERE db_accounts.username = '$username'; ");
	    echo "<script>alert('Password Changed!')</script>";
	    echo "<script>location.href='../settings.php'</script>";
      

     } else {
     echo "<script>alert('No User Found!')</script>";
     echo "<script>location.href='../settings.php'</script>";
     }
?>
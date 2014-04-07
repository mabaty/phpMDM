
<?php

include '../connect.php';
$username=$_POST['un'];
$password=$_POST['pw1'];
?>

<?php

$check = mysqli_query($con,"SELECT db_accounts.username, db_accounts.password FROM db_accounts
	WHERE db_accounts.username = '$username'");
        
        
        $num=mysqli_num_rows($check);
    if ($num > 0) {
	    echo "<script>alert('Username Already Taken!')</script>";
	    echo "<script>location.href='../settings.php'</script>";
      

     } else {
     // Invalid login? Try again!
     mysqli_query($con, "INSERT INTO db_accounts (username, password) VALUES ('$username','$password');");
     echo "<script>alert('Account Created!')</script>";
     echo "<script>location.href='../settings.php'</script>";
     }
?>
<?php session_start(); ?>


<?php
session_destroy();

echo "<script>alert('Logged Out!')</script>";
echo "<script>location.href='http://mdm.techandtheory.com/alpha/login.php'</script>";
?>
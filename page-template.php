<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='login.php'</script>";
}  
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Matt Baty">

    <title>Mobile Device Management ALPHA - </title>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>MDM ALPHA - </h1>
        </div>

        <div id="menu">
            <div class="nav"><a href="dashboard.php">Dashboard</a></div><div class="nav"><a href="addrec.php">Add Record</a></div><div class="nav"><a href="#update">Update Records</a></div><div class="nav"><a href="new_reports.php">Reports</a></div><div class="nav"><a href="#home">Settings</a></div>
            <div class="nav"><a href="logout.php">Logout</a>
        </div>

        <div id="content">
            <p>Add New Record:</p>
            
            <div id="footer">
            	<p>Project MDM.</p>
            </div>
        </div>
    </div>
</body>
</html>
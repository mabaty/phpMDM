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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Matt Baty">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

    <title>Mobile Device Management ALPHA - Settings</title>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>MDM ALPHA - Settings </h1><?php echo "<p>Hello, $username</p>"; ?>
        </div>

        <div id="menu">
            <div class="nav">
                <a href="dashboard.php">Dashboard</a>
            </div>
            
            <div class="nav">
                <a href="addrec.php">Add Record</a>
            </div>

            <div class="nav">
                <a href="update.php">Update Records</a>
            </div>

            <div class="nav">
                <a href="new_reports.php">Reports</a>
            </div>

            <div class="nav">
                <a href="settings.php">Settings</a>
            </div>

            <div class="nav">
                <a href="scripts/logout.php">Logout</a>
            </div>
       </div>

        <div id="content">
        	<div id="dashsettings">
            	<h3 style="margin-left:25px;">Settings</h3>
            	<p style="margin-left:25px; font-size:x-small;">MDM version: 0.1 (Alpha)</p><br/>
            	
            	<!-- New Users -->
            	<div style="width:250px; float:left; margin-top:25px; margin-left:175px;">
            		<form action="scripts/newuser.php" method="post" id="newb">
	            		<fieldset>
		            		<legend>Add New Database User</legend>

		            		<label class="un">User Name: </label><br/>
		            		<input type="text" name="un" id="un" maxlength="25" pattern="[a-z,A-Z,0-9]{4,25}" title="Username must have 4-25 characters and alphanumeric!" required="on"/> <br/>

		            		<label class="pw">Password: </label> <br/>
		            		<input type="password" name="pw1" id="pw1" maxlength="25" pattern=".{6,25}" title="Password must be 6-25 characters!" required="on"/> <br/>
		            		
		            		<label class="pw">Re-Type Password: </label> <br/>
		            		<input type="password" name="pw2" id="pw2" maxlength="25" pattern=".{6,25}" title="Password must be 6-25 characters!" required="on"/> <br/>

			            		<input type="reset" value="Clear" class="button"/>
				            	<input type="submit" value="Submit" class="button"/>
			            </fieldset>
				     </form><br/>
				     <script type="text/javascript">
						$("#newb").submit(function() {
							var error = 0;
							var password1 = $('#pw1').val();
							var password2 = $('#pw2').val();
							if (password1 != password2) {
								error = 1;
								$(".pw").css({color:"red"});
								$(".pw").html('Passwords do not match.');
							} if (error) {
								return false;
							} else {
								return true;
							}
						});
					</script></div>
				<!-- End New Users -->
					
            	<!-- New PW -->
            	<div style="width:250px; float:left; margin-top:25px; margin-left:100px;">
            		<form action="scripts/cpw.php" method="post" id="newpw">
	            		<fieldset style="height: 225px;">
		            		<legend>Change User Password</legend>

		            		<label class="cpw">Password: </label> <br/>
		            		<input type="password" name="cpw1" id="cpw1" maxlength="25" pattern=".{6,25}" title="Password must be 6-25 characters!" required="on"/> <br/>
		            		
		            		<label class="cpw">Re-Type Password: </label> <br/>
		            		<input type="password" name="cpw2" id="cpw2" maxlength="25" pattern=".{6,25}" title="Password must be 6-25 characters!" required="on"/> <br/><br/><br/>

			            		<input type="reset" value="Clear" class="button"/>
				            	<input type="submit" value="Submit" class="button"/>
			            </fieldset>
				     </form><br/>
				     <script type="text/javascript">
						$("#newpw").submit(function() {
							var error = 0;
							var cpassword1 = $('#cpw1').val();
							var cpassword2 = $('#cpw2').val();
							if (cpassword1 != cpassword2) {
								error = 1;
								$(".cpw").css({color:"red"});
								$(".cpw").html('Passwords do not match.');
							} if (error) {
								return false;
							} else {
								return true;
							}
						});
					</script>
					</div>
				<!-- End New PW -->
			
        		</div>   	
            </div>
            <div id="footer">
            	<p></p>
            </div>
        </div>
    </div>
</body>
</html>
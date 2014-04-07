


<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Matt Baty" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    
    <title>Mobile Device Management ALPHA - Login</title>
</head>

<body>
	
	<div id="container">
		<div id="header">
			<h1>MDM ALPHA LOGIN</h1>
			</div>
			<div id="content">
				<div id="login">
					<strong>Please Login:</strong>
					<form  id="lgnfrm" action="scripts/securebot.php" method="post" autocomplete="on">
					<label class="un">Username:</label>
					<input type="text" style="width:210px" maxlength="25" id="un" name="username" autofocus="on" /><br/>
					<label class="unpw">Password:</label>
					<input type="password" style="width:210px" maxlength="25" id="pw" name="password" /><br/>
					<input  class="button" type="submit" value="Sign-in" id="signin" />
					</form>
					
					<script type="text/javascript">
						$("#lgnfrm").submit(function() {
							var error = 0;
							var username = $('#un').val();
							if (username == '') {
								error = 1;
								$(".un").css({color:"red"});
								$(".un").html('Must enter a username.');
								$("#login").effect("bounce", {times:2}, 150);
							} else if (username.length > 25 || username.length < 4) {
								error = 1;
								$(".un").css({color:"red"});
								$(".un").html('Username must be 4-25 characters.');
								$("#login").effect("bounce", {times:2}, 150);
								//$("form input:text").css({border:"2px red solid"});
							}
							if (error) {
								return false;
							} else {
								return true;
							}
						});
					</script>
				</div>
			</div>
			<div id="footer">
				<p>Project MDM.</p>
			</div>
	</div>
</body>
</html>


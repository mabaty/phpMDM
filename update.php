<?php
session_start();
include("connect_new.php");
include("function.php");

@$username = $_SESSION['username'];
if(@$username==null || @$username=="")
{
	echo "<script>location.href='http://mdm.techandtheory.com/alpha/login.php'</script>";
}


if(isset($_POST['submit'])){
	unset($_SESSION['user_id']);

	if(!empty($_POST['userlist'])){

		$_SESSION['user_id'] = $_POST['userlist'];
		echo '<script>window.location.replace("add_device.php");</script>';

	}else{

		$f_name     = mysql_real_escape_string(trim($_POST['f_name']));
		$l_name     = mysql_real_escape_string(trim($_POST['l_name']));
		$office_loc = mysql_real_escape_string(trim($_POST['office_loc']));

		$insert_data  = array(
			'f_name'    =>$f_name,
			'l_name'    =>$l_name,
			'office_loc'=>$office_loc
		);

		$data   = insertData('users', $insert_data);

		if($data){

			$_SESSION['success'] = "New User Added Successfully...";
			$_SESSION['user_id'] = mysql_insert_id();
			echo '<script>window.location.replace("add_device.php");</script>';
		}
	}

}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Mobile Device Management - Update Record</title>

	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery-datepicker.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript" src="js/validation.js"></script>
	<script type="text/javascript" src="js/jquery-datepicker.js"></script>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#date").datepicker({showOn: 'button', buttonImage: 'css/calendar.gif',dateFormat:"yy-mm-dd", buttonImageOnly: true, changeMonth: true, changeYear: true, showOn: 'both'});

			$('.success-msg').delay(10000).fadeOut('slow');
			$('.error_msg').delay(10000).fadeOut('slow');

			$("#userlist").change(function () {
				if ($('#userlist').val()) {
					$('#submit').val('Next');
				} else {
					$('#submit').val('Submit');
				}
			});

		});
	</script>
</head>
<body>

<div id="container">
		<div id="header">
            <h1>MDM ALPHA DASHBOARD - Update Record</h1><?php echo "<p>Hello, $username</p>"; ?>
        </div>
        <div id="menu">
            <div class="nav"><a href="dashboard.php">Dashboard</a></div>
            <div class="nav"><a href="addrec.php">Add Record</a></div>
            <div class="nav"><a href="update.php">Update Records</a></div>
            <div class="nav"><a href="new_reports.php">Reports</a></div>
            <div class="nav"><a href="settings.php">Settings</a></div>
            <div class="nav"><a href="scripts/logout.php">Logout</a>
        </div>
        
        
	<div id="content">
    	<div id="dash" style="height:325px;">
        	<div style="width:350px;margin-left:305px;">
        <h2>Update Record:</h2>

	<form action="" method="post" name="" id="form">

		<div class="laft-box update">
			<fieldset>	<legend>Add Device to Existing User :</legend>
				Select a User
				<select name="userlist" class="select" id="userlist">
					<option value="">--Select One--</option>
					<?php
					foreach(get_all_user() as $user){ $name = $user->f_name.' '.$user->l_name; ?>
						<option value="<?php echo $user->user_id ?>"><?php echo $name; ?></option>
					<?php }
					?>
				</select>
			</fieldset>
		</div>

		<div class="all_button" style="margin-top:20px;">
			<input type="reset" name="clear" value="Cancel" class="button" />
			<input type="submit" name="submit" value="Submit" class="button" id="submit" />
		</div>

		</form>

			</div>
            </div>
		<div id="footer">
            	<p>Project MDM</p>
            
		</div>
	</div>
    </div>
</body>
</html>
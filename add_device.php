<?php
session_start();
include("connect_new.php");
include("function.php");

@$username = $_SESSION['username'];
if(@$username==null || @$username=="")
{
	echo "<script>location.href='http://mdm.techandtheory.com/alpha/login.php'</script>";
}

date_default_timezone_set('America/Boise');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>Mobile Device Management ALPHA - </title>

		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<link href="css/jquery-datepicker.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/validation.js"></script>
		<script type="text/javascript" src="js/jquery-datepicker.js"></script>
		<script type="text/javascript" src="js/divice-validation.js"></script>

		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#date").datepicker({showOn: 'button', buttonImage: 'css/calendar.gif',dateFormat:"yy-mm-dd", buttonImageOnly: true, changeMonth: true, changeYear: true, showOn: 'both'});

				$('.success-msg').delay(10000).fadeOut('slow');
				$('.error_msg').delay(10000).fadeOut('slow');
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
    	<div id="dash" style="height:480px;">
        	<div style="width:900px;height:470px;margin-left:30px;">
        <h2>Update Record:</h2>
		<?php
		if(isset($_SESSION['success'])){
			echo "<h3 class='success-msg'>".$_SESSION['success']."</h3>";
			unset($_SESSION['success']);
		}

		if(isset($_POST['submit'])){

			$user_ID         = mysql_real_escape_string(trim($_POST['user_ID']));
			$purchase_date   = mysql_real_escape_string(trim($_POST['purchase_date']));
			$price           = mysql_real_escape_string(trim($_POST['price']));
			$imei            = mysql_real_escape_string(trim($_POST['imei']));
			$serial          = mysql_real_escape_string(trim($_POST['serial']));
			$phone           = mysql_real_escape_string(trim($_POST['phone']));
			$purchaser       = mysql_real_escape_string(trim($_POST['purchaser']));
			$model           = mysql_real_escape_string(trim($_POST['model']));
			$manufac         = mysql_real_escape_string(trim($_POST['manufac']));
			$carrier         = mysql_real_escape_string(trim($_POST['carrier']));
			$status          = mysql_real_escape_string(trim($_POST['status']));
			$note            = mysql_real_escape_string(trim($_POST['note']));
				//Strips Regex from <textarea>
				$note 		 = stripslashes($note);
				$note 		 = str_replace("\r\n", " ", $note);
				
			$devices_row = getRow("SELECT * FROM `devices` WHERE `user_id` ='$user_ID'");

				$insert_data  = array(
					'user_id'       => $user_ID,
					'make'          => $manufac,
					'model'         => $model,
					'phone_num'     => $phone,
					'serial_num'    => $serial,
					'imei_string'   => $imei,
					'purchaser'     => $purchaser,
					'price'         => $price,
					'purchase_date' => $purchase_date,
					'carrier'       => $carrier,
					'device_status' => $status
				);

			if($devices_row==null){
				$data       = insertData('devices', $insert_data);
				$devices_ID = mysql_insert_id();
			}else{
				$where      = array('user_id'=> $user_ID);
				$data       = updateData('devices', $insert_data, $where);
				$devices_ID = $devices_row[0];
			}

			if($data){

				$activity_data  = array(
					'user_id'       => $user_ID,
					'device_id'     => $devices_ID,
					'activity_type' => '',
					'activity_notes'=> $note,
					'activity_date' => date("Y-m-d"),
				);

			 $activity_row = getRow("SELECT * FROM `activity_log` WHERE `user_id` ='$user_ID'");

			 if($activity_row==null){
			     insertData('activity_log', $activity_data);
				 echo "<h3 class='success-msg'>Device Added Successfully.</h3>";
			 }else{
				 $where = array('user_id'=> $user_ID);
				 $data = updateData('activity_log', $activity_data, $where);
				 echo "<h3 class='success-msg'>Device Updated Successfully.</h3>";
			 }

			}

		}

		if(!empty($_SESSION['user_id'])){

		    $user_data  = get_user_data($_SESSION['user_id']);
            $name       =  $user_data->f_name.' '.$user_data->l_name;

           if($device_data = get_device_data($_SESSION['user_id'])){
	           $purchase_date = $device_data-> 	purchase_date ? $device_data-> 	purchase_date : '';
	           $price         = $device_data->price ? $device_data->price : '';
	           $imei          = $device_data->imei_string ? $device_data->imei_string : '';
	           $serial        = $device_data->serial_num ? $device_data->serial_num : '';
	           $phone         = $device_data->phone_num ? $device_data->phone_num : '';
	           $purchaser     = $device_data->purchaser ? $device_data->purchaser : '';
	           $model         = $device_data->model ? $device_data->model : '';
	           $manufac       = $device_data->make ? $device_data->make : '';
	           $carrie        = $device_data->carrier ? $device_data->carrier : '';
	           $status        = $device_data->device_status ? $device_data->device_status : '';
	           $note          = get_user_note($_SESSION['user_id']) ? get_user_note($_SESSION['user_id']) : '';
	       }else{
	           $purchase_date = '';
	           $price         = '';
	           $imei          = '';
	           $serial        = '';
	           $phone         = '';
	           $purchaser     = '';
	           $model         = '';
	           $manufac       = '';
	           $carrie        = '';
	           $status        = '';
	           $note          = '';
           }


		?>

		<form action="" method="post" name="" id="form">

			<div class="laft-box">

				<table border="0" class="table">
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_id']; ?>" />
					<tr>
                        <td><label for="name">Device User</label></td>
						<td><input type="text" name="name" value="<?php echo $name; ?>" readonly /></td>
					</tr>
					<tr>
						<td><label for="name">Purchase Date</label></td>
						<td><input type="text" name="purchase_date" id="date" value="<?php echo $purchase_date; ?>" placeholder="Optional" /></td>
					</tr>
					<tr>
						<td><label for="name">Price $</label></td>
						<td><input type="text" name="price" value="<?php echo $price; ?>" placeholder="Optional" /></td>
					</tr>
					<tr>
						<td><label for="name">IMEI #</label></td>
						<td><input type="text" name="imei" value="<?php echo $imei; ?>" placeholder="Optional" /></td>
					</tr>
					<tr>
						<td><label for="name">Serial #</label></td>
						<td><input type="text" name="serial" value="<?php echo $serial; ?>" placeholder="Optional" /></td>
					</tr>
					<tr>
						<td><label for="name">Phone #</label></td>
						<td><input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Optional"  /></td>
					</tr>
					<tr>
						<td><label for="name">Purchaser</label></td>
						<td>
							<select name="purchaser" id="purchaser">
								<option value="">--Select One---</option>
								<option value="Wirestone" <?php if($purchaser == 'Wirestone') echo 'selected' ?>>Wirestone</option>
								<option value="User" <?php if($purchaser == 'User') echo 'selected' ?>>User</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="name">Model</label></td>
						<td>
							<select name="model" id="model">
								<option value="">--Select One---</option>
								<option value="iPhone" <?php if($model == 'iPhone') echo 'selected' ?>>iPhone</option>
								<option value="One" <?php if($model == 'One') echo 'selected' ?>>One</option>
								<option value="Galaxy" <?php if($model == 'Galaxy') echo 'selected' ?>>Galaxy</option>
								<option value="Droid" <?php if($model == 'Droid') echo 'selected' ?>>Droid</option>
								<option value="Lumia" <?php if($model == 'Lumia') echo 'selected' ?>>Lumia</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="name">Manufacturer</label></td>
						<td>
							<select name="manufac" id="manufac">
								<option value="">--Select One---</option>
								<option value="Apple" <?php if($manufac == 'Apple') echo 'selected' ?>>Apple</option>
								<option value="HTC" <?php if($manufac == 'HTC') echo 'selected' ?>>HTC</option>
								<option value="Samsung" <?php if($manufac == 'Samsung') echo 'selected' ?>>Samsung</option>
								<option value="Nokia" <?php if($manufac == 'Nokia') echo 'selected' ?>>Nokia</option>
								<option value="Nokia" <?php if($manufac == 'Motorola') echo 'selected' ?>>Motorola</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="name">Carrier </label></td>
						<td>
							<select name="carrier" id="carrier">
								<option value="">--Select One---</option>
								<option value="AT&T" <?php if($carrie == 'AT&T') echo 'selected' ?>>AT&T</option>
								<option value="Verizon" <?php if($carrie == 'Verizon') echo 'selected' ?>>Verizon</option>
								<option value="Sprint" <?php if($carrie == 'Sprint') echo 'selected' ?>>Sprint</option>
								<option value="T-Mobile" <?php if($carrie == 'T-Mobile') echo 'selected' ?>>T-Mobile</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="name">Device Status</label></td>
						<td>
							<select name="status" id="status">
								<option value="">--Select One---</option>
								<option value="Active" <?php if($status == 'Active') echo 'selected' ?>>Active</option>
								<option value="Inactive" <?php if($status == 'Inactive') echo 'selected' ?>>Inactive</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<div class="right-box">
				<textarea class="textarea" name="note" id="notes" placeholder="Device Notes" cols="41" rows="10"><?php print($note); ?></textarea>
			</div>
			<div class="all_button" style="width: 52%">
				<input type="reset" name="clear" value="Cancel" class="button" />
				<input type="submit" name="submit" value="Submit" class="button" />
			</div>

		</form>

	    <?php

		}else{ ?>
			<div>
				<h2>Sorry, no data found.</h2>
			</div>
		<?php } ?>

		</div>
	</div>
    <div style="clear:both"></div>
		<div id="footer">
            	<p>Project MDM</p>
            
		</div>
    </div>
	</body>
</html>
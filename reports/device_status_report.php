<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?>

<?php include '../connect.php'; 

extract($_POST);

$device_status=$device_status;

$device_status_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.phone_num, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where device_status='$device_status' order by devices.user_id";
$device_status_results=mysqli_query($con, $device_status_query);


$purchase_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where purchaser='Wirestone' and device_status='$device_status' order by devices.user_id";
$purchase_results=mysqli_query($con, $purchase_query);

$purchase_amount_query="select sum(price), devices.purchaser, devices.user_id, devices.device_status from devices inner join users on devices.user_id=users.user_id where purchaser='Wirestone' and device_status='$device_status'";
$purchase_amount_results=mysqli_query($con, $purchase_amount_query);

$purchase_average_query="select avg(price), devices.purchaser, devices.user_id, devices.device_status from devices inner join users on devices.user_id=users.user_id where purchaser='Wirestone' and device_status='$device_status'";
$purchase_average_results=mysqli_query($con, $purchase_average_query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<title>device_status_report.php</title>
</head>
<body>
 
       <div id="header">
       <h1>MDM ALPHA REPORTS</h1><?php echo "<p>Hello, $username</p>"; ?>
       </div>

       <div id="menu">
       <div class="nav"><a href="../dashboard.php">Dashboard</a></div><div class="nav"><a href="../addrec.php">Add Record</a></div><div class="nav"><a href="../update.php">Update Records</a></div><div class="nav"><a href="../new_reports.php">Reports</a></div><div class="nav"><a href="../settings.php">Settings</a></div>
       <div class="nav"><a href="../logout.php">Logout</a>
       </div>

       <div id="contreports">
       <h2>Report for <?php print "$device_status"; ?> Devices</h2>
             
<table class="dashlog">

	           
	           	   <thead><tr><th class="lhead">Device Status</th><th>First Name</th><th>Last Name</th><th>Location</th><th>User ID</th><th>Device ID</th><th>Phone #</th><th>Make</th><th>Model</th><th>Serial Number</th><th>Purchaser</th><th>Purchase Price</th><th>Purchase Date</th><th class="rhead">Carrier</th></tr></thead>
	           	   <tbody>
	           	   	<?php while($row=mysqli_fetch_assoc($device_status_results))	
									{
 									 extract($row);
 									 print "<tr class='hilight'><td>$device_status</td><td>$f_name</td><td>$l_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$phone_num</td><td>$make</td><td>$model</td><td>$serial_num</td><td>$purchaser</td><td>$price</td><td>$purchase_date</td><td>$carrier</td></tr>";
 									 }
  								 ?>	
	           	   </tbody>
		           <tfoot></tfoot>
	           </table>
						 <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php print "Total Number of Wirestone Employees with $device_status Devices: ".mysqli_num_rows($device_status_results); ?></p>
						 <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php print "Total Number of Wirestone Purchased $device_status Devices: ".mysqli_num_rows($purchase_results); ?></p>
						 <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php while($row4=mysqli_fetch_array($purchase_amount_results)){echo"Total Amount Spent on Purchases of $device_status Devices by Wirestone:"."=$".$row4['sum(price)'];} ?></p>
						 <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php while($row5=mysqli_fetch_array($purchase_average_results)){echo"Average Amount Spent per Purchase of $device_status Device by Wirestone:"."=$".$row5['avg(price)'];} ?></p>

						 
</div>





</body>
</html>

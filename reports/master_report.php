<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?>

<?php  include '../connect.php';

$master_report_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id order by devices.user_id";
$master_report_results=mysqli_query($con, $master_report_query);

$purchase_report_query="select * from devices where purchaser='Wirestone'";
$purchase_report_results=mysqli_query($con, $purchase_report_query);

$purchase_amount_query="select sum(price) from devices where purchaser='Wirestone'";
$purchase_amount_results=mysqli_query($con, $purchase_amount_query);

$purchase_average_query="select avg(price) from devices where purchaser='Wirestone'";
$purchase_average_results=mysqli_query($con, $purchase_average_query);

//while($row4=mysqli_fetch_array($purchase_amount_results))
//{
 //extract($row4);
 //print_r($row4);
// }



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<title>master_report.php</title>
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
       <h2>Master Report:</h2>             
<table class="dashlog">    
	           	   <thead><tr><th class="lhead">First Name</th><th>Last Name</th><th>Location</th><th>User ID</th><th>Device ID</th><th>Make</th><th>Model</th><th>Serial Number</th><th>Purchaser</th><th>Purchase Price</th><th>Purchase Date</th><th>Carrier</th><th class="rhead">Device Status</th></tr></thead>
	           	   <tbody>
	           	   		<?php
										while($row=mysqli_fetch_assoc($master_report_results))
										{
 										 extract ($row);
 	  
			           			print "<tr class='hilight'><td>$f_name</td><td>$l_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$make</td><td>$model</td><td>$serial_num</td><td>$purchaser</td><td>$price</td><td>$purchase_date</td><td>$carrier</td><td>$device_status</td></tr>";
			           			}
			           			?>
	           	   </tbody>
		           <tfoot></tfoot>
	           </table>
					 
<p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php print "Total Number of Devices:  ".mysqli_num_rows($master_report_results); ?></p>
<p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php print "Total Number of Wirestone Purchased Devices:  ".mysqli_num_rows($purchase_report_results); ?></p>
<p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php while($row4=mysqli_fetch_array($purchase_amount_results)){echo"Total Cost of Wirestone Devices:  "."=$".$row4['sum(price)'];} ?></p>
<p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php while($row5=mysqli_fetch_array($purchase_average_results)){echo"Average Amount Spent Per Device:  "."=$".$row5['avg(price)'];} ?></p>


           </div>          

<br/>


</body>
</html>
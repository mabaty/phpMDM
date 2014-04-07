<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?><?php include '../connect.php'; 

extract($_POST);

$carrier=$carrier;

$carrier_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.phone_num, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where carrier='$carrier' order by devices.user_id";
$carrier_results=mysqli_query($con, $carrier_query);


$purchase_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where purchaser='Wirestone' and carrier='$carrier' order by devices.user_id";
$purchase_results=mysqli_query($con, $purchase_query);

$purchase_amount_query="select sum(price), devices.purchaser, devices.carrier, devices.user_id from devices inner join users on devices.user_id=users.user_id where purchaser='Wirestone' and carrier ='$carrier'";
$purchase_amount_results=mysqli_query($con, $purchase_amount_query);

$purchase_average_query="select avg(price), devices.purchaser, devices.carrier, devices.user_id from devices inner join users on devices.user_id=users.user_id where purchaser='Wirestone' and carrier='$carrier'";
$purchase_average_results=mysqli_query($con, $purchase_average_query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>carrier_report.php</title>
</head>

<body>
    <div style="margin-left:50px;">
        <div id="header">
            <h1>MDM ALPHA REPORTS</h1><?php echo "<p>Hello, $username</p>"; ?>
        </div>

        <div id="menu">
            <div class="nav">
                <a href="../dashboard.php">Dashboard</a>
            </div>

            <div class="nav">
                <a href="../addrec.php">Add Record</a>
            </div>

            <div class="nav">
                <a href="../update.php">Update Records</a>
            </div>

            <div class="nav">
                <a href="../new_reports.php">Reports</a>
            </div>

            <div class="nav">
                <a href="../settings.php">Settings</a>
            </div>

            <div class="nav">
                <a href="../logout.php">Logout</a>
            </div>

            <div id="contreports">
                <h2>Report for Devices Using: <?php print "$carrier"; ?></h2>

                <table class="dashlog">
                    <thead>
                        <tr>
                            <th class="lhead">Carrier</th>

                            <th>First Name</th>

                            <th>Last Name</th>

                            <th>Location</th>

                            <th>User ID</th>

                            <th>Device ID</th>

                            <th>Phone #</th>

                            <th>Make</th>

                            <th>Model</th>

                            <th>Serial Number</th>

                            <th>Purchaser</th>

                            <th>Purchase Price</th>

                            <th>Purchase Date</th>

                            <th class="rhead">Device Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row=mysqli_fetch_assoc($carrier_results))  
                                                            {
                                                             extract($row);
                                                             print "<tr class='hilight'><td>$carrier</td><td>$f_name</td><td>$l_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$phone_num</td><td>$make</td><td>$model</td><td>$serial_num</td><td>$purchaser</td><td>$price</td><td>$purchase_date</td><td>$device_status</td></tr>";
                                                             }
                                                         ?>
                    </tbody>
                </table>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php print "Total Number of Wirestone Employees with $carrier: ".mysqli_num_rows($carrier_results); ?></p>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php print "Total Number of Wirestone Purchased Devices with $carrier: ".mysqli_num_rows($purchase_results); ?></p>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php while($row4=mysqli_fetch_array($purchase_amount_results)){echo"Total Amount Spent on Purchases of Devices with $carrier by Wirestone:"."=$".$row4['sum(price)'];} ?></p>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family: Lucida Sans Unicode;"><?php while($row5=mysqli_fetch_array($purchase_average_results)){echo"Average Amount Spent per Device Purchase with $carrier by Wirestone:"."=$".$row5['avg(price)'];} ?></p>
            </div>
        </div>
    </div>
</body>
</html>

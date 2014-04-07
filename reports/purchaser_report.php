<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?><?php  include '../connect.php';

extract ($_POST);

$purchaser=$purchaser;

$purchaser_report_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.phone_num, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where purchaser='$purchaser' order by devices.user_id";
$purchaser_report_results=mysqli_query($con, $purchaser_report_query);

$purchaser_count_query="select count(purchaser) from devices where purchaser='$purchaser'";
$purchaser_count_results=mysqli_query($con, $purchaser_count_query);

$purchaser_cost_query="select sum(price) from devices where purchaser='$purchaser'";
$purchaser_cost_results=mysqli_query($con, $purchaser_cost_query);

$purchaser_average_query="select avg(price) from devices where purchaser='$purchaser'";
$purchaser_average_results=mysqli_query($con, $purchaser_average_query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>purchaser_report.php</title>
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
                <h2>Purchaser Report for: <?php print "$purchaser"; ?></h2>

                <table class="dashlog">
                    <thead>
                        <tr>
                            <th class="lhead">Purchaser</th>

                            <th>First Name</th>

                            <th>Last Name</th>

                            <th>Location</th>

                            <th>User ID</th>

                            <th>Device ID</th>

                            <th>Phone #</th>

                            <th>Make</th>

                            <th>Model</th>

                            <th>Serial Number</th>

                            <th>Purchase Price</th>

                            <th>Purchase Date</th>

                            <th>Carrier</th>

                            <th class="rhead">Device Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                                                while($row=mysqli_fetch_assoc($purchaser_report_results))
                                                                {
                                                                 extract ($row);
                                                        print "<tr class='hilight'><td>$purchaser</td><td>$f_name</td><td>$l_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$phone_num</td><td>$make</td><td>$model</td><td>$serial_num</td><td>$price</td><td>$purchase_date</td><td>$carrier</td><td>$device_status</td></tr>";
                                                             }
                                                        ?>
                    </tbody>
                </table>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php while($row5=mysqli_fetch_array($purchaser_count_results)){echo"Number of Devices:  "."".$row5['count(purchaser)'];} ?></p>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php while($row6=mysqli_fetch_array($purchaser_cost_results)){echo"Total Value of Devices:  "."=$".$row6['sum(price)'];} ?></p>

                <p class="hilight" style="margin-left:20px; font-size:21px; font-family:Lucida Sans Unicode;"><?php while($row7=mysqli_fetch_array($purchaser_average_results)){echo"Average Amount Spent Per Device:  "."=$".$row7['avg(price)'];} ?></p>
            </div><br>
        </div>
    </div>
</body>
</html>

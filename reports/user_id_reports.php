<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?><?php include '../connect.php';

extract ($_POST);

$user_id=$user_id;


$user_report_query="select users.user_id, users.f_name, users.l_name, users.office_loc from users where users.user_id='$user_id' order by users.user_id";
$user_report_results=mysqli_query($con, $user_report_query);

//while($row=mysqli_fetch_assoc($user_report_results))
//{
 //extract ($row);
// }
 
$device_report_query="select devices.user_id, devices.device_id, devices.make, devices.model, devices.phone_num, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status, devices.device_status from devices where devices.user_id='$user_id' order by devices.user_id";
$device_report_results=mysqli_query($con, $device_report_query);

//while($row1=mysqli_fetch_assoc($device_report_results))
//{
 //extract($row1);
 //}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>user_id_reports.php</title>
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
                <h2>Report for User ID: <?php print "$user_id"; ?></h2>

                <table class="dashlog">
                    <thead>
                        <tr>
                            <th class="lhead">First Name</th>

                            <th>Last Name</th>

                            <th>Location</th>

                            <th>User ID</th>

                            <th>Device ID</th>

                            <th>Make</th>

                            <th>Model</th>

                            <th>Phone #</th>

                            <th>Serial Number</th>

                            <th>Purchaser</th>

                            <th>Purchase Price</th>

                            <th>Purchase Date</th>

                            <th>Carrier</th>

                            <th class="rhead">Device Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                                                while($row=mysqli_fetch_assoc($user_report_results))
                                                                {
                                                                 extract ($row);
                                                                 }
                                                                 while($row1=mysqli_fetch_assoc($device_report_results))
                                                                 {
                                                                    extract($row1);   
                                                        print "<tr class='hilight'><td>$f_name</td><td>$l_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$make</td><td>$model</td><td>$phone_num</td><td>$serial_num</td><td>$purchaser</td><td>$price</td><td>$purchase_date</td><td>$carrier</td><td>$device_status</td></tr>";
                                                        }
                                                        ?>
                    </tbody>
                </table>
            </div><br>
        </div>
    </div>
</body>
</html>

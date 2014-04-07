<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='../login.php'</script>";
}  
?><?php include '../connect.php';

extract ($_POST);

$l_name=$l_name;

$last_name_query="select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.phone_num, devices.serial_num, devices.purchaser, devices.price, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id where l_name='$l_name' order by devices.user_id";
$last_name_results=mysqli_query($con, $last_name_query);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>last_name_report.php</title>
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
                <h2>Report for Last Name: <?php print "$l_name"; ?></h2>

                <table class="dashlog">
                    <thead>
                        <tr>
                            <th class="lhead">Last Name</th>

                            <th>First Name</th>

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

                            <th>Carrier</th>

                            <th class="rhead">Device Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                                                while($row=mysqli_fetch_assoc($last_name_results))
                                                                {
                                                                 extract($row);
                                                     print "<tr class='hilight'><td>$l_name</td><td>$f_name</td><td>$office_loc</td><td>$user_id</td><td>$device_id</td><td>$phone_num</td><td>$make</td><td>$model</td><td>$serial_num</td><td>$purchaser</td><td>$price</td><td>$purchase_date</td><td>$carrier</td><td>$device_status</td></tr>";
                                                             }
                                                        ?>
                    </tbody>
                </table>
            </div><br>
        </div>
    </div>
</body>
</html>

<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
	echo "<script>location.href='http://mdm.techandtheory.com/alpha/login.php'</script>";
}
?><?php include 'connect.php';


$master_report_query = "select users.f_name, users.l_name, users.office_loc, devices.device_id, devices.user_id, devices.make, devices.model, devices.serial_num, devices.purchaser, devices.price, devices.phone_num, devices.purchase_date, devices.carrier, devices.device_status from users inner join devices on users.user_id=devices.user_id";
$master_report_results = mysqli_query($con, "select distinct user_id from devices;");
$master_report_results2=mysqli_query($con, "select distinct device_id from devices;");
$master_report_results3=mysqli_query($con, "select distinct f_name from users;");
$master_report_results4=mysqli_query($con, "select distinct l_name from users;");
$master_report_results5=mysqli_query($con, "select distinct phone_num from devices where phone_num IS NOT NULL AND phone_num <> '';");
$master_report_results6=mysqli_query($con, "select distinct purchaser from devices;");
$master_report_results7=mysqli_query($con, "select distinct make from devices;");
$master_report_results8=mysqli_query($con, "select distinct model from devices;");
$master_report_results9=mysqli_query($con, "select distinct serial_num from devices;");
$master_report_results10=mysqli_query($con, "select distinct purchase_date from devices where purchase_date IS NOT NULL AND purchase_date <> '0000-00-00';");
$master_report_results11=mysqli_query($con, "select distinct price from devices;");
$master_report_results12=mysqli_query($con, "select distinct carrier from devices;");
$master_report_results13=mysqli_query($con, "select distinct device_status from devices;");
$master_report_results14=mysqli_query($con, "select distinct office_loc from users;");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>new_reports.php</title>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>MDM ALPHA REPORTS</h1><?php echo "<p>Hello, $username</p>"; ?>
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

            <div id="content">
                <h2>Reports:</h2>

                <div id="dash">
                    <table style="width:auto;">
                        <tr>
                            <td>
                                <form action="reports/office_location_report.php" method="post">
                                    <label style="">Office Location</label>
                                
                            </td>

                            <td><select name="office_loc" style="">
                                <option>
                                    Office Location
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results14)){ print'<option value="'.                                         $row['office_loc'].'">'.$row['office_loc'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Office Location Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/user_id_reports.php" method="post">
                                    <label style="">User ID</label>
                                
                            </td>

                            <td><select name="user_id" style="">
                                <option>
                                    User ID
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results)){ print'<option value="'.$row['user_id'].'">'.$row['user_id'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="User ID Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/device_id_report.php" method="post">
                                    <label style="">Device ID</label>
                                
                            </td>

                            <td><select name="device_id" style="">
                                <option>
                                    Device ID
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results2)){ print'<option value="'.$row['device_id'].'">'.$row['device_id'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Device ID Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/first_name_report.php" method="post">
                                    <label style="">First Name</label>
                                
                            </td>

                            <td><select name="f_name" style="">
                                <option>
                                    First Name
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results3)){ print'<option value="'.$row['f_name'].'">'.$row['f_name'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="First Name Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/last_name_report.php" method="post">
                                    <label style="">Last Name</label>
                                
                            </td>

                            <td><select name="l_name" style="">
                                <option>
                                    Last Name
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results4)){ print'<option value="'.$row['l_name'].'">'.$row['l_name'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Last Name Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/phone_num_report.php" method="post">
                                    <label style="">Phone #</label>
                                
                            </td>

                            <td><select name="phone_num" style="">
                                <option>
                                    Phone #
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results5)){ print'<option value="'.$row['phone_num'].'">'.$row['phone_num'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Phone # Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/purchaser_report.php" method="post">
                                    <label style="">Purchaser</label>
                                
                            </td>

                            <td><select name="purchaser" style="">
                                <option>
                                    Purchaser
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results6)){ print'<option value="'.$row['purchaser'].'">'.$row['purchaser'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Purchaser Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/make_report.php" method="post">
                                    <label style="">Make</label>
                                
                            </td>

                            <td><select name="make" style="">
                                <option>
                                    Make
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results7)){ print'<option value="'.$row['make'].'">'.$row['make'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Make Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/model_report.php" method="post">
                                    <label style="">Model</label>
                                
                            </td>

                            <td><select name="model" style="">
                                <option>
                                    Model
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results8)){ print'<option value="'.$row['model'].'">'.$row['model'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Model Report"></form></td>
                        </tr>

                        <!--<tr>
                            <td>
                                <form action="reports/serial_num_report.php" method="post">
                                    <label style="">Serial Number</label>
                                
                            </td>

                            <td><select name="serial_num" style="">
                                <option>
                                    Serial Number
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results9)){ print'<option value="'.$row['serial_num'].'">'.$row['serial_num'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Serial # Report"></form></td>
                        </tr>-->

                        <tr>
                            <td>
                               <form action="reports/purchase_date_report.php" method="post">
                                    <label style="">Purchase Date</label>
                                
                            </td>

                            <td><select name="purchase_date" style="">
                                <option>
                                    Purchase Date
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results10)){ print'<option value="'.$row['purchase_date'].'">'.$row['purchase_date'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Purchase Date Report"></form></td>
                        </tr>

                        <!--<tr>
                            <td>
                                <form action="reports/price_report.php" method="post">
                                    <label style="">Price</label>
                                
                            </td>

                            <td><select name="price" style="">
                                <option>
                                    Price
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results11)){ print'<option value="'.$row['price'].'">'.$row['price'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Price Report"></form></td>
                        </tr>-->

                        <tr>
                            <td>
                                <form action="reports/carrier_report.php" method="post">
                                    <label style="">Carrier</label>
                                
                            </td>

                            <td><select name="carrier" style="">
                                <option>
                                    Carrier
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results12)){ print'<option value="'.$row['carrier'].'">'.$row['carrier'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Carrier Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/device_status_report.php" method="post">
                                    <label style="">Status</label>
                                
                            </td>

                            <td><select name="device_status" style="">
                                <option>
                                    Status
                                </option><?php while($row=mysqli_fetch_assoc($master_report_results13)){ print'<option value="'.$row['device_status'].'">'.$row['device_status'];} ?>
                            </select></td>

                            <td><input class="rprtbutton" style="" type="submit" name="submit" value="Status Report"></form></td>
                        </tr>

                        <tr>
                            <td>
                                <form action="reports/master_report.php" method="post">
                                    <input class="rprtbutton" style="color:red;" type="submit" name="submit" value="Run Master Report">
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

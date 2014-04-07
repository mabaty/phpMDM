<?php session_start(); ?><?php
//Check if user is logged in or not.
$username = $_SESSION['username'];
if($username==null || $username=="")
{
    echo "<script>location.href='http://mdm.techandtheory.com/alpha/login.php'</script>";
}  
?><?php include 'connect.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Matt Baty">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript">
</script>
    <script src="http://code.highcharts.com/highcharts.js" type="text/javascript">
</script>

    <title>Mobile Device Management ALPHA - Dashboard</title>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>MDM ALPHA DASHBOARD</h1><?php echo "<p>Hello, $username</p>"; ?>
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
       </div>

            <div id="content">
                <h2>Dashboard:</h2>

                <div id="dash" style="border:none;">
                    <div id="graph">
                        <?php 
                                            $result = mysqli_query($con,"SELECT (Select count(*) from devices where carrier = 'AT&T' and device_status = 'Active') AS 'AT&T', (select count(*) from devices where carrier = 'Verizon' and device_status = 'Active') AS 'Verizon', (Select count(*) from devices where carrier = 'Sprint' and device_status = 'Active') AS 'Sprint', (Select count(*) from devices where carrier = 'T-Mobile' and device_status = 'Active') AS 'T-Mobile';");
                                            while ($row = mysqli_fetch_array($result)) {
                                                $data[] = $row['AT&T'];
                                                $data2[] = $row['Verizon'];
                                                $data3[] = $row['Sprint'];
                                                $data4[] = $row['T-Mobile'];
                                            } 
                                            $statsresult = mysqli_query($con,"Select count(*) AS 'users' from users;");
                                            while ($statrow = mysqli_fetch_array($statsresult)) {
                                                $stat1[] = $statrow['users'];
                                            }
                                            $graph2result = mysqli_query($con,"Select count(*) AS 'devices' from devices;");
                                            while ($stat2row = mysqli_fetch_array($graph2result)) {
                                                $stat2[] = $stat2row['devices'];
                                            }  
                                            
                                            $pieresult = mysqli_query($con,"SELECT (Select count(*) from devices where make = 'Apple' and device_status = 'Active') AS 'Apple', (select count(*) from devices where make = 'HTC' and device_status = 'Active') AS 'HTC', (Select count(*) from devices where make = 'Samsung' and device_status = 'Active') AS 'Samsung', (Select count(*) from devices where make = 'Nokia' and device_status = 'Active') AS 'Nokia';");
                                            while ($pierow = mysqli_fetch_array($pieresult)) {
                                                $piedata1[] = $pierow['Apple'];
                                                $piedata2[] = $pierow['HTC'];
                                                $piedata3[] = $pierow['Samsung'];
                                                $piedata4[] = $pierow['Nokia'];
                                            }   
                                            
                                            $logresult = mysqli_query ($con,"select a.activity_date AS 'date', CONCAT_WS(' ', u.f_name, u.l_name) AS 'name', a.activity_notes AS 'notes' from activity_log a, users u WHERE u.user_id = a.user_id LIMIT 0, 12;");    
                                        ?><script type="text/javascript">
$(function () { 
                        $('#graph').highcharts({
                        chart: {
                            type: 'bar'
                            },
                        credits: { enabled:false },
                        title: {
                            text: 'Top Carriers'
                            },
                        colors: ['#0088CE', '#F30001', '#FFDE00', '#E11274'],
                        xAxis: {
                            categories: ['Carrier']
                            },
                        yAxis: {
                            title: {
                            text: 'Devices'
                            }},
                        series: [{
                            name: 'AT&T',
                            data: [<?php echo join($data, ',') ?>]
                            }, {
                            name: 'Verizon',
                            data: [<?php echo join($data2, ',') ?>]
                            }, {
                            name: 'Sprint',
                            data: [<?php echo join($data3, ',') ?>]
                            }, {
                            name: 'T-Mobile',
                            data: [<?php echo join($data4, ',') ?>]
                            }]
                        });
                        });
                        </script>​
                    </div>

                    <div id="stats">
                        <table class="stats">
                            <tr>
                                <td>Total Active Users</td>
                            </tr>

                            <tr>
                                <td class="stattd"><?php echo join($stat1) ?></td>
                            </tr>

                            <tr>
                                <td>Total Active Devices</td>
                            </tr>

                            <tr>
                                <td class="stattd"><?php echo join($stat2) ?></td>
                            </tr>
                            
                            <tr>
                            	<td>
                            		<div class="nav"><a href="addrec.php">Add User</a>
                            		</div>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<div class="nav"><a href="reports/master_report.php">View Users</a>
                            		</div>
                            	</td>
                            </tr>
                        </table>
                    </div>

                    <div id="graph2">
                        <script type="text/javascript">
$(function () {
                        $('#graph2').highcharts({
                            chart: {type: 'pie'},
                            credits: { enabled:false },
                            title: {text: 'Top Device Makers'},
                            xAxis: {categories: ['Apple', 'HTC', 'Samsung', 'Nokia']},
                            series: [{
                                name: '# of Devices',
                                data: [
                                    ['Apple', <?php echo join($piedata1) ?>],
                                    ['HTC', <?php echo join($piedata2) ?>],
                                    ['Samsung', <?php echo join($piedata3) ?>],
                                    ['Nokia', <?php echo join($piedata4) ?>],
                                ]        
                                }]
                        })
                        });
                        </script>​
                    </div>

                    <h3 class="log">Recent Activity Log</h3>

                    <div id="logs">
                        <table class="dashlog">
                            <thead>
                                <tr>
                                    <th class="lhead">Date</th>

                                    <th>User</th>

                                    <th class="rhead">Notes</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    while ($logrow = mysqli_fetch_array($logresult)) {
                                    extract($logrow);   
                                    print "<tr class='hilight'><td>$date</td><td>$name</td><td>$notes</td></tr>"; 
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="footer">
                    <p>Project MDM Alpha</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php

session_start();
include('config.php');

$months = array(
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
);

if ($_SESSION['login']) { ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>RECORDS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
        <style>
            body {
                background-image: url(bg.png);
                background-repeat: repeat;
                background-size: 100%;

            }

            td,
            th {
                border: 1px solid black;
                padding: 0.5rem;
                text-align: center;
            }

            table {
                border-collapse: collapse;

            }

            tbody tr:nth-child(odd) {
                background: #eee;
            }

            caption {
                font-size: 0.8rem;
            }

            .center {
                margin-left: auto;
                margin-right: auto;
            }
        </style>


    </head>

    <body bgcolor="#D3D3D3">

        <script>
            function fun() {
                $("#tableData").table2excel({
                    exclude: ".excludeThisClass",
                    name: "Worksheet Name",
                    filename: "Empdata.xls", 
                    preserveColors: false 
                });
            }

           
        </script>



        <p style="margin-left:570px;font-size:30px;margin-top:10px;color:aliceblue;font-weight: bold;">Welcome <?php echo $_SESSION['login']; ?><a style="float:right;font-size:20px;margin-right:20px;text-decoration: none;margin-top:20px;" href="welcome.php"><button type="button" class="btn btn-outline-light">Back</button></a> <a style="float:right;font-size:20px;margin-right:20px;text-decoration: none;margin-top:20px;" href="logout.php"><button type="button" class="btn btn-outline-light">Logout</button></a> </p>
        <button class="Btn" onclick='fun()' style="border: 0px;margin-left:50px;border-radius: 10px;background:transparent;"><Img src="dw.png"></Img></button>

        <?php if ($_SESSION['login'] == 'main') { ?>
            <table class="center" id="tableData">
                <tr>
                    <th>Serial No.</th>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <th>Log-in Time</th>
                    <th>Log-out Time</th>
                    <th>Working Time (in HH:MM:SS) </th>
                </tr>

                <?php $query = mysqli_query($con, "select * from userlog ");
                $cnt = 1;
                $curr_month;
                while ($row = mysqli_fetch_array($query)) {

                    
                ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row['userId']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['loginTime']; ?></td>
                        <td><?php echo $row['logoutTime']; ?></td>
                        <td>
                            <?php $init = $row['working_time'];
                            $prev_month = 11;
                            $hours = floor($init / 3600);
                            $minutes = floor(($init / 60) % 60);
                            $seconds = $init % 60;
                            echo "$hours:$minutes:$seconds";
                            $hrs = "$hours:$minutes:$seconds";

                            ?>
                        </td>
                    </tr>
            <?php $cnt = $cnt + 1;
                }
            } ?>
            </table>

    </body>

    </html>
<?php
} else {
    header('location:logout.php');
}
?>
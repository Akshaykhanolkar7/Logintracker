<?php
session_start();
if ($_SESSION['login']) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>HOME</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <style>
            body {
                background-image: url(bg.png);
                background-repeat: repeat;
                background-size: 100%;

            }

            #clockContainer {
                position: relative;
                margin: auto;
                height: 30vw;
                /*to make the height and width responsive*/
                width: 30vw;
                background: url(clock.png) no-repeat;
                /*setting our background image*/
                background-size: 100%;
                opacity: 0.5;
                margin-top: 40px;
                
            }

            #hour,
            #minute,
            #second {
                position: absolute;
                background: black;
                border-radius: 10px;
                transform-origin: bottom;
            }

            #hour {
                width: 1.8%;
                height: 25%;
                top: 25%;
                left: 48.85%;
                opacity: 0.8;
            }

            #minute {
                width: 1.6%;
                height: 30%;
                top: 19%;
                left: 48.9%;
                opacity: 0.8;
            }

            #second {
                width: 1%;
                height: 40%;
                top: 9%;
                left: 49.25%;
                opacity: 0.8;
            }

            
        </style>
    </head>

    <body bgcolor="#d6c2c2">

        <p style="margin-left:580px;font-size:30px;margin-top:20px;color:aliceblue;font-weight: bold;">Welcome <?php echo $_SESSION['login']; ?> <a class="logoutbtn" style="float:right;font-size:20px;margin-right:20px;text-decoration: none;color:aliceblue;" href="logout.php"><button type="button" class="btn btn-outline-light">Logout</button></a> </p>
        <?php if ($_SESSION['login'] == 'main') {
        ?>

            <div style="text-align: center; padding-top:25vh;width:auto; "><a href="userlog.php"> <button type="button" class="btn btn-outline-light">Show Employee Access Log</button></a></div>
        <?php } else { ?>
            <div id="clockContainer">
                <div id="hour"></div>
                <div id="minute"></div>
                <div id="second"></div>
            </div>
        <?php  } ?>
        <script>
            setInterval(() => {
                d = new Date(); //object of date()
                hr = d.getHours();
                min = d.getMinutes();
                sec = d.getSeconds();
                hr_rotation = 30 * hr + min / 2; //converting current time
                min_rotation = 6 * min;
                sec_rotation = 6 * sec;

                hour.style.transform = `rotate(${hr_rotation}deg)`;
                minute.style.transform = `rotate(${min_rotation}deg)`;
                second.style.transform = `rotate(${sec_rotation}deg)`;
            }, 1000);
        </Script>
    </body>

    </html>
<?php
} else {
    header('location:logout.php');
}
?>
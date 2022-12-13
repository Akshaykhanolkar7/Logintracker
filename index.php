<?php
session_start();
include 'config.php';
if (isset($_POST['login'])) {
  $username = $_POST['username']; // Get username
  $password = $_POST['password']; // get password
  //query for match  the user inputs
  $ret = mysqli_query($con, "SELECT * FROM login WHERE userName='$username'  and password='$password'");
  $num = mysqli_fetch_array($ret);
  // if user inputs match if condition will runn
  if ($num > 0) {
    $_SESSION['login'] = $username; // hold the user name in session
    $_SESSION['id'] = $num['id']; // hold the user id in session
    $uip = $_SERVER['REMOTE_ADDR']; // get the user ip
    // query for inser user log in to data base
    if ($_SESSION['login'] != 'main') {
      mysqli_query($con, "insert into userlog(userId,username,userIp,status) values('" . $_SESSION['id'] . "','" . $_SESSION['login'] . "','$uip','1')");
    }
    // code redirect the page after login
    $extra = "welcome.php";
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
  }
  // If the userinput no matched with database else condition will run
  else {
    $_SESSION['msg'] = "Invalid username or password";
    $extra = "index.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>LOGIN PAGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Raleway, sans-serif;
    }

    body {
      background: linear-gradient(90deg, #C7C5F4, #776BCC);
      overflow: hidden;
    }
    body {
                background-image: url(bg.png);
                background-repeat: repeat;
                background-size: 100%;

            }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .screen {
     /* background: linear-gradient(90deg, #5D54A4, #7C78B8);*/
      background-image: url(bg.png);
      position: relative;
      height: 600px;
      width: 360px;
      box-shadow: 0px 0px 24px #1a727c;
    }

    .screen__content {
      z-index: 1;
      position: relative;
      height: 100%;
    }

    .screen__background {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
      -webkit-clip-path: inset(0 0 0 0);
      clip-path: inset(0 0 0 0);
    }

    .screen__background__shape {
      transform: rotate(45deg);
      position: absolute;
    }

    .screen__background__shape1 {
      height: 520px;
      width: 520px;
      background: #FFF;
      top: -50px;
      right: 120px;
      border-radius: 0 72px 0 0;
    }

    .screen__background__shape2 {
      height: 220px;
      width: 220px;
      background: #6C63AC;
      top: -172px;
      right: 0;
      border-radius: 32px;
    }

    .screen__background__shape3 {
      height: 540px;
      width: 190px;
      background: linear-gradient(270deg, #5D54A4, #6A679E);
      top: -24px;
      right: 0;
      border-radius: 32px;
    }

    .screen__background__shape4 {
      height: 400px;
      width: 200px;
      background: #7E7BB9;
      top: 420px;
      right: 50px;
      border-radius: 60px;
    }

    .login {
      width: 320px;
      padding: 30px;
      padding-top: 156px;
      background-color: transparent;
      margin-top: 60px;
      margin-left: 20px;
    }

    .login__field {
      padding: 20px 0px;
      position: relative;
    }

    .login__icon {
      position: absolute;
      top: 30px;
      color: #7875B5;
    }

    .login__input {
      border: none;
      border-bottom: 2px solid #D1D1D4;
      background: none;
      padding: 10px;
      padding-left: 24px;
      font-weight: 700;
      width: 75%;
      transition: .2s;
    }

    .login__input:active,
    .login__input:focus,
    .login__input:hover {
      outline: none;
      border-bottom-color: #6A679E;
    }

    .login__submit {
      background: #b8d7d2;
      font-size: 14px;
      margin-top: 30px;
      padding: 16px 20px;
      border-radius: 26px;
      border: 1px solid #D4D3E8;
      text-transform: uppercase;
      font-weight: 700;
      display: flex;
      align-items: center;
      width: 100%;
      color: #4C489D;
      box-shadow: 0px 2px 2px #5C5696;
      cursor: pointer;
      transition: .2s;
    }

    .login__submit:active,
    .login__submit:focus,
    .login__submit:hover {
      border-color: #6A679E;
      outline: none;
    }

    .button__icon {
      font-size: 24px;
      margin-left: auto;
      color: #7875B5;
    }

    .social-login {
      position: absolute;
      height: 140px;
      width: 160px;
      text-align: center;
      bottom: 0px;
      right: 0px;
      color: #fff;
    }

    .social-icons {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .social-login__icon {
      padding: 20px 10px;
      color: #fff;
      text-decoration: none;
      text-shadow: 0px 0px 8px #7875B5;
    }

    .social-login__icon:hover {
      transform: scale(1.5);
    }

    form {
      background: white;
      width: 40%;
      box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.7);
      font-family: lato;
      position: relative;
      color: #333;
      border-radius: 10px;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="screen">
      <div class="screen__content">
        <form class="login" method="post" name="login">
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" class="login__input" placeholder="Employee ID" name="username" required value="">
          </div>
          <div class="login__field">
            <i class="login__icon fas fa-lock"></i>
            <input type="password" class="login__input" placeholder="Password" name="password" value="" required>
          </div>
          <button class="button login__submit" type="submit" name="login">
            <span class="button__text"   style="margin-left: 60px;"  >Log In Now</span>
           
          </button>
        </form>

      </div>
      <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>
    </div>
  </div>




</body>

</html>
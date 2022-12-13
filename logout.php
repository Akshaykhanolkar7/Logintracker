<?php
session_start();
include 'config.php';

mysqli_query($con,"UPDATE userlog SET logoutTime=CURRENT_TIMESTAMP WHERE status='1'" );

mysqli_query($con,"UPDATE userlog SET working_time=MOD(TIMESTAMPDIFF(SECOND, loginTime, logoutTime),60) where status='1'");

mysqli_query($con,"UPDATE userlog SET status='0' WHERE status='1'" );




//session_destroy();
$_SESSION['msg'] = "You have logged out successfully..!";

session_unset();
?>
<script language="javascript">
    document.location = "index.php";
</script>
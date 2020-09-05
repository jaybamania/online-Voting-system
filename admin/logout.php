<?php
session_start();
unset($_SESSION['admin_email']);
unset($_SESSION['user_email']);
session_destroy();

header("location:index.php");

?>
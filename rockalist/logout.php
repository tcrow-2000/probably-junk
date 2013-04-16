<?php 
session_start();
session_destroy();
header('Location: radio.php');
exit();
?>
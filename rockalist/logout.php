<?php 
session_start();
session_destroy();
header('Location: go.php');
exit();
?>
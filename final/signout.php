<?php
session_start();
$_SESSION = array();
session_destroy();
include_once 'header.php';
echo "<p>You are now logged out.</p>";
include_once 'footer.php';
?>

<?php 
session_start();
if ($_SESSION['account'][0] == '1') {
	header('Location: ../Views/userpage.php');
} else header('Location: ../Views/error.html');
?>
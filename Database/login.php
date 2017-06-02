<?php 
session_start();

$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
$user_tbl_name="User"; // Table names


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");

$username = $_POST['user_name'];
$password = $_POST['pass_word'];

$user_login ="SELECT Username, Password FROM $user_tbl_name WHERE Username = '$username' AND Password = '$password'";

$checked_user_login = mysqli_query($dbc, $user_login);

$dbase_u_info_SQL ="SELECT Password,Username,UserID FROM $user_tbl_name WHERE Username = '$username' ";

$dbase_user_info_dataset = mysqli_query($dbc, $dbase_u_info_SQL);


$dbase_user_info = mysqli_fetch_row($dbase_user_info_dataset);


if ($dbase_user_info[0] == $password && $dbase_user_info[1] == $username){
$_SESSION['account'][0] = '1';
$_SESSION['account'][1] = $username;
$_SESSION['account'][2] = $dbase_user_info[2];
header('Location: ../Views/homepage.php');
} else header('Location: ../Views/login-error.html');
?>
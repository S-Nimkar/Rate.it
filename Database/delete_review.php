<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
$tbl_name="Review"; // Table names

// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
$reviewid = $_POST['reviewid'];
$userid = $_SESSION['account'][2];
$delete_review_SQL = "DELETE FROM Review WHERE UserID = $userid AND ReviewID = $reviewid";

$result = mysqli_query($dbc, $delete_review_SQL);

header('Location: ../Views/userpage.php');
?>

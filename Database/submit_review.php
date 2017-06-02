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
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$postcode = $_POST['postcode'];
$city = $_POST['city'];
$region = $_POST['region'];
$postcode = $_POST['postcode'];
$review = $_POST['review-body'];

$userid = $_SESSION['account'][2];

$currentdate = date("Y/m/d");
$currenttime = date("h:i:s");

$insert_review_sql="INSERT INTO $tbl_name (UserID,Address1,Address2,Postcode,City,Region,ReviewBody,Date,Time) Values('$userid','$address1','$address2','$postcode','$city','$region','$review','$currentdate','$currenttime')";
mysqli_query($dbc, $insert_review_sql);
header('Location: ../Views/userpage.php');

?>
<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
// Connect to server and select databsae.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
$userid = $_POST['user_id'];
$reviewid = $_POST['reviewid'];
if (isset($_SESSION['account'][2])) {
	$selected_radio = $_POST['group1'];
	$check_if_rating_exist_SQL = "SELECT Rating FROM Rating WHERE UserID = $userid AND ReviewID = $reviewid";
	$get_existing_review_dataset = mysqli_query($dbc,$check_if_rating_exist_SQL);
	if (mysqli_num_rows($get_existing_review_dataset) == '1') {
		$update_rating_SQL = "UPDATE Rating SET Rating = '$selected_radio' WHERE UserID = $userid AND ReviewID = $reviewid";
		mysqli_query($dbc,$update_rating_SQL);
	} else {
		$insert_new_rating_SQL = "INSERT INTO Rating (UserID,ReviewID,Rating) VALUES ('$userid','$reviewid','$selected_radio')";
		mysqli_query($dbc,$insert_new_rating_SQL);
	}
	header('Location: '.$_SESSION['current_location']);
} else header('Location: ../Views/error.html');
?>
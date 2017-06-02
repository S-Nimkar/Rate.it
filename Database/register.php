<?php 
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
$tbl_name="User"; // Table names


// Connect to server and select databse.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
$first_name =$_POST['first_name'];
$surname =$_POST['surname'];
$email =$_POST['email_add'];
$user_name =$_POST['user_name'];
$pass_word =$_POST['c_pass_word'];

$insert_user_sql="INSERT INTO $tbl_name (Fname,Sname,Email,Username,Password) Values('$first_name','$surname','$email','$user_name','$pass_word')";


$usernamechecksql ="SELECT Username FROM $tbl_name WHERE Username = '$user_name' ";

$checked_username = mysqli_query($dbc, $usernamechecksql);

$msg = "Your registration to sign up with StudentReviews has been succesfull! Your username is : ' $user_name '  and your password is : ' $pass_word ' . We hope you find the use of our service to be satisfactory and if there are any inquries the contact address is support@studentreiviews.co.uk ";

if (mysqli_num_rows($checked_username) == 0){
   mail($email,"StudentReviews Registration",$msg);
   mysqli_query($dbc, $insert_user_sql);
   //add registration success page
   header('Location: ../Views/homepage.php');
}else {

   header('Location: ../Views/registration-error.html');
}



?>
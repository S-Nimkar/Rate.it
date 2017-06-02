<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
// Connect to server and select databsae.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
   $GetReviewData_Sql = "SELECT ReviewID, UserID, Address1, PostCode, City, Region, Date, Time FROM Review ORDER BY Date,Time";
   $ReviewDataSet = mysqli_query($dbc,$GetReviewData_Sql);
   $number_of_reviews = mysqli_num_rows($ReviewDataSet);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" type="text/css" href="../Styles/Minified-Styles/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="../Styles/master.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class ="back-colour">
    <header>
		<nav>
		  <div class="nav-wrapper base-colour">
		    <a href="homepage.php" class="logo-title left homepage-logo">Rate</a>
		    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		      	<?php if ($_SESSION['account'][0] == '1'){
		    	$current_username = $_SESSION['account'][1];
		    	echo "
			        <li><a href=\"../Database/getaccount.php\">Account: $current_username</a></li>
			        <li><a href=\"../Database/logout.php\">Logout</a></li>";
			    } else echo "
			        <li><a href=\"login.html\">Login</a></li>
			        <li><a href=\"register.html\">Signup</a></li>";
		   		 ?>
		      </ul>
		      <ul class="side-nav" id="mobile-demo">
		      	<?php if ($_SESSION['account'][0] == '1'){
		    	$current_username = $_SESSION['account'][1];
		    	echo "
			        <li><a href=\"../Database/getaccount.php\">Account: $current_username</a></li>
			        <li><a href=\"../Database/logout.php\">Logout</a></li>";
			    } else echo "
			        <li><a href=\"login.html\">Login</a></li>
			        <li><a href=\"register.html\">Signup</a></li>";
			    ?>
		      </ul>
		  </div>
		</nav>
    </header>
    <main>
    <div class="row">
   <?php 
   for ($i=0; $i < $number_of_reviews; $i++) { 
        mysqli_data_seek($ReviewDataSet,$i);
        $reviewinfo = mysqli_fetch_row($ReviewDataSet);
        $GetUserInfo_SQL = "SELECT Fname, Sname FROM User WHERE UserID = $reviewinfo[1]";
        $UserDataSet = mysqli_query($dbc,$GetUserInfo_SQL);
        $UserData = mysqli_fetch_row($UserDataSet);
        $GetReviewScore_SQL = "SELECT Rating FROM Rating WHERE ReviewID = $reviewinfo[0]";
        $RatingDataSet = mysqli_query($dbc,$GetReviewScore_SQL);
        $number_of_ratings = mysqli_num_rows($RatingDataSet);
        $RatingData = 0;
        for ($x=0; $x < $number_of_ratings; $x++) { 
        	mysqli_data_seek($RatingDataSet,$x);
        	$RatingData_Row = mysqli_fetch_row($RatingDataSet);
        	$RatingData += $RatingData_Row[0]; 
        }
        $RatingData /= $x;
        $rating = number_format((float)$RatingData, 2, '.', '');
        echo "
        	<div class=\"col s12 m6 l3\">
	          <div class=\"card darken-1 lighter-colour\">
	          <form action=\"view_review.php\" method='GET'>
	            <div class=\"card-content left-allign white\">
	              <span style=\"font-size: 2rem; font-weight: 300;\">$reviewinfo[2]</span>
	              <p>$reviewinfo[4]</p>
	              <p>$reviewinfo[3]</p>
	              <p>Review by: $UserData[0] $UserData[1] </p>
	              <p>Date: $reviewinfo[6] at: $reviewinfo[7]</p>
	              <p>Review Score: ";
	              if ($rating == 0) {
	              	echo "No Score";
	              } else echo "$rating"; 
	              echo " /5 </p>
	              <input id=\"review_id\" name=\"review_id\" value=\"$reviewinfo[0]\" hidden></input> 
	              <input id=\"user_id\"name=\"user_id\" value=\"$reviewinfo[1]\" hidden></input>
	            </div>
	            <div class=\"card-action white-text\">
	              <button class=\"waves-effect waves-light btn-large button-center blue\" type=\"submit\">View Review</button>
	            </div>
	            </form>
	          </div>
        	</div>";
    }
   ?>
    </div>
    </main>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
    <script type="text/javascript" src="../Scripts/homepage.js"></script>
</body>
</html>

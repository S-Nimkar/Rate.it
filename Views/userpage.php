<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
// Connect to server and select databsae.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
$userid = $_SESSION['account'][2];
$get_user_details_SQl = "SELECT * FROM User WHERE UserID = $userid";
$userdetails = mysqli_query($dbc,$get_user_details_SQl);
$user = mysqli_fetch_row($userdetails);
$get_user_review_SQL = "SELECT ReviewID, Address1, PostCode, City, Region, Date, Time,UserID FROM Review WHERE UserID = $userid ORDER BY Date,Time";
$review_dataset = mysqli_query($dbc,$get_user_review_SQL);
$number_of_reviews = mysqli_num_rows($review_dataset);
$_SESSION['account_id'] = $userid;
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
		      	<?php
		    	$current_username = $_SESSION['account'][1];
		    	echo "<li><a href=\"../Database/getaccount.php\">Account: $current_username</a></li>
			        <li><a href=\"../Database/logout.php\">Logout</a></li>";
		   		 ?>
		      </ul>
		      <ul class="side-nav" id="mobile-demo">
		      	<?php
		    	$current_username = $_SESSION['account'][1];
		    	echo "<li><a href=\"../Database/getaccount.php\">Account: $current_username</a></li>
			        <li><a href=\"../Database/logout.php\">Logout</a></li>";
			    ?>
		      </ul>
		  </div>
		</nav>
    </header>
    <main>
    <div class="container">
    <div class="row comment-margin">
	        <div class="col s12">
	          <div class="card blue-grey darken-3 comment-margin">
	            <div class="card-content white-text">
	              <p style="font-size: 3rem;">My Details</p>
	            </div>
	          </div>
	        </div>
	        <div class="col s12">
	          <div class="card blue-grey comment-margin">
	            <div class="card-content white-text">
	              <p><?php echo"User ID: $user[0]" ?></p>
	              <p><?php echo"User Email: $user[1]" ?></p>
	              <p><?php echo"First Name: $user[2]" ?></p>
	              <p><?php echo"Second Name: $user[3]" ?></p>
	              <hr>
	            </div>
	          </div>
	        </div>
	        <div class="col s12 center-align">
	          <div class="card blue-grey comment-margin">
	            <div class="card-content white-text">
	            	<a href="create_review.php" class="waves-effect waves-light blue-grey darken-3 btn-large"><i class="material-icons left">open_in_browser</i>Create New Review</a>
	            </div>
	          </div>
	        </div>
	        <div class="col s12">
	          <div class="card blue-grey comment-margin">
	            <div class="card-content white-text">
	            	<p style="font-size: 2rem;">My Reviews. Total number of reviews published: <?php echo "$number_of_reviews"; ?> </p>
	            	<hr>
	            </div>
	          </div>
	        </div>
	    </div>
	    <br>
	    <div class="row">
		   <?php 
		   for ($i=0; $i < $number_of_reviews; $i++) { 
		        mysqli_data_seek($review_dataset,$i);
		        $reviewinfo = mysqli_fetch_row($review_dataset);
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
		        	<div class=\"col s12 m6 l4\">
			          <div class=\"card darken-1 blue-grey\">
			          <form action=\"view_review.php\" method='POST'>
			            <div class=\"card-content left-allign white\">
			              <span style=\"font-size: 2rem; font-weight: 300;\">$reviewinfo[1]</span>
			              <p>$reviewinfo[2]</p>
			              <p>$reviewinfo[3]</p>
			              <p>Date: $reviewinfo[5] at: $reviewinfo[6]</p>
			              <p>Review Score: ";
			              if ($rating == 0) {
			              	echo "No Score";
			              } else echo "$rating"; 
			              echo " /5 </p>
			              <p>ReviewID: $reviewinfo[0]</p>
			              <input id=\"review_id\" name=\"review_id\" value=\"$reviewinfo[0]\" hidden></input> 
			              <input id=\"user_id\"name=\"user_id\" value=\"$reviewinfo[7]\" hidden></input>
			            </div>
			            <div class=\"card-action white-text\">
			              <button class=\"waves-effect waves-light btn-large button-center blue-grey darken-3\" type=\"submit\">View Review</button>
			            </div>
			            </form>
			          </div>
		        	</div>";
		    }
		   ?>
    </div>
   		<form action ="../Database/delete_review.php" method='POST'>
   		<div class="row">
   			<div class="col s12">
	          <div class="card blue-grey">
	            <div class="card-content right-align white-text">
	            <div class="input-field col l8 s12">
			          <input placeholder="To delete a review, enter the ReviewID here" name="reviewid" id="reviewid" type="text" class="validate">
			          <label for="reviewid" class="white-text">ReviewID</label>
			    </div>
	            	<button type="submit" class="waves-effect waves-light blue-grey darken-3 btn-large"><i class="material-icons left">delete</i>Delete Review</button>
	            </div>
	          </div>
	        </div>
   		</div>
		</form>
    </main>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
    <script type="text/javascript" src="../Scripts/userpage.js"></script>
</body>
</html>

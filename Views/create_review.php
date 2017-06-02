<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
// Connect to server and select databsae.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");

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
    	<div class="col s12">
	        <div class="card blue darken-3">
	            <div class="card-content white-text">
	              <p style="font-size: 3rem;">New Review Form</p>
	            </div>
	            <div class="card-content white-text">
		           <form name="review" onsubmit="return validateForm()" action="../Database/submit_review.php" method='POST'>
			           <div class="input-field">
				          <input id="address1" name="address1" type="text" class="validate">
				          <label for="address1" class="white-text">Address1</label>
				        </div>
				        <div class="input-field">
				          <input id="address2" name="address2" type="text" class="validate">
				          <label for="address2" class="white-text">Address2 (Optional)</label>
				        </div>
				        <div class="input-field">
				          <input id="city" name="city" type="text" class="validate">
				          <label for="city" class="white-text">City</label>
				        </div>
				        <div class="input-field">
				          <input id="region" name="region" type="text" class="validate">
				          <label for="region" class="white-text">Region</label>
				        </div>
				        <div class="input-field">
				          <input id="postcode" name="postcode" type="text" class="validate">
				          <label for="postcode" class="white-text">Postcode</label>
				        </div>
				        <div class="input-field">
				          <textarea id="review-body" name="review-body" class="materialize-textarea"></textarea>
          				  <label for="review-body" class="white-text">Review Body</label>
				        </div>
				        <button class="waves-effect waves-light btn-large button-center blue" type="submit">Submit Review</button>
	          		</form>
	            </div>
	        </div>
	    </div>
    </div>
    </main>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
    <script type="text/javascript" src="../Scripts/view_review.js"></script>
</body>
</html>

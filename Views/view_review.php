<?php 
session_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$passsword="root"; // Mysql password
$db_name="StudentReviews"; // Database name
// Connect to server and select databsae.
$dbc = mysqli_connect("$host", "$username", "$passsword")or die("cannot connect");
mysqli_select_db($dbc, $db_name) or die("cannot select DB");
$reviewid = $_GET['review_id'];
$user_id = $_GET['user_id'];
$_SESSION['current_location'] = $_SERVER['REQUEST_URI'];
$_SESSION['comment'] = 'false';
$_SESSION['rating'] = 'false';
$GetReviewData_Sql = "SELECT * FROM Review WHERE UserID = $user_id AND ReviewID = $reviewid";
$GetUserInfo_SQL = "SELECT Fname,Sname FROM User WHERE UserID = $user_id";
$GetRating_SQL = "SELECT Rating FROM Rating WHERE ReviewID = $reviewid";
$GetComments_SQL = "SELECT Comment.Comment,Comment.Date,Comment.Time, User.Fname,User.Sname FROM Comment INNER JOIN User ON Comment.UserID = User.UserID WHERE ReviewID = $reviewid ORDER BY Date,Time";
$ReviewDataSet = mysqli_query($dbc,$GetReviewData_Sql);
$reviewinfo = mysqli_fetch_row($ReviewDataSet);
$UserInfoDataSet = mysqli_query($dbc,$GetUserInfo_SQL);
$UserInfo = mysqli_fetch_row($UserInfoDataSet);
$GetReviewScore_SQL = "SELECT Rating FROM Rating WHERE ReviewID = $reviewid";
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
$CommentsDataSet = mysqli_query($dbc,$GetComments_SQL);
$number_of_comments = mysqli_num_rows($CommentsDataSet);
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
 	<div class ="container">
 		<div class="row comment-margin">
	        <div class="col s12">
	          <div class="card darkest-colour comment-margin">
	            <div class="card-content white-text">
	              <p style="font-size: 3rem;">House Review: <?php echo "$reviewinfo[2]";?></p>
	              <p class="right-align">By: <?php echo"$UserInfo[0] $UserInfo[1]"?></p>
	            </div>
	          </div>
	        </div>
	    </div>
 		<div class="row comment-margin">
        <div class="col s12 l4 m4">
          <div class="card blue ">
            <div class="card-content white-text">
            	<p style="font-size: 2.3rem;">House Details:</p>
              <p><?php echo "$reviewinfo[2]";?></p>
              <p><?php echo "$reviewinfo[3]";?></p>
              <p><?php echo "$reviewinfo[4]";?></p>
              <p><?php echo "$reviewinfo[5]";?></p>
              <p><?php echo "$reviewinfo[6]";?></p>
            </div>
          </div>
        </div>
        <div class="col s12 l8 m8">
          <div class="card blue ">
            <div class="card-content white-text">
            <p style="font-size: 3rem;">Review:</p>
              <p><?php echo "$reviewinfo[7]";?></p>
              <br>
              <p class="right-align">Review Submitted: <?php echo "$reviewinfo[8] $reviewinfo[9]"?></p>
            </div>
          </div>
        </div>
      </div>
      <div class = "row">
      <div class="col s12 l3">
      <div class="card blue">
            <div class="card-content blue-grey darken-2 white-text">
            <p>Review Score: <?php if ($rating == 0) {
            	echo "No Score";
            } else echo"$rating"; ?> / 5</p>
            </div>
      </div>
      </div>
      	<div class="col s12 l6 offset-l3">
          <div class="card blue">
            <div class="card-content white-text">
            	<form action="../Database/submit_rating.php" method='POST'>
				    <p>
				    Rate:
				      <input name="group1" type="radio" id="test1" value="1" />
				      <label class="white-text"  for="test1">1</label>
				      <input name="group1" type="radio" id="test2" value="2"/>
				      <label class="white-text"  for="test2">2</label>
				      <input name="group1" type="radio" id="test3"  value="3"/>
				      <label class="white-text"  for="test3">3</label>
				      <input name="group1" type="radio" id="test4" value="4"/>
				      <label class="white-text"  for="test4">4</label>
				      <input name="group1" type="radio" id="test5" value="5"/>
				      <label class="white-text" for="test5">5</label>
				      &nbsp
				      &nbsp
              <input id=\"review_id\" name=\"review_id\" value="<?php echo"$reviewid" ?>" hidden></input> 
              <input id=\"user_id\"name=\"user_id\" value="<?php echo"$user_id" ?>" hidden></input>
				      <button class="waves-effect waves-light btn blue darken-3" type="submit"> Rate</button>
				     </p>
				  </form>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row comment-margin">
        <div class="col l4 s12">
          <div class="card blue white-text comment-margin darken-1">
            <div class="card-content">
              <p style="font-size: 2rem;"><i class="material-icons">forum</i> &nbspComments:</p>
            </div>
          </div>
        </div>
     </div>
      <div class="row">
        <div class="col s12">
        	<?php 
        	if ($number_of_comments == 0) {
        		echo "<div class=\"card blue white-text comment-margin darken-1\">
            				<div class=\"card-content\">
              					<p style=\"font-size: 2rem;\">No Comments</p>
            				</div>
          				</div>";
        	} else {
        	for ($y=0; $y < $number_of_comments; $y++) { 
					mysqli_data_seek($CommentsDataSet,$y);
					$CommentData= mysqli_fetch_row($CommentsDataSet);
					echo "<div class=\"card blue white-text comment-margin darken-1\">
            				<div class=\"card-content\">
              					<p>$CommentData[0]</p>
              					<hr>
              					<p class=\"right\">$CommentData[3] $CommentData[4]&nbsp&nbspon: $CommentData[1] at: $CommentData[2]</p>
            				</div>
          				</div>";
          		}
			}
			?>
        </div>
     </div>
     <?php if ($_SESSION['account'][0] == '1') {
     	echo "<hr>
        <div class=\"row\">
		    <form class=\"col s12\" action =\"../Database/submit_comment.php\" method='POST'>
		      <div class=\"row\">
		        <div class=\"input-field col s12 l10\">
		          <textarea id=\"user_comment\" name=\"user_comment\" class=\"materialize-textarea\"></textarea>
		          <label for=\"user_comment\">New Comment:</label>
		        </div>
		        <button class=\"waves-effect waves-light btn blue darken-3 col s6 offset-s3 l1\" type=\"submit\" style=\"margin-top: 25px; \"> Submit</button>
            <input id=\"review_id\" name=\"review_id\" value=\"$reviewid\" hidden></input> 
            <input id=\"user_id\"name=\"user_id\" value=\"$user_id\" hidden></input>
		      </div>
		    </form>
		  </div>";
     };
     ?>
    </main>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../Scripts/Minified-Scripts/materialize.min.js"></script>
    <script type="text/javascript" src="../Scripts/view_review.js"></script>
</body>
</html>

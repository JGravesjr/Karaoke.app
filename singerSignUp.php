<?php 
	#Connects to the Karaoke database through mysqli. I could set all of this to variables,
	#but it's a one time thing.
	$connection = mysqli_connect("localhost", "Karaoke", "HarvardFan46", "Karaoke_app");
	
	#Checks to see if there were any errors connecting to the database and stops the page
	#if so. 
	if (mysqli_connect_errno()) {
		die("Database connection failed: " . mysqli_connect_error() . 
		" (" . mysqli_connect_errno() . ")" );
	}
		
	#Brings in the functions.php doc.
	require_once("functions.php");
	$errors = array();	
	#Checks for a submission, if none exists continues to page.
	if (isset($_POST['submit'])) {
		#Setting variable values.
		$name = trim($_POST['name']);
		$song = trim($_POST['song']);
		
		#Checks that both values are submitted, sends an error if not.
		$fieldsRequired = array("name", "song");
		foreach($fieldsRequired as $field) {
			$value = trim($_POST[$field]);
			if (!presenceVal($value)){
				$errors[$field] = ucfirst($field) . " can't be blank";
			}
		}
		
		#Checks that the song is in the song database.
		$query = "SELECT songTitle FROM songList WHERE songTitle = '$song' LIMIT 1;";
		$songResult = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($songResult);

		#Assigns DB data to a variable.
		$songMatch = $row[0];
		#Checks to see if there was a match, adds an error if not. 
		if ($song =! $songMatch) {
			$errors[$match] = "You must choose a song from the list.";	
		}

		#Check for errors before logging in.
		if (empty($errors)) {	
			#Add user data to database. 
			$query = "INSERT INTO signUp (name, songName)
				VALUES ('{$name}', '{$songMatch}')";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Database query failed. " . mysqli_error($connection));
			}		
		}
	}	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Online app to let karaoke singers sign up.">
    <meta name="author" content="J Graves Jr">
    <link rel="icon" href="../../favicon.ico">

    <title>Karaoke Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme CSS -->
    <link href="../../dist/css/bootstrap-theme.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this site -->
    <link href="./css/karaoke.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">
      <!-- Allows us to add multiple pages in a scroll type fashion. -->
      <div class="site-wrapper-inner">
        <!-- Starts the cover page -->
        <div class="cover-container">

          <div class="inner cover"> 
		<?php 
			if (isset($_POST['submit']) && empty($errors)){
				echo "Proof of concept.";
			} else {
			echo '<form action="singerSignUp.php" method="post">
				<input type="text" class="input-large" name="name" placeholder="Name" value="" /><br><br>
				<input type="text" class="input-large" name="song" placeholder="Song Name" value="" /><br><br>
				<input type="submit" class="btn btn-lg btn-default" name="submit" value="Sign Up" /><br><br>
			</form>'; 
			}
		?>
          </div>
	  <div class="well well-lg" style="background-color: #635c51;"> <?php echo form_errors($errors); ?></div>
          <div class="mastfoot">
            <div class="inner">
              <p> <a href="http://Karaoke.io">Karaoke.io</a>, by <a href="https://twitter.com/jwgravesjr">@jwgravesjr</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php mysqli_close($connection); ?>

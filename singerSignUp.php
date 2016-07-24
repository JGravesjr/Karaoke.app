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
		$query = "SELECT songTitle FROM songList;";
		$result = mysqli_query($connection, $query);
		

		#Kills the page if no result from database.
		if (!$result) {
			die("Database query failed.");
		}
		
		#Generate a value if they are on the songList.
		$match = 0; 
		while($row = mysqli_fetch_array($result)) {
			$songTitle = $row['songTitle'];
			if ($song == $songTitle) {
				$match ++;	
			}
		}
			
		#Checks to see if there was a match, adds an error if not. 
		if ($match < 1) {
			$errors[$match] = "You must choose a song from the list.";	
		}

		#Check for errors before logging in.
		if (empty($errors)) {
			#Add user data to database. 
			$query = "INSERT INTO signUp (name, songName)
				VALUES ('{$name}', '{$song}')";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				die("Database query failed. " . mysqli_error($connection));
			}		
		}
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Karaoke Sign Up</title>
	</head>
	<body>
		<form action="singerSignUp.php" method="post">
			Name: <input type="text" name="name" value="" /><br>
			Song Choice: <input type="text" name="song" value="" /><br>
			<input type="submit" name="submit" value="Submit" />
		</form>
		<?php echo form_errors($errors); ?>
	</body>
</html>
<?php mysqli_close($connection); ?>

<?php 
	require_once(functions.php);
		
?>

<html lang="en">
	<head>
		<title>Karaoke Sign Up</title>
	</head>
	<body>
		<form action="singerSignUp.php" method="post">
			First Name: <input type="text" name="firstname"><br>
			Last Name: <input type="text" name="lastname"><br>
			Song Choice: <input type="text" name="songchoice"><br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>

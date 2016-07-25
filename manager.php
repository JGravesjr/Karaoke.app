<?php $connection = mysqli_connect("localhost", "karaoke", "HarvardFan46", "Karaoke_app"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
      <title>Karaoke Manager</title>
  </head>
  <body>
	<!-- Gets the data from signUp and prints it to screen.-->
   <pre> <?php
	$query = "SELECT * FROM signUp;";
	$result = mysqli_query($connection, $query);
	
	if (!$result) {
		die("Database query failed.");
	}
	while($row = mysqli_fetch_row($result)) {
		#output data from each row
		print_r(var_dump($row));
		echo "<hr />";
	}
    ?></pre>
  </body>
</html>


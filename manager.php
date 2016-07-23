<?php $connection = mysqli_connect("localhost", "Karaoke", "HarvardFan46", "Karaoke_app"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
  <head>
      <title>Karaoke Manager</title>
  </head>
  <body>
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


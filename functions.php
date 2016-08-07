<?php 
	#Sets the errors global, so that I don't have to initialise it on every page.
	#global $errors = "";

	#Redirects a user to a new location. 
	function redirect($newLocation) {
		header("Location: " . $newLocation);
	}

	#Checks whether or not there is a value in the field.
	function presenceVal($value) {
		return !isset($value) || $value !== "";
	}
	
	
	#Formats error reports for users.
	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {	
			$output .= "<strong>Please fix the following errors:</strong><br>";	
			foreach ($errors as $key => $error) {
				$output .= "<li>{$error}</li> ";
			}
		}
		return $output;
	}

        function showSignUp() {

		#Connect to database
        	$connection = mysqli_connect("localhost", "Karaoke", "HarvardFan46", "Karaoke_app"); 
        	#Assign output variable.
		$output = "";
		#Create table
        	$output .= "<table>";
                	$output .= "<tr>";
                        	$output .= "<th>#</th>";
                        	$output .= "<th>Name</th>";
                        	$output .= "<th>Song Name</th>";
                	$output .= "</tr>";
                        	#Get data from DB
                        	$query = "SELECT * FROM signUp;";
                        	$result = mysqli_query($connection, $query);
				#Check for DB connection
                        	if (!$result) {
                                	die("Database query failed.");
                        	}
				#Create table row by row with new data.
                        	while ($row = mysqli_fetch_row($result)) {
                                	$output .= "<tr>"; 
                                	$output .= "<td>" . $row[0] . "</td>";
                                	$output .= "<td>" . $row[1] . "</td>";
                                	$output .= "<td>" . $row[2] . "</td>";
                        	        $output .= "</tr>";
                	        }
		#End Table
        	$output .=  "</table>";
	        return $output;

        }

?>

<?php
	require_once 'login.php';
	$connection = new mysqli($hn,$un,$pw,$db);

	if($connection->connect_error) die("fatal Error");

	if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
		$un_temp = secureString($_SERVER['PHP_AUTH_USER'],$connection);
		$pw_temp = secureString($_SERVER['PHP_AUTH_PW'],$connection);

		$query = "SELECT * FROM users WHERE username ='$un_temp'";
		$result = $connection->query($query);


		if(!$result) die("User not found");
		elseif ($result->num_rows)
		{
			$row = $result->fetch_array(MYSQLI_NUM);
			$result->close();
			if(password_verify($pw_temp, $row[3])){
				echo "Succesfully logged in";
			}else{
				 die("Invalid username/password combination");
			}
		}else{
			 die("Invalid username/password combination");
		}

		$connection->close();

	}else{
		
		header('WWW-Authenticate: Basic realm="Resticted Area"');
		header('HTTP/1.0 401 Unauthorized');
		die("Please enter your username and password");
	}

	// protection against html injection
	function secureString($var,$conn){
		if(get_magic_quotes_gpc()) $var = stripslashes($var);
		$var = htmlentities($var); 
		return $conn->real_escape_string($var);	// preventing mysql injection
	}

?>

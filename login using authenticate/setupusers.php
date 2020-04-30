<?php
	require_once 'login.php';
	$connection = new mysqli($hn,$un,$pw,$db);
	if($connection->connect_error) die("Fatal Error");

	$insertStatus = FALSE;
	$forename = secureString($_POST['forename'],$connection);
	$surname  = secureString($_POST['surname'],$connection);
	$username = secureString($_POST['username'],$connection);
	$password = secureString($_POST['password'],$connection);

	if (!$connection->query("DESCRIBE users" )){
		createTable($connection);
		$insertStatus=TRUE;	
	}else{
		if(checkUsername($username,$connection)){
			$insertStatus = TRUE;
		}
	}

	if($insertStatus)
	{	
		if(checkPassword($password)){
			addUser($connection,$forename,$surname,$username,$password);
			echo "Success";
		}
		
	}
	

	echo <<<_END
	<form action="setupusers.php" method="post">
		<pre> 
		<font size="+3"><b>Welcome to User Registeration!!!</b></font>
		<font size="+0"><b>Passwort must have  minimum length of 6.</b></font>
		<font size="+1">Forename </font><input type="text" name="forename" required="required">
		<font size="+1">Surname  </font><input type="text" name="surname" required="required">
		<font size="+1">Username </font><input type="text" name="username" required="required">
		<font size="+1">Password </font><input type="text" name="password"  required="required" >
				        <input type="submit" value="Submit">
		</pre>
	</form>
_END;


	//creating a table if the table doesnot exit
	function createTable($conn){
		$query="CREATE TABLE users(
		forename VARCHAR(32) NOT NULL,
		surname VARCHAR(32) NOT NULL,
		username VARCHAR(32) NOT NULL UNIQUE,
		password VARCHAR(255) NOT NULL)";
		$result = $conn->query($query);
		if(!$result) die("Unable to create Table");

	}



	// protection against html injection
	function secureString($var,$conn){
		if(get_magic_quotes_gpc()) $var = stripslashes($var);
		$var = htmlentities($var); 
		return sanititzeString($var,$conn);
	}



	// preventing mysql injection
	function sanititzeString($var,$conn)
	{        
		return $conn->real_escape_string($var);
	}

	// adds user to database + hashes the password
	function addUser($conn,$fn,$sn,$un,$pw){
		$hash=password_hash($pw, PASSWORD_DEFAULT);
		$stmt = $conn->prepare('INSERT INTO users VALUES(?,?,?,?)');
		$stmt->bind_param('ssss',$fn,$sn,$un,$hash);
		$stmt->execute();
		$stmt->close();
	}


	//checking password

	function checkPassword($var){
		if(strlen($var)<5)
		{
			return FALSE;
		} 		
		return TRUE;
	}


	//checking username


	function checkUsername($var,$conn){
		if($conn->query("SELECT username FROM users WHERE username = '$var'")){
			echo "Username already taken!!";
			return FALSE;
		}		
		return TRUE;
	}

?>        

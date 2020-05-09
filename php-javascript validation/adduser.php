
<?php
	// for user who have disable javascript	
	
	$forename = $username = $username = $password =$age =$email ="";

	if(isset($_POST['forename']))
		$forename = fix_string($_POST['forename']);
	if(isset($_POST['surname']))
		$surname = fix_string($_POST['surname']);
	if(isset($_POST['username']))
		$username = fix_string($_POST['username']);
	if(isset($_POST['password']))
		$password = fix_string($_POST['password']);
	if(isset($_POST['age']))
		$age = fix_string($_POST['age']);
	if(isset($_POST['email']))
		$email = fix_string($_POST['email']);



	$fail  = validate_forename($forename);
	$fail .= validate_surname($surname);
	$fail .= validate_username($username);
	$fail .= validate_password($password);
	$fail .= validate_age($age);
	$fail .= validate_email($email);	

	 
	echo "<!DOCTYPE html>\n<html><head><title>An Example Form</title>";
	
	if($fail === ""){
		echo "</head><body> Form data Succesfully validated: </body></html>";
		exit;
	}
	



	echo <<<_END
	<style>
			.signup{
				border:1px solid #999999;
				font: normal 14px helvetica;
				color: #444444;
			}
	</style>
	<script src="validate_functions.js"></script>
	</head>
	<body>
		<table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
			<th colspan="2" align="center"> Signup Form </th>

			<tr><td colspan="2">Sorry,the following errors were Found <br> in your form: <p><font color=red size=1><i>$fail</i></font></p>
			<form  name ="test" method="post"  action="adduser.php"   onsubmit="return validate(this)" >
				<tr><td>Forename</td>
					<td><input type="text" maxlength="32" name="forename" value="$forename"></td></tr>
				<tr><td>Surname</td>
					<td><input type="text" maxlength="32" name="surname" value="$surname"></td></tr>
				<tr><td>Username</td>
					<td><input type="text" maxlength="16" name="username" value="$username"></td></tr>
				<tr><td>Password</td>
					<td><input type="text" maxlength="12" name="password" value="$password"></td></tr>
				<tr><td>Age</td>
					<td><input type="text" maxlength="3" name="age" value="$age"></td></tr>
				<tr><td>E-mail</td>
					<td><input type="text" maxlength="64" name="email" value="$email"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" value="Sign up"></td></tr>
			</form>
		</table>
	</body>

_END;



	//validates fornname
	function validate_forename($field)
	{
	    return ($field == "") ? "No Forename was entered.<br>" : "";
	}

	//validates surname
	function validate_surname($field)
	{
		return ($field == "")? "No Surname was entered.<br>" : "";
	}

	/*validates username
	 *length must be  miniumum 5
	*/
	function validate_username($field)
	{
		if ($field == "") return  "No Username was entered.<br>";
		else if (strlen($field) < 5)
			return "Username must be at least 5 characters.<br>";
		else if (preg_match("/[^a-zA-Z0-9_-]/",$field))
			return "Only a-z, A-Z,0-9,- and _ allowed in Usernames.<br>";
		return "";
	}
	// validates age
	function validate_age($field) 
	{
		if($field == "") return "No Age was entered.<br>";
		else if($field < 18  || $field >110)
			return "Age must be between 18 & 110.<br>";
		return "";
	}

	/*validates password
	 * must be of minimum length 6
	 * must contain one atleast a-z, one atleas A-Z ,and one minimum digit
	*/
	function validate_password($field) {
		if ($field == "") return  "No Password was entered.<br>";
		else if (strlen($field) < 6)
			return "Password must be at least 6 characters.<br>";
		else if (!preg_match("/[a-z]/",$field) || !preg_match("/[A-Z]/",$field) || !preg_match("/[0-9]/",$field) )
			return "Password require one each of a-z, A-Z,0-9.<br>";
		return "";
	}

	/*validate email
	 *is invalid if . and @  conntains at inital place
	*/
	function validate_email($field) {
		if ($field == "") return  "No Email was entered.<br>";
		else if ( !( (strpos($field,".") > 0) && (strpos($field,"@") > 0) )  || preg_match("/[^a-zA-Z0-9.@_-]/",$field) )
			return "The Email address is Invaild.<br>";
		return "";
	}
	// stops html injection
	function fix_string($string)
	{
		if(get_magic_quotes_gpc()) $string = stripslashes($string);
		return htmlentities($string);
	}

	 

?>
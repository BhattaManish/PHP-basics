	/* This function checks is the user have succesfully 
	fullied all condition for signup data
 
	*/

	function validate(form)
	{
		fail  = validateForename(form.forename.value)
		fail += validateSurname(form.surname.value)
		fail += validateUsername(form.username.value)
		fail += validatePassword(form.password.value)
		fail += validateAge(form.age.value)
		fail += validateEmail(form.email.value)
		
		if(fail == "") return true
		else {alert(fail);return false}
	}
	//validates fornname
	
	function validateForename(field)
	{
	    return (field == "")? "No Forename was entered.\n" : ""
	}

	//validates surnname
	function validateSurname(field)
	{
		return (field == "")? "No Surname was entered.\n" : ""
	}

	/*validates username
	 *length must be  miniumum 5
	*/

	function validateUsername(field)
	{
		if (field == "") return  "No Username was entered.\n"
		else if (field.length < 5)
			return "Username must be at least 5 characters.\n"
		else if (/[^a-zA-Z0-9_-]/.test(field))
			return "Only a-z, A-Z,0-9,- and _ allowed in Usernames.\n"
		return ""
	}

	// validates age
	function validateAge(field) 
	{
		if(field == "" || isNaN(field)) return "No Age was entered.\n"
		else if(field < 18  || field >110)
			return "Age must be between 18 & 110.\n"
		return ""
	}

	/*validates password
	 * must be of minimum length 6
	 * must contain one atleast a-z, one atleas A-Z ,and one minimum digit
	*/
	function validatePassword(field) {
		if (field == "") return  "No Password was entered.\n"
		else if (field.length < 6)
			return "Password must be at least 6 characters.\n"
		else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
			return "Password require one each of a-z, A-Z,0-9.\n"
		return ""
	}

	/*validate email
	 *is invalid if . and @  conntains at inital place
	*/
	function validateEmail(field) {
		if (field == "") return  "No Email was entered.\n"
		else if ( !((field.indexOf(".") > 0) && (field.indexOf("@") > 0))  || /[^a-zA-Z0-9.@_-]/.test(field) )
			return "The Email address is Invaild.\n"
		return ""
	}
		
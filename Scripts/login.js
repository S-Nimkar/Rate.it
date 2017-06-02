
function logincheck() {
	var selectusername = document.forms["test"]["user_name"].value;
	var selectpass = document.forms["test"]["pass_word"].value;
	if (selectusername == ""){
		jQuery("input[id='user_name']").val('Please enter a username!')
		return false;
	} else if (selectusername == "Please enter a username!") {return false;}
	if (selectpass == ""){
		jQuery("input[id='pass_word']").val('Please enter a password!')
		return false;
	}	else if (selectpass == "Please enter a password!") {return false;}

}
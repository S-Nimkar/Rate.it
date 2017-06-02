

function validateForm() {
    var firstname = document.forms["registration_form"]["first_name"].value;
    var surname = document.forms["registration_form"]["surname"].value;
    var username = document.forms["registration_form"]["user_name"].value;
    var password = document.forms["registration_form"]["pass_word"].value;
    var c_password = document.forms["registration_form"]["c_pass_word"].value;
    var email = document.forms["registration_form"]["email_add"].value;
    var emailregex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;


    if (firstname == ""){
        jQuery("input[name='first_name']").val('Please enter your first name!')
        return false;
    } else if (firstname == "Please enter your first name!") {return false;} else if (firstname.length> 15 ) {
        jQuery("input[name='first_name']").val('Please enter a valid first name!')
        return false;
    }

    if (surname == ""){
        jQuery("input[name='surname']").val('Please enter your surname!')
        return false;
    } else if (surname == "Please enter your surname!") {return false;} else if (surname.length> 15 ) {
        jQuery("input[name='surname']").val('Please enter a valid surname!')
        return false;
    }
    if (username == ""){
        jQuery("input[name='user_name']").val('Please enter a username!')
        return false;
    } else if (username == "Please enter a username!") {return false;} else if (username.length> 20 ) {
        jQuery("input[name='user_name']").val('Please enter a valid username!')
        return false;
    }
    if (password == ""){
        window.alert( "Please enter a password!" );
        return false;
    } else if (password.length > 20 ) {
        window.alert( "Please enter a password length less than 20!" );
        return false;
    }
    if (c_password != password) {
        window.alert( "Passwords do not match!");
        return false;
    }
    if (emailregex.test(email) == false) {
        window.alert('Please enter a valid email address!');
        return false;
    }
    if (email.length > 50){
        window.alert('Please enter a proper email!');
        return false;
    }
    

}
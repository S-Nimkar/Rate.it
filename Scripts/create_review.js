$( document ).ready(function(){
    $(".button-collapse").sideNav();
});
function validateForm() {
	var address1 = document.forms["review"]["address1"].value;
	var address2 = document.forms["review"]["address2"].value;
	var city = document.forms["review"]["city"].value;
	var region = document.forms["review"]["region"].value;
	var postcode = document.forms["review"]["postcode"].value;
	var review = document.forms["review"]["review-body"].value;

	 if (address1 == ""){
        jQuery("input[name='address1']").val('Please enter a Address 1!')
        return false;
    } else if (address1 == "Please enter a Address 1!") {return false;} else if (address1.length> 50 ) {
        jQuery("input[name='address1']").val('Please enter a valid address 1!')
        return false;
    }
    if (city == ""){
        jQuery("input[name='city']").val('Please enter a city!')
        return false;
    } else if (city == "Please enter a city!") {return false;} else if (city.length> 15 ) {
        jQuery("input[name='city']").val('Please enter a valid city')
        return false;
    }
    if (region == ""){
        jQuery("input[name='region']").val('Please enter a region!')
        return false;
    } else if (region == "Please enter a region!") {return false;} else if (region.length> 15 ) {
        jQuery("input[name='region']").val('Please enter a valid region')
        return false;
    }
    if (postcode == ""){
        jQuery("input[name='postcode']").val('Please enter a postcode!')
        return false;
    } else if (postcode == "Please enter a postcode!") {return false;} else if (postcode.length> 15 ) {
        jQuery("input[name='postcode']").val('Please enter a valid postcode')
        return false;
    }
    if (review == ""){
        jQuery("input[name='review']").val('Please enter a review!')
        return false;
    } else if (review == "Please enter a review!") {return false;}
}
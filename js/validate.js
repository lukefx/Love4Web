function checkWholeForm(errorID) {

	var f = getElementsByClassName(document, "*", "error");
    for(var i=0; i<f.length; i++){
        s += f[i].className + '/';
		f.className = "";
	}

	var why = "";
	why += checkFirstName($('firstName').value);
	why += checkLastName($('lastName').value);
	why += checkStreet($('street').value);
	why += checkCity($('city').value);
	why += checkCountry($('country').value);
	why += checkDate($('day').value, $('month').value, $('year').value);
    why += checkUsername($('username').value);
    why += checkPassword($('password').value);
	why += isDifferent($('password').value, $('password2').value);
	why += checkEmail($('email').value);
	why += checkTerms($('accept'));

    if (why != "") {
		//$(errorID).style.display = 'block';
		//$(errorID).innerHTML = '<h2 class="errorHeader">Errors</h2><hr />'+'<ul>' + why + '</ul>';
	  	return false;
    }
	return true;
}

function checkChangePassword(errorID)
{
	var why = "";
	why += checkPassword($('newpwd').value);
	why += isDifferent($('newpwd').value, $('newpwd2').value);

	if (why != "") {
		$(errorID).style.display = 'block';
		$(errorID).innerHTML = '<h2 class="errorHeader">Errors</h2><hr />'+'<ul>' + why + '</ul>';
	  	return false;
    }
	return true;
}

// 4-10 chars, uc, lc, and underscore only.
function checkFirstName (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li0').className = "error";
	    error = "<small>You didn't enter a firstname.</small>";
        $('i0').innerHTML = error;
	}
    var illegalChars = /\W[\s]/; // allow letters, numbers, and underscores
    if ((strng.length < 2) ) {
        $('fo1li0').className = "error";
        error = "<small>The firstname is the wrong length.</small>";
        $('i0').innerHTML = error;
    }
    else if (illegalChars.test(strng)) {
        $('fo1li0').className = "error";
        error = "<small>The firstname contains illegal characters.</small>";
        $('i0').innerHTML = error;
    }
	return error;
}

// username - 4-10 chars, uc, lc, and underscore only.
function checkLastName (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li0').className = "error";
	    error = "<small>You didn't enter a lastname.</small>";
        $('i0').innerHTML = error;
	}
    var illegalChars = /\W[\s]/; // allow letters, numbers, and underscores
    if ((strng.length < 2)) {
        $('fo1li0').className = "error";
        error = "<small>The lastname is the wrong length.</small>";
        $('i0').innerHTML = error;
    }
    else if (illegalChars.test(strng)) {
        $('fo1li0').className = "error";
        error = "<small>The lastname contains illegal characters.</small>";
        $('i0').innerHTML = error;
    }
	return error;
}  

// non-empty textbox
function isEmpty(strng) {
	var error = "";
	if (strng.length == 0) {
    	error = "<li>The mandatory text area has not been filled in.</li>";
  	}
	return error;	  
}

function checkStreet(strng) {
	var error = "";
	if (strng.length == 0) {
        $('fo1li2').className = "error";
    	error = "<small>The street text has not been filled in.</small>";
        $('i2').innerHTML = error;
  	}
	return error;
}

function checkZip (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li2').className = "error";
	    error = "<li>You didn't enter a ZIP Postal code.</li>";
        $('i2').innerHTML = error;
	}
	if (strng.length < 4) {
    	error = "<li>The ZIP Postal code is too short.</li>";
        $('i2').innerHTML = error;
  	}
	var stripped = strng.replace(/[\(\)\.\-\ ]/g, ''); //strip out acceptable non-numeric characters
    if (isNaN(parseInt(stripped))) {
       error = "<li>The ZIP Postal code contains illegal characters.</li>";
       $('i2').innerHTML = error;
    }
	return error;
}

function checkCity(strng) {
	var error = "";
	if (strng.length == 0) {
        $('fo1li2').className = "error";
    	error = "<li>The City text has not been filled in.</li>";
        $('i2').innerHTML = error;
  	}
	return error;	  
}

function checkCountry(strng) {
	var error = "";
	if (strng.length == 0) {
        $('fo1li2').className = "error";
    	error = "<small>The Country text has not been filled in.</small>";
        $('i2').innerHTML = error;
  	}
	return error;	  
}

function checkDate(day, month, year) {
	var error = "";
	var stripped = day.replace(/[\(\)\.\-\ ]/g, ''); //strip out acceptable non-numeric characters
    if (isNaN(parseInt(stripped))) {
        $('fo1li3').className = "error";
    	error = "<small>The day number contains illegal characters.</small>";
        $('i3').innerHTML = error;
  	}
	var stripped = month.replace(/[\(\)\.\-\ ]/g, ''); //strip out acceptable non-numeric characters
    if (isNaN(parseInt(stripped))) {
        $('fo1li3').className = "error";
    	error += "<small>The month number contains illegal characters.</small>";
        $('i3').innerHTML = error;
  	}
	var stripped = year.replace(/[\(\)\.\-\ ]/g, ''); //strip out acceptable non-numeric characters
    if (isNaN(parseInt(stripped))) {
        $('fo1li3').className = "error";
    	error += "<small>The year number contains illegal characters.</small>";
        $('i3').innerHTML = error;
  	}
	return error;	  
}

// username - 6-40 chars, uc, lc, and underscore only.
function checkUsername (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li5').className = "error";
	    error = "<small>You didn't enter a username.</small>";
        $('i5').innerHTML = error;
	}
    var illegalChars = /\W/; // allow letters, numbers, and underscores
    if ((strng.length < 6) || (strng.length > 40)) {
        $('fo1li5').className = "error";
        error = "<small>The username is the wrong length.</small>";
        $('i5').innerHTML = error;
    }
    else if (illegalChars.test(strng)) {
        $('fo1li5').className = "error";
        error = "<small>The username contains illegal characters.</small>";
        $('i5').innerHTML = error;
    } 
	return error;
}

// password - between 4-40 chars, uppercase, lowercase, and numeral
function checkPassword (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li6').className = "error";
        error = "<small>You didn't enter a password.</small>";
        $('i6').innerHTML = error;
	}

    var illegalChars = /[\W_]/; // allow only letters and numbers

    if ((strng.length < 4) || (strng.length > 40)) {
        $('fo1li6').className = "error";
        error = "<small>The password is the wrong length.</small>";
        $('i6').innerHTML = error;
    }
    else if (illegalChars.test(strng)) {
        $('fo1li6').className = "error";
        error = "<small>The password contains illegal characters.</small>";
        $('i6').innerHTML = error;
    }
    else if (!((strng.search(/(a-z)+/)) && (strng.search(/(A-Z)+/)) && (strng.search(/(0-9)+/)))) {
        $('fo1li6').className = "error";
        error = "<small>The password must contain at least one uppercase letter, one lowercase letter, and one numeral.</small>";
        $('i6').innerHTML = error;
    }  
	return error;
}

// Password different?
function isDifferent(passwd1, passwd2) {
	var error = "";
	if (passwd1 != passwd2) {
        $('fo1li7').className = "error";
        error = "<small>The passwords are different.</small>";
    	$('i7').innerHTML = error;
	}
	return error;
}

function checkEmail (strng) {
	var error = "";
	if (strng == "") {
        $('fo1li8').className = "error";
	    error = "<small>You didn't enter an email address.</small>";
        $('i8').innerHTML = error;
	}

	var emailFilter=/^.+@.+\..{2,3}$/;
    if (!(emailFilter.test(strng))) {
        $('fo1li8').className = "error";
        error = "<small>Please enter a valid email address.</small>";
        $('i8').innerHTML = error;
    }
    else
	{
		//test email for illegal characters
       	var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/
        if (strng.match(illegalChars)) {
            $('fo1li8').className = "error";
            error = "<small>The email address contains illegal characters.</small>";
            $('i8').innerHTML = error;
        }
    }
	return error;    
}

function checkTerms(checkbox) {
	var error = "";
	if (!checkbox.checked) {
        $('fo1li10').className = "error";
    	error = "<li>You have to accept the Terms of conditions.</li>"
        $('i10').innerHTML = error;
  	}
	return error;
}

// exactly one radio button is chosen
function checkRadio(checkvalue) {
var error = "";
   if (!(checkvalue)) {
       error = "<small>Please check a radio button.</small>";
    }
return error;
}

// valid selector from dropdown list

function checkDropdown(choice) {
var error = "";
    if (choice == 0) {
    error = "<li>You didn't choose an option from the drop-down list.</li>";
    }    
return error;
}
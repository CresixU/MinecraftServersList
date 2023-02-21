var minLength = false;
var upperCase = false;
var specialChar = false
var number = false;
var inputId = "";
var isAvailable = false;
var isRequirementsChecked = false;
var requirements;

//Call on initialize
function ShowPasswordRequirements(input_id,elementInfoId) {

    $.ajax({
        url: api_url+'/api/v1/users/password-requirements/',
    }).done(res => {
        requirements = res;
        inputId = '#'+input_id;
        $('#'+elementInfoId).append('<span id="req-min-length">Minimalna ilość znaków: '+requirements.minLength+'</span><br>');
        if(requirements.mustContainsSpecialChar)
        {
            $('#'+elementInfoId).append('<span id="req-spec-char">Wymagany znak specjalny</span><br>');
        }
        if(requirements.mustContainsUpperLetter)
        {
            $('#'+elementInfoId).append('<span id="req-upper-letter">Wymagana wielka litera</span><br>');
        }
        if(requirements.mustContainsNumber)
        {
            $('#'+elementInfoId).append('<span id="req-number">Wymagana cyfra</span><br>');
        }
        isAvailable = true;
    }); 
}

/*
function isRequirementsChecked() {
    if(minLength && upperCase && number && specialChar) return true;
    else return false;
}
*/

//Call on input / change value
function PasswordMessager() {
    if(!isAvailable) return;
    var password = $(inputId).val();
    if(requirements.minLength > password.length) {
        $('#req-min-length').css('color', 'red');
        minLength = false;
    }
    else {
        $('#req-min-length').css('color', 'green');
        minLength = true;
    }

    var regex = /[A-Z]/;
    if(requirements.mustContainsUpperLetter && !password.match(regex)) {
        $('#req-upper-letter').css('color', 'red');
        upperCase = false;
    }
    else {
        $('#req-upper-letter').css('color', 'green');
        upperCase = true;
    }

    regex = /[0-9]/;
    if(requirements.mustContainsNumber && !password.match(regex)) {
        $('#req-number').css('color', 'red');
        number = false;
    }
    else {
        $('#req-number').css('color', 'green');
        number = true;
    }

    regex = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if(requirements.mustContainsSpecialChar && !password.match(regex)) {
        $('#req-spec-char').css('color', 'red');
        specialChar = false;
    }
    else {
        $('#req-spec-char').css('color', 'green');
        specialChar = true
    }
}



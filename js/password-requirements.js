var minLength = 8;
var upperCase = true;
var specialChar = true
var number = true;
var inputId = "";
var isAvailable = false;
//Call on initialize
function ShowPasswordRequirements(input_id,elementInfoId) {

    $.ajax({
        url: api_url+'/api/v1/users/password-requirements/',
    }).done(res => {
        minLength = res.minLength;
        upperCase = res.mustContainsUpperLetter;
        specialChar = res.mustContainsSpecialChar;
        number = res.mustContainsNumber;
        inputId = '#'+input_id;
        $('#'+elementInfoId).append('<span id="req-min-length">Minimalna ilość znaków: '+minLength+'</span><br>');
        if(specialChar)
        {
            $('#'+elementInfoId).append('<span id="req-spec-char">Wymagany znak specjalny</span><br>');
        }
        if(upperCase)
        {
            $('#'+elementInfoId).append('<span id="req-upper-letter">Wymagana wielka litera</span><br>');
        }
        if(number)
        {
            $('#'+elementInfoId).append('<span id="req-number">Wymagana cyfra</span><br>');
        }
        isAvailable = true;
    });
        
        
    
}
//Call on input / change value
function PasswordMessager() {
    if(!isAvailable) return;
    var password = $(inputId).val();
    if(minLength > $(inputId).val().length) {
        $('#req-min-length').css('color', 'red');
    }
    else {
        $('#req-min-length').css('color', 'green');
    }

    var regex = /[A-Z]/;
    if(upperCase && !password.match(regex)) {
        $('#req-upper-letter').css('color', 'red');
    }
    else {
        $('#req-upper-letter').css('color', 'green');
    }

    regex = /[0-9]/;
    if(number && !password.match(regex)) {
        $('#req-number').css('color', 'red');
    }
    else {
        $('#req-number').css('color', 'green');
    }

    regex = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if(specialChar && !password.match(regex)) {
        $('#req-spec-char').css('color', 'red');
    }
    else {
        $('#req-spec-char').css('color', 'green');
    }
}

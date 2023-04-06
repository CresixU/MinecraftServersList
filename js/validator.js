//Return false on fail
function ValidateInput(id) {
    if($(id).val().length == 0 || $(id).val() == null || $(id).val() == ' ') {
        $(id).css("border-bottom","2px solid red");
        return false;
    }
    else {
        $(id).css("border-bottom", "2px solid var(--main-color)");
        return true;
    }
}
function ValidateSelect(id) {
    if($(id).val() == null) {
        $(id).css("border-bottom","2px solid red");
        return false;
    }
    else {
        $(id).css("border-bottom", "2px solid var(--main-color)");
        return true;
    }
}
//ReturnServerVersions().versions for array or .versionsString for string
function ReturnServerVersions(versionsArray) {
    if(versionsArray.length === 0) return "??";
    var v = versionsArray.map(x => x.minecraftVersion.version);
    var vs = v.join(', ');
    var fv = '>'+v[0]+'?';
    var obj = {
        versions: v,
        versionsString: vs,
        formatedVersions: fv,
    };

    return obj;
}

//Return false on fail
function ValidateInput(id) {
    if($(id).val().length == 0) {
        $(id).css("border-bottom","2px solid red");
        return false;
    }
    else {
        $(id).css("border-bottom", "2px solid var(--main-color)");
        return true;
    }
}
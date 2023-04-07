<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="autocomplete/tokenize2.css">
        <link rel="stylesheet" href="css/ckeditor.css">
        <style>
            body {
                color: #dfd7cc;
            }
            label:not(.checkbox-label) {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
                position: relative;
                top: 10px;
            }
            .panel-content > div > *:not(.second-header) {
                padding: 10px 30px;
            }
            .second-header {
                padding-left: 20px;
            }
            input[type=text],
            input[type=password] {
                width: 100%;
                padding: 8px 12px;
                color: white;
                border: none;
                border-bottom: 2px solid var(--main-color);
                border-radius: 8px;
            }
            .form-control {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                border: none;
                border-left: 2px solid var(--main-color);
                border-right: 2px solid var(--main-color);
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <?php require_once("components/top.php"); ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    Dodaj nowy serwer
                                </div>
                            </div>
                            <form id="myForm">
                                <div class="panel-content pb-5">
                                    <p style="padding-left: 20px;">
                                        Pola oznaczone <span style="color:red"> * </span> są wymagane.
                                    </p>
                                    <div>
                                        <p class="second-header mb-0">Weryfikacja</p>
                                        <p>Przed przejściem do wypełniania dalszej częsci formularza ustaw swojemu serwerowi następujący MOTD (Message of the day - Wiadomość dnia)</p>
                                        <h3 id="desired-motd">www.minecraft-list.pl#<span id="user-name"></span></h3>
                                        <p>Weryfikacja jest konieczna, aby pewne było, że serwer, który dodajesz na listę należy do Ciebie</p>
                                        <!--<button class="simple-button" onclick="CheckServerMotd()">Sprawdź MOTD</button>-->
                                        <p id="motd-response"></p>
                                    </div>
                                    <div>
                                        <p class="second-header mb-0">Nazwa i adres serwera</p>
                                        <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                            <div>
                                                <label for="addserver-servername" id="addserver-servername-label">Nazwa serwera<span style="color:red">*</span></label>
                                                <input type="text" id="addserver-servername" placeholder="Minecraft Server" required>
                                            </div>
                                            <div>
                                                <label for="addserver-ip" id="addserver-ip-label">Adres IP lub domena serwera<span style="color:red">*</span></label>
                                                <input type="text" id="addserver-ip" placeholder="mój-server.pl" required>
                                            </div>
                                            <div>
                                                <label for="addserver-port" id="addserver-port-label">Port<span style="color:red">*</span></label>
                                                <input type="text" id="addserver-port" value="25565" placeholder="Domyślnie 25565" required>
                                            </div>
                                            <div class="mt-3">
                                                <input type="checkbox" id="addserver-onlinemode">
                                                <label for="addserver-onlinemode" class="checkbox-label">Online Mode</label>
                                            </div>
                                            <div id="server-gamemodes-div">
                                                <label for="server-gamemode" id="server-gamemode-label" style="top:0;">Tryb gry</label>
                                                <select class="demo2" id="server-gamemode" multiple>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="addserver-ping-versions">
                                                <label for="addserver-ping-versions" class="checkbox-label">Ręcznie dodam wersję serwera</label>
                                                <p class="mb-0" style="opacity: 0.5">Jeśli ta opcja jest odznaczona, nasz system zrobi to automatycznie</p>
                                            </div>
                                            <div id="server-versions-div" style="display: none;">
                                                <label for="server-versions" id="server-versions-label" style="top:0;">Wersję serwera</label>
                                                <select class="demo1" id="server-versions" multiple>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="second-header mb-0">Socialmedia</p>
                                        <div  class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                            <div>
                                                <label for="addserver-website" id="addserver-website-label">Strona serwera</label>
                                                <input type="text" id="addserver-website" placeholder="http://example.com">
                                                <label for="addserver-website" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>http://</b> na początku.</label>
                                            </div>
                                            <div>
                                                <label for="addserver-discord-server" id="addserver-discord-server-label">Link do Discorda serwera</label>
                                                <input type="text" id="addserver-discord-server" placeholder="http://example.com">
                                                <label for="addserver-discord-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                            </div>
                                            <div>
                                                <label for="addserver-facebook-server" id="addserver-facebook-server-label">Link do strony serwera na Facebooku</label>
                                                <input type="text" id="addserver-facebook-server" placeholder="http://example.com">
                                                <label for="addserver-facebook-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="second-header mb-0 d-flex">
                                            <p class="mb-0" style="margin-right: auto;">Dodatkowe informacje o serwerze<span style="color:red">*</span></p>
                                            <!--<p class="mb-0" style="padding-right: 20px">Pozostało <span id="addserver-desc-chars">5000</span> znaków</p>-->
                                        </div>
                                        <div>
                                            <!--<textarea name="addserver-desc" id="addserver-desc" rows="10" placeholder="Twój opis serwera..."
                                            style="background: transparent; color: white; width: 100%; padding: 10px"></textarea>-->
                                            <textarea id="editor"></textarea>
                                        </div>

                                    </div>
                                    <div class="pb-5">
                                        <p class="second-header mb-0">
                                            Dodaj serwer do listy
                                        </p>
                                        <div class="px-3"> 
                                            <button class="btn-green mx-auto" style="float:right" onclick="OnCreate(event)">Dodaj serwer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">

            </div>
        </footer>
        <div class="copyright">
            Lista serwerów Minecraft, spis serwerów Minecraft, prywatne serwery Minecraft, serwery Minecraft - &copy; Copyright 2013-2021
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="autocomplete/tokenize2.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script src="js/ckeditor.js"></script>
        <script src="js/validator.js" type="text/javascript"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;
            var gamemodes = [];
            var versions = [];

            GetMinecraftAllGameModes();
            $('#nav-serwery').addClass('active');

            /*$('#addserver-desc').on('input', function() {
                $('#addserver-desc-chars').text(5000 - $('#addserver-desc').val().length );
            });*/

            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                xhrFields: {
                        withCredentials: true
                    },
                complete: function(xhr, textStatus) {
                    if(xhr.status != "200") {
                        window.location.replace("auth.php");
                    }

                } 
            }).done(res => {
                userData = res;
                $('#user-name').text(userData.login);

                $('.demo2').tokenize2({
                    sortable: true,
                    placeholder: "Zacznij wpisywać..."
                });
                $('.demo1').tokenize2({
                    sortable: true,
                    placeholder: "Zacznij wpisywać..."
                });
             })

            function CheckServerMotd() {
                $('#motd-response').empty();
                var serverIp = $('#addserver-ip').val();
                if(serverIp == '') {
                    $('#motd-response').text("Ip serwera nie zostało ustawione poniżej");
                    return false;
                }
                    
                var serverPort = $('#addserver-port').val();
                if(serverIp == '') {
                    $('#motd-response').text("Port serwera nie został ustawiony poniżej");
                    return false;
                }

                   
                var mcapi_url = 'https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort;

                $.ajax({
                    url: mcapi_url,
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    if(res.status == 'error')  {
                        $('#motd-response').text("Error. Prawdopodobnie nie odnaleziono serwera");
                        return false;
                    }
                    if(res.motd_json != $('#desired-motd').text()) {
                        var desired_motd = $("#desired-motd").text();
                        $('#motd-response').append($('<p>MOTD nie został ustawiony poprawnie<br> Wymagany MOTD: '+desired_motd+'<br>Twoje MOTD: '+res.motd_json+'</p>'));
                        return false;
                    }
                    $('#motd-response').append($('<p color="var(--main-color)">MOTD zostało zweryfikowane</p>'))
                    
                    return true;
                })
                
            }

            function OnCreate(e) {
                e.preventDefault();

                $("#myForm")[0].reportValidity();
                if( !ValidateInput('#addserver-servername') || !ValidateInput('#addserver-ip') || !ValidateInput('#addserver-port')) {
                    alert("Uzupełnij wymagane pola");
                    return;
                }
        
                grecaptcha.ready(function() {
                    grecaptcha.execute('6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl', {action: 'submit'}).then(function(token) {
                        CreateNewServer(token);
                    });
                });
            }

            //Funkcja zwarająca wszystkie oficialne wersje serwerów mc
            async function GetMinecraftAllVersions() {
                await $.ajax({
                    url: api_url+'/api/v1/servers/versions/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    res.forEach(x => $('#server-versions').append($('<option value="'+x.version+'">'+x.version+'</option>')));
                })
            }
            //Versions
            function GetVersionsFromInput() {
                var htmlArray = $('#server-versions-div').children('.tokenize').children('.tokens-container').children('li.token');
                for(var i = 0; i<htmlArray.length; i++) {
                    versions[i] = htmlArray[i].attributes[1].textContent;
                }
            }
            $('#addserver-ping-versions').on('change', function() {
                console.log("Git");
                if($('#addserver-ping-versions').prop('checked'))
                    $('#server-versions-div').css('display','block');
                else 
                    $('#server-versions-div').css('display','none');
            })

            //Gamemodes
            function GetGameModesFromInput() {
                var htmlArray = $('#server-gamemodes-div').children('.tokenize').children('.tokens-container').children('li.token');
                for(var i = 0; i<htmlArray.length; i++) {
                    gamemodes[i] = htmlArray[i].attributes[1].textContent;
                }
            }
            async function GetMinecraftAllGameModes() {
                $.ajax({
                    url: api_url+'/api/v2/game-modes/?status=ACCEPTED',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    res.content.forEach(x => $('#server-gamemode').append($('<option value="'+x.id+'">'+x.gameMode+'</option>')));
                });
            }
            function DeleteElement(id) {
                $('li.token[data-value="'+id+'"]').remove();
            }

            //Create Server
            function CreateNewServer(token) {
                //if(!CheckServerMotd()) return;

                var servername = $('#addserver-servername').val();
                var ip = $('#addserver-ip').val();
                var port = $('#addserver-port').val();
                var isOnlineMode = $('#addserver-onlinemode').prop('checked');
                var homepage = $('#addserver-website').val();
                var discordServer = $('#addserver-discord-server').val();
                var facebookServer = $('#addserver-facebook-server').val();
                //var desc = $('#addserver-desc').val();
                var desc = editor.getData();
                var pingVersions = $('#addserver-ping-versions').prop('checked');
                GetGameModesFromInput();
                if(pingVersions) GetVersionsFromInput();

                $.ajax({
                    type: 'POST',
                    url: api_url+'/api/v1/servers/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    //data: '{"hostCredentials": {"host": "'+ip+'","port": '+port+',"address": "'+ip+'"},"serverCredentials": {"name": "'+servername+'","description": "'+desc+'","homepage": "'+homepage+'","facebook": "'+facebookServer+'","discord": "'+discordServer+'","isOnlineModeEnabled": '+isOnlineMode+',"pingVersions": '+pingVersions+'},"gameModeCredentials": {"gameModeIds": '+ReturnStringArray(gamemodes)+'},"versionCredentials": {"versions": '+ReturnStringArray(versions)+'}, "gResponse": "'+token+'"}',
                    data: JSON.stringify({hostCredentials: {host: ip,port: port,address: ip},serverCredentials: {name: servername,description: desc,homepage: homepage,facebook: facebookServer,discord: discordServer,isOnlineModeEnabled: isOnlineMode,pingVersions: pingVersions},gameModeCredentials: {gameModeIds: gamemodes},versionCredentials: {versions: versions}, gResponse: token}),
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        if(xhr.status == 200) {
                            alert('Serwer został dodany');
                            window.location.replace("index.php");
                        }
                        else alert(xhr.responseJSON.message);
                    } 
                });
            }

            function ReturnStringArray(arr) {
                var str = '[';
                for(var i=0; i<arr.length;i++) {
                    str+='"'+arr[i]+'"';
                    if(i != arr.length-1) str+=','
                }
                str+=']'
                return str;
            }

            GetMinecraftAllVersions()

        </script>
    </body>
</html>

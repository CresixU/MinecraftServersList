<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="autocomplete/tokenize2.css">
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
                            <div class="panel-content pb-5">
                                <p style="padding-left: 20px;">
                                    Pola oznaczone <span style="color:red"> * </span> są wymagane.
                                </p>
                                <div>
                                    <p class="second-header mb-0">Weryfikacja</p>
                                    <p>Przed przejściem do wypełniania dalszej częsci formularza ustaw swojemu serwerowi następujący MOTD (Message of the day - Wiadomość dnia)</p>
                                    <h3 id="desired-motd">www.minecraft-list.pl#<span id="user-name"></span></h3>
                                    <p>Weryfikacja jest konieczna, aby pewne było, że serwer, który dodajesz na listę należy do Ciebie</p>
                                    <button class="simple-button" onclick="CheckServerMotd()">Sprawdź MOTD</button>
                                    <p id="motd-response"></p>
                                </div>
                                <div>
                                    <p class="second-header mb-0">Nazwa i adres serwera</p>
                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                        <div>
                                            <label for="addserver-servername" id="addserver-servername-label">Nazwa serwera</label>
                                            <input type="text" id="addserver-servername">
                                        </div>
                                        <div>
                                            <label for="addserver-ip" id="addserver-ip-label">Adres IP lub domena serwera</label>
                                            <input type="text" id="addserver-ip">
                                        </div>
                                        <div>
                                            <label for="addserver-port" id="addserver-port-label">Port</label>
                                            <input type="text" id="addserver-port" value="25565">
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
                                        <p class="mb-0" style="margin-right: auto;">Dodatkowe informacje o serwerze</p>
                                        <p class="mb-0" style="padding-right: 20px">Pozostało <span id="addserver-desc-chars">5000</span> znaków</p>
                                    </div>
                                    <div>
                                        <textarea name="addserver-desc" id="addserver-desc" rows="10" placeholder="Twój opis serwera..."
                                        style="background: transparent; color: white; width: 100%; padding: 10px"></textarea>
                                    </div>

                                </div>
                                <div>
                                    <p class="second-header mb-0">
                                        Dodaj serwer do listy
                                    </p>
                                    Captcha na środku
                                    <button class="simple-button d-block" style="float:right">Dodaj serwer</button>
                                </div>

                            </div>
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
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;
            var gamemodes = [];

            GetMinecraftAllGameModes();
            $('#nav-serwery').addClass('active');

            $('#addserver-desc').on('input', function() {
                $('#addserver-desc-chars').text(5000 - $('#addserver-desc').val().length );
            })

            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                complete: function(xhr, textStatus) {
                    if(xhr.status != "200") 
                        window.location.replace("auth.php");
                } 
            }).done(res => {
                userData = res;
                $('#user-name').text(userData.login);

                $('.demo2').tokenize2({sortable: true});
            })

            function CheckServerMotd() {
                $('#motd-response').empty();
                var serverIp = $('#addserver-ip').val();
                if(serverIp == '') {
                    $('#motd-response').text("Ip serwera nie zostało ustawione poniżej");
                    return;
                }
                    
                var serverPort = $('#addserver-port').val();
                if(serverIp == '') {
                    $('#motd-response').text("Port serwera nie został ustawiony poniżej");
                    return;
                }
                   
                var mcapi_url = 'https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort;

                $.ajax({
                    url: mcapi_url,
                }).done(res => {
                    if(res.status == 'error')  {
                        $('#motd-response').text("Error. Prawdopodobnie nie odnaleziono serwera");
                        return;
                    }
                    if(res.motd_json != $('#desired-motd').text()) {
                        var desired_motd = $("#desired-motd").text();
                        $('#motd-response').append($('<p>MOTD nie został ustawiony poprawnie<br> Wymagany MOTD: '+desired_motd+'<br>Twoje MOTD: '+res.motd_json+'</p>'));
                        return;
                    }
                    $('#motd-response').append($('<p color="var(--main-color)">MOTD zostało zweryfikowane</p>'))
                        
                })
            }

            //Funkcja zwarająca wszystkie oficialne wersje serwerów mc
            async function GetMinecraftAllVersions() {
                await $.ajax({
                    url: 'https://launchermeta.mojang.com/mc/game/version_manifest.json',
                }).done(res => {
                    var results = res.versions.filter(x => x.type == 'release');
                    console.log(results);
                })
            }

            //Gamemodes
            function GetGameModesFromInput() {
                var htmlArray = $('#server-gamemodes-div').children('.tokenize').children('.tokens-container').children('li.token');
                for(var i = 0; i<htmlArray.length; i++) {
                    gamemodes[i] = htmlArray[i].attributes[1].textContent;
                }
            }
            async function GetMinecraftAllGameModes() {
                $.ajax({
                    url: api_url+'/api/v1/servers/game-modes/',
                }).done(res => {
                    res.content.forEach(x => $('#server-gamemode').append($('<option value="'+x.id+'">'+x.gameMode+'</option>')));
                });
            }
            function DeleteElement(id) {
                $('li.token[data-value="'+id+'"]').remove();
            }

            //Create Server
            function CreateNewServer() {
                var servername = $('#addserver-servername').val();
                var ip = $('#addserver-ip').val();
                var port = $('#addserver-port').val();
                var isOnlineMode = $('#addserver-onlinemode').prop('checked');
                var homepage = $('#addserver-website').val();
                var discordServer = $('#addserver-discord-server').val();
                var facebookServer = $('#addserver-facebook-server').val();
                var desc = $('#addserver-desc').val();
                GetGameModesFromInput();
                $.ajax({
                    type: 'POST',
                    url: api_url+'/api/v1/servers/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"hostCredentials": {"host": "'+ip+'","port": '+port+'},"serverCredentials": {"name": "'+servername+'","description": "'+desc+'","homepage": "'+homepage+'","facebook": "'+facebookServer+'","discord": "'+discordServer+'","isOnlineModeEnabled": '+isOnlineMode+'},"gameModesCredentials": {"internalGameModes": "'+gamemodes+'"}}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        //console.log("Complete: "+xhr.responseJSON.message);
                    } 
                });
            }

        </script>
    </body>
</html>

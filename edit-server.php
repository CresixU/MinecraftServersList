<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="autocomplete/tokenize2.css">
        <link rel="stylesheet" href="css/ckeditor.css">
        <style>
            body {
                color: #dfd7cc;
            }
            .panel-header a {
                color: var(--href-color);
                text-decoration: none;
            }
            label:not(.checkbox-label) {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
                position: relative;
                top: 10px;
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
            .version {
                transition: .3s;
            }
            .version:hover {
                cursor: help;
                color: var(--href-color2);
            }
        </style>
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <?php require_once("components/top.php"); ?>
        <main>
            <?php echo "<span id='server-id' style='display: none;'>" . $_GET['id']."</span>";?>
            <div class="container">
                <div class="row">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="col">
                                    Edytowanie serwera
                                </div>
                            </div>
                            <div class="panel-content p-3 pt-5">
                                <div class="body">
                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                        <div>
                                            <label for="edit-servername" id="edit-servername-label">Nazwa serwera</label>
                                            <input type="text" id="edit-servername">
                                        </div>
                                        <div>
                                            <label for="edit-ip" id="edit-ip-label">Adres IP lub domena serwera</label>
                                            <input type="text" id="edit-ip" disabled>
                                        </div>
                                        <div>
                                            <label for="edit-port" id="edit-port-label">Port</label>
                                            <input type="text" id="edit-port" value="25565" disabled>
                                        </div>
                                        <div class="mt-3">
                                            <input type="checkbox" id="edit-onlinemode">
                                            <label for="edit-onlinemode" class="checkbox-label">Online Mode</label>
                                        </div>
                                        <div>
                                            <label for="edit-website" id="edit-website-label">Strona serwera</label>
                                            <input type="text" id="edit-website" placeholder="http://example.com">
                                            <label for="edit-website" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>http://</b> na początku.</label>
                                        </div>
                                        <div>
                                            <label for="edit-discord-server" id="edit-discord-server-label">Link do Discorda serwera</label>
                                            <input type="text" id="edit-discord-server" placeholder="http://example.com">
                                            <label for="edit-discord-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                        </div>
                                        <div>
                                            <label for="edit-facebook-server" id="edit-facebook-server-label">Link do strony serwera na Facebooku</label>
                                            <input type="text" id="edit-facebook-server" placeholder="http://example.com">
                                            <label for="edit-facebook-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="addserver-ping-versions">
                                            <label for="addserver-ping-versions" class="checkbox-label">Ręcznie dodam wersję serwera</label>
                                            <p class="mb-0" style="opacity: 0.5; font-size: 13px;">Jeśli ta opcja jest odznaczona, nasz system zrobi to automatycznie</p>
                                        </div>
                                        <div id="server-versions-div" style="display: none;">
                                            <label for="server-versions" id="server-versions-label" style="top:0;">Wersję serwera</label>
                                            <select class="demo1" id="server-versions" multiple>
                                            </select>
                                        </div>
                                        <div id="server-gamemodes-div">
                                            <label for="server-gamemode" id="server-gamemode-label" style="top:0;">Tryb gry</label>
                                            <select class="demo2" id="server-gamemode" multiple>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="second-header" style="padding-left: 15px; margin-left: -17px;">Opis serwera</p>
                                        <!--<textarea name="edit-desc" id="edit-desc" rows="10" placeholder="Twój opis serwera..."
                                        style="background: transparent; color: white; width: 100%; padding: 10px"></textarea>-->
                                        <textarea id="editor"></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-green mx-auto d-block mt-5 mb-3" style="color: #dfd7cc;" onclick="OnEditModalAction(event)">Zapisz</button>
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
        <script src="autocomplete/tokenize2.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/password-requirements.js"></script>
        <script type="text/javascript" src="js/server-service.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script src="js/ckeditor.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;
            var gamemodes = [];
            var versions = [];
            $('#nav-konto').addClass('active');

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
            });
            var serverId = $('#server-id').text();

            function ModalEdit() {
                thisServer = data.content.find(x => x.server.id == serverId);
                
                $('#edit-servername').val(thisServer.server.name);
                $('#edit-ip').val(thisServer.serverHostCredentials.address);
                $('#edit-port').val(thisServer.serverHostCredentials.port);
                if(thisServer.server.onlineModeEnabled) $('#edit-onlinemode').prop('checked', true);
                $('#edit-website').val(thisServer.server.homepage);
                $('#edit-discord-server').val(thisServer.server.discord);
                $('#edit-discord-owner').val(thisServer.owner.discord);
                $('#edit-facebook-server').val(thisServer.server.facebook);
                //$('#edit-desc').val(thisServer.server.description);
                editor.setData(thisServer.server.htmlDescription);
                $('#edit').modal('toggle');

                $('.demo1').tokenize2({sortable: true});
                AddGameVersionsToInput(thisServer);
                $('.demo2').tokenize2({sortable: true});
                AddGameModesToInput(thisServer)
                
            }
            function OnEditModalAction(e) {
                e.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute('6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl', {action: 'submit'}).then(function(token) {
                        ModalEditAction(token)
                    });
                });
            }
            function ModalEditAction(token) {
                var servername = $('#edit-servername').val();
                var ip = $('#edit-ip').val();
                var port = $('#edit-port').val();
                var isOnlineMode = $('#edit-onlinemode').prop('checked');
                var homepage = $('#edit-website').val();
                var discordServer = $('#edit-discord-server').val();
                var facebookServer = $('#edit-facebook-server').val();
                var desc = $('#edit-desc').val();
                GetGameModesFromInput();
                var pingVersions = $('#addserver-ping-versions').prop('checked');
                if(pingVersions) GetVersionsFromInput();

                $.ajax({
                    type: 'PUT',
                    url: api_url+'/api/v1/servers/'+thisServer.server.id+'/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"hostCredentials": {"host": "'+ip+'","port": '+port+',"address": "'+ip+'"},"serverCredentials": {"name": "'+servername+'","description": "'+desc+'","homepage": "'+homepage+'","facebook": "'+facebookServer+'","discord": "'+discordServer+'","isOnlineModeEnabled": '+isOnlineMode+',"pingVersions": '+pingVersions+'},"gameModeCredentials": {"gameModeIds": '+ReturnStringArray(gamemodes)+'},"versionCredentials": {"versions": '+ReturnStringArray(versions)+'}, "gResponse": "'+token+'"}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        //console.log("Complete: "+xhr.responseJSON.message);
                    } 
                });
            }

            //Wersje gry 
            function AddGameVersionsToInput(thisServer) {
                if(thisServer.minecraftServerVersions.length == 0) return;
                var v = thisServer.minecraftServerVersions.map(x => x.minecraftVersion.version);
                console.log(v);
                v.forEach(x => $('#server-versions-div .tokens-container').prepend($('<li class="token" data-value="'+x+'"><a class="dismiss" onclick="DeleteElement(\''+x+'\')"></a><span>'+x+'</span></li>')));

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

            function AddGameModesToInput(thisServer) {
                $('#server-versions-div .tokens-container').children('.token').remove();
                if(thisServer.serverGameModes.length == 0) return;
                if($('#server-gamemodes-div .tokens-container').children().length > 1) return;
                var gm = thisServer.serverGameModes;
                gm.forEach(x => $('#server-gamemodes-div .tokens-container').prepend($('<li class="token" data-value="'+x.id+'"><a class="dismiss" onclick="DeleteElement(\''+x.id+'\')"></a><span>'+x.gameMode+'</span></li>')))
            }
            function GetGameModesFromInput() {
                var htmlArray = $('#server-gamemodes-div').children('.tokenize').children('.tokens-container').children('li.token');
                for(var i = 0; i<htmlArray.length; i++) {
                    gamemodes[i] = htmlArray[i].attributes[1].textContent;
                }
            }

            function DeleteElement(id) {
                $('li.token[data-value="'+id+'"]').remove();
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

            function ReturnStringArray(arr) {
                var str = '[';
                for(var i=0; i<arr.length;i++) {
                    str+='"'+arr[i]+'"';
                    if(i != arr.length-1) str+=','
                }
                str+=']'
                return str;
            }

            async function GetOwnerServers() {
                await $.ajax({
                    url: api_url+'/api/v1/servers/own/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res;
                    ModalEdit();
                })
            }
            
            GetOwnerServers();
            GetMinecraftAllGameModes();
            
        </script>
        
    </body>
</html>
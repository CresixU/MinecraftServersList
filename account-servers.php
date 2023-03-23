
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="autocomplete/tokenize2.css">
        <style>
            body {
                color: #dfd7cc;
            }
            .panel-header a {
                color: var(--href-color);
                text-decoration: none;
            }

            .ad-storage-item {
                border: 1px solid #201915;
                padding: 15px;
            }
            .ad-storage-item .col {
                justify-content: center;
                display: flex;
            }
            button {
                color: var(--href-color);
            }
            .panel-content-profile td {
                padding: 15px 10px;
            }
            #servers-list tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td {
                color: var(--href-color);
            }
            #servers-list tr:hover,
            #history-list tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td,
            thead td {
                color: var(--href-color);
            }
            #servers-list td i,
            #history-list td i {
                font-size: 20px;
            }
            #servers-list td a,
            #history-list td a {
                color: inherit;
            }
            #servers-list td a:hover,
            #history-list td a:hover{
                color: inherit;
            }
            .bi-trash3-fill {
                color: #ff4a61;
            }
            .bi-pencil-square {
                color: #fcf860;
            }
            .bi-card-text {
                color: #73d6fa;
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
            <div class="container">

                         <!-- MODAL DELETE -->
                                    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Usuwanie serwera</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć serwer <span id="modal_delete-server-name"></span>?</p>
                                                    <p id="modal_delete-server-id"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalDeleteAction()">Tak</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_delete').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edytowanie serwera</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_edit').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="modal_edit-server-id"></p>
                                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                                        <div>
                                                            <label for="modal_edit-servername" id="modal_edit-servername-label">Nazwa serwera</label>
                                                            <input type="text" id="modal_edit-servername">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-ip" id="modal_edit-ip-label">Adres IP lub domena serwera</label>
                                                            <input type="text" id="modal_edit-ip">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-port" id="modal_edit-port-label">Port</label>
                                                            <input type="text" id="modal_edit-port" value="25565">
                                                        </div>
                                                        <div class="mt-3">
                                                            <input type="checkbox" id="modal_edit-onlinemode">
                                                            <label for="modal_edit-onlinemode" class="checkbox-label">Online Mode</label>
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-website" id="modal_edit-website-label">Strona serwera</label>
                                                            <input type="text" id="modal_edit-website" placeholder="http://example.com">
                                                            <label for="modal_edit-website" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>http://</b> na początku.</label>
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-discord-server" id="modal_edit-discord-server-label">Link do Discorda serwera</label>
                                                            <input type="text" id="modal_edit-discord-server" placeholder="http://example.com">
                                                            <label for="modal_edit-discord-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-facebook-server" id="modal_edit-facebook-server-label">Link do strony serwera na Facebooku</label>
                                                            <input type="text" id="modal_edit-facebook-server" placeholder="http://example.com">
                                                            <label for="modal_edit-facebook-server" style="font-size:70%; color: #b9b9b9; position: relative; top: -5px">Adres URL musi zawierać <b>https://</b> na początku.</label>
                                                        </div>
                                                        <div>
                                                            <textarea name="modal_edit-desc" id="modal_edit-desc" rows="10" placeholder="Twój opis serwera..."
                                                            style="background: transparent; color: white; width: 100%; padding: 10px"></textarea>
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="OnEditModalAction(event)">Zapisz</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_edit').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                <div class="row">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="col">
                                    <a href="account.php">Profil</a>
                                </div>
                                <div class="col">
                                    <a href="account-servers.php">Serwery</a>
                                </div>
                                <div class="col">
                                    <a href="account-history.php">Historia konta</a>
                                </div>
                                <div class="col">
                                    <a href="account-ad.php">Reklama</a>
                                </div>
                            </div>
                            <div class="panel-content p-3 pt-5">
                                <div class="panel-content-servers row">
                                    <div class="col col-12">
                                        <div class="row second-header">
                                            <div class="col col-12">
                                                <p class="mb-0">Informacje o dodanych przez Ciebie serwerach</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <table style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <td>Rank</td>
                                                    <td>Nazwa</td>
                                                    <td>Adres serwera</td>
                                                    <td>Port</td>
                                                    <td>Online mode</td>
                                                    <td>Wersja</td>
                                                    <td>Punkty</td>
                                                    <td colspan="3">Akcje</td>
                                                </tr>
                                            </thead>
                                            <tbody id="servers-list">
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="mt-3" id="panel-content-servers-p"><a href="new-server.php">Dodaj nowy serwer</a></p> 
                                </div>
                                <div>
                                    <div>
                                        <label for="request-new-gamemode" style="color: #a9a48f">Nie widzisz swojego trybu gry podczas tworzenia/edytowania serwera? Zaproponuj nowy tryb gry, aby został dodany do listy</label>
                                        <input type="text" id="request-new-gamemode" placeholder="np. Survival" style="max-width: 300px">
                                        <button onclick="RequestNewGamemode()" class="simple-button pt-3">Wyślij zapytanie</button>
                                        <p id="request-new-gamemode-response"></p>
                                    </div>
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
                    if(xhr.status != "200") 
                        window.location.replace("auth.php");
                }
            }).done(res => {
                userData = res;
                if(userData.role == "ADMIN") {
                    $('.panel-header').append($('<div class="col"><a href="admin-servers.php">Panel Administratora</a></div>'))
                }
            })


            async function ShowOwnerServers() {
                await $.ajax({
                    url: api_url+'/api/v1/servers/own/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res;
                    if(data.content.length == 0) $('#panel-content-servers-p').prepend('Nie dodano jeszcze żadnego serwera na tym koncie. ')
                    var onlineMode = "Tak";
                    data.content.forEach(x => {
                        if(!x.server.onlineModeEnabled) onlineMode = "Nie";
                        $('#servers-list').append($('<tr><td>'+x.stats.placeInRanking+'</td><td>'+x.server.name+'</td><td>'+x.serverHostCredentials.address+'</td><td>'+x.serverHostCredentials.port+'</td><td>'+onlineMode+'</td><td class="version" title="'+(ReturnServerVersions(x.minecraftServerVersions).versionsString ?? '?')+'">'+(ReturnServerVersions(x.minecraftServerVersions).formatedVersions ?? '?')+'</td><td>'+x.server.points+'</td><td><button onclick="ModalDelete(\''+x.server.id+'\',\''+x.server.name+'\')"><i class="bi bi-trash3-fill"></i></button></td><td><button onclick="ModalEdit(\''+x.server.id+'\')"><i class="bi bi-pencil-square"></i></button></td><td><a href="server.php?id='+x.server.id+'"><i class="bi bi-card-image"></i></a></td></tr>'))
                    })
                    ;
                })
            }

            
            function ReturnStringDate(x) {
                return x.substr(8,2)+'.'+x.substr(5,2)+'.'+x.substr(0,4)+'  '+x.substr(11,5);
            }
            function ReturnServerValue(x) {
                if(!x) return "";
                return x.address;
            }
            function ReturnPaymentValue(x) {
                if(!x) return "";
                return x;
            }


            function ModalDelete(serverId,serverName) {
                $('#modal_delete-server-name').text(serverName);
                $('#modal_delete-server-id').text(serverId);
                $('#modal_delete').modal('toggle');
            }
            function ModalDeleteAction() {
                $('#modal_delete').modal('toggle');
                var id = $('#modal_delete-server-id').text();
                $.ajax({
                    url: api_url+'/api/v1/servers/'+id+'/',
                    xhrFields: {
                        withCredentials: true
                    },
                    type: 'DELETE',
                }).done(alert("Usunięto serwer "+id));
            }

            function ModalEdit(serverId) {
                thisServer = data.content.find(x => x.server.id == serverId);
                
                $('#modal_edit-servername').val(thisServer.server.name);
                $('#modal_edit-ip').val(thisServer.serverHostCredentials.address);
                $('#modal_edit-port').val(thisServer.serverHostCredentials.port);
                if(thisServer.server.onlineModeEnabled) $('#modal_edit-onlinemode').prop('checked', true);
                $('#modal_edit-website').val(thisServer.server.homepage);
                $('#modal_edit-discord-server').val(thisServer.server.discord);
                $('#modal_edit-discord-owner').val(thisServer.owner.discord);
                $('#modal_edit-facebook-server').val(thisServer.server.facebook);
                $('#modal_edit-desc').val(thisServer.server.description);
                $('#modal_edit').modal('toggle');

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
                var servername = $('#modal_edit-servername').val();
                var ip = $('#modal_edit-ip').val();
                var port = $('#modal_edit-port').val();
                var isOnlineMode = $('#modal_edit-onlinemode').prop('checked');
                var homepage = $('#modal_edit-website').val();
                var discordServer = $('#modal_edit-discord-server').val();
                var facebookServer = $('#modal_edit-facebook-server').val();
                var desc = $('#modal_edit-desc').val();
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

            function RequestNewGamemode() {
                var newGamemode = $('#request-new-gamemode').val();
                $('request-new-gamemode-response').text('');
                $.ajax({
                    url: api_url+'/api/v2/game-modes/',
                    type: 'POST',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"gameMode": "'+newGamemode+'", "autoAccept": '+false+'}',
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                        if(xhr.status == 200) $('#request-new-gamemode-response').text('Wysłano zapytanie');
                        else $('#request-new-gamemode-response').text(xhr.responseJSON.message);
                    } 
                }).done(res => {
                    $('#request-new-gamemode').val("");
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
            
            
            ShowOwnerServers();
            GetMinecraftAllGameModes();
            
        </script>
        
    </body>
</html>
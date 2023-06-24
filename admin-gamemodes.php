
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="description" content="Serwery Minecraft - Znajdź i promuj swoje serwery Minecraft. Minecraft-List.pl to platforma, na której możesz odkrywać różnorodne serwery Minecraft, znaleźć społeczność graczy i promować swój własny serwer. Przeglądaj setki serwerów, oceniaj je i wybieraj najlepsze miejsce do gry. Dodawaj swój serwer na naszej stronie i dotrzyj do szerokiego grona graczy. Zapraszamy do świata Minecraft na Minecraft-List.pl!">
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

            button {
                color: var(--href-color);
            }
            tbody tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td {
                color: var(--href-color);
            }
            td i {
                font-size: 20px;
            }
            td a {
                color: inherit;
            }
            td a:hover {
                color: inherit;
            }
            .bi-trash3-fill {
                color: #ff4a61;
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
            #pagination-list li {
                cursor: pointer;
            }
            .form-control {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                border: none;
                border-left: 2px solid var(--main-color);
                border-right: 2px solid var(--main-color);
                border-radius: 10px;
            }
            tbody tr td:nth-child(2) button {
                padding: 0px 10px;
            }
            #waiting-gamemodes tbody td:nth-child(3) {
                width: 42px;
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
                <div class="row mb-5">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header d-flex justify-content-around">
                                <a href="admin-servers.php" class="simple-button align-center">Lista serwerów</a>
                                <a href="admin-users.php" class="simple-button">Lista userów</a>
                                <a href="admin-blocked-services.php" class="simple-button">Zablokowane serwisy</a>
                                <a href="admin-codes.php" class="simple-button">Generator kodów</a>
                                <a href="admin-gamemodes.php" class="simple-button">Tryby gry</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col col-6 px-5 d-flex justify-content-center" style="min-width: 300px">
                                        <div class="w-100">
                                            <p>
                                                Liczba oczekujących zapytań: <span id="waiting-gamemodes-count">0</span>
                                            </p>
                                            <table id="waiting-gamemodes" class="w-100 mt-3">
                                                <thead>
                                                    <tr>
                                                        <td>Propozycja od </td>
                                                        <td>Tryb gry</td>
                                                        <td style="max-width: 85px;"colspan="2">Akcje</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="waiting-gamemodes-list">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col col-6 px-5 d-flex justify-content-center" style="min-width: 300px">
                                        <div class="w-100">
                                            <table id="gamemodes" class=" mt-3">
                                                <p>
                                                    Aktualne tryby gry w puli: <span id="gamemodes-count">0</span>
                                                </p>
                                                <thead>
                                                    <tr>
                                                        <td>Tryb gry</td>
                                                        <td>Akcje</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="gamemodes-list">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><input id="input-gamemodes" type="text" placeholder="Survival"></td>
                                                        <td><button onclick="AddGameMode()">Dodaj</button></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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
        <?php include_once("components/copyright.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            $('#nav-konto').addClass('active');
            //Authentication
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
                if(userData.role != "ADMIN")
                    window.location.replace("account.php");
            });

            async function ShowWaitingGamemodes() {
                $('#waiting-gamemodes-list').empty();
                await $.ajax({
                    url: api_url+'/api/v2/game-modes/add-requests/?status=WAITING',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res.content;
                    $('#waiting-gamemodes-count').text(data.length);
                    if(data.length == 0) return;
                    data.forEach(x => $('#waiting-gamemodes-list').append($('<tr><td>'+x.addedByUser.login+'</td><td>'+x.gameMode.gameMode+'</td><td><button onclick="GameModeChangeStatus(1,\''+x.gameMode.id+'\')"><i class="icon icon-verified"></i></button></td><td><button onclick="GameModeChangeStatus(0,\''+x.gameMode.id+'\')"><i class="icon icon-no-verified"></i></button></td></tr>')))
                })
            };

            async function ShowGamemodes() {
                $('#gamemodes-list').empty();
                await $.ajax({
                    url: api_url+'/api/v2/game-modes/?status=ACCEPTED',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data2 = res.content;
                    $('#gamemodes-count').text(data2.length);
                    if(data2.length == 0) return;
                    data2.forEach(x => $('#gamemodes-list').append($('<tr><td>'+x.gameMode+'</td><td><button onclick=\'GameModeChangeStatus(0,"'+x.id+'")\'><i class="bi bi-trash3-fill""></i></button></td></tr>')));
                })
            }

            //status: 0 = reject, 1 = accept
            function GameModeChangeStatus(status,id) {
                var gameStatus;
                if(status == 0) gameStatus = 'REJECTED';
                else if(status == 1) gameStatus = 'ACCEPTED';
                else {
                    alert("Błąd techniczny");
                    return;
                }

                $.ajax({
                    type: 'PATCH',
                    url: api_url+'/api/v2/game-modes/'+id+'/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"gameModeStatus": "'+gameStatus+'"}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        if(xhr.responseJSON.message != undefined)
                            alert(xhr.responseJSON.message);
                    } 
                }).done(res => {
                    ShowGamemodes();
                    ShowWaitingGamemodes();
                });
            }

            function AddGameMode() {
                var gamemodeInput = $('#input-gamemodes').val();
                $.ajax({
                    url: api_url+'/api/v2/game-modes/',
                    type: 'POST',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"gameMode": "'+gamemodeInput+'", "autoAccept": '+true+'}',
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                        if(xhr.responseJSON.message != undefined)
                            alert(xhr.responseJSON.message);
                    } 
                }).done(res => {
                    ShowGamemodes();
                    ShowWaitingGamemodes();
                    $('#input-gamemodes').val("");
                });
            }

            ShowGamemodes();
            ShowWaitingGamemodes();

        </script>
    </body>
</html>
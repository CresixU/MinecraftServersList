
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
        </style>
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <?php require_once("components/top.php"); ?>
        <main>
            <div class="container">
                                    <!--MODAL IP DELETE -->
                                    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Usuwanie IP z listy</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć ip <span id="modal_delete-ip"></span>?</p>
                                                    <p id="modal_delete-id"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalDeleteIpAction()">Tak</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_delete').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL DOMAIN DELETE -->
                                    <div class="modal fade" id="modal_delete2" tabindex="-1" role="dialog" aria-labelledby="modal_delete2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Usuwanie Domeny z listy</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete2').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć domene <span id="modal_delete-domain"></span>?</p>
                                                    <p id="modal_delete-domain"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalDeleteDomainAction()">Tak</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_delete2').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


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
                                            Liczba zablokowanych ip: <span id="blocked-ip-count">0</span>
                                        </p>
                                        <table id="blocked-ips" class=" mt-3">
                                            <thead>
                                                <tr>
                                                    <td>Zablokowany adres</td>
                                                    <td>Akcje</td>
                                                </tr>
                                            </thead>
                                            <tbody id="blocked-list-ip">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><input id="input-ip" type="text" placeholder="1.1.1.1"></td>
                                                    <td><button onclick="AddBlockedIp()">Dodaj</button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col col-6 px-5 d-flex justify-content-center" style="min-width: 300px">
                                    <div class="w-100">
                                        <table id="blocked-domains" class=" mt-3">
                                            <p>
                                                Liczba zablokowanych domen: <span id="blocked-domains-count">0</span>
                                            </p>
                                            <thead>
                                                <tr>
                                                    <td>Zablokowany domeny</td>
                                                    <td>Akcje</td>
                                                </tr>
                                            </thead>
                                            <tbody id="blocked-list-domain">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><input id="input-domains" type="text" placeholder="example.com"></td>
                                                    <td><button onclick="AddBlockedDomain()">Dodaj</button></td>
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
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var data2;
            var userData;
            var clickedIp;
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

            async function ShowBlockedIp() {
                $('#blocked-list-ip').empty();
                await $.ajax({
                    url: api_url+'/api/v1/blocked-ip/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data2 = res;
                    $('#blocked-ip-count').text(data.length);
                    data.forEach(x => $('#blocked-list-ip').append($('<tr><td>'+x.ip+'</td><td><button onclick="ModalDeleteIp(\''+x.id+'\')"><i class="bi bi-trash3-fill"></i></button></td></tr>')))
                })
            };

            async function ShowBlockedDomain() {
                $('#blocked-list-domain').empty();
                await $.ajax({
                    url: api_url+'/api/v1/emails/blocked/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res;
                    $('#blocked-domains-count').text(data.length);
                    data.forEach(x => $('#blocked-list-domain').append($('<tr><td>'+x.value+'</td><td><button onclick="ModalDeleteDomain(\''+x.id+'\')"><i class="bi bi-trash3-fill"></i></button></td></tr>')))
                })
            };

            function ModalDeleteIp(id) {
                clickedIp = data2.find(x => x.id == id);
                $('#modal_delete-ip').text(clickedIp.ip);
                $('#modal_delete-id').text(clickedIp.id);
                $('#modal_delete').modal('toggle');
            };
            function ModalDeleteDomain(id) {
                clickedIp = data.find(x => x.id == id);
                $('#modal_delete-ip2').text(clickedIp.value);
                $('#modal_delete-id2').text(clickedIp.id);
                $('#modal_delete2').modal('toggle');
            };

            function ModalDeleteIpAction(){
                $('#modal_delete').modal('toggle');
                $.ajax({
                    url: api_url+'/api/v1/blocked-ip/'+clickedIp.id+'/',
                    xhrFields: {
                        withCredentials: true
                    },
                    type: 'DELETE',
                }).done(res => {
                    ShowBlockedIp();
                    alert("Usunięto ip "+clickedIp.ip);
                });
            };
            function ModalDeleteDomainAction(){
                $('#modal_delete2').modal('toggle');
                $.ajax({
                    url: api_url+'/api/v1/emails/blocked/'+clickedIp.id+'/',
                    xhrFields: {
                        withCredentials: true
                    },
                    type: 'DELETE',
                }).done(res => {
                    ShowBlockedDomain();
                    alert("Usunięto domene "+clickedIp.value);
                });
            };


            function AddBlockedIp() {
                var ip = $('#input-ip').val();
                $.ajax({
                    url: api_url+'/api/v1/blocked-ip/',
                    type: 'POST',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"ip": "'+ip+'"}',
                    complete: function(xhr, textStatus) {
                        if(xhr.status != 200) alert("Tego ip nie można zablokować");
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                    } 
                }).done(res => {
                    ShowBlockedIp();
                    $('#input-ip').val("");
                });
            }
            function AddBlockedDomain() {
                var ip = $('#input-domains').val();
                $.ajax({
                    url: api_url+'/api/v1/emails/blocked/',
                    type: 'POST',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"value": "'+ip+'"}',
                    complete: function(xhr, textStatus) {
                        if(xhr.status != 200) alert("Tej domeny nie można zablokować");
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                    } 
                }).done(res => {
                    ShowBlockedDomain();
                    $('#input-domains').val("");
                });
            }

            ShowBlockedIp();
            ShowBlockedDomain()

        </script>
    </body>
</html>
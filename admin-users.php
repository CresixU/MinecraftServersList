
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
            .bi-pencil-square {
                color: #fcf860;
            }
            .bi-card-text {
                color: #73d6fa;
            }

            .modal-content {
                background: linear-gradient(to bottom, #110b08, #0e0906 70%);
                color: #dfd7cc;
            }
            .modal-header {
                border-bottom: none;
            }
            .modal-footer {
                border-top: none;
            }
            .modal-title + button {
                font-size: 200%;
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
                                                    <h5 class="modal-title">Usuwanie usera</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć usera o nazwie <span id="modal_delete-user-name"></span>?</p>
                                                    <p id="modal_delete-user-id"></p>
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
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edytowanie usera</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_edit').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="modal_edit-user-id"></p>
                                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                                        <div>
                                                            <label for="modal_edit-email" id="modal_edit-email-label">Email</label>
                                                            <input type="text" id="modal_edit-email">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-login" id="modal_edit-login-label">Login</label>
                                                            <input type="text" id="modal_edit-login">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-discord" id="modal_edit-discord-label">Discord</label>
                                                            <input type="text" id="modal_edit-discord" value="25565">
                                                        </div>
                                                        <div class="mt-3">
                                                            <input type="checkbox" id="modal_edit-advertisment">
                                                            <label for="modal_edit-advertisment" class="checkbox-label">Zgoda na treści reklamowe</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalEditAction()">Zapisz</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_edit').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

            <!-- MODAL HISTORY -->
                                    <div class="modal fade" id="modal_history" tabindex="-1" role="dialog" aria-labelledby="modal_history" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Historia zmian użytwkonika <span id="user-name"></span></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_history').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="modal_history-server-id"></p>
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <td>Data</td>
                                                                <td>Typ operacji</td>
                                                                <td>IP</td>
                                                                <td>Nowe IP</td>
                                                                <td>Płatność</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="history-list-users">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_history').modal('toggle');">Wyjdź</button>
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
                            Liczba użytkowników: <span id="users-count">0</span>
                        </div>
                        <div class="panel-content px-5">
                            <div class="row">
                                <div class="col col-12">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Login</td>
                                                <td>E-mail</td>
                                                <td>MotD</td>
                                                <td>Rola</td>
                                                <td colspan="4">Akcje</td>
                                            </tr>
                                        </thead>
                                        <tbody id="users-list">

                                        </tbody>
                                    </table>
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
            var historyData;
            var clickedUser;
            $('#nav-konto').addClass('active');
            
            //Authentication
            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                complete: function(xhr, textStatus) {
                    if(xhr.status != "200") 
                        window.location.replace("auth.php");
                } 
            }).done(res => {
                userData = res;
                if(userData.role != "ADMIN")
                    window.location.replace("account.php");
            });

            $.ajax({
                url: api_url+'/api/v1/users/',
            }).done(res => {
                data = res;
                $('#users-count').text(data.total);
                data.content.forEach(x => $('#users-list').append($('<tr><td>'+x.id+'</td><td>'+x.login+'</td><td>'+x.email+'</td><td>'+x.motD+'</td><td>'+x.role+'</td><td><button onclick="ModalDelete(\''+x.id+'\')"><i class="bi bi-trash3-fill"></i></button></td><td><button onclick="ModalEdit(\''+x.id+'\')"><i class="bi bi-pencil-square"></i></button</td><td><button onclick="ModalHistory(\''+x.id+'\')"><i class="bi bi-card-text"></i></button></td><td><a href="server.php?id='+x.id+'"><i class="bi bi-card-image"></i></a></td></tr>')))

            });

            function ModalDelete(userId) {
                clickedUser = data.content.find(x => x.id == userId);
                $('#modal_delete-user-name').text(clickedUser.login);
                $('#modal_delete').modal('toggle');
            }
            function ModalDeleteAction() {
                //Zabezpieczenie na testy
                if(clickedUser.login == 'test_user') return;

                $('#modal_delete').modal('toggle');
                var id = $('#modal_delete-user-id').text();
                $.ajax({
                    url: api_url+'/api/v1/users/'+id+'/',
                    type: 'DELETE',
                }).done(alert("Usunięto użytkownika "+id));
            }

            function ModalEdit(userId) {
                clickedUser = data.content.find(x => x.id == userId);
                $('#modal_edit-email').val(clickedUser.email);
                $('#modal_edit-login').val(clickedUser.login);
                $('#modal_edit-discord').val(clickedUser.discord);
                if(clickedUser.acceptsAdvertisements) $('#modal_edit-advertisment').prop('checked', true);
                $('#modal_edit').modal('toggle');
                
            }
            function ModalEditAction() {
                var userEmail = $('#modal_edit-email').val();
                var userLogin = $('#modal_edit-login').val();
                var userDiscord = $('#modal_edit-discord').val();
                var userAds = $('#modal_edit-advertisment').prop('checked');
                $('#modal_edit').modal('toggle');

                $.ajax({
                    type: 'PATCH',
                    url: api_url+'/api/v1/users/'+clickedUser.id+'/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"email": {"value": "'+userEmail+'"},"login": "'+userLogin+'","discord": "'+userDiscord+'","acceptsAdvertisements": '+userAds+'}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                    } 
                });
                
            }

            function ModalHistory(userId) {
                //Show modal change ip history
                $('#modal_history').modal('toggle');
                $.ajax({
                    url: api_url+'/api/v1/history/'+userId+'/?page=0&size=10',
                }).done(res => {
                    historyData = res;
                    if(historyData.content.length == 0) return;
                    $('#user-name').text(historyData.content[0].user.login);
                    historyData.content.forEach(x => {
                        var t = x.at.substr(8,2)+'.'+x.at.substr(5,2)+'.'+x.at.substr(0,4)+'  '+x.at.substr(11,5);
                        $('#history-list-users').append($('<tr><td>'+t+'</td><td>'+x.type+'</td><td>'+ReturnServerValue(x.oldHostCredentials)+'</td><td>'+ReturnServerValue(x.newHostCredentials)+'</td><td>'+ReturnPaymentValue(x.payment)+'</td></tr>'));

                    })
                })
            }
            function ReturnServerValue(x) {
                if(!x) return "";
                return x;
            }
            function ReturnPaymentValue(x) {
                if(!x) return "";
                return x;
            }

        </script>
    </body>
</html>
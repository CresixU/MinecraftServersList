
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
            label {
                -webkit-user-select: none; /* Safari */
                -ms-user-select: none; /* IE 10 and IE 11 */
                user-select: none; /* Standard syntax */
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

                    <!-- MODAL PASSWORD EDIT -->
                        <div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="modal_password" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Zmiana hasła</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_password').modal('toggle');">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="modal_password-user-id"></p>
                                        <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                            <div>
                                                <label for="modal_password-1">Nowe hasło</label>
                                                <input type="password" id="modal_password-1">
                                            </div>
                                            <div>
                                                <label for="modal_password-2">Potwierdź nowe hasło</label>
                                                <input type="password" id="modal_password-2">
                                            </div>
                                            <p class="mt-2" id="password-messager"></p>
                                            <p style="color: red" id="modal_password-info"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="ChangePasswordAction()">Zapisz</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_password').modal('toggle');">Anuluj</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL EDIT -->
                                    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edytowanie profilu</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_edit').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="modal_edit-user-id"></p>
                                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                                        <div>
                                                            <label for="modal_edit-username">Nazwa użytkownika</label>
                                                            <input type="text" id="modal_edit-username">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-email">Email</label>
                                                            <input type="text" id="modal_edit-email">
                                                        </div>
                                                        <div>
                                                            <label for="modal_edit-discord">Discord</label>
                                                            <input type="text" id="modal_edit-discord" placeholder="User#1234">
                                                        </div>
                                                        <div class="mt-3">
                                                            <input type="checkbox" id="modal_edit-ad">
                                                            <label for="modal_edit-ad" class="checkbox-label">Wyrażam zgodę na dostarczanie przez serwis minecraftlist treści reklamowych na adres e-mail podany przeze mnie podczas rejestracji</label>
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

                <?php
                if(!isset($_GET['subpage'])) $_GET['subpage'] = 'profile'; 
                echo "<span id='selected-subpage' style='display: none;'>" . $_GET['subpage']."</span>";?>
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
                                <div class="panel-content-profile row">
                                    <div class="col col-12">
                                        <div class="second-header">
                                            <p class="mb-0" style="padding-left: 20px;">Informacje o twoim koncie</p> 
                                        </div>
                                    </div>
                                    <div class="col col-12">
                                        <table>
                                            <tr>
                                                <td>Nazwa użytkownika</td>
                                                <td id="user-name"></td>
                                            </tr>
                                            <tr>
                                                <td>Hasło</td>
                                                <td><button class="simple-button" onclick="ChangePassword()">Zmień hasło</a></td>
                                            </tr>
                                            <tr>
                                                <td>Adres e-mail</td>
                                                <td id="user-email"></td>
                                            </tr>
                                            <tr>
                                                <td>Discord</td>
                                                <td id="user-discord"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="account-ad-mails">
                                                        <input type="checkbox" id="account-ad-mails" style="float:left; margin-top: 5px;" disabled>
                                                        <p style="float:left; padding-left: 10px;">Wyrażam zgodę na dostarczanie przez serwis minecraftlist treści reklamowych na adres e-mail podany przeze mnie podczas rejestracji</p>
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>
                                        <button class="btn-green" onclick="ModalEdit()">Zaaktualizuj dane</button>
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
        <script type="text/javascript" src="js/password-requirements.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;

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
                $('#user-name').text(userData.login);
                $('#user-email').text(userData.email);
                $('#user-discord').text(userData.discord);
                $('#account-ad-mails').prop('checked', userData.acceptsAdvertisements);
                if(userData.role == "ADMIN") {
                    $('.panel-header').append($('<div class="col"><a href="admin-servers.php">Panel Administratora</a></div>'))
                }
            })

            function ReturnStringDate(x) {
                return x.substr(8,2)+'.'+x.substr(5,2)+'.'+x.substr(0,4)+'  '+x.substr(11,5);
            }
            function ReturnServerValue(x) {
                if(!x) return "";
                return x;
            }
            function ReturnPaymentValue(x) {
                if(!x) return "";
                return x;
            }

            function ChangePassword() {
                $('#modal_password').modal('toggle');
                ShowPasswordRequirements('modal_password-1','password-messager')
                $('#modal_password-1').on('input',function() {
                    PasswordMessager();
                    if($('#modal_password-1').val() != $('#modal_password-2').val()) $('#modal_password-info').text("Hasła się różnią");
                    else $('#modal_password-info').text("");
                })
                $('#modal_password-2').on('input',function() {
                    if($('#modal_password-1').val() != $('#modal_password-2').val()) $('#modal_password-info').text("Hasła się różnią");
                    else $('#modal_password-info').text("");
                })
            }

            function ChangePasswordAction() {
                var pass1 = $('#modal_password-1').val();
                var pass2 = $('#modal_password-2').val();
                if(pass1 != pass2) return;

                $.ajax({
                    url: api_url+'/api/v1/users/change-password/',
                    type: 'PATCH',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"password": "'+pass1+'", "passwordConfirm": "'+pass2+'"}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                    } 
                }).done(res => {
                    $('#modal_password').modal('toggle');
                    alert("Hasło zostało zmienione");
                })
            }

            function ModalEdit() {
                $('#modal_edit').modal('toggle');
                $('#modal_edit-username').val(userData.login);
                $('#modal_edit-email').val(userData.email);
                $('#modal_edit-discord').val(userData.discord);
                $('#modal_edit-ad').prop('checked', userData.acceptsAdvertisements);
            }

            function ModalEditAction() {
                var uLogin = $('#modal_edit-username').val();
                var uEmail = $('#modal_edit-email').val();
                var uDiscord = $('#modal_edit-discord').val();
                var uAds = $('#modal_edit-ad').prop('checked');

                $.ajax({
                    url: api_url+'/api/v1/users/',
                    type: 'PATCH',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    xhrFields: {
                        withCredentials: true
                    },
                    data: '{"email": {"value": "'+uEmail+'"},"login": "'+uLogin+'","discord": "'+uDiscord+'","acceptsAdvertisements": '+uAds+'}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                    } 
                }).done(res => {
                    $('#modal_edit').modal('toggle');
                    alert("Dane zaaktualizowano");

                })
            }
            
        </script>
        
    </body>
</html>

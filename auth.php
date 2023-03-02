<!DOCTYPE html>
<html>
<head>
    <title>MinecraftList</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
        * {
            color: #dfd7cc;
        }
        body {
            min-height: 100vh;
        }
        .account-authentication a:hover {
            color:var(--main-color) !important;
        }
        main .container {
            color: #dfd7cc;
        }
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 8px 12px;
            color: #dfd7cc;
            border: none;
            border-bottom: 2px solid var(--main-color);
            border-radius: 8px;
        }
        label:not(label:last-child) {
            margin-top: 10px;
            width: 100%;
            color: var(--href-color);
            position: relative;
            top: 10px;
        }
        .account-authentication > div > div > a {
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .account-authentication > div:not(div:first-child){
            margin: 0px auto;
            max-width: 600px;
            background: linear-gradient(to bottom, rgba(17, 11, 8), rgba(14, 9, 6,0.5) 70%);
            border-radius: 20px;
            padding: 30px;
        }
        input[type=submit], input[type=button] {
            margin: 30px auto;
            display: block;
            font-weight: bold;
        }
        input[type=checkbox] {
            background-color: var(--main-color);
            padding: 5px;
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

    </style>

</head>
<body>
    <?php $api = require("config.php"); ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
    <?php require_once("components/top.php"); ?>
    <main>
        <div class="container p-5">

                    <!-- Reset password modal -->
                    <div class="modal fade" id="modal_password-reset" tabindex="-1" role="dialog" aria-labelledby="modal_password-reset" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Resetowanie hasła</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_password-reset').modal('toggle');">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="modal_password-reset-input">Podaj mail do zresetowania hasła</label>
                                    <input type="text" id="modal_password-reset-input" placeholder="example@mail.com">
                                    <div id="modal_reset-response"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="ModalResetPasswordAction()">Wyślij</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_password-reset').modal('toggle');">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resend mail activation modal -->
                    <div class="modal fade" id="modal_activation" tabindex="-1" role="dialog" aria-labelledby="modal_activation" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Wyślij ponownie mail aktywacyjny</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_activation').modal('toggle');">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="modal_activation-input">Podaj mail</label>
                                    <input type="text" id="modal_activation-input" placeholder="example@mail.com">
                                    <div id="modal_activation-response"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="ModalActivationAction()">Wyślij</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_activation').modal('toggle');">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="account-authentication row">
                <div class="col col-12" style="justify-content: center; display: flex;">
                    <div><a onclick="ShowLogin()">Zaloguj się</a></div>
                    <div style="border-left: 2px solid rgba(44, 148, 33,0.5); margin: 0px 10px;"></div>
                    <div><a onclick="ShowRegister()">Zarejestruj się</a></div>
                </div>
                <div class="account-login col-12 col-md-12" style="display: none;">
                    <form >
                        <div>
                            <label for="account-login-name" id="account-login-name-label">Nazwa użytkownika</label>
                            <input type="text" id="account-login-name">
                        </div>
                        <div>
                            <label for="account-login-password">Hasło</label>
                            <input type="password" id="account-login-password">
                        </div>
                        <div id="login-response"></div>

                        <input type="button" class="btn-green" onclick="OnLogin(event)" value="Zaloguj">
                    </form>
                    <button class="simple-button" onclick="$('#modal_password-reset').modal('toggle');">Nie pamiętam hasła</button><br>
                    
                </div>
                <div class="account-register col-12 col-md-12">
                    <form >
                        <div>
                            <label for="account-register-name">Nazwa użytkownika</label>
                            <input type="text" id="account-register-name">
                        </div>
                        <div>
                            <label for="account-register-password">Hasło</label>
                            <input type="password" id="account-register-password">
                        </div>
                        <div>
                            <label for="account-register-password2">Powtórz hasło</label>
                            <input type="password" id="account-register-password2">
                        </div>
                        <div>
                            <label for="account-register-discord">Discord</label>
                            <input type="text" id="account-register-discord" placeholder="user#1234">
                        </div>
                        <div>
                            <label for="account-register-email">Email</label>
                            <input type="text" id="account-register-email" placeholder="example@ex.com">
                        </div>
                        <div>
                            <label for="account-register-email2">Powtórz email</label>
                            <input type="text" id="account-register-email2" placeholder="example@ex.com">
                        </div>
                        <div class="mt-4">
                            <input type="checkbox" id="account-register-rules">
                            <label for="account-register-rules">Akceptuje regulamin</label>
                        </div>
                        <div class="mt-4">
                            <input type="checkbox" id="account-register-ads" checked>
                            <label for="account-register-ads">Zgadzam się na otrzymywanie treści reklamowych przez portal minecraftlist na podany adres mailowy</label>
                        </div>
                        <div id="account-info-box" style="color: red; margin-top:20px;"></div>
                        <div id="account-info-box2" style="color: red; margin-top:20px;"></div>
                        <div id="register-response"></div>
                        <input type="button" onclick="OnRegister(event)" class="btn-green" value="Zarejestruj się">
                    </form>
                    <button class="simple-button" onclick="$('#modal_activation').modal('toggle');">Wyślij ponownie klucz weryfikacyjny</button>
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
    <script src="https://www.google.com/recaptcha/api.js?render=6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl"></script>
    <script>
        var api_url = "<?php echo $api ?>";
        var data;
        $('#nav-konto').addClass('active');

        ShowPasswordRequirements('account-register-password','account-info-box');
        $('#account-register-password').on('input', function() {
            PasswordMessager()
        })

        function isRequirementsChecked() {
            if(minLength && upperCase && number && specialChar) return true;

            return false;
        }

        function ShowLogin() {
            $('.account-login').css('display' ,'block');
            $('.account-register').css('display', 'none');
        }
        function ShowRegister() {
            $('.account-login').css('display' ,'none');
            $('.account-register').css('display', 'block');
        }

        function OnRegister(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl', {action: 'submit'}).then(function(token) {
                    Register(token);
                });
            });
        }
        function Register(token) {
            var username = $('#account-register-name').val();
            var password = $('#account-register-password').val();
            var password2 = $('#account-register-password2').val();
            var discord = $('#account-register-discord').val();
            var email = $('#account-register-email').val();
            var email2 = $('#account-register-email2').val();
            var adsCheckbox = true;
            
            if(!($('#account-register-rules').prop('checked'))) {
                console.log($('#account-register-rules').prop('checked'));
                $('#account-info-box2').text("Akceptacja regulaminu jest wymagana");
                return;
            }
            if(!($('#account-register-ads').prop('checked'))) {
                console.log($('#account-register-ads').prop('checked'));
                adsCheckbox = false;
            }
            if(password != password2 || password == '') {
                $('#account-info-box2').text("Hasła są różne");
                return;
            }
            if(email != email2 || email == "") {
                $('#account-info-box2').text("Adresy email są różne");
                return;
            }
            if(!isRequirementsChecked()) {
                $('#account-info-box2').text("Wymagania hasła nie zostały spełnione");
                return;
            }
            $('#account-info-box2').text(" ");

            $.ajax({
                    type: 'POST',
                    url: api_url+'/api/v1/users/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"login": "'+username+'","password": "'+password+'","passwordConfirm": "'+password2+'","discord": "'+discord+'","email": {"value": "'+email+'"},"emailConfirm": {"value": "'+email2+'"},"acceptsRules": true,"acceptsAdvertisements": '+adsCheckbox+', "gResponse": "'+token+'"}',
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        if(xhr.status != 200) $('#register-response').html($('<p class="mt-3" style="color: red">'+xhr.responseJSON.message+'</p>'));
                    } 
                });


        }
        function OnLogin(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6Ldj08kkAAAAAOAR7XBwQsbBnsFMfQFGAwE5qusl', {action: 'submit'}).then(function(token) {
                    Login(token);
                });
            });
        }
        function Login(token) {
            var username = $('#account-login-name').val();
            var password = $('#account-login-password').val();
            $.ajax({
                type: 'POST',
                url: api_url+'/api/v1/auth/login/',
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
                contentType: "application/json; charset=utf-8",
                data: '{"login": "'+username+'", "password": "'+password+'", "gResponse": "'+token+'"}',
                complete: function(xhr, textStatus) {
                    console.log("Complete: "+xhr.status + " " +textStatus);
                    if(xhr.status == 200) window.location.replace("index.php");
                    else $('#login-response').html($('<p class="mt-3" style="color: red">'+xhr.responseJSON.message+'</p>'));
                } 
            });
        }

        function ModalResetPasswordAction() {
            var resetEmail = $('#modal_password-reset-input').val();
            if(resetEmail == '') {
                alert("Nie podano maila");
                return;
            }

            $.ajax({
                type: 'POST',
                url: api_url+'/api/v1/users/password-reset/',
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                xhrFields: {
                        withCredentials: true
                    },
                data: '{"email": {"value": "'+resetEmail+'"}}',
                complete: function(xhr, textStatus) {
                    console.log(xhr)
                    console.log("Complete: "+xhr.status + " " +textStatus);
                    if(xhr.status == 200) $('#modal_reset-response').html($('<p class="mt-3" style="color: green">Link resetujący hasło został wysłany na podany adres mailowy</p>'));
                    else $('#modal_reset-response').html($('<p class="mt-3" style="color: red">'+xhr.responseJSON.message+'</p>'));
                } 
            });
        }
        function ModalActivationAction() {
            var activationEmail = $('#modal_activation-input').val();
            if(activationEmail == '') {
                alert("Nie podano maila");
                return;
            }

            $.ajax({
                type: 'POST',
                url: api_url+'/api/v1/auth/resend-activation/',
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                xhrFields: {
                        withCredentials: true
                    },
                data: '{"email": "'+activationEmail+'"}',
                complete: function(xhr, textStatus) {
                    console.log(xhr)
                    console.log("Complete: "+xhr.status + " " +textStatus);
                    if(xhr.status == 200) $('#modal_activation-response').html($('<p class="mt-3" style="color: green">Link aktywacyjny został ponownie wysłany na podany adres mailowy</p>'));
                    else $('#modal_activation-response').html($('<p class="mt-3" style="color: red">'+xhr.responseJSON.message+'</p>'));
                } 
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>
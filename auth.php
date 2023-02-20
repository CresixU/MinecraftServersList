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
    </style>

</head>
<body>
    <?php $api = require("config.php"); ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
    <?php require_once("components/top.php"); ?>
    <main>
        <div class="container p-5">
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
                        

                        <input type="button" class="btn-green" onclick="Login()" value="Zaloguj">
                    </form>
                    <a href="">Nie pamiętam hasła</a>
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

                        <input type="button" onclick="Register()" class="btn-green" value="Zarejestruj się">
                    </form>
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


        function Register() {
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
                    data: '{"login": "'+username+'","password": "'+password+'","passwordConfirm": "'+password2+'","discord": "'+discord+'","email": {"value": "'+email+'"},"emailConfirm": {"value": "'+email2+'"},"acceptsRules": true,"acceptsAdvertisements": '+adsCheckbox+'}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                    } 
                });


        }

        function Login() {
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
                data: '{"login": "'+username+'", "password": "'+password+'"}',
                success: function(data, textStatus, xhr) {
                    console.log("Success: "+xhr.status + " " +textStatus);
                },
                complete: function(xhr, textStatus) {
                    console.log("Complete: "+xhr.status + " " +textStatus);
                    console.log("Complete: "+xhr.responseJSON.message);
                } 
            })
            .done(res => {
                $.ajax({
                    type: 'GET',
                    url: api_url+'/api/v1/auth/logged/',
                })
                .done(res => {
                    data = res;
                })
            });
            
        }
    </script>
</body>
</html>
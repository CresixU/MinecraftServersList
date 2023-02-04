<!DOCTYPE html>
<html>
<head>
    <title>MinecraftList</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
        * {
            color: white;
        }
        body {
            min-height: 100vh;
        }
        .account-authentication a:hover {
            color:rgb(44, 148, 33) !important;
        }
        main .container {
            color: white;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 8px 12px;
            color: #fceec7;
        }
        label:not(label:last-child) {
            margin-top: 10px;
            width: 100%;
            color: #fceec7;
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
        input[type=text],
        input[type=password]{
            border: none;
            border-bottom: 2px solid rgb(44, 148, 33);
        }
        input[type=submit], input[type=button] {
            margin: 30px auto;
            display: block;
            font-weight: bold;
        }
        input[type=checkbox] {
            background-color: rgb(44, 148, 33);
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
                    <form action="">
                        <div>
                            <label for="account-login-name" id="account-login-name-label">Nazwa użytkownika</label>
                            <input type="text" id="account-login-name">
                        </div>
                        <div>
                            <label for="account-login-password">Hasło</label>
                            <input type="password" id="account-login-password">
                        </div>
                        

                        <input type="button" class="btn-green" onclick="Login()" value="Zaloguj">
                        <?php echo $_COOKIE['token'] ?>
                    </form>
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
                            <label for="account-register-email">Email</label>
                            <input type="text" id="account-register-email">
                        </div>
                        <div>
                            <label for="account-register-email2">Powtórz email</label>
                            <input type="text" id="account-register-email2">
                        </div>
                        <div class="mt-4">
                            <input type="checkbox" id="account-register-rules">
                            <label for="account-register-rules">Akceptuje regulamin</label>
                        </div>
                        <div id="account-info-box" style="color: red;"></div>

                        <input type="submit" onclick="Register()" class="btn-green" value="Zarejestruj się">
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
    <script>
        var requirements;
        var api_url = "<?php echo $api ?>";
        $.ajax({
            url: api_url+'/api/v1/users/password-requirements/',
        })
        .done(res => {
            requirements = res;
        });


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
            var email = $('#account-register-email').val();
            var email2 = $('#account-register-email2').val();

            if(password != password2) {
                $('#account-info-box').text("Hasła się różnią");
                return;
            }

            if(password.length < requirements.minLength) {
                $('#account-info-box').text("Hasło musi się składać z minimum "+requirements.minLength+" znaków");
                return;
            }

            var regex = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            if(requirements.mustContainsSpecialChar && !password.match(regex)) {
                $('#account-info-box').text("Hasło musi posiadać znak specjalny");
                return;
            }

            regex = /[A-Z]/;
            if(requirements.mustContainsUpperLetter && !password.match(regex)) {
                $('#account-info-box').text("Hasło musi posiadać duże litery");
                return;
            }

            regex = /[0-9]/;
            if(requirements.mustContainsNumber && !password.match(regex)) {
                $('#account-info-box').text("Hasło musi posiadać cyrfy");
                return;
            }

            if(!email == email2) {
                $('#account-info-box').text("Adresy email się różnią");
                return;
            }

            if(!($('#account-register-rules').prop('checked'))) {
                console.log($('#account-register-rules').prop('checked'));
                $('#account-info-box').text("Akceptacja regulaminu jest wymagana");
                return;
            }
            $('#account-info-box').text(" ");
            fetch(api_url+'/api/v1/users/', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    login: username,
                    password: password,
                    passwordConfirm: password2,
                    email: {
                        value: email,
                    },
                    emailConfirm: {
                        value: email2,
                    },
                    acceptsRules: true,
                }),
            });


        }

        function Login() {
            var username = $('#account-login-name').val();
            var password = $('#account-login-password').val();
            $.ajax({
                type: 'POST',
                url: api_url+'/api/v1/users/',
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                data: '[{"login": "'+username+'", "password": "'+password+'"}]',
                success: function(data, textStatus, xhr) {
                    console.log(xhr.status + " " +textStatus);
                },
                complete: function(xhr, textStatus) {
                    console.log(xhr.status + " " +textStatus);
                    console.log(xhr.responseJSON.message);
                } 
            });
        }
    </script>
</body>
</html>
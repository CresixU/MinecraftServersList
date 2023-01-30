<!DOCTYPE html>
<html>
<head>
    <title>MinecraftList</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
        main .container {
            background: linear-gradient(to bottom, #110b08, #0e0906 70%);
            color: white;
        }
        input[type=text], input[type=password] {
            border: 1px solid red;
            width: 100%;
            padding: 8px 12px;
            color: white;
        }
        input[type=submit] {
            border: 1px solid blue;
            color: white;
        }
        label:not(label:last-child) {
            margin-top: 10px;
            width: 100%;
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
                <div class="account-login col-12 col-md-6">
                    <form action="">
                        <div>
                            <label for="account-login-name">Nazwa użytkownika</label>
                            <input type="text" id="account-login-name">
                        </div>
                        <div>
                            <label for="account-login-password">Hasło</label>
                            <input type="password" id="account-login-password">
                        </div>
                        

                        <input type="submit" value="Zaloguj">
                    </form>
                </div>
                <div class="account-register col-12 col-md-6">
                    <form action="">
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
                            <input type="password" id="account-register-email">
                        </div>
                        <div>
                            <label for="account-register-email2">Powtórz email</label>
                            <input type="password" id="account-register-email2">
                        </div>
                        <div>
                            <input type="checkbox" id="account-register-rules">
                            <label for="account-register-rules">Akceptuje regulamin</label>
                        </div>
                        

                        <input type="submit" value="Zarejestruj się">
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
</body>
</html>
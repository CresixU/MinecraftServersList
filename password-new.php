
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
            .box {
                max-width: 700px;
                margin-left:auto !important;
                margin-right: auto !important;
                margin-top: 20px;
                margin-bottom: 20px;
                background: linear-gradient(to bottom, rgba(17, 11, 8), rgba(14, 9, 6,0.5) 70%);
                border-radius: 20px;
                padding: 30px;
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
        </style>
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <?php require_once("components/top.php"); ?>
        <main>
            <div class="container">
                <div class="box">
                    <p style="display:none" id="user-task-hash"><?php if(isset($_GET['hash']))echo $_GET['hash'];?></p>
                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                        <div>
                            <label for="password-1">Nowe hasło</label>
                            <input type="password" id="password-1">
                        </div>
                        <div>
                            <label for="password-2">Potwierdź nowe hasło</label>
                            <input type="password" id="password-2">
                        </div>
                        <p class="mt-2" id="password-messager"></p>
                        <p style="color: red" id="password-info"></p>
                        <button class="mt-3 btn-green mx-auto" onclick="ChangePasswordAction()">Ustaw nowe hasło</button>
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
        <script type="text/javascript" src="js/password-requirements.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var hash;
            $('#nav-konto').addClass('active');
            ShowPasswordRequirements('password-1','password-messager')
            $('#password-1').on('input',function() {
                    PasswordMessager();
                    if($('#password-1').val() != $('#password-2').val()) $('#password-info').text("Hasła się różnią");
                    else $('#password-info').text("");
                })
            $('#password-2').on('input',function() {
                if($('#password-1').val() != $('#password-2').val()) $('#password-info').text("Hasła się różnią");
                else $('#password-info').text("");
            })

            function ChangePasswordAction() {
                var pass1 = $('#password-1').val();
                var pass2 = $('#password-2').val();
                hash = $('#user-task-hash').text();
                if(pass1 != pass2) return;

                $.ajax({
                    url: api_url+'/api/v1/users/password-reset/',
                    type: 'PATCH',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"hash": "'+hash+'","newPassword": "'+pass1+'", "passwordConfirm": "'+pass2+'"}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                        window.location.replace("index.php");
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                        alert(xhr.responseJSON.message);
                    } 
                })
            }
                
        </script>
    </body>
</html>
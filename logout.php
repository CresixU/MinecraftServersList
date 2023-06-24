
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
            .message-box {
                max-width: 700px;
                margin-left:auto !important;
                margin-right: auto !important;
                margin-top: 20px;
                margin-bottom: 20px;
                background: linear-gradient(to bottom, rgba(17, 11, 8), rgba(14, 9, 6,0.5) 70%);
                border-radius: 20px;
                padding: 30px;
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
                <div class="message-box">
                    <h2 id="info-header" class="mb-3">Wylogowywanie...</h2>
                    <p id="show-info" style="display: none;">Za 5 sekund zostaniesz przeniesiony na stronę główną. Jeśli to nie nastąpi <a href="index.php">Kliknij tutaj</a></p>
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
            $('#nav-konto').addClass('active');
            $.ajax({
                type: "DELETE",
                url: api_url+'/api/v1/auth/logout/',
            }).done(res => {
                $('#info-header').text("Wylogowano");
                $('#show-info').css('display','block');
                setTimeout(window.location.replace("index.php"), 10000);
            });
        </script>
    </body>
</html>
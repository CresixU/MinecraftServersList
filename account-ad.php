
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
                                <!-- Reklama -->
                                <div class="panel-content-ad row">
                                    <div class="col col-12">
                                        <div class="col col-12">
                                            <p><b>Uwaga:</b> Banery reklamowe na stronie głównej wyświetlane są w losowej kolejności, kolejnośc miejsca reklamowego podczas wynajmu nie ma znaczenia.</p>
                                        </div>
                                    </div>
                                    <div class="col col-12">
                                        <div class="panel-content-ad-storage row w-100">
                                            <div class="ad-storage-item col col-6">
                                                <div class="row">
                                                    <div class="col col-12">
                                                        <input type="text" placeholder="Link do strony" style="width: 100%; margin-bottom: 5px; border-bottom: 2px solid var(--main-color); padding: 4px; color: white;">
                                                    </div>
                                                    <div class="col col-12">
                                                        <p>Plik obrazu o wymiarach 555x100px</p>
                                                        <input type="file" class="pl-3" style="margin-left: 20px;">
                                                    </div>
                                                    <div class="col col-12">
                                                        <p style="text-align: center">Wynajem do 2 lutego 2023 15:00:00<br>Zostało x dni</p>
                                                    </div>
                                                    <div class="col col-12" style="justify-content: center; display: flex;">
                                                        <button class="simple-button mx-3">Zapisz</button>
                                                        <button class="simple-button mx-3">Statystyki</button>
                                                        <button class="simple-button mx-3">Przedłuż</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-storage-item col col-6">
                                                <div class="row">
                                                    <div class="col col-12">
                                                        <p>To miejsce reklamowe jest wolne, możesz je wynająć</p>
                                                    </div>
                                                    <div class="col col-12">
                                                        <button class="simple-button">Wynajmij</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-storage-item col col-6">
                                                <div class="row">
                                                    <div class="col col-12">
                                                        <p>To miejsce reklamowe jest wolne, możesz je wynająć</p>
                                                    </div>
                                                    <div class="col col-12">
                                                        <button  class="simple-button">Wynajmij</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-storage-item col col-6">
                                                <div class="row">
                                                    <div class="col col-12">
                                                        <p>To miejsce reklamowe jest wolne, możesz je wynająć</p>
                                                    </div>
                                                    <div class="col col-12">
                                                        <button  class="simple-button">Wynajmij</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-storage-item col col-6">
                                                <div class="row">
                                                    <div class="col col-12">
                                                        <p>To miejsce reklamowe jest wolne, możesz je wynająć</p>
                                                    </div>
                                                    <div class="col col-12">
                                                        <button  class="simple-button">Wynajmij</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ad-storage-item col col-6">
                                                <div class="row" style="justify-content: center; display: flex">
                                                    <div class="col col-12">
                                                        <p>To miejsce reklamowe jest wolne, możesz je wynająć</p>
                                                    </div>
                                                    <div class="col col-12">
                                                        <button class="simple-button">Wynajmij</button>
                                                    </div>
                                                </div>
                                            </div>
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
        <div class="copyright">
            Lista serwerów Minecraft, spis serwerów Minecraft, prywatne serwery Minecraft, serwery Minecraft - &copy; Copyright 2013-2021
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;
            $('#nav-konto').addClass('active');

            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                complete: function(xhr, textStatus) {
                    if(xhr.status != "200") 
                        window.location.replace("auth.php");
                } 
            }).done(res => {
                userData = res;
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
        </script>
        
    </body>
</html>
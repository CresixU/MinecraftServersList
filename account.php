
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <style>
            body {
                color: white;
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
        </style>
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <?php require_once("components/top.php"); ?>
        <main>
            <div class="container">
                <?php
                if(!isset($_GET['subpage'])) $_GET['subpage'] = 'profile'; 
                echo "<span id='selected-subpage' style='display: none;'>" . $_GET['subpage']."</span>";?>
                <div class="row">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="col">
                                    <button onclick="ChangeSubpage(1)">Profil</button>
                                </div>
                                <div class="col">
                                    <button onclick="ChangeSubpage(2)">Serwery</button>
                                </div>
                                <div class="col">
                                    <button onclick="ChangeSubpage(3)">Historia konta</button>
                                </div>
                                <div class="col">
                                    <button onclick="ChangeSubpage(4)">Reklama</button>
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
                                                <td>{user.name}</td>
                                            </tr>
                                            <tr>
                                                <td>Hasło</td>
                                                <td><a href="" >Zmień hasło</a></td>
                                            </tr>
                                            <tr>
                                                <td>Adres e-mail</td>
                                                <td>{user.email} <a href="">Zmień</a></td>
                                            </tr>
                                            <tr>
                                                <td>{img} Ilość tokenów:</td>
                                                <td>{user.tokens} <a href="">Kup tokeny</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="checkbox" id="account-ad-mails">
                                                    <label for="account-ad-mails">Wyrażam zgodę na dostarczanie przez serwis {website name} treści reklamowych na adres e-mail podany przeze mnie podczas rejestracji</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- Serwery -->
                                <div class="panel-content-servers row">
                                    <div class="col col-12">
                                        <div class="row second-header">
                                            <div class="col col-6">
                                                <p class="mb-0">Informacje o dodanych przez Ciebie serwerach</p>
                                            </div>
                                            <div class="col col-6">
                                                <p class="mb-0" style="display: block; margin-left: 10px; float: right;">Tokeny z programu partnerskiego: 0</p>
                                                <button class="simple-button" style="display: block; float: right">Kup tokeny</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <table style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <td>Rank</td>
                                                    <td>Nazwa</td>
                                                    <td>Adres serwera</td>
                                                    <td>Port</td>
                                                    <td>Online mode</td>
                                                    <td>Wersja</td>
                                                    <td>Punkty</td>
                                                    <td>Hajs</td>
                                                    <td>Akcje</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <p>Nie dodano jeszcze żadnego serwera na tym koncie. <a href="new-server.php">Dodaj nowy serwer</a></p> 
                                </div>
                                <!-- Historia -->
                                <div class="panel-content-history row">
                                    <div class="col col-12">
                                        <div class="row">
                                            <div class="col col-6 second-header mb-3">
                                                <p class="mb-0">Historia konta {Zalogowany user}: <span>0</span> operacji</p>
                                            </div>
                                            <div class="col col-6">
                                                <button class="simple-button d-block" style="float: right">Kup tokeny</button>
                                                <p class="d-block" style="float: right; margin-right: 20px;">Twoje tokeny: <span>0</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-12">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td>Tokeny przed operacją</td>
                                                    <td>Tokeny</td>
                                                    <td>Tokeny po operacji</td>
                                                    <td>Typ operacji</td>
                                                    <td>Czas operacji</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>0</td>
                                                    <td>+0</td>
                                                    <td>0</td>
                                                    <td>Program partnerski (Polecanie serwerów przez użytkownika</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col col-12">
                                        <p style="font-weight: bold; padding: 20px">Na twoim koncie nie zostały jeszcze wykonane żadne operacje na Tokenach.</p>
                                    </div>
                                </div>
                                <!-- Reklama -->
                                <div class="panel-content-ad row">
                                    <div class="col col-12">
                                        <div class="row mb-3 w-100">
                                            <div class="col col-6 mb-3" style="display: flex; justify-content: center;">
                                                <i class="bi bi-cash-coin"></i>
                                                <p class="mb-auto">Twoje tokeny: 12345</p>
                                            </div>
                                            <div class="col col-6 mb-3" style="display: flex; justify-content: center;">
                                                <button class="simple-button">Kup tokeny</button>
                                            </div>
                                            <div class="col col-12">
                                                <p><b>Uwaga:</b> Banery reklamowe na stronie głównej wyświetlane są w losowej kolejności, kolejnośc miejsca reklamowego podczas wynajmu nie ma znaczenia.</p>
                                            </div>
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
            var selected_subpage;
            //UWAGA token jest tylko testowy dla konta test_user
            var token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMzgzOTY2MzAtMzIzMC02MzMzLTJkMzktMzgzMjMyMmQzMTMxIiwiZXhwIjoxNjc1ODg3MDUyfQ.buQOyXv4455nPJgPiXDw_L5eGzhFn3PfaqQ3K1q_LXY';

            function ChangeSubpage(e) {
                if(e == '' || e == undefined || e == null) selected_subpage = $('#selected-subpage').text();
                else selected_subpage = e;
                $('.panel-content-profile').css('display','none');
                $('.panel-content-servers').css('display','none');
                $('.panel-content-history').css('display','none');
                $('.panel-content-ad').css('display','none');
                if(selected_subpage == 'profile' || selected_subpage == 1) $('.panel-content-profile').css('display','flex');
                if(selected_subpage == 'servers' || selected_subpage == 2) $('.panel-content-servers').css('display','flex');
                if(selected_subpage == 'history' || selected_subpage == 3) $('.panel-content-history').css('display','flex');
                if(selected_subpage == 'ad' || selected_subpage == 4) $('.panel-content-ad').css('display','flex');
            }
            ChangeSubpage();
            ShowOwnerServers();

            function ShowOwnerServers() {
                $.ajax({
                url: api_url+'/api/v1/servers/own/?token='+token
            })
            .done(res => {
                data = res;
            })
            }
        </script>
    </body>
</html>
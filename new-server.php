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
            label {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
            }
            input {
                border: 1px solid red;
            }
            .panel-content > div > *:not(.second-header) {
                padding: 10px 30px;
            }
            .second-header {
                padding-left: 20px;
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
                                <div class="panel-header-title">
                                    Dodaj nowy serwer
                                </div>
                            </div>
                            <div class="panel-content pb-5">
                                <p style="padding-left: 20px;">
                                    Pola oznaczone <span style="color:red"> * </span> są wymagane.
                                </p>
                                <div>
                                    <p class="second-header mb-0">Weryfikacja</p>
                                    <p>Przed przejściem do wypełniania dalszej częsci formularza ustaw swojemu serwerowi następujący MOTD (Message of the day - Wiadomość dnia)</p>
                                    <h3>www.minecraft-list.pl#{user.name}</h3>
                                    <p>Weryfikacja jest konieczna, aby pewne było, że serwer, który dodajesz na listę należy do Ciebie</p>
                                </div>
                                <div>
                                    <p class="second-header mb-0">Nazwa i adres serwera</p>
                                    <div class="mx-auto">
                                        <div>
                                            <label for="addserver-servername" id="addserver-servername-label">Nazwa serwera</label>
                                            <input type="text" id="addserver-servername">
                                        </div>
                                        <div>
                                            <label for="addserver-ip" id="addserver-ip-label">Adres IP lub domena serwera</label>
                                            <input type="text" id="addserver-ip">
                                        </div>
                                        <div>
                                            <label for="addserver-port" id="addserver-port-label">Port</label>
                                            <input type="text" id="addserver-port" value="25565">
                                        </div>
                                        <div>
                                            <label for="addserver-website" id="addserver-website-label">Strona serwera</label>
                                            <input type="text" id="addserver-website">
                                            <span >Adres URL musi zawierać <b>http://</b> na początku.</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="second-header mb-0 d-flex">
                                        <p class="mb-0" style="margin-right: auto;">Dodatkowe informacje o serwerze</p>
                                        <p class="mb-0" style="padding-right: 20px">Pozostało <span id="addserver-desc-chars">5000</span> znaków</p>
                                    </div>
                                    <div>
                                        <textarea name="addserver-desc" id="addserver-desc" cols="30" rows="10"
                                        style="background: transparent; color: white"></textarea>
                                    </div>

                                </div>
                                <div>
                                    <p class="second-header mb-0">
                                        Dodaj serwer do listy
                                    </p>
                                    Captcha na środku
                                    <button class="simple-button d-block" style="float:right">Dodaj serwer</button>
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
            $('#addserver-desc').on('input', function() {
                $('#addserver-desc-chars').text(5000 - $('#addserver-desc').val().length );
            })
            
        </script>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <style>
            body {
                color: #dfd7cc;
            }
            label:not(.not-label) {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
                position: relative;
                top: 10px;
            }
            .panel-content > div > *:not(.second-header) {
                padding: 10px 30px;
            }
            .second-header {
                padding-left: 20px;
            }
            input[type=text],
            input[type=password],
            input[type=number] {
                width: 100%;
                padding: 8px 12px;
                color: white;
                border: none;
                border-bottom: 2px solid var(--main-color);
                border-radius: 8px;
            }
            select {
                width: 100%;
                background-color: #110b08;
                color: white;
                padding: 2px 5px;
                border: 1px solid #110b08;
                border-bottom: 2px solid var(--main-color);
                border-radius: 8px;
            }
            select:focus {
                outline: none;
            }
            .panel li::marker {
                content: '> ';
                font-size: 120%;
                font-weight: bold;
                color: var(--main-color);
            }

            .promote-item {
                width: calc(50% - 30px);
                margin: 15px;
                padding: 20px;
                transition: all 0.2s ease-in;
                border-radius: 5px;
            }
            .promote-item:hover {
                margin: 10px 20px 20px 10px;
            }
            .bronze:hover {
                box-shadow: 5px 5px 10px rgba(223, 138, 20, 0.5);
            }
            .silver:hover {
                box-shadow: 5px 5px 10px rgba(179, 179, 179, 1);
            }
            .gold:hover {
                box-shadow: 5px 5px 10px rgba(197, 177, 0, 1);
            }
            .diamond:hover {
                box-shadow: 5px 5px 10px rgba(21, 213, 213, 1);
            }
            .promote-item-header {
                padding: 10px 5px;
                border-bottom: 1px solid var(--main-color);
            }
            .promote-item-header div:first-child {
                font-size: 150%;
                font-weight: bold;
            }
            .promote-item-header div:nth-child(2) {
                text-align: right;
            }
            .promote-item-content {
                padding: 10px 5px;
            }
            .promote-item-footer {
                padding: 10px;
                margin: 10px 0px;
            }
            .promote-item-footer > button {
                margin-left: auto;
                margin-right: auto;
                display: block;
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
                                    Promuj swój serwer
                                </div>
                            </div>
                            <div class="panel-content pb-5">
                                <div>
                                    <h2>Promowanie serwera</h2>
                                    <p>Na czym polega i co zyskujesz na umieszczeniu swojego serwera na liście serwerów promowanych:</p>
                                    <ul class="mx-3">
                                        <li>
                                            Aby promować swój serwer musisz posiadać Tokeny, które wymieniasz na jeden z pakietów pozwalający na umieszczenie serwera na liście serwerwów promowanych.
                                        </li>
                                        <li>
                                            Goście odwiedzający nasz serwis mogą obejrzeć wszystkie promowane serwery w galerii na górze strony. System rozpoczyna prezentację od ostatno wyświetlonego serwera, indywidualnie dla każdego gościa odwiedzającego nasz serwis.
                                        </li>
                                        <li>
                                            Serwer jest wyróżniony na liście wszystkich serwerów
                                        </li>
                                        <li>
                                            Gracze zauważają to, że inwestujesz w rozwój i promocję swojego serwera
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <button class="simple-button" style="margin-right: 20px;">Kup tokeny</button>
                                        <button class="simple-button" style="margin-left: 20px;">Promuj serwer</button>
                                    </div>
                                </div>
                                <div>
                                    <div class="second-header mb-0 pr-4" style="padding-right: 20px;">
                                        <p style="width: 50%" class="mb-0">Kup tokeny</p>
                                        <p style="width: 50%; text-align: right;" class="mb-0">Twoje tokeny: 123</p>
                                    </div>
                                    <div class="mx-auto" style="max-width: 500px; width: 100%; padding: 20px 15px;">
                                        <div>
                                            <label for="payment-method" id="payment-method-label" style="top:0">Metoda płatności</label>
                                            <select name="payment-method" id="payment-method">
                                                <option value="Brak" selected disabled>Wybierz metodę płatności</option>
                                                <option value="przelew">Przelew</option>
                                                <option value="blik">BLIK</option>
                                                <option value="przelew_tradycyjny">Przelew tradycyjny</option>
                                                <option value="sms">SMS Premium</option>
                                                <option value="paypal">Paypal</option>
                                                <option value="psc">PaySafeCard</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="tokens" id="tokens-label">Ilość tokenów</label>
                                            <input type="text" id="tokens" placeholder="Wpisz tutaj ile tokenów chcesz kupić...">
                                        </div>
                                        <div>
                                            <label for="money" id="money-label">Cena w PLN</label>
                                            <input type="number" id="money-port" placeholder="---">
                                        </div>
                                        <div>
                                            <label for="email" id="email-label">Adres e-mail</label>
                                            <input type="text" id="email" placeholder="example@ex.com">
                                        </div>
                                        <div>
                                            <label for="select-server" id="select-server-label" style="top:0">Metoda płatności</label>
                                            <select name="select-server" id="select-server">
                                                <option value="Brak" selected disabled>Wybierz serwer</option>
                                                <option value="ID">hypixel.com</option>
                                                <option value="ID2">hakuna-matata.pl</option>
                                            </select>
                                        </div>
                                        <div class="mt-4 row">
                                            <div class="col col-6">
                                                <input type="checkbox" id="account-register-rules">
                                                <label for="account-register-rules" class="not-label">Akceptuje regulamin</label>
                                            </div>
                                            <div class="col col-6">
                                                <button class="simple-button mt-1">Przejdź do płatności</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- PAKIETY PROMOWANIA -->
                                <div>
                                    <p class="second-header mb-0">Pakiety promowania</p>
                                    <div class="row">
                                        <div class="promote-item bronze">
                                            <div class="promote-item-header row">
                                                <div class="col">Pakiet Bronze</div>
                                                <div class="col">token-img 1000</div>
                                            </div>
                                            <div class="promote-item-content row">
                                                <div class="col col-12">
                                                    <p>Pakiet, dzięki któremy otrzymujesz możliwość umieszczenia swojego serwera na liście serwerów promowanych na 3 dni w zamian za <b>1000</b> Tokenów.</p>
                                                    
                                                </div>
                                                <div class="col col-12">
                                                    <label for="promote-bronze-select" id="promote-bronze-select" style="top:0">Metoda płatności</label>
                                                    <select name="promote-bronze-select" id="promote-bronze-select">
                                                        <option value="Brak" selected disabled>Wybierz serwer</option>
                                                        <option value="ID">hypixel.com</option>
                                                        <option value="ID2">hakuna-matata.pl</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="promote-item-footer">
                                                <button class="simple-button ">Promuj serwer</button>
                                            </div>
                                        </div>
                                        <div class="promote-item silver">
                                            <div class="promote-item-header row">
                                                <div class="col">Pakiet Silver</div>
                                                <div class="col">token-img 2000</div>
                                            </div>
                                            <div class="promote-item-content row">
                                                <div class="col col-12">
                                                    <p>Pakiet, dzięki któremy otrzymujesz możliwość umieszczenia swojego serwera na liście serwerów promowanych na 7 dni w zamian za <b>2000</b> Tokenów.</p>
                                                    
                                                </div>
                                                <div class="col col-12">
                                                    <label for="promote-silver-select" id="promote-silver-select" style="top:0">Metoda płatności</label>
                                                    <select name="promote-silver-select" id="promote-silver-select">
                                                        <option value="Brak" selected disabled>Wybierz serwer</option>
                                                        <option value="ID">hypixel.com</option>
                                                        <option value="ID2">hakuna-matata.pl</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="promote-item-footer">
                                                <button class="simple-button ">Promuj serwer</button>
                                            </div>
                                        </div>
                                        <div class="promote-item gold">
                                            <div class="promote-item-header row">
                                                <div class="col">Pakiet Gold</div>
                                                <div class="col">token-img 3200</div>
                                            </div>
                                            <div class="promote-item-content row">
                                                <div class="col col-12">
                                                    <p>Pakiet, dzięki któremy otrzymujesz możliwość umieszczenia swojego serwera na liście serwerów promowanych na 14 dni w zamian za <b>3200</b> Tokenów.</p>
                                                    
                                                </div>
                                                <div class="col col-12">
                                                    <label for="promote-gold-select" id="promote-gold-select" style="top:0">Metoda płatności</label>
                                                    <select name="promote-gold-select" id="promote-gold-select">
                                                        <option value="Brak" selected disabled>Wybierz serwer</option>
                                                        <option value="ID">hypixel.com</option>
                                                        <option value="ID2">hakuna-matata.pl</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="promote-item-footer">
                                                <button class="simple-button ">Promuj serwer</button>
                                            </div>
                                        </div>
                                        <div class="promote-item diamond">
                                            <div class="promote-item-header row">
                                                <div class="col">Pakiet Diamond</div>
                                                <div class="col">token-img 6000</div>
                                            </div>
                                            <div class="promote-item-content row">
                                                <div class="col col-12">
                                                    <p>Pakiet, dzięki któremy otrzymujesz możliwość umieszczenia swojego serwera na liście serwerów promowanych na 3 dni w zamian za <b>6000</b> Tokenów.</p>
                                                    
                                                </div>
                                                <div class="col col-12">
                                                    <label for="promote-diamond-select" id="promote-diamond-select" style="top:0">Metoda płatności</label>
                                                    <select name="promote-diamond-select" id="promote-diamond-select">
                                                        <option value="Brak" selected disabled>Wybierz serwer</option>
                                                        <option value="ID">hypixel.com</option>
                                                        <option value="ID2">hakuna-matata.pl</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="promote-item-footer">
                                                <button class="simple-button ">Promuj serwer</button>
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
            $('#nav-serwery').addClass('active');            
        </script>
    </body>
</html>

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
            #payment-list tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td {
                color: var(--href-color);
            }
            #payment-list tr:hover,
            #history-list tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td,
            thead td {
                color: var(--href-color);
            }
            #payment-list td i,
            #history-list td i {
                font-size: 20px;
            }
            #payment-list td a,
            #history-list td a {
                color: inherit;
            }
            #payment-list td a:hover,
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
                color: #dfd7cc;
            }
            .form-control:active, .form-control:focus {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                color: #dfd7cc;
            }
            .form-control option {
                color: #dfd7cc;
                background-color: black;
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
                                <div class="panel-content-history row">
                                    <div class="col col-12">
                                        <div class="row">
                                            <div class="col col-12 second-header mb-3">
                                                <p class="mb-0">Historia konta</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-12 mb-3">
                                        <div class="col col-6">
                                            <label for="history-type" style="top: 0px;">Typ operacji</label>
                                            <select id="history-type" class="form-control">
                                                    <option value="NONE">Bez filtrowania</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col col-12">
                                        <table class="w-100">
                                            <thead>
                                                <tr>
                                                    <td>Data</td>
                                                    <td>Operacja</td>
                                                    <td>IP</td>
                                                    <td>Nowe IP</td>
                                                </tr>
                                            </thead>
                                            <tbody id="history-list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-content p-3 pt-5">
                                <div class="panel-content-history row">
                                    <div class="col col-12">
                                        <div class="row">
                                            <div class="col col-12 second-header mb-3">
                                                <p class="mb-0">Historia płatności</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-12">
                                        <table class="w-100">
                                            <thead>
                                                <tr>
                                                    <td>Data</td>
                                                    <td>Cena</td>
                                                    <td>Status</td>
                                                    <td>Typ płatności</td>
                                                </tr>
                                            </thead>
                                            <tbody id="payment-list">

                                            </tbody>
                                        </table>
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
            var dataHistory;
            var userData;
            $('#nav-konto').addClass('active');

            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                xhrFields: {
                    withCredentials: true
                },
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

            async function ShowHistoryList() {
                $('#history-list').empty();
                var historyType = $('#history-type').val();
                var fullUrl = api_url+'/api/v1/history/?page=0&size=10';
                if(historyType != 'NONE')
                {
                    fullUrl += '&type='+historyType;
                }
                await $.ajax({
                    url: fullUrl,
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    dataHistory = res;
                    $('#operations-count').text(dataHistory.content.length);
                    if(dataHistory.content.length < 1) {
                        $('#history-list').append($('<tr><td>Brak wyników</td></tr>'));
                        return;
                    }
                    dataHistory.content.forEach(x => $('#history-list').append($('<tr><td>'+ReturnStringDate(x.at)+'</td><td>'+x.type+'</td><td>'+ReturnServerValue(x.oldHostCredentials)+'</td><td>'+ReturnServerValue(x.newHostCredentials)+'</td></tr>')));
                })
            }
            async function ShowPaymentHistoryList() {
                $('#payment-list').empty();
                await $.ajax({
                    url: api_url+'/api/v1/payments/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    console.log(res)
                    if(res.length < 1) {
                        $('#payment-list').append($('<tr><td>Brak wyników</td></tr>'));
                        return;
                    }
                    res.forEach(x => $('#payment-list').append($('<tr><td>'+ReturnStringDate(x.createDate)+'</td><td>'+x.price+'</td><td>'+x.status+'</td><td>'+x.method+'</td><td><a href="'+x.url+'" class="simple-button">Przejdź do płatności</a></td></tr>')));
                })
            }
            
            function ReturnStringDate(x) {
                return x.substr(8,2)+'.'+x.substr(5,2)+'.'+x.substr(0,4)+'  '+x.substr(11,5);
            }
            function ReturnServerValue(x) {
                if(!x) return "";
                return x;
            }
            async function GenerateHistoryTypes() {
                await $.ajax({
                    url: api_url+'/api/v1/history/types/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    res.forEach(x => $('#history-type').append($('<option value="'+x+'">'+x+'</option>')));
                });
            }
            GenerateHistoryTypes()   
            ShowHistoryList();
            ShowPaymentHistoryList()
            
            $('#history-type').on('change', function() {
                ShowHistoryList();
            })
            
        </script>
        
    </body>
</html>
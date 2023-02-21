
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
                                <div class="panel-content-history row">
                                    <div class="col col-12">
                                        <div class="row">
                                            <div class="col col-12 second-header mb-3">
                                                <p class="mb-0">Historia konta: <span id="operations-count">0</span> operacji</p>
                                            </div>
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
                                                    <td>Płatność</td>
                                                </tr>
                                            </thead>
                                            <tbody id="history-list">

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

            async function ShowHistoryList() {
                await $.ajax({
                    url: api_url+'/api/v1/history/?page=0&size=10'
                }).done(res => {
                    dataHistory = res;
                    $('#operations-count').text(dataHistory.content.length);
                    if(dataHistory.content.length < 1) {
                        $('#history-list').append($('<tr><td>Brak wyników</td></tr>'));
                        return;
                    }
                    dataHistory.content.forEach(x => $('#history-list').append($('<tr><td>'+ReturnStringDate(x.at)+'</td><td>'+x.type+'</td><td>'+ReturnServerValue(x.oldHostCredentials)+'</td><td>'+ReturnServerValue(x.newHostCredentials)+'</td><td>'+ReturnPaymentValue(x.payment)+'</td></tr>')));
                })
            }
            
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
                 
            ShowHistoryList();
            
        </script>
        
    </body>
</html>
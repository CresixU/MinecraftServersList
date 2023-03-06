<!DOCTYPE html>
<html>
<head>
    <title>MinecraftList</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
        main .container {
            background: linear-gradient(to bottom, #110b08, #0e0906 70%);
            color: #dfd7cc;
        }
        .icon-on, .icon-off {
            display: block;
            padding: 19px 0px 0px 0px;
            float: left;
            margin-top: 3px;
        }
        .star {
            cursor: pointer;
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
    <?php echo "<span id='server-id' style='display: none;'>" . $_GET['id']."</span>";?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
    <?php require_once("components/top.php"); ?>
    <main>
        <div class="container p-5">

                    <!-- MODAL Renew -->
                    <div class="modal fade " id="modal_like" tabindex="-1" role="dialog" aria-labelledby="modal_like" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Polub serwer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_like').modal('toggle');">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-3">
                                    <p>W celu polubienia serwera, należy podać adres E-mail, na który przyjdzie link potwierdzający polubinie</p>
                                    <div>
                                        <label for="modal-email">Adres E-mail</label>
                                        <input type="text" id="modal-email">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="LikeServerAction()">Wyślij</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_like').modal('toggle');">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            <div class="server-header p-2">
                <h1 id="server-data-name" style="margin-left: 15px !important;">Ładowanie danych...</h1>
            </div>
            <div class="row mt-2">
                <div class="body-rate">
                    <div class="stars" id="stars">
                        <div class="star star-full" id="star_1" onclick="Rate(this.id)"></div>
                        <div class="star star-full" id="star_2" onclick="Rate(this.id)"></div>
                        <div class="star star-full" id="star_3" onclick="Rate(this.id)"></div>
                        <div class="star star-full" id="star_4" onclick="Rate(this.id)"></div>
                        <div class="star star-empty" id="star_5" onclick="Rate(this.id)"></div>
                    </div>
                    <span id="server-rate" style="color: var(--href-color);">4.00</span><br>
                    <span style="color">Kliknij w gwiazdkę by ocenić serwer</span>
                </div>
                <div class="py-3">
                    <div class="table_filter_button px-3" id="like_button">
                        <span id="server-likes" style="float:left; padding: 10px 0px;"></span><i class="icon icon-likes" style="float:left;"></i> <span style="float:left; padding: 9px 0px;">Lubię to</span>
                    </div>
                </div>
            </div>
            
            <div class="server-data-list mb-5 mt-2" >
                <div class="server-data-list-header mb-2">
                    Informacje o serwerze
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%; max-width: 500px">Adres serwera:</td>
                        <td id="server-data-ip">Ładowanie danych...</td>
                    </tr>
                    <tr>
                        <td>Port:</td>
                        <td id="server-data-port">??</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td id="server-data-status"></td>
                    </tr>
                    <tr>
                        <td>Top players:</td>
                        <td id="server-data-top">??</td>
                    </tr>
                    <tr>
                        <td>Ostatnio online:</td>
                        <td id="server-data-last-online">??</td>
                    </tr>
                    <tr>
                        <td>Strona serwera:</td>
                        <td id="server-data-page">??</td>
                    </tr>
                    <tr>
                        <td>Facebook serwera:</td>
                        <td id="server-data-facebook">??</td>
                    </tr>
                    <tr>
                        <td>Discord serwera:</td>
                        <td id="server-data-discord">??</td>
                    </tr>
                    <tr>
                        <td>Wersja serwera:</td>
                        <td id="server-data-version">Nie sprecyzowano</td>
                    </tr>
                    <tr>
                        <td>Online mode:</td>
                        <td id="server-data-online-mode">??</td>
                    </tr>
                    <tr>
                        <td>Punkty:</td>
                        <td id="server-data-points">??</td>
                    </tr>
                    <tr>
                        <td>Ratio online:</td>
                        <td id="server-data-ratio">??</td>
                    </tr>
                    <tr>
                        <td>Miejsce w rankingu:</td>
                        <td id="server-data-rank">??</td>
                    </tr>
                    <tr>
                        <td>Data dodania na listę:</td>
                        <td id="server-data-added">??</td>
                    </tr>
                </table>
            </div>
            <div class="server-data-chart my-5">
                <h2 style="text-align: center">Wykres graczy online</h2>
                <canvas id="myChart"></canvas>
            </div>
            <div class="server-data-description my-5">
                <h2>Opis serwera</h2>
                <div id="server-data-desc">

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
    <script type="text/javascript" src="js/server-service.js"></script>
    <script>
        var api_url = "<?php echo $api ?>";
        var data;
        var chartData;
        var serverId;
        var onlineLight = 'icon-on';
        var serverOnlineRatio = 100.00;
        var time = [];
        var players = [];

        $('#nav-serwery').addClass('active');
        const ctx = document.getElementById('myChart');

        function GetServerInfo() {
            serverId = $('#server-id').text();
            $.ajax({
                url: api_url+'/api/v1/servers/'+serverId+"/",
            })
            .done(res => {
                data = res;
                $('#server-data-name').text(data.server.name);
                $('#server-data-ip').text(data.serverHostCredentials.address);
                $('#server-data-port').text(data.serverHostCredentials.port);
                if(!data.serverPingCredentials.isOnline) onlineLight = 'icon-off';
                $('#server-data-status').html($('<i class="icon '+onlineLight+'"></i> <span style="display:block; float: left;">'+data.serverPingCredentials.onlinePlayers+'/'+data.serverPingCredentials.serverSize+'</span>'));
                $('#server-data-top').text(data.stats.maxPlayers);
                $('#server-data-last-online').text(data.serverPingCredentials.addedAt.substr(8,2)+'.'+data.serverPingCredentials.addedAt.substr(5,2)+'.'+data.serverPingCredentials.addedAt.substr(0,4)+'  '+data.serverPingCredentials.addedAt.substr(11,5));
                $('#server-data-page').text(data.server.homepage);
                $('#server-data-facebook').text(data.server.facebook);
                $('#server-data-discord').text(data.server.discord);
                $('#server-data-version').text(ReturnServerVersions(data.minecraftServerVersions).versionsString);
                if(data.server.onlineModeEnabled) $('#server-data-online-mode').text("Tak");
                else $('#server-data-online-mode').text("Nie");
                $('#server-data-points').text(data.server.points);
                if(data.serverPingCredentials.timesOffline > 0)
                    serverOnlineRatio = (data.serverPingCredentials.timesOnline / data.serverPingCredentials.timesOffline).toFixed(2);
                $('#server-data-ratio').text(serverOnlineRatio+'%');
                $('#server-data-rank').text(data.stats.placeInRanking);
                $('#server-data-added').text(data.server.addedAt.substr(8,2)+'.'+data.server.addedAt.substr(5,2)+'.'+data.server.addedAt.substr(0,4)+'  '+data.server.addedAt.substr(11,5));
                $('#server-data-desc').text(data.server.description);
                $('#server-rate').text("Ocena: "+data.rate.rate.toFixed(2));
                $('#server-likes').text(data.likes.likes);

                ShowStarsRate(data.rate.rate);
            })
        }


        function ShowChart() {
            serverId = $('#server-id').text();
            $.ajax({
                url: api_url+'/api/v1/servers/'+serverId+"/ping/?page=0&size=50",
            })
            .done(res => {
                chartData = res;
                for(var k=0;k<chartData.content.length;k++) {
                    if(chartData.content[k].onlinePlayers > 0) {
                        time.push(chartData.content[k].addedAt);
                        players.push(chartData.content[k].onlinePlayers);
                    }
                }
                chart.data.datasets[0].data = players.reverse();
                chart.data.labels = time.map(t => t.substr(11,5)).reverse();

                chart.update();
            })
        }


        //Chart
        chart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: time,
            datasets: [{
                label: 'Ilość graczy',
                data: players,
                borderColor: color => {
                    let colors = ReturnColorByIndex(color.index);
                    return colors;
                },
                borderWidth: 3,
                fill: false
            }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMin: 0
                }
            }
            }
        });

        function ReturnColorByIndex(index) {
            if(time.length == 0) return;
            var i = time.length - index - 1;
            var day = parseInt(time[i].substr(8,2))%3;
            if(index == 0) return 'rgb(46, 46, 46)'; //gray
            if(day == 0) return 'rgb(75,192,192)'; //blue
            else if(day == 1) return 'rgb(189, 4, 105)'; //green
            else if(day == 2) return 'rgb(28, 176, 77)';    
        }

        //Return Stars in table
        function ShowStarsRate(value) {
            starsId = ('#stars');
            $(starsId).empty();
            for(var i=0;i<5;i++) {
                if(i<value) {
                    $(starsId).append($('<div id="star_'+(i+1)+'" class="star star-full" onclick="Rate(this.id)"></div>'));
                }
                else {
                    $(starsId).append($('<div id="star_'+(i+1)+'" class="star star-empty" onclick="Rate(this.id)"></div>'));
                }
            }
        }
        //Rate server
        function Rate(id) {
            var number = id.substr(5,1);
            $.ajax({
                type: 'PUT',
                contentType: "application/json; charset=utf-8",
                url: api_url+'/api/v2/servers/'+serverId+'/rates/',
                data: '{"rate": "'+number+'", "description": ""}',
            })
            .done(res => {
                console.log(res);
                alert("Oceniono serwer<br>Ocena: "+number);
                GetServerInfo();
            });
            
        }

        //Like server
        $('#like_button').on('click', function() {
            $('#modal_like').modal('toggle');
        });

        function LikeServerAction() {
            var emailInput = $('#modal-email').val();
            $.ajax({
                url: api_url+'/api/v1/servers/'+data.server.id+'/likes/',
                type: 'POST',
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                data: '{"email": "'+emailInput+'"}',
                xhrFields: {
                    withCredentials: true
                },
            }).done(res => {
                $('#modal_like').modal('toggle');
                alert("Mail został wysłany. Oczekuje na potwierdzenie");
            })
        }

        /*
        $('.stars')
        .hover(function(event) {
            ShowStarsRate(event.target.id.substr(5,1))
        })
        .mouseleave(function() {
            console.log("out");
            ShowStarsRate(data.rate.rate);
        })   
    */
        GetServerInfo();
        ShowChart();


    </script>
</body>
</html>
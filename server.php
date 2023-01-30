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
        .icon-on, .icon-off {
            display: block;
            padding: 19px 0px 0px 0px;
            float: left;
            margin-top: 3px;
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
            <div class="server-header p-2">
                <h1 id="server-data-name" style="margin-left: 15px !important;">IP</h1>
            </div>
            <div class="body-rate">
                <div class="stars" id="stars">
                    <div class="star star-full"></div>
                    <div class="star star-full"></div>
                    <div class="star star-full"></div>
                    <div class="star star-full"></div>
                    <div class="star star-empty"></div>
                </div>
                <span id="server-rate">4.00</span>
            </div>
            <div class="server-data-list my-5" >
                <div class="server-data-list-header">
                    Informacje o serwerze
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%; max-width: 500px">Adres serwera:</td>
                        <td id="server-data-ip"></td>
                    </tr>
                    <tr>
                        <td>Port:</td>
                        <td id="server-data-port"></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td id="server-data-status"></td>
                    </tr>
                    <tr>
                        <td>Top players:</td>
                        <td id="server-data-top"></td>
                    </tr>
                    <tr>
                        <td>Ostatnio online:</td>
                        <td id="server-data-last-online"></td>
                    </tr>
                    <tr>
                        <td>Strona serwera:</td>
                        <td id="server-data-page"></td>
                    </tr>
                    <tr>
                        <td>Wersja serwera:</td>
                        <td id="server-data-version"></td>
                    </tr>
                    <tr>
                        <td>Online mode:</td>
                        <td id="server-data-online-mode"></td>
                    </tr>
                    <tr>
                        <td>Punkty:</td>
                        <td id="server-data-points"></td>
                    </tr>
                    <tr>
                        <td>Ratio online:</td>
                        <td id="server-data-ratio"></td>
                    </tr>
                    <tr>
                        <td>Miejsce w rankingu:</td>
                        <td id="server-data-rank"></td>
                    </tr>
                    <tr>
                        <td>Data dodania na listę:</td>
                        <td id="server-data-added"></td>
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
    <script>
        var api_url = "<?php echo $api ?>";
        var data;
        var chartData;
        var serverId;
        var onlineLight = 'icon-on';
        var serverOnlineRatio = 100.00;
        var time = [];
        var players = [];

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
                $('#server-data-status').append($('<i class="icon '+onlineLight+'"></i> <span style="display:block;">'+data.serverPingCredentials.onlinePlayers+'/'+data.serverPingCredentials.serverSize+'</span>'));
                $('#server-data-top').text("Nie skończono");
                $('#server-data-last-online').text(data.serverPingCredentials.addedAt.substr(8,2)+'.'+data.serverPingCredentials.addedAt.substr(5,2)+'.'+data.serverPingCredentials.addedAt.substr(0,4)+'  '+data.serverPingCredentials.addedAt.substr(11,5));
                $('#server-data-page').text(data.server.homepage);
                if(data.minecraftServerVersions.length != 0 )
                    $('#server-data-version').text(data.minecraftServerVersions[0].minecraftVersion.version);
                if(data.server.onlineModeEnabled) $('#server-data-online-mode').text("Tak");
                else $('#server-data-online-mode').text("Nie");
                $('#server-data-points').text(data.server.points);
                if(data.serverPingCredentials.timesOffline > 0)
                    serverOnlineRatio = (data.serverPingCredentials.timesOnline / data.serverPingCredentials.timesOffline).toFixed(2);
                $('#server-data-ratio').text(serverOnlineRatio+'%');
                $('#server-data-rank').text("Brak implementacji w endpoincie");
                $('#server-data-added').text(data.server.addedAt.substr(8,2)+'.'+data.server.addedAt.substr(5,2)+'.'+data.server.addedAt.substr(0,4)+'  '+data.server.addedAt.substr(11,5));
                $('#server-data-desc').text(data.server.description);
                $('#server-rate').text("Ocena: "+data.rate.rate.toFixed(2));

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
                    $(starsId).append($('<div id="star_'+(i+1)+'" class="star star-full"></div>'));
                }
                else {
                    $(starsId).append($('<div id="star_'+(i+1)+'" class="star star-empty"></div>'));
                }
            }
        }
        //Rate server
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
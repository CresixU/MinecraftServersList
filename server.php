<!DOCTYPE html>
<html>
<head>
    <title>MinecraftList</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/35076142fc.js" crossorigin="anonymous"></script>
    
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
        table a {
            color: var(--href-color);
            transition: all 0.3s;
            text-decoration: none;
        }
        table a:hover {
            color: var(--href-color2);
        }
        #server-data-ip {
            cursor: pointer;
        }
        table thead tr td:nth-child(1) {
            background-image: url("img/row/row_head_bg.png");
            padding-left: 10px;
            color: var(--href-color);
        }
        table tbody tr td:nth-child(1) {
            background-image: url("img/row/row_left.png");
            width: 10px;
            height: 38px;
        } 
        table tbody tr td:nth-child(2) {
            background-image: url("img/row/row_bg.png");
        } 
        table tbody tr td:nth-child(3) {
            background-image: url("img/row/row_middle.png");
            width: 10px;
            height: 38px;
        } 
        table tbody tr td:nth-child(4) {
            background-image: url("img/row/row_bg.png");
        } 
        table tbody tr td:nth-child(5) {
            background-image: url("img/row/row_right.png");
            width: 10px;
            height: 38px;
        } 
        #server-fullip-tocopy:hover {
            filter: brightness(1.3);
        }
        #server-data-desc * {
            max-width: 100%
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

                    <!-- MODAL Like -->
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
                                        <p style="color: red" id="modal_like-message"></p>
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
                <div class="col-6">
                    <div class="body-rate">
                        <div class="stars" id="stars">
                            <div class="star star-full" id="star_1" onclick="Rate(this.id)"></div>
                            <div class="star star-full" id="star_2" onclick="Rate(this.id)"></div>
                            <div class="star star-full" id="star_3" onclick="Rate(this.id)"></div>
                            <div class="star star-full" id="star_4" onclick="Rate(this.id)"></div>
                            <div class="star star-empty" id="star_5" onclick="Rate(this.id)"></div>
                        </div>
                        <span id="server-rate" style="color: var(--href-color);">Ładowanie danych...</span><br>
                        <span style="color">Kliknij w gwiazdkę by ocenić serwer</span>
                    </div>
                    <div class="py-3">
                        <div class="table_filter_button px-3" id="like_button">
                            <span id="server-likes" style="float:left; padding: 10px 0px;"></span><i class="icon icon-likes" style="float:left;"></i> <span style="float:left; padding: 9px 0px;">Lubię to</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <p class="py-5" id="server-fullip-tocopy"><span id="server-fullip" style="font-size: 20px;"></span><i class="fa-regular fa-copy" style="color: #fceec7; margin-left: 5px; cursor: pointer;" onclick="CopyOnClick()"></i></p>
                </div>
                
            </div>
            
            <div class="server-data-list mb-5 mt-2" >
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td colspan="5">Informacje o serwerze</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td style="width: 50%; max-width: 500px">Adres serwera:</td>
                            <td></td>
                            <td id="server-data-ip" onclick="CopyOnClick()">Ładowanie danych...</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Port:</td>
                            <td></td>
                            <td id="server-data-port">??</td>
                            <td></td>
                        </tr>
                        <tr>
                        <td></td>
                            <td>Status:</td>
                            <td></td>
                            <td id="server-data-status"></td>
                            <td></td>
                        </tr>
                        <tr>
                        <td></td>
                            <td>Top players:</td>
                            <td></td>
                            <td id="server-data-top">??</td>
                            <td></td>
                        </tr>
                        <tr>
                        <td></td>
                            <td>Ostatnio online:</td>
                            <td></td>
                            <td id="server-data-last-online">??</td>
                            <td></td>
                        </tr>
                        <tr>
                        <td></td>
                            <td>Strona serwera:</td>
                            <td></td>
                            <td id="server-data-page">??</td>
                            <td></td>
                        </tr>
                        <tr> <td></td>
                            <td>Facebook serwera:</td><td></td>
                            <td id="server-data-facebook">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Discord serwera:</td><td></td>
                            <td id="server-data-discord">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Wersja serwera:</td><td></td>
                            <td id="server-data-version">Nie sprecyzowano</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Online mode:</td><td></td>
                            <td id="server-data-online-mode">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Punkty:</td><td></td>
                            <td id="server-data-points">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Ratio online:</td><td></td>
                            <td id="server-data-ratio">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Miejsce w rankingu:</td><td></td>
                            <td id="server-data-rank">??</td><td></td>
                        </tr>
                        <tr><td></td>
                            <td>Data dodania na listę:</td><td></td>
                            <td id="server-data-added">??</td><td></td>
                        </tr>
                    </tbody>
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
                $('#server-data-ip').text(data.serverHostCredentials.host);
                $('#server-data-port').text(data.serverHostCredentials.port);
                $('#server-fullip').text(data.serverHostCredentials.host+':'+data.serverHostCredentials.port);
                if(data.serverPingCredentials != null) {
                    if(!data.serverPingCredentials.isOnline) onlineLight = 'icon-off';
                    $('#server-data-status').html($('<i class="icon '+onlineLight+'"></i> <span style="display:block; float: left;">'+data.serverPingCredentials.onlinePlayers+'/'+data.serverPingCredentials.serverSize+'</span>'));
                    $('#server-data-last-online').text(data.serverPingCredentials.addedAt.substr(8,2)+'.'+data.serverPingCredentials.addedAt.substr(5,2)+'.'+data.serverPingCredentials.addedAt.substr(0,4)+'  '+data.serverPingCredentials.addedAt.substr(11,5));
                    if(data.serverPingCredentials.timesOffline > 0)
                    {
                        serverOnlineRatio = (data.serverPingCredentials.timesOnline / data.serverPingCredentials.timesOffline).toFixed(2);
                        if(serverOnlineRatio > 100) serverOnlineRatio = 100.00;
                    } 
                }
                else {
                    $('#server-data-status').html($('<i class="icon icon-off"></i> <span style="display:block; float: left;">0/0</span>'));
                    $('#server-data-last-online').text("??");
                }
                
                
                $('#server-data-top').text(data.stats.maxPlayers);
                
                $('#server-data-page').html($('<a href="'+data.server.homepage+'">'+data.server.homepage+'</a>'));
                $('#server-data-facebook').html($('<a href="'+data.server.facebook+'">'+data.server.facebook+'</a>'));
                $('#server-data-discord').html($('<a href="'+data.server.discord+'">'+data.server.discord+'</a>'));
                $('#server-data-version').text(ReturnServerVersions(data.minecraftServerVersions).versionsString);
                if(data.server.onlineModeEnabled) $('#server-data-online-mode').text("Tak");
                else $('#server-data-online-mode').text("Nie");
                $('#server-data-points').text(data.server.points);
                
                $('#server-data-ratio').text(serverOnlineRatio+'%');
                $('#server-data-rank').text(data.stats.placeInRanking);
                $('#server-data-added').text(data.server.addedAt.substr(8,2)+'.'+data.server.addedAt.substr(5,2)+'.'+data.server.addedAt.substr(0,4)+'  '+data.server.addedAt.substr(11,5));
                //$('#server-data-desc').text(data.server.description);
                $('#server-data-desc').html(data.server.htmlDescription);
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
                    if(chartData.content[k].onlinePlayers >= 0) {
                        time.push(chartData.content[k].addedAt);
                        players.push(chartData.content[k].onlinePlayers);
                    }
                }
                chart.data.datasets[0].data = players.reverse();
                chart.data.labels = time.map(t => (t.substr(0,10) + ' ' + t.substr(11,5))).reverse();

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
                xhrFields: {
                    withCredentials: true
                },
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
                complete: function(xhr, textStatus) {
                    console.log("Complete: "+xhr.status + " " +textStatus);
                    if(xhr.status != 200) $('#modal_like-message').text(xhr.responseJSON.message);
                }
            }).done(res => {
                $('#modal_like').modal('toggle');
                alert("Mail został wysłany. Oczekuje na potwierdzenie");
            })
        }
        
        function CopyOnClick() {
            navigator.clipboard.writeText(data.serverHostCredentials.host+':'+data.serverHostCredentials.port);
            console.log('Content copied to clipboard');

            //alert('Skopiowano ip serwera');
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
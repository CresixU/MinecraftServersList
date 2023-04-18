
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            .body-version, .version-number {
                transition: .3s;
            }
            .body-version:hover, .version-number:hover {
                cursor: help;
                color: var(--href-color2);
            }
            .body-web {
                overflow: hidden;
            }
            .body-web:hover {
                overflow: visible;
            }
            .servers-filter label {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
                position: relative;
                top: 0px;
            }
            .servers-filter .form-control {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                border: none;
                border-left: 2px solid var(--main-color);
                border-right: 2px solid var(--main-color);
                border-radius: 10px;
                color: #dfd7cc;
            }
            .servers-filter .form-control:active, .form-control:focus {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                color: #dfd7cc;
            }
            .servers-filter .form-control option {
                color: #dfd7cc;
                background-color: black;
            }
            .servers-filter > div {
                padding: 0px 10px;
                float:left;
            }

            #ad-servers-list > div {
                padding: 20px;
            }
            #ad-servers-list img {
                width: 100%;
                height: 150px;
            }
            .server-url a {
                text-decoration: none;
                color: #bed484;
                transition: all .3s;
            }
            .server-url a:hover {
                color: #b0db3e;
            }
            .filters {
                color: #dfd7cc;
            }
            .filters ul {
                list-style-type: none;
                margin-top: 10px;
            }
            .filters li {
                color: #b1a697;
                cursor: pointer;
                margin: 5px 0px;
                transition: all 0.5s;
            }
            .filters li:hover {
                color: var(--href-color2);
            }
            .filters p {
                padding-left: 32px;
                color: var(--href-color);
            }

            .banner {
                border: 2px solid rgb(40, 120, 31);
                padding: 40px 20px !important;
                justify-content: center;
                display: flex;
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
                    <div class="col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    Promowane serwery
                                </div>
                                <div class="panel-header-addon">
                                    <a href="promote-server.php" class="btn-green">Promuj swój serwer</a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="promoted-servers-items">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-3" id="ad-servers-list" style="margin: 10px 0px;">
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-header-input">
                                    <input type="text" id="input_search" placeholder="Wyszukaj...">
                                    <buttton type="button" class="btn-search" id="button_search"></buttton>
                                </div>
                                <div class="panel-header-promote">
                                    <div class="promoting-text">Tylko promowane serwery:</div>
                                    <div class="promoting-switch"><div class="switch-button" id="button_switch_premium"></div></div>
                                </div>
                                <div class="panel-header-pagination">
                                    <a onclick="GetServers(currentPage-=1,sizeRecords,isPromoted,searchPhrase,sortBy)" class="pagination-arrow-left"></a>
                                    <ul id="pagination-list">
                                    </ul>
                                    <a onclick="GetServers(currentPage+=1,sizeRecords,isPromoted,searchPhrase,sortBy)" class="pagination-arrow-right"></a>
                                </div>
                            </div>
                            <div class="panel-content panel-list-content">
                                <div class="table-list">
                                    <div class="table-list-head">
                                        <div class="head-rank">Rank.</div>
                                        <div class="head-name">Nazwa Serwera</div>
                                        <div class="head-web">Strona Serwera</div>
                                        <div class="head-players table_filter_button" data-filter="players"><i class="icon icon-players"></i></div>
                                        <div class="head-points table_filter_button" data-filter="points"><i class="icon icon-points"></i></div>
                                        <div class="head-ratio"><i class="icon icon-ratio"></i></div>
                                        <div class="head-mode"><i class="icon icon-online"></i></div>
                                        <div class="head-version"><i class="icon icon-version"></i></div>
                                        <div class="head-verified"><i class="icon icon-verify"></i></div>
                                        <div class="head-likes table_filter_button" data-filter="likes"><i class="icon icon-likes"></i></div>
                                        <div class="head-rate table_filter_button" data-filter="rating"><i class="icon icon-rate"></i></div>
                                    </div>
                                    <div class="table-list-content">
                                    
                                    </div>
                                </div>
                                <div class="list-footer row" style="margin: 10px 0px 0px 0px">
                                    <div class="col col-12" style="display: flex;justify-content: flex-end;margin-bottom: 12px;">
                                        <span id="last-updated-datetime" style="padding-top: 10px;"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="panel filters">
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    Filtrowanie serwerów
                                </div>
                            </div>
                            <div class="panel-content row">
                                <div class="col col-6">
                                    <h4 class="text-center">Filtruj po trybie gry</h4>
                                    <p>Aktualnie wybrane filtrowanie: <span id="gamemode-selected-filter">Brak </span></p>
                                    <ul id="servers-filter-gamemodes">
                                        <li onclick="FilterByGamemode('Brak')">Wszystkie tryby gry serwerów Minecraft</li>
                                    </ul>
                                </div>
                                <div class="col col-6">
                                    <h4 class="text-center">Filtruj po wersji serwera</h4>
                                    <p>Aktualnie wybrane filtrowanie: <span id="gameversion-selected-filter">Brak </span></p>
                                    <ul id="servers-filter-gameversions">
                                    <li onclick="FilterByGameversion('Brak')">Wszystkie wersje serwerów Minecraft</li>
                                    </ul>
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
        <script type="text/javascript" src="js/server-service.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var promotedData;
            var currentPage = 0;
            var isPromoted = false;
            var searchPhrase = "";
            var sizeRecords = 20;
            var sortBy = 'points';
            var filterByLikesASC = false;
            var filterByRatingASC = false;
            var filterByPlayersASC = false;
            var filterByPointsASC = false;
            var gamemodeFilter = 'Brak';
            var gameversionFilter = 'Brak';

            $('#nav-serwery').addClass('active');

            $.ajax({
                url: api_url+'/api/v1/servers/last-ping/',
            }).done(res => {
                var str = 'Ostatnie sprawdzenie: '+res.timestamp.substr(8,2)+'.'+res.timestamp.substr(5,2)+'.'+res.timestamp.substr(0,4)+'  '+res.timestamp.substr(11,5);
                $('#last-updated-datetime').text(str);
            })

            function GetServers(page,size,promoted,search,sort_by) {
                currentPage = page;
                if(data && page >= Math.ceil(data.total/size)) currentPage = Math.ceil(data.total/size)-1;
                if(search=='' || search == null) search = "";
                var apiUrl;
                sizeRecords = size;
                isPromoted = promoted;
                searchPhrase = search;
                sortBy = sort_by;
                if(currentPage<0) currentPage = 0;
                apiUrl = api_url+"/api/v1/servers/?page="+currentPage+"&size="+sizeRecords+"&search="+searchPhrase+"&promoted="+isPromoted+"&sort_by="+sortBy;
                if(gamemodeFilter != 'Brak') apiUrl += '&game_mode='+gamemodeFilter;
                if(gameversionFilter != 'Brak') apiUrl += '&version='+gameversionFilter;
                console.log(apiUrl)
                $.ajax({
                    url: apiUrl,
                })
                .done(res => {
                    $('.table-list-content').empty();

                    data = res;
                    if(data.content.length == 0) {
                        $('.table-list-content').append($('<p style="color: white; margin-top: 10px;">Brak serwerów z tym kryterium.</p>'));
                        console.log("empty");
                        return;
                    }

                    for(var i=0;i<data.content.length;i++) {
                        var currentServer = data.content[i];
                        var onlineLight = 'icon-off';
                        var serverOnlineRatio = 100.00;
                        var onlineModeIcon = 'icon-verified';
                        var starsId;
                        var promotedClass = '';
                        var onlinePlayers = 0;
                        var serverSize = 0;
                        if(currentServer.server.promoted) promotedClass = 'premium';
                        if(currentServer.serverPingCredentials != null) {
                            onlinePlayers = currentServer.serverPingCredentials.onlinePlayers;
                            serverSize = currentServer.serverPingCredentials.serverSize;
                            
                            if(currentServer.serverPingCredentials.isOnline)  onlineLight = 'icon-on'

                            if(currentServer.serverPingCredentials.timesOffline > 0) {
                                serverOnlineRatio = (currentServer.serverPingCredentials.timesOnline / currentServer.serverPingCredentials.timesOffline).toFixed(2);
                            }
                        }
                        

                        if(!currentServer.server.onlineModeEnabled) onlineModeIcon = 'icon-no-verified';

                        $('.table-list-content').append($('<a href="./server.php?id='+currentServer.server.id+'"><div class="table-list-row '+promotedClass+'"><div class="body-rank">'+(currentServer.stats.placeInRanking)+'.</div><div class="body-name">'+currentServer.server.name+'</div><div class="body-web">'+currentServer.server.homepage+'</div><div style="margin-left: 5px;" class="body-players">'+onlinePlayers+'/'+serverSize+' <i style="margin-left: auto; margin-right: 5px;" class="icon '+onlineLight+'"></i></div><div class="body-points">'+currentServer.server.points+'</div><div class="body-ratio">'+serverOnlineRatio+'%</div><div class="body-mode"><i class="icon '+onlineModeIcon+'"></i></div><div class="body-version" title="'+(ReturnServerVersions(currentServer.minecraftServerVersions).versionsString ?? '?')+'">'+(ReturnServerVersions(currentServer.minecraftServerVersions).formatedVersions ?? '?')+'</div><div class="body-verified"><i class="icon icon-no-verified"></i></div><div class="body-likes">'+currentServer.likes.likes+'</div><div class="body-rate"><div class="stars" id="stars_'+i+'"></div><span>'+currentServer.rate.rate+'</span></div></div></a>'));
                        ShowStarsRate("stars",i,currentServer.rate.rate);
                    }
                    ChangePage(currentPage);
                });
            }

            GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
            ShowPromotedServersPanel();
            

            //Search input
            $('#button_search').on('click', function() {
                searchPhrase = $('#input_search').val();
                GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
            });

            //Premium button
            $('#button_switch_premium').on('click',function() {
                if(isPromoted) {
                    $('#button_switch_premium').css('right','21px');
                    isPromoted = false;
                    GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
                }
                else {
                    $('#button_switch_premium').css('right','4px');
                    isPromoted = true;
                    GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
                }
            })


            //Return Stars in table
            function ShowStarsRate(name,elementId,value) {
                starsId = ('#'+name+'_'+elementId).toString();
                for(var i=0;i<5;i++) {
                    if(i<value) {
                        $(starsId).append($('<div class="star star-full"></div>'));
                    }
                    else {
                        $(starsId).append($('<div class="star star-empty"></div>'));
                    }
                }
            }

            //Filter by likes, rating, promoted
            //Possible filter likes, -likes, rate, -rate, +players, -players
            $('.table_filter_button').on('click', function() {
                if($(this).data('filter') == 'likes') {
                    if(filterByLikesASC) {
                        filterByLikesASC = false;
                        sortBy = '-likes';
                    }
                    else {
                        filterByLikesASC = true;
                        sortBy = 'likes';
                    }
                }
                if($(this).data('filter') == 'rating') {
                    if(filterByRatingASC) {
                        filterByRatingASC = false;
                        sortBy = '-rate';
                    }
                    else {
                        filterByRatingASC = true;
                        sortBy = 'rate';
                    }
                }
                if($(this).data('filter') == 'players') {
                    if(filterByPlayersASC) {
                        filterByPlayersASC = false;
                        sortBy = '-players';
                    }
                    else {
                        filterByPlayersASC = true;
                        sortBy = 'players';
                    }
                }
                if($(this).data('filter') == 'points') {
                    if(filterByPointsASC) {
                        filterByPointsASC = false;
                        sortBy = '-points';
                    }
                    else {
                        filterByPointsASC = true;
                        sortBy = 'points';
                    }
                }
                GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
            });

            function ShowPromotedServersPanel() {
                $.ajax({
                    url: api_url+"/api/v1/servers/?promoted=true",
                })
                .done(res => {
                    $('.promoted-servers-items').empty();
                    promotedData = res;
                    if(promotedData.content.length == 0) {
                        $('.promoted-servers-items').append($('<p style="color: white; margin-top: 10px;">Brak promowanych serwerów</p>'));
                        return;
                    }

                    for(var i=0;i<5;i++) {
                        var currentServer = promotedData.content[i];
                        if(!currentServer) return;
                        var onlineLight = 'icon-on';
                        var serverOnlineRatio = 100.00;
                        var onlineModeIcon = 'icon-verified';
                        var starsId;
                        if(!currentServer.serverPingCredentials.isOnline)  onlineLight = 'icon-off'

                        if(currentServer.serverPingCredentials.timesOffline > 0) {
                            serverOnlineRatio = (currentServer.serverPingCredentials.timesOnline / currentServer.serverPingCredentials.timesOffline).toFixed(2);
                        }

                        if(!currentServer.server.onlineModeEnabled) onlineModeIcon = 'icon-no-verified';

                        $('.promoted-servers-items').append($('<div class="promoted-server-item"><div class="promoted-server-title">'+currentServer.server.name+'</div><div class="promoted-server-players"><i class="icon icon-players"></i><div class="server-players-number">'+currentServer.serverPingCredentials.onlinePlayers+'/'+currentServer.serverPingCredentials.serverSize+'</div><i class="icon '+onlineLight+'"></i></div><div class="promoted-server-rate"><i class="icon icon-rate"></i><div class="rate-number">'+currentServer.rate.rate+'</div><div class="stars" id="starsP_'+i+'"> </div> </div><div class="promoted-server-mode"><i class="icon icon-www"></i><div class="promoted-server-status">Online mode: <i class="icon '+onlineModeIcon+'"></i></div></div><div class="promoted-server-version"><i class="icon icon-version"></i><div class="version-number" title="'+ReturnServerVersions(currentServer.minecraftServerVersions).versionsString+'">Wersja serwera: '+ReturnServerVersions(currentServer.minecraftServerVersions).formatedVersions+'</div></div><div class="promoted-server-web"><div class="server-url"><a href="'+currentServer.server.homepage+'">'+currentServer.server.homepage+'</a></div></div></div>'));
                        ShowStarsRate("starsP",i,currentServer.rate.rate);
                    }
                });
            }

            function ChangePage(page) {
                $('#pagination-list').empty();
                var startPage = 1;
                var maxPages = Math.ceil(data.total/sizeRecords);
                if(currentPage > 4) startPage = currentPage - 4;
                if(currentPage+4 < maxPages) maxPages = currentPage+4; 
                for(var i=startPage; i<=maxPages;i++) {
                    if(i==currentPage+1) 
                        $('#pagination-list').append($('<li><a class="active">'+i+'</a></li>'));
                    else
                        $('#pagination-list').append($('<li><a onclick="GetServers('+(i-1)+','+sizeRecords+','+isPromoted+',searchPhrase, sortBy)">'+i+'</a></li>'));
                }
            }  
            
            function ShowAdServers() {
                $.ajax({
                    url: api_url+'/api/v1/banner/?random=true'
                }).done(res => {
                    if(res.length % 2 == 0)
                        $('#ad-servers-list').append($('<div class="col col-6"><div class="banner"><a href="account-ad.php"><button class="simple-button">Wynajmij miejsce reklamowe</button></a></div></div>'), $('<div class="col col-6"><div class="banner"><a href="account-ad.php"><button class="simple-button">Wynajmij miejsce reklamowe</button></a></div></div>'));
                    else
                        $('#ad-servers-list').append($('<div class="col col-6"><div class="banner"><a href="account-ad.php"><button class="simple-button">Wynajmij miejsce reklamowe</button></a></div></div>'));

                    res.forEach(x => {
                        $('#ad-servers-list').append($('<div class="col col-6"><img data-href="'+x.link+'" onclick="BannerClick(event,\''+x.id+'\')" id="'+x.id+'" src="'+api_url+'/resources/'+x.fileName+'"></div>'));
                    })
                })
            }
            ShowAdServers()

            function BannerClick(e,id) {
                $.ajax({
                    type: 'POST',
                    url: api_url+'/api/v1/banner/statistics/'+id+'/',
                    xhrFields: {
                        withCredentials: true
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        window.open($('#'+id).data('href'),"_blank");
                    } 
                })
            }
            
            
            $.ajax({
                url: api_url+'/api/v2/game-modes/?status=ACCEPTED&aggregator=BY_SERVERS_COUNT&page=0&size=50',
            }).done(res => {
                var availableGM = res.content.filter(x => x.servers_count > 0);
                availableGM.forEach(x => $('#servers-filter-gamemodes').append($('<li onclick="FilterByGamemode(\''+x.game_mode+'\')">Serwer Minecraft '+x.game_mode+'</li>')));
            });
            $.ajax({
                url: api_url+'/api/v1/servers/versions/?aggregator=BY_SERVERS_COUNT',
            }).done(res => {
                var availableGV = res.filter(x => x.servers_count > 0);
                availableGV.forEach(x => $('#servers-filter-gameversions').append($('<li onclick="FilterByGameversion(\''+x.version+'\')">Serwery Minecraft '+x.version+'</li>')));
            });


            function FilterByGamemode(gamemode) {
                gamemodeFilter = gamemode;
                $('#gamemode-selected-filter').text(gamemodeFilter);
                GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
            }

            function FilterByGameversion(version) {
                gameversionFilter = version;
                $('#gameversion-selected-filter').text(gameversionFilter);
                GetServers(currentPage,sizeRecords,isPromoted,searchPhrase,sortBy);
            }

        </script>
    </body>
</html>
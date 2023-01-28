
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
    </head>
    <body>
        <?php $api = require("config.php"); ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v11.0&appId=915876171902531&autoLogAppEvents=1" nonce="k7fGxMia"></script>
        <nav>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="menu">
                            <ul>
                                <li><a href="">Konto</a></li>
                                <li class="active"><a href="">Serwery</a></li>
                                <li><a href="">Partnerzy</a></li>
                                <li><a href="">Statystyki</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="facebook-likebox">
                            <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="" class="logo">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    Promowane serwery
                                </div>
                                <div class="panel-header-addon">
                                    <a href="" class="btn-green">Promuj swój serwer</a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="promoted-servers-items">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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
                                    <a onclick="GetServers(currentPage-1,sizeRecords,isPromoted,searchPhrase,sortBy)" class="pagination-arrow-left"></a>
                                    <ul id="pagination-list">
                                    </ul>
                                    <a onclick="GetServers(currentPage+1,sizeRecords,isPromoted,searchPhrase,sortBy)" class="pagination-arrow-right"></a>
                                </div>
                            </div>
                            <div class="panel-content panel-list-content">
                                <div class="table-list">
                                    <div class="table-list-head">
                                        <div class="head-rank">Rank.</div>
                                        <div class="head-name">Nazwa Serwera</div>
                                        <div class="head-web">Strona Serwera</div>
                                        <div class="head-players"><i class="icon icon-players"></i></div>
                                        <div class="head-points"><i class="icon icon-points"></i></div>
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
                                <div class="list-footer">
                                    <span id="last-updated-datetime"> </span>
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
            var promotedData;
            var currentPage = 0;
            var isPromoted = false;
            var searchPhrase = "";
            var sizeRecords = 10;
            var sortBy = 'likes';
            var filterByLikesASC = false;
            var filterByRatingASC = false;

            function GetServers(page,size,promoted,search,sort_by) {
                if(page<0) page = 0;
                if(data && page>= data.total%size) page = (data.total%size)-1;
                if(search=='' || search == null) search = "";
                var apiUrl;
                currentPage = page;
                sizeRecords = size;
                isPromoted = promoted;
                searchPhrase = search;
                sortBy = sort_by;
                apiUrl = api_url+"/api/v1/servers/?page="+currentPage+"&size="+sizeRecords+"&search="+searchPhrase+"&promoted="+isPromoted+"&sort_by="+sortBy;

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
                    var str = 'Ostatnie sprawdzenie: '+data.content[0].serverPingCredentials.addedAt.substr(8,2)+'.'+data.content[0].serverPingCredentials.addedAt.substr(5,2)+'.'+data.content[0].serverPingCredentials.addedAt.substr(0,4)+'  '+data.content[0].serverPingCredentials.addedAt.substr(11,5);
                    $('#last-updated-datetime').text(str);

                    for(var i=0;i<data.content.length;i++) {
                        var currentServer = data.content[i];
                        var onlineLight = 'icon-on';
                        var serverOnlineRatio = 100.00;
                        var onlineModeIcon = 'icon-verified';
                        var starsId;
                        var promotedClass = '';
                        if(currentServer.server.promoted) promotedClass = 'premium';
                        if(!currentServer.serverPingCredentials.isOnline)  onlineLight = 'icon-off'

                        if(currentServer.serverPingCredentials.timesOffline > 0) {
                            serverOnlineRatio = (currentServer.serverPingCredentials.timesOnline / currentServer.serverPingCredentials.timesOffline).toFixed(2);
                        }

                        if(!currentServer.server.onlineModeEnabled) onlineModeIcon = 'icon-no-verified';

                        $('.table-list-content').append($('<a href="./server.php?id='+currentServer.server.id+'"<div class="table-list-row '+promotedClass+'"><div class="body-rank">'+(i+1)+'.</div><div class="body-name">'+currentServer.server.name+'</div><div class="body-web">'+currentServer.server.homepage+'</div><div style="margin-left: 5px;" class="body-players">'+currentServer.serverPingCredentials.onlinePlayers+'/'+currentServer.serverPingCredentials.serverSize+' <i style="margin-left: auto; margin-right: 5px;" class="icon '+onlineLight+'"></i></div><div class="body-points">'+currentServer.server.points+'</div><div class="body-ratio">'+serverOnlineRatio+'%</div><div class="body-mode"><i class="icon '+onlineModeIcon+'"></i></div><div class="body-version">'+ReturnServerVersion(currentServer)+'</div><div class="body-verified"><i class="icon icon-no-verified"></i></div><div class="body-likes">'+currentServer.likes.likes+'</div><div class="body-rate"><div class="stars" id="stars_'+i+'"></div><span>'+currentServer.rate.rate+'</span></div></div></a>'));
                        ShowStarsRate("stars",i,currentServer.rate.rate);
                        ChangePage(currentPage);
                    }
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

            //Return server version
            function ReturnServerVersion(thisServer) {
                if(!thisServer.minecraftServerVersions[0]) return "??";
                var text = thisServer.minecraftServerVersions[0].minecraftVersion.version.split(',');
                if(text.length>1) {
                    return '>'+text[0];
                }
                return text[0];
            }

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
            //Possible filter likes, -likes, rate, -rate
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

                        $('.promoted-servers-items').append($('<div class="promoted-server-item"><div class="promoted-server-title">MinecraftServerName</div><div class="promoted-server-players"><i class="icon icon-players"></i><div class="server-players-number">'+currentServer.serverPingCredentials.onlinePlayers+'/'+currentServer.serverPingCredentials.serverSize+'</div><i class="icon '+onlineLight+'"></i></div><div class="promoted-server-rate"><i class="icon icon-rate"></i><div class="rate-number">'+currentServer.rate.rate+'</div><div class="stars" id="starsP_'+i+'"> </div> </div><div class="promoted-server-mode"><i class="icon icon-www"></i><div class="promoted-server-status">Online mode: <i class="icon '+onlineModeIcon+'"></i></div></div><div class="promoted-server-version"><i class="icon icon-version"></i><div class="version-number">Wersja serwera '+ReturnServerVersion(currentServer)+'</div></div><div class="promoted-server-web"><div class="server-url">'+currentServer.server.homepage+'</div></div></div>'));
                        ShowStarsRate("starsP",i,currentServer.rate.rate);
                    }
                });
            }

            function ChangePage(page) {
                $('#pagination-list').empty();
                var startPage = 1;
                var maxPages = data.total;
                if(currentPage > 4) startPage = currentPage - 4;
                if(currentPage+4 < maxPages) maxPages = currentPage+4; 
                for(var i=startPage; i<=maxPages;i++) {
                    if(i==currentPage+1) 
                        $('#pagination-list').append($('<li><a onclick="GetServers('+i+','+sizeRecords+','+isPromoted+','+searchPhrase+','+sortBy+')" class="active">'+i+'</a></li>'));
                    else
                        $('#pagination-list').append($('<li><a onclick="GetServers('+i+','+sizeRecords+','+isPromoted+','+searchPhrase+','+sortBy+')">'+i+'</a></li>'));
                }
            }           

        </script>
    </body>
</html>
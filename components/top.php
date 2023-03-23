<nav>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="menu">
                    <ul>
                        <li id="nav-konto"><a href="auth.php?new_user=0">Logowanie</a></li>
                        <li id="nav-register"><a href="auth.php?new_user=1">Rejestracja</a></li>
                        <li id="nav-serwery" ><a href="index.php">Serwery</a></li>
                        <li id="nav-partnerzy" ><a href="partners.php">Partnerzy</a></li>
                        <li id="nav-statystyki" onclick="ToggleStats()"><a style="position: relative;">Statystyki
                            <ol id="stats-desc">
                                <li>Serwery online: <span id="stats-online-servers"></span></li>
                                <li>Użytkownicy: <span id="stats-users"></span></li>
                                <li>Gracze na serwerach: <span id="stats-server-users"></span></li>
                            </ol>
                        </a></li>
                        <li id="nav-logout" style="display:none" onclick="Logout()"><a>Wyloguj</a></li>
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
                <a href="index.php" class="logo">
                    <img src="img/logo.png">
                </a>
            </div>
        </div>
    </div>
</header>
<?php $api = require("config.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    var statsHidden = true;
    var api_url = "<?php echo $api ?>";
    $.ajax({
        url: api_url+'/api/v1/auth/logged/',
        xhrFields: {
            withCredentials: true
        },
        success: function() {
            $('#nav-logout').css('display','list-item');
            $('#nav-register').css('display','none');
            $('#nav-konto').html($('<a href="account.php">Konto</a>'));
            $('nav .menu ul').css('max-width','480px !important');
        }
    })

    function Logout() {
        $.ajax({
            url: api_url+'/api/v1/auth/logout/',
            type: 'DELETE',
            success: console.log('logout'),
            xhrFields: {
                withCredentials: true
            },
        }).done(res => {
            window.location.replace('index.php');
        })
    }

    function ToggleStats() {
        if(statsHidden) {
            $('#stats-desc').css('display','block');
            statsHidden = false;
        }
        else {
            $('#stats-desc').css('display','none');
            statsHidden = true;
        }
    }

    async function ShowStats() {
        await $.ajax({
            url: api_url+'/api/v1/statistics/',
        }).done(res => {
            $('#stats-online-servers').text(res.numberOfOnlineServers+'/'+res.numberOfServers);
            $('#stats-users').text(res.numberOfUsers);
            $('#stats-server-users').text(res.numberOfOnlinePlayers);
        })
    }

    ShowStats();
</script>
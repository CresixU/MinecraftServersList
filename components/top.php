    <nav>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="menu">
                        <ul>
                            <li id="nav-konto"><a href="account.php">Konto</a></li>
                            <li id="nav-serwery" ><a href="index.php">Serwery</a></li>
                            <li id="nav-partnerzy" ><a href="partners.php">Partnerzy</a></li>
                            <li id="nav-statystyki" ><a href="">Statystyki</a></li>
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
                    <a href="" class="logo">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <?php $api = require("config.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        var api_url = "<?php echo $api ?>";
        $.ajax({
            url: api_url+'/api/v1/auth/logged/',
            success: function() {
                $('#nav-logout').css('display','list-item');
            }
        })

        function Logout() {
            $.ajax({
                url: api_url+'/api/v1/auth/logout/',
                type: 'DELETE',
                success: console.log('logout'),
            })
        }
    </script>
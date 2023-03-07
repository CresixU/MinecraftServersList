
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
            .ad-storage-item .edit-ad {
                display: block;
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
            select {
                width: 100%;
                background-color: #110b08;
                color: white;
                padding: 2px 5px;
                border: 1px solid #110b08;
                border-bottom: 2px solid var(--main-color);
                border-radius: 8px;
            }

            .web-link {
                width: 100%;
                margin-bottom: 5px; 
                border-bottom: 2px solid var(--main-color); 
                padding: 4px; color: white;
            }
            .btn-green:hover {
                color: inherit;
            }
            .btn-green {
                animation: pulseButton 3s infinite;
                margin-left: auto;
                margin-right: auto;
            }
            @keyframes pulseButton {
                0% {
                    filter: brightness(1) drop-shadow(0px 0px 0px #73a721);
                }
                50% {
                    filter: brightness(1.3) drop-shadow(0px 0px 20px #73a721);
                }
                100% {
                    filter: brightness(1) drop-shadow(0px 0px 0px #73a721);
                }
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

                <!-- MODAL Stats -->
                    <div class="modal fade" id="modal_stats" tabindex="-1" role="dialog" aria-labelledby="modal_stats" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Statystyki reklam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_stats').modal('toggle');">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-3">
                                    <p>Łączna liczba kliknięć: <span id="modal_stats-sum-clicks"></span></p>
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <td>Data</td>
                                                <td>Liczba kliknięć</td>
                                            </tr>
                                        </thead>
                                        <tbody id="modal_stats-table">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                <!-- MODAL Renew -->
                <div class="modal fade " id="modal_renew" tabindex="-1" role="dialog" aria-labelledby="modal_renew" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Odnowienie reklamy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_renew').modal('toggle');">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-3">
                                    <input type="text" id="modal_renew-id" style="display: none;">
                                    <div>
                                        <label for="modal-method" style="top:0;">Forma płatności</label>
                                        <select id="modal-method" class="calculate-price">
                                            <option value="Brak" selected disabled>Wybierz</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="modal-daysToReserve">Dni do rezerwacji</label>
                                        <input type="text" id="modal-daysToReserve" class="calculate-price">
                                    </div>
                                    <div id="modal_renew-button"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="ButtonAdExtendAction()">Odnów</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_renew').modal('toggle');">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <!-- Reklama -->
                                <div class="panel-content-ad row">
                                    <div class="col col-12">
                                        <div class="col col-12">
                                            <p><b>Uwaga:</b> Banery reklamowe na stronie głównej wyświetlane są w losowej kolejności, kolejnośc miejsca reklamowego podczas wynajmu nie ma znaczenia.</p>
                                        </div>
                                    </div>
                                    <div class="col col-12">
                                        <div class="panel-content-ad-storage row w-100 mx-auto">

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="panel-content-create-ad" style="display:none">
                                    <p class="second-header">Spersonalizuj baner reklamowy</p>
                                    <form action="" method="post" enctype="multipart/form-data" id="adform" style="max-width: 600px; margin: auto;">
                                        <div>
                                            <label for="file" class="mb-3" accept="image/png, image/jpeg, image/gif">Wybierz tło baneru <span style="color: #008f04;">(plik 1920x1270px)</span></label>
                                            <input name="file" type="file" id="file">
                                        </div>
                                        <div>
                                            <label for="link">Odnośnik dla baneru</label>
                                            <input name="link"  type="text" id="link">
                                        </div>
                                        <div>
                                            <label for="serverId" style="top:0;">Serwer</label>
                                            <select id="serverId" name="serverId">
                                                <option value="Brak" selected disabled>Wybierz</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="method" style="top:0;">Forma płatności</label>
                                            <select id="method" class="calculate-price" name="method">
                                                <option value="Brak" selected disabled>Wybierz</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="daysToReserve">Dni do rezerwacji</label>
                                            <input type="text" id="daysToReserve" class="calculate-price" name="daysToReserve">
                                        </div>
                                        <div>
                                            <label for="promotionalCode">Kod promocyjny</label>
                                            <input type="text" id="promotionalCode" class="calculate-price" name="promotionalCode">
                                        </div>
                                        <div class="mt-3">
                                            <p style="text-align: right">Cena: <span id="calculated-price">0</span> zł</p>
                                        </div>
                                        <div id="createAd-response"></div>
                                        <div>
                                            <input type="button" value="Zakup baner" class="simple-button mx-auto" onclick="SendData()">
                                        </div>
                                    </form>
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
        <script src="js/payment-services.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;
            var totalAds = 0;
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
                    $('.panel-header').append($('<div class="col"><a href="admin-servers.php">Panel Administratora</a></div>'));
                    
                }
            })

            function GenerateEmptyAds() {
                
                for(var i=0; i<(6-totalAds); i++) {
                    $('.panel-content-ad-storage').append($('<div class="ad-storage-item col col-12 col-lg-6"><div class="row" style="justify-content: center; display: flex"><div class="col col-12"><p>To miejsce reklamowe jest wolne, możesz je wynająć</p></div><div class="col col-12"><button class="simple-button" onclick="ShowCreateAd()">Wynajmij</button></div></div></div>'));
                }
            }
            async function ShowOwnerServers() {
                await $.ajax({
                    url: api_url+'/api/v1/servers/own/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res;
                    if(data.content.length == 0) return;
                    $('#serverId').empty();
                    data.content.forEach(x => {
                        $('#serverId').append($('<option value="'+x.server.id+'">'+x.server.name+'</option>'));   
                    });
                })
            }

            function ShowCreateAd() {
                ShowOwnerServers();
                $('#panel-content-create-ad').css('display','block');
            }

            function ShowAds() {

                $.ajax({
                    url: api_url+'/api/v1/banner/own/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    totalAds = res.length;
                    console.log(res);
                    var i = 0;
                    res.forEach(x => {
                        $('.panel-content-ad-storage').append($('<div class="ad-storage-item col col-12 col-lg-6"><div class="row"><div class="col col-12 edit-ad"><label for="edit-ad-link_'+i+'">Link do strony serwera</label><input type="text" id="edit-ad-link_'+i+'" placeholder="Link do strony" class="web-link" value="'+x.link+'"></div><div class="col col-12 edit-ad"><label for="edit-ad-file_'+i+'" style="top: 0">Zmiana baneru (wymiary 1920x1270px)</label><input type="file" id="edit-ad-file_'+i+'" class="pl-3" style="margin-left: 20px;" accept="image/png, image/jpeg, image/gif"></div><div class="col col-12"><p style="text-align: center">Wynajem do '+ReturnStringDate(x.expiresAt)+'<br>'+ReturnRemainDays(x.expiresAt)+'</p></div><div class="col col-12" style="justify-content: center; display: flex;"><button onclick="ButtonAdSave(\''+i+'\',\''+x.id+'\')" class="simple-button mx-3">Zapisz</button><button onclick="ButtonAdStatistics(\''+x.id+'\')" class="simple-button mx-3">Statystyki</button><button onclick="ButtonAdExtend(\''+x.id+'\')" class="simple-button mx-3">Przedłuż</button></div></div></div>'))
                        i++;
                    })
                    GenerateEmptyAds();
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

            function ReturnRemainDays(date) {
                var remain = Date.parse(date) - Date.now();
                var remainDays = Math.floor((((remain/1000)/60)/60)/24);
                if(remainDays >= 0) return 'Zostało '+remainDays+' dni';
                else return 'Reklama wygasła';
            }

            $('.calculate-price').on('change', function() {
                if($('#method').val() == null) return;
                if($('#daysToReserve').val() == '') return;

                var fullUrl = api_url+'/api/v1/banner-payments/calculate/?days='+$("#daysToReserve").val()+'&method='+$('#method').val();
                if($('#promotionalCode').val() != '') fullUrl += '&promotionalCode='+$('#promotionalCode').val();

                $.ajax({
                    url: fullUrl,
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res=>{
                    $('#calculated-price').text(res.price);
                })
            })

            function SendData() {
                var vcfData = new FormData($('#adform')[0]); 
                $.ajax({
                    url : api_url+'/api/v1/banner-payments/',
                    type : "POST",
                    data : vcfData,
                    processData: false,
                    contentType: false,
                    cache : false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success : function(data) {
                    },
                    complete: function(xhr, textStatus) {
                        if(xhr.status != 200) $('#createAd-response').html($('<p class="mt-3" style="color: red">'+xhr.responseJSON.message+'</p>'));
                    }
                }).done(res => {
                    var win = window.open(res.paymentUrl, '_blank');
                    if (win) {
                        win.focus();
                    } else {
                        alert('Wymagane zezwolenie na wyskakujące okna na stronie. W celu dokonania płatności kliknij w pulsujący zielony guzik');
                    }
                    $('form').append($('<div><a href="'+res.paymentUrl+'" class="btn-green">Przejdź do płatności</a></div>'));
                })   
            }

            function ButtonAdSave(id,adId) {
                var link = $('#edit-ad-link_'+id).val();
                $.ajax({
                    url: api_url+'/api/v1/banner/'+adId+'/',
                    type: 'PATCH',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: '{"link": "'+link+'"}',
                    xhrFields: {
                        withCredentials: true
                    },
                    complete: function(xhr, textStatus) {
                        if(xhr.status != 200) alert(xhr.responseJSON.message);
                        else alert('Zaaktualizowano dane');
                    } 
                })
            }
            async function ButtonAdStatistics(adId) {
                $('#modal_stats-table').empty();
                await $.ajax({
                    url: api_url+'/api/v1/banner/statistics/'+adId+'/clicks/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    $('#modal_stats-sum-clicks').text(res.clicks);
                })
                await $.ajax({
                        url: api_url+'/api/v1/banner/statistics/'+adId+'/',
                        xhrFields: {
                            withCredentials: true
                        },
                    }).done(res => {
                        res.forEach(x => $('#modal_stats-table').append($('<tr><td>'+x.date+'</td><td>'+x.clicks+'</td></tr>')));
                    })
                $('#modal_stats').modal('toggle'); 
            }
            function ButtonAdExtend(adId) {
                $('#modal_renew').modal('toggle'); 
                $('#modal_renew-id').val(adId)
            }
            async function ButtonAdExtendAction() {
                var adId = $('#modal_renew-id').val();
                var modalMethod = $('#modal-method').val();
                var modalDays = $('#modal-daysToReserve').val();
                await $.ajax({
                    url: api_url+'/api/v1/banner-payments/renew/'+adId+'/',
                    type: 'POST',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: '{"days": '+modalDays+',"method": "'+modalMethod+'"}',
                    xhrFields: {
                        withCredentials: true
                    },
                    complete: function(xhr, textStatus) {
                        if(xhr.status != 200) alert(xhr.responseJSON.message);
                    } 
                }).done(res => {
                    var win = window.open(res.payment.url, '_blank');
                    if (win) {
                        win.focus();
                    } else {
                        alert('Wymagane zezwolenie na wyskakujące okna na stronie. W celu dokonania płatności kliknij w pulsujący zielony guzik');
                    }
                    $('#modal_renew-button').append($('<div><a href="'+res.payment.url+'" class="btn-green mt-3">Przejdź do płatności</a></div>'));
                }) 
            }



            ShowAds()
            $.ajax({
                url: api_url+'/api/v1/banner-payments/available-methods/',
                xhrFields: {
                        withCredentials: true
                    },
            }).done(res => {
                res.forEach(x => $('#method').append($('<option value="'+x+'">'+ReturnPaymentType(x)+'</option>')));
                res.forEach(x => $('#modal-method').append($('<option value="'+x+'">'+ReturnPaymentType(x)+'</option>')));    
            })
            
        </script>
        
    </body>
</html>
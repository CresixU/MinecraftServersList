
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="description" content="Serwery Minecraft - Znajdź i promuj swoje serwery Minecraft. Minecraft-List.pl to platforma, na której możesz odkrywać różnorodne serwery Minecraft, znaleźć społeczność graczy i promować swój własny serwer. Przeglądaj setki serwerów, oceniaj je i wybieraj najlepsze miejsce do gry. Dodawaj swój serwer na naszej stronie i dotrzyj do szerokiego grona graczy. Zapraszamy do świata Minecraft na Minecraft-List.pl!">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="autocomplete/tokenize2.css">
        <script src="js/payment-services.js"></script>
        

        <style>
            body {
                color: #dfd7cc;
            }
            .panel-header a {
                color: var(--href-color);
                text-decoration: none;
            }
            button {
                color: var(--href-color);
            }
            label:not(.not-label) {
                margin-top: 10px;
                width: 100%;
                color: var(--href-color);
                position: relative;
                top: 10px;
            }
            input[type=text],
            input[type=password],
            input[type=number] {
                width: 100%;
                padding: 8px 12px;
                color: white;
                border: none;
                border-bottom: 2px solid var(--main-color);
                border-radius: 8px;
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
            .date {
                width: auto !important;
            }
            select:focus {
                outline: none;
            }
            .panel-content > div:not(#codes-list) {
                padding-bottom: 20px;
                max-width: 700px;
                margin: 0 auto;
            }
            .code-item-around {
                padding: 15px 10px;
                justify-content: center;
                display: flex;
            }

            .code-item {
                position: relative;
                z-index: 0;
                max-width: 200px;
            }
            .code-item > div {
                background-color: black;
                border-radius: 20px;
                padding: 20px;
                min-width: 170px;
            }
            .code-item::before {
                content: '';
                position: absolute;
                background-color: red;
                z-index: -1;
                top: 0px;
                left: 0px;
                right: 0px;
                bottom: 0px;
                border-radius: 20px;
                transform: skew(2deg, 2deg);
                background: linear-gradient(315deg, #05fc4f, #0abcfc);
            }
            .code-item p {
                text-align: center;
            }
            .code-item p:nth-child(odd) {
                margin-bottom: 0px;
                color: #f9da9d;
            }

            .close {
                float: right;
                position: relative;
                top: -4px;
                right: 10px;
            }
            .close span {
                font-size: 25px;
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
                                    <!--MODAL IP DELETE -->
                                    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Usuwanie IP z listy</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć ip <span id="modal_delete-ip"></span>?</p>
                                                    <p id="modal_delete-id"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalDeleteIpAction()">Tak</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_delete').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL DOMAIN DELETE -->
                                    <div class="modal fade" id="modal_delete2" tabindex="-1" role="dialog" aria-labelledby="modal_delete2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Usuwanie Domeny z listy</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_delete2').modal('toggle');">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Czy chcesz usunąć domene <span id="modal_delete-domain"></span>?</p>
                                                    <p id="modal_delete-domain"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" onclick="ModalDeleteDomainAction()">Tak</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal_delete2').modal('toggle');">Anuluj</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                <div class="row mb-5">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header d-flex justify-content-around">
                                <a href="admin-servers.php" class="simple-button align-center">Lista serwerów</a>
                                <a href="admin-users.php" class="simple-button">Lista userów</a>
                                <a href="admin-blocked-services.php" class="simple-button">Zablokowane serwisy</a>
                                <a href="admin-codes.php" class="simple-button">Generator kodów</a>
                                <a href="admin-gamemodes.php" class="simple-button">Tryby gry</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    Aktualne kody zniżkowe
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="d-flex justify-content-around row" id="codes-list" style="padding: 0 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col col-12">
                    <div class="panel">
                        <div class="panel-header">
                            <p class="mb-0">Generator kodów</p>
                        </div>
                        <div class="panel-content">
                            <div>
                                <label for="code" id="code-label">Kod</label>
                                <input type="text" id="code-port" placeholder="Wpisz kod">
                            </div>
                            <div class="date-container">
                                <label for="expire-date">Data wygaśnięcia kodu</label>
                                <select name="expire-date" id="year" class="date"></select>
                                <select name="expire-date" id="month" class="date"></select>
                                <select name="expire-date" id="day" class="date"></select>
                                <select name="expire-date" id="hour" class="date"></select>:
                                <select name="expire-date" id="minute" class="date"></select>
                            </div>
                            <!--<div>
                                <div class="w-100">
                                    <input type="checkbox" id="check-server-allowed">
                                    <label for="check-server-allowed" class="not-label">Może zostać użyty do kupna serwera</label>
                                </div>
                                <div class="w-100">
                                    <input type="checkbox" id="check-server-extend">
                                    <label for="check-server-extend" class="not-label">Może zostać użyty do przedłużenia serwera</label>
                                </div>
                                <div class="w-100">
                                    <input type="checkbox" id="check-server-one-ip">
                                    <label for="check-server-one-ip" class="not-label">Jedno użycie na IP</label>
                                </div>
                                <div class="w-100">
                                    <input type="checkbox" id="check-server-one-user">
                                    <label for="check-server-one-user" class="not-label">Jedno użycie na użytkownika</label>
                                </div>
                                <div class="w-100">
                                    <input type="checkbox" id="check-server-global-usage">
                                    <label for="check-server-global-usage" class="not-label">Globalny limit użyć</label>
                                </div>
                            </div>
                            <div>
                                <label for="usage-limit" id="usage-limit-label">Ilość użyć (?)</label>
                                <input type="text" id="usage-limit" value="1">
                            </div>
                            <div>
                                <label for="payment-type" style="top:0">Typ płatności</label>
                                <select id="payment-type">
                                    <option value="Brak" selected disabled>Wybierz</option>
                                </select>
                            </div>-->
                            <!--<div>
                                <label for="code-time" id="code-time-label">Długość trwania pakietu w dniach</label>
                                <input type="number" id="code-time" placeholder="Podaj ilość dni">
                            </div>-->
                            <div>
                                <label for="code-price" id="code-price-label">Procent zniżki</label>
                                <input type="number" id="code-price">
                            </div>
                            <!--<div>
                                <label for="sms-option" id="sms-option-label" style="top:0">Opcja SMS</label>
                                <select id="sms-option">
                                    <option value="Brak" selected disabled>Brak</option>
                                    <option value="przelew">Nie wiem co jeszcze</option>
                                </select>
                            </div>-->
                            <div>
                                <label for="code-target" style="top:0">Target</label>
                                <select id="code-target">
                                </select>
                            </div>
                            <div>
                                <button class="simple-button" onclick="CreatePromoCode()">Utwórz</button>
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
        <?php include_once("components/copyright.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="js/validator.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var currentYear;
            var currentMonth;
            var selectedYear;
            var selectedMonth;
            $('#nav-konto').addClass('active');         

            function GenerateYears() {
                currentYear = new Date().getFullYear();

                for(var i=currentYear; i<=(currentYear+10);i++) {
                    $('#year').append('<option value='+i+' class="year">'+i+'</option>');
                }
            }
            function GenerateMonths(selectedYear) {
                $('#month').empty();
                this.selectedYear = selectedYear;
                var months = ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"];
                var startMonth = 0;
                currentMonth = new Date().getMonth();
                if(currentYear == selectedYear) startMonth = currentMonth;
                for(var i=startMonth; i<months.length;i++) {
                    $('#month').append('<option value='+(i+1)+'>'+months[i]+'</option>');
                }
            }
            function GenerateDays(month) {
                $('#day').empty();
                var currentDay = new Date().getDate();
                var daysInMonth = new Date(selectedYear, month, 0).getDate();
                var startDay = 1;
                if(currentMonth == (month-1) && currentYear == selectedYear) startDay = currentDay;

                for(var i=startDay; i<=daysInMonth;i++) {
                    $('#day').append('<option value='+i+'>'+i+'</option>');
                }
            }

            $('#year').on('click input', function() {
                GenerateMonths($('#year').val());
            });
            $('#month').on('click input',function() {
                GenerateDays($('#month').val());
            });

            function GenerateTime() {
                $('#hour').empty();
                $('#minute').empty();
                var t;
                for(var i=0; i<=23;i++) {
                    t = i;
                    if(t < 10 ) t='0'+i;
                    $('#hour').append('<option value='+i+'>'+t+'</option>');
                }
                for(var i=0; i<=59;i++) {
                    t = i;
                    if(t < 10) t='0'+i;
                    $('#minute').append('<option value='+i+'>'+t+'</option>');
                }
            }


            function CreatePromoCode() {
                if( !ValidateInput('#code-port')
                    || !ValidateInput('#year')
                    || !ValidateInput('#month') 
                    || !ValidateInput('#day')
                    || !ValidateInput('#hour')
                    || !ValidateInput('#minute')
                    || !ValidateInput('#code-price')
                    || !ValidateInput('#code-target')) {
                    alert("Uzupełnij wymagane pola");
                    return;
                }

                var code = $('#code-port').val();

                var y = $('#year').val();
                var m = $('#month').val()-1;
                var d = $('#day').val();
                var h = $('#hour').val();
                var min = $('#minute').val();

                var datetime = Date.parse(new Date(y,m,d,h,min));

                var discount = $('#code-price').val();
                var target = $('#code-target').val();

                $.ajax({
                    type: 'POST',
                    url: api_url+'/api/v1/promotional-codes/',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                    data: '{"code": "'+code+'","discountPercent": '+discount+',"expires": '+datetime+',"target": "'+target+'"}',
                    success: function(data, textStatus, xhr) {
                        console.log("Success: "+xhr.status + " " +textStatus);
                    },
                    complete: function(xhr, textStatus) {
                        console.log("Complete: "+xhr.status + " " +textStatus);
                        console.log("Complete: "+xhr.responseJSON.message);
                        if(!xhr.responseJSON.message == undefined)
                            alert(xhr.responseJSON.message);
                    } 
                }).done(res => {
                    ShowPromoCodes();
                });
            }
            
            async function GenerateTargets() {
                await $.ajax({
                    url: api_url+'/api/v1/promotional-codes/targets/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    res.forEach(x => $('#code-target').append($('<option value="'+x+'">'+ReturnTargetType(x)+'</option>')))
                })
            }
            function ReturnTargetType(target) {
                if(target == 'ANY') return "Wszystko";
                else if (target == 'PROMOTE') return "Promowanie";
                else if (target == 'ADVERTISEMENT') return "Reklama";
                else return target;
            }

            async function ShowPromoCodes() {
                $('#codes-list').empty();
                await $.ajax({
                    url: api_url+'/api/v1/promotional-codes/',
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(res => {
                    data = res;
                    data.forEach(x => $('#codes-list').append($('<div class="code-item-around col col-3"><div class="code-item"><button type="button" class="close" aria-label="Close" onclick="DeleteCode(\''+x.id+'\')"><span aria-hidden="true">&times;</span></button><div><p>Kod:</p><p>'+x.code+'</p><p>Zniżka:</p><p>'+x.discountPercent+'%</p><p>Wygasa: </p><p>'+ReturnStringDate(x.expires)+'</p></div></div></div>')));
                })
            }
            function ReturnStringDate(x) {
                return x.substr(8,2)+'.'+x.substr(5,2)+'.'+x.substr(0,4)+'  '+x.substr(11,5);
            }

            function DeleteCode(id) {
                $.ajax({
                    url: api_url+'/api/v1/promotional-codes/'+id+'/',
                    type: 'DELETE',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    contentType: "application/json; charset=utf-8",
                }).done(res => {
                    alert("Kod został usunięty");
                    ShowPromoCodes();
                })
            }
            
            GenerateYears();
            GenerateMonths(new Date().getFullYear());
            GenerateDays(new Date().getMonth()+1);
            GenerateTime();
            GenerateTargets();
            GeneratePaymentTypes();
            ShowPromoCodes();
        </script>
    </body>
</html>

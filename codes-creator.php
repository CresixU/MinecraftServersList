
<!DOCTYPE html>
<html>
    <head>
        <title>MinecraftList</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <style>
            body {
                color: #dfd7cc;
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
            .panel-content > div {
                padding-bottom: 20px;
                max-width: 700px;
                margin: 0 auto;
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
                                <p class="mb-0">Generator kodów</p>
                            </div>
                            <div class="panel-content p-5">
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
                                <div>
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
                                    <label for="sms-option" id="sms-option-label" style="top:0">Typ</label>
                                    <select id="sms-option">
                                        <option value="Brak" selected disabled>Wybierz</option>
                                        <option value="gra">Gra</option>
                                        <option value="gra2">??</option>
                                        <option value="gra3">??</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="package" id="package-label" style="top:0">Pakiet</label>
                                    <select id="package">
                                        <option value="Bronze" selected>Bronze</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Diamond">Diamond</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="code-time" id="code-time-label">Długość trwania pakietu w dniach</label>
                                    <input type="number" id="code-time" placeholder="Podaj ilość dni">
                                </div>
                                <div>
                                    <label for="code-price" id="code-price-label">Cena</label>
                                    <input type="number" id="code-price">
                                </div>
                                <div>
                                    <label for="sms-option" id="sms-option-label" style="top:0">Opcja SMS</label>
                                    <select id="sms-option">
                                        <option value="Brak" selected disabled>Brak</option>
                                        <option value="przelew">Nie wiem co jeszcze</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="simple-button">Utwórz</button>
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
            var currentYear;
            var currentMonth;
            var selectedYear;
            var selectedMonth;
            

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
            
            GenerateYears();
            GenerateMonths(new Date().getFullYear());
            GenerateDays(new Date().getMonth()+1);
            GenerateTime();

            
            
        </script>
    </body>
</html>

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

            button {
                color: var(--href-color);
            }
            tbody tr:hover {
                border-bottom: 1px solid var(--href-color);
                color: var(--href-color);
            }
            thead td {
                color: var(--href-color);
            }
            td i {
                font-size: 20px;
            }
            td a {
                color: inherit;
            }
            td a:hover {
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

            .modal-content {
                background: linear-gradient(to bottom, #110b08, #0e0906 70%);
                color: #dfd7cc;
            }
            .modal-header {
                border-bottom: none;
            }
            .modal-footer {
                border-top: none;
            }
            .modal-title + button {
                font-size: 200%;
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
            #pagination-list li {
                cursor: pointer;
            }
            .form-control {
                background: linear-gradient(180deg, rgba(2,0,36,0) 0%, rgba(0,0,0,0.30) 100%);
                border: none;
                border-left: 2px solid var(--main-color);
                border-right: 2px solid var(--main-color);
                border-radius: 10px;
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
                <div class="row mb-5">
                    <div class="col col-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div class="row w-100">
                                    <div class="col col-3">
                                        <a href="admin-servers.php" class="simple-button align-center">Lista serwerów</a>
                                    </div>
                                    <div class="col col-3">
                                        <a href="admin-users.php" class="simple-button">Lista userów</a>
                                    </div>
                                    <div class="col col-3">
                                        <a href="admin-blocked-services.php" class="simple-button">Zablokowane serwisy</a>
                                    </div>
                                    <div class="col col-3">
                                        <a href="" class="simple-button">Zablkowowane domeny</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-12">
                    <div class="panel">
                        <div class="panel-header">
                            Liczba użytkowników: <span id="users-count">0</span>
                        </div>
                        <div class="panel-content px-5">
                            <div class="row">
                                <div class="col col-12">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Login</td>
                                                <td>E-mail</td>
                                                <td>MotD</td>
                                                <td>Rola</td>
                                                <td colspan="4">Akcje</td>
                                            </tr>
                                        </thead>
                                        <tbody id="users-list">

                                        </tbody>
                                    </table>
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
        <script src="//code.jquery.com/jquery.min.js"></script>
        <script src="autocomplete/tokenize2.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script>
            var api_url = "<?php echo $api ?>";
            var data;
            var userData;

            //Authentication
            $.ajax({
                url: api_url+'/api/v1/auth/logged/',
                complete: function(xhr, textStatus) {
                    if(xhr.status != "200") 
                        window.location.replace("auth.php");
                } 
            }).done(res => {
                userData = res;
                if(userData.role != "ADMIN")
                    window.location.replace("account.php");
            });

            $.ajax({
                url: api_url+'/api/v1/users/',
            }).done(res => {
                data = res;
                $('#users-count').text(data.total);
                data.content.forEach(x => $('#users-list').append($('<tr><td>'+x.id+'</td><td>'+x.login+'</td><td>'+x.email+'</td><td>'+x.motD+'</td><td>'+x.role+'</td><td><button onclick="ModalDelete(\''+x.id+'\')"><i class="bi bi-trash3-fill"></i></button></td><td><button onclick="ModalEdit(\''+x.id+'\')"><i class="bi bi-pencil-square"></i></button</td><td><button onclick="ModalHistory(\''+x.id+'\')"><i class="bi bi-card-text"></i></button></td><td><a href="server.php?id='+x.id+'"><i class="bi bi-card-image"></i></a></td></tr>')))

            });

        </script>
    </body>
</html>
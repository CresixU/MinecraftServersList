<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <style>
        body {
            font-family: "Myriad Pro", sans-serif;
        }
        body a {
            padding: 10px 12px;
            font-weight: 700px;
            color: white;
            background-color: green;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
            margin: auto;
        }
        body a:hover {
            filter: brightness(1.1)
        }
    </style>
</head>
<body>
    <div>
        <img src="../img/logo.png" height="150px">
    </div>
    <div>
        <h2>Odzyskiwanie hasła</h2>
        <p>Witaj %login% <Br>Wygląda na to, że nie pamiętasz hasła.<br><br>Kliknij przycisk poniżej, aby je zresetować.</p>
        <a href="%link%">Resetuj hasło</a>
    </div>
</body>
</html>
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
        <h2>Dziękujemy za rejestracje w Minecraft-list</h2>
        <p>Witaj %login% <Br>Prosimy o aktywację konta.<br><br>Kliknij przycisk poniżej, żeby potwierdzić adres e-mail do logowania się na konto.</p>
        <a href="%link%">Aktywuj konto</a>
    </div>
</body>
</html>
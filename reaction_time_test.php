<?php include 'functions.php' ?>
<?php include 'login.php' ?>
<?php
$is_invalid = false;
if (!empty($_SESSION['login_failed'])) {
    $is_invalid = true;
    unset($_SESSION['login_failed']);
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainRush</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="Page">
        <div class="header">
            <div class="Navigation-Left">
                <button type="button" class="Menu-Buttons-Left" onclick="window.location.href='index.php'">Dashboard</button>
                <button type="button" class="Menu-Buttons-Left">Results</button>
            </div>
            <form class="Navigation-Right" method="POST">
                <button type="submit" name="register" class="Menu-Buttons-Right">Reģistrēties</button>
                <button type="submit" name="login" class="Menu-Buttons-Right">Login</button>
            </form>
        </div>
        <div class="start">
            <svg width="160" height="130" viewBox="0 0 100 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Reaction Time" class="svgg"><path d="M0.719527 59.616L32.8399 2.79148C33.8149 1.06655 35.6429 0 37.6243 0H94.4947C98.9119 0 101.524 4.94729 99.0334 8.59532L71.201 49.357C68.7101 53.0051 71.3225 57.9524 75.7397 57.9524H82.2118C87.3625 57.9524 89.6835 64.4017 85.7139 67.6841L14.34 126.703C9.85287 130.413 3.43339 125.513 5.82845 120.206L25.9709 75.5735C27.6125 71.936 24.9522 67.8166 20.9615 67.8166H5.50391C1.29539 67.8166 -1.35146 63.2798 0.719527 59.616Z" fill="currentcolor"></path></svg>
            <h1>Reakcijas Laika Tests</h1>
            <div class="start-button-holder">
                <button type="button" class="start-button">Start</button>
            </div>
        </div>
        <div class="info-container">
            <div class="info-Choices">
                <a class="info-box">
                    <h2>Statistika</h2>
                    <img src="https://cslabez.com/wp-content/uploads/2022/08/Human-benchmark.png" alt="Statistika" width="500" height="400">
                </a>
                <a class="info-box">
                    <h2>Par testu</h2>
                    <p>Šis ir vienkāršs rīks reakcijas laika mērīšanai.</p>
                    <p>Saskaņā ar līdz šim apkopotajiem datiem vidējais (mediānais) reakcijas laiks ir 273 milisekundes.</p>
                    <p>Papildus reakcijas laika mērīšanai šo testu ietekmē arī datora un monitora latentums. Izmantojot ātru datoru un monitoru ar zemu latentumu/augstu kadru ātrumu, jūs uzlabosiet savu rezultātu.</p>
                    <p>Lai gan vidējais cilvēka reakcijas laiks var būt no 200 līdz 250 ms, jūsu dators var pievienot vēl 10–50 ms. Daži mūsdienu televizori pievieno pat 150 ms!</p>
                </a>
            </div>
        </div>
    </div>

    <?php include 'modals.php'; ?>

</body>
</html>

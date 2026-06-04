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
            <form class="Navigation-Left" method="POST">
                <button type="submit" name="dashboard" class="Menu-Buttons-Left">Dashboard</button>
                <button type="button" class="Menu-Buttons-Left">Results</button>
            </form>
            <form class="Navigation-Right" method="POST">
                <button type="submit" name="register" class="Menu-Buttons-Right">Reģistrēties</button>
                <button type="submit" name="login" class="Menu-Buttons-Right">Login</button>
            </form>
        </div>
        <div class="start">
          <div class="ikonas">
            <svg width="160" height="130" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Aim Trainer" class="svgg"><path fill-rule="evenodd" clip-rule="evenodd" d="M64 118C93.8234 118 118 93.8234 118 64C118 34.1766 93.8234 10 64 10C34.1766 10 10 34.1766 10 64C10 93.8234 34.1766 118 64 118ZM64 128C99.3462 128 128 99.3462 128 64C128 28.6538 99.3462 0 64 0C28.6538 0 0 28.6538 0 64C0 99.3462 28.6538 128 64 128Z" fill="currentcolor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M64 97C82.2254 97 97 82.2254 97 64C97 45.7746 82.2254 31 64 31C45.7746 31 31 45.7746 31 64C31 82.2254 45.7746 97 64 97ZM64 107C87.7482 107 107 87.7482 107 64C107 40.2518 87.7482 21 64 21C40.2518 21 21 40.2518 21 64C21 87.7482 40.2518 107 64 107Z" fill="currentcolor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M64 76C70.6274 76 76 70.6274 76 64C76 57.3726 70.6274 52 64 52C57.3726 52 52 57.3726 52 64C52 70.6274 57.3726 76 64 76ZM64 86C76.1503 86 86 76.1503 86 64C86 51.8497 76.1503 42 64 42C51.8497 42 42 51.8497 86 64C42 76.1503 51.8497 86 64 86Z" fill="currentcolor"></path></svg>
            <svg width="160" height="130" viewBox="0 0 100 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Reaction Time" class="svgg"><path d="M0.719527 59.616L32.8399 2.79148C33.8149 1.06655 35.6429 0 37.6243 0H94.4947C98.9119 0 101.524 4.94729 99.0334 8.59532L71.201 49.357C68.7101 53.0051 71.3225 57.9524 75.7397 57.9524H82.2118C87.3625 57.9524 89.6835 64.4017 85.7139 67.6841L14.34 126.703C9.85287 130.413 3.43339 125.513 5.82845 120.206L25.9709 75.5735C27.6125 71.936 24.9522 67.8166 20.9615 67.8166H5.50391C1.29539 67.8166 -1.35146 63.2798 0.719527 59.616Z" fill="currentcolor"></path></svg>
            <svg width="160" height="130" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Sequence Memory" class="svgg"><rect width="58" height="58" rx="10" fill="currentcolor"></rect><rect x="70" width="58" height="58" rx="10" fill="currentcolor"></rect><rect y="70" width="58" height="58" rx="10" fill="currentcolor"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M118 80H80L80 118H118V80ZM80 70C74.4772 70 70 74.4772 70 80V118C70 123.523 74.4772 128 80 128H118C123.523 128 128 123.523 128 118V80C128 74.4772 123.523 70 118 70H80Z" fill="currentcolor"></path></svg>
          </div>
          <div class="start-button-holder">
            <button type="button" class="start-button" onclick="window.location.href='reaction_time_test.php'">Start</button>
          </div>
        </div>
        <div class="container">
            <div class="Choices">
                <a class="Game-box" href="">
                    <svg width="128" height="100" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Aim Trainer" style="padding: 20px;"><path fill-rule="evenodd" clip-rule="evenodd" d="M64 118C93.8234 118 118 93.8234 118 64C118 34.1766 93.8234 10 64 10C34.1766 10 10 34.1766 10 64C10 93.8234 34.1766 118 64 118ZM64 128C99.3462 128 128 99.3462 128 64C128 28.6538 99.3462 0 64 0C28.6538 0 0 28.6538 0 64C0 99.3462 28.6538 128 64 128Z" fill="currentcolor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M64 97C82.2254 97 97 82.2254 97 64C97 45.7746 82.2254 31 64 31C45.7746 31 31 45.7746 31 64C31 82.2254 45.7746 97 64 97ZM64 107C87.7482 107 107 87.7482 107 64C107 40.2518 87.7482 21 64 21C40.2518 21 21 40.2518 21 64C21 87.7482 40.2518 107 64 107Z" fill="currentcolor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M64 76C70.6274 76 76 70.6274 76 64C76 57.3726 70.6274 52 64 52C57.3726 52 52 57.3726 52 64C52 70.6274 57.3726 76 64 76ZM64 86C76.1503 86 86 76.1503 86 64C86 51.8497 76.1503 42 64 42C51.8497 42 42 51.8497 42 64C42 76.1503 51.8497 86 64 86Z" fill="currentcolor"></path></svg>
                    <h3>Tēmēšanas Treneris</h3>
                    <p>Cik ātri tu vari trāpīt pa ikonām?</p>
                </a>
                <a class="Game-box" href="reaction_time_test.php">
                    <svg width="100" height="100" viewBox="0 0 100 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Reaction Time" style="padding: 20px;"><path d="M0.719527 59.616L32.8399 2.79148C33.8149 1.06655 35.6429 0 37.6243 0H94.4947C98.9119 0 101.524 4.94729 99.0334 8.59532L71.201 49.357C68.7101 53.0051 71.3225 57.9524 75.7397 57.9524H82.2118C87.3625 57.9524 89.6835 64.4017 85.7139 67.6841L14.34 126.703C9.85287 130.413 3.43339 125.513 5.82845 120.206L25.9709 75.5735C27.6125 71.936 24.9522 67.8166 20.9615 67.8166H5.50391C1.29539 67.8166 -1.35146 63.2798 0.719527 59.616Z" fill="currentcolor"></path></svg>
                    <h3>Reakcijas Laika Tests</h3>
                    <p>Cik ātri tu vari reaģēt?</p>
                </a>
                <a class="Game-box" href="">
                    <svg width="128" height="100" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg" title="Sequence Memory" style="padding: 20px;"><rect width="58" height="58" rx="10" fill="currentcolor"></rect><rect x="70" width="58" height="58" rx="10" fill="currentcolor"></rect><rect y="70" width="58" height="58" rx="10" fill="currentcolor"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M118 80H80L80 118H118V80ZM80 70C74.4772 70 70 74.4772 70 80V118C70 123.523 74.4772 128 80 128H118C123.523 128 128 123.523 128 118V80C128 74.4772 123.523 70 118 70H80Z" fill="currentcolor"></path></svg>
                    <h3>Secības Atmiņas Tests</h3>
                    <p>Atceries secību.</p>
                </a>
            </div>
        </div>
    </div>

    <?php include 'modals.php'; ?>

</body>
</html>
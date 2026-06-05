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
    <title>BrainRush – Reakcijas Laika Tests</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="Page">
    <div class="header">
        <form class="Navigation-Left" method="POST">
            <button type="submit" class="Menu-Buttons-Left" name="dashboard">Dashboard</button>
        </form>
        <?php if (!empty($_SESSION['user_id'])): ?>
        <form class="Navigation-Right" method="POST" action="logout.php">
            <button type="submit" name="logout" class="Menu-Buttons-Right">Log Out</button>
        </form>
        <?php else: ?>
        <form class="Navigation-Right" method="POST">
            <button type="submit" name="register" class="Menu-Buttons-Right">Reģistrēties</button>
            <button type="submit" name="login" class="Menu-Buttons-Right">Login</button>
        </form>
        <?php endif; ?>
    </div>

    <!-- GAME ARENA -->
    <div id="arena" class="arena arena--idle" onclick="handleClick()">

        <!-- IDLE state -->
        <div id="state-idle" class="arena-state">
            <svg width="60" height="77" viewBox="0 0 100 128" fill="none" xmlns="http://www.w3.org/2000/svg" class="arena-icon"><path d="M0.719527 59.616L32.8399 2.79148C33.8149 1.06655 35.6429 0 37.6243 0H94.4947C98.9119 0 101.524 4.94729 99.0334 8.59532L71.201 49.357C68.7101 53.0051 71.3225 57.9524 75.7397 57.9524H82.2118C87.3625 57.9524 89.6835 64.4017 85.7139 67.6841L14.34 126.703C9.85287 130.413 3.43339 125.513 5.82845 120.206L25.9709 75.5735C27.6125 71.936 24.9522 67.8166 20.9615 67.8166H5.50391C1.29539 67.8166 -1.35146 63.2798 0.719527 59.616Z" fill="currentcolor"/></svg>
            <h2 class="arena-title">Reakcijas Laika Tests</h2>
            <p class="arena-sub">Kad ekrāns kļūst zaļš — klikšķini cik ātri vari!</p>
            <button type="button" class="start-button" onclick="startTest(event)">Sākt testu</button>
        </div>

        <!-- WAITING state -->
        <div id="state-waiting" class="arena-state" style="display:none">
            <div class="arena-pulse"></div>
            <h2 class="arena-title">Gaidi...</h2>
            <p class="arena-sub">Neklikšķini vēl!</p>
        </div>

        <!-- GO state -->
        <div id="state-go" class="arena-state" style="display:none">
            <h2 class="arena-title arena-title--go">KLIKŠĶINI!</h2>
        </div>

        <!-- TOO EARLY state -->
        <div id="state-early" class="arena-state" style="display:none">
            <h2 class="arena-title">Per agru! 😬</h2>
            <p class="arena-sub">Tu klikšķināji pirms signāla.</p>
            <button type="button" class="start-button" onclick="startTest(event)">Mēģini vēlreiz</button>
        </div>

        <!-- RESULT state -->
        <div id="state-result" class="arena-state" style="display:none">
            <p class="arena-sub">Tavs laiks</p>
            <div class="result-time">
                <span id="result-ms">—</span><span class="result-unit">ms</span>
            </div>
            <div id="result-rating" class="result-rating"></div>
            <div class="result-actions">
                <button type="button" class="start-button" onclick="startTest(event)">Vēlreiz</button>
                <button type="button" class="result-btn-secondary" onclick="showStats(event)">Statistika</button>
            </div>
        </div>

    </div>

    <!-- STATS PANEL -->
    <div id="stats-panel" class="stats-panel" style="display:none">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Labākais</div>
                <div class="stat-value" id="stat-best">—</div>
                <div class="stat-unit">ms</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Vidējais</div>
                <div class="stat-value" id="stat-avg">—</div>
                <div class="stat-unit">ms</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Sliktākais</div>
                <div class="stat-value" id="stat-worst">—</div>
                <div class="stat-unit">ms</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Mēģinājumi</div>
                <div class="stat-value" id="stat-count">0</div>
                <div class="stat-unit">&nbsp;</div>
            </div>
        </div>
        <div class="history-row" id="history-row"></div>
    </div>

    <!-- INFO SECTION -->
    <div class="info-container">
        <div class="info-Choices">
            <a class="info-box">
                <h2>Par testu</h2>
                <p>Šis ir vienkāršs rīks reakcijas laika mērīšanai. Noklikšķini tiklīdz ekrāns kļūst zaļš.</p>
                <p>Saskaņā ar līdz šim apkopotajiem datiem vidējais (mediānais) reakcijas laiks ir 273 milisekundes.</p>
                <p>Papildus reakcijas laika mērīšanai šo testu ietekmē arī datora un monitora latentums. Izmantojot ātru datoru un monitoru ar zemu latentumu/augstu kadru ātrumu, jūs uzlabosiet savu rezultātu.</p>
                <p>Lai gan vidējais cilvēka reakcijas laiks var būt no 200 līdz 250 ms, jūsu dators var pievienot vēl 10–50 ms. Daži mūsdienu televizori pievieno pat 150 ms!</p>
            </a>
            <a class="info-box">
                <h2>Rezultātu skala</h2>
                <div class="scale-list">
                    <div class="scale-item"><span class="scale-dot" style="background:#4ade80"></span><span class="scale-label">Zem 150 ms</span><span class="scale-desc">Izcili ātrs</span></div>
                    <div class="scale-item"><span class="scale-dot" style="background:#86efac"></span><span class="scale-label">150 – 200 ms</span><span class="scale-desc">Lieliski</span></div>
                    <div class="scale-item"><span class="scale-dot" style="background:#7c5cf5"></span><span class="scale-label">200 – 250 ms</span><span class="scale-desc">Virs vidējā</span></div>
                    <div class="scale-item"><span class="scale-dot" style="background:#a07cf8"></span><span class="scale-label">250 – 300 ms</span><span class="scale-desc">Vidējs</span></div>
                    <div class="scale-item"><span class="scale-dot" style="background:#facc15"></span><span class="scale-label">300 – 400 ms</span><span class="scale-desc">Zem vidējā</span></div>
                    <div class="scale-item"><span class="scale-dot" style="background:#f87171"></span><span class="scale-label">Virs 400 ms</span><span class="scale-desc">Lēns</span></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include 'modals.php'; ?>

<script>
var currentState = 'idle';
var waitTimer = null;
var startTime = 0;
var results = [];

var arenaEl      = document.getElementById('arena');
var stateIdle    = document.getElementById('state-idle');
var stateWaiting = document.getElementById('state-waiting');
var stateGo      = document.getElementById('state-go');
var stateEarly   = document.getElementById('state-early');
var stateResult  = document.getElementById('state-result');

function showState(name) {
    stateIdle.style.display    = 'none';
    stateWaiting.style.display = 'none';
    stateGo.style.display      = 'none';
    stateEarly.style.display   = 'none';
    stateResult.style.display  = 'none';

    document.getElementById('state-' + name).style.display = '';
    arenaEl.className = 'arena arena--' + name;
    currentState = name;
}

function startTest(e) {
    if (e) e.stopPropagation();

    clearTimeout(waitTimer);
    showState('waiting');

    var delay = 1500 + Math.random() * 3500;
    waitTimer = setTimeout(function() {
        startTime = performance.now();
        showState('go');
    }, delay);
}

function handleClick() {
    if (currentState === 'idle' || currentState === 'result' || currentState === 'early') return;

    if (currentState === 'waiting') {
        clearTimeout(waitTimer);
        showState('early');
        return;
    }

    if (currentState === 'go') {
        var ms = Math.round(performance.now() - startTime);
        results.push(ms);

        document.getElementById('result-ms').textContent = ms;

        var ratingEl = document.getElementById('result-rating');
        ratingEl.textContent = getRating(ms);
        ratingEl.style.color = getRatingColor(ms);

        showState('result');
        updateStats();
    }
}

function getRating(ms) {
    if (ms < 150) return 'Izcili ātrs!';
    if (ms < 200) return 'Lieliski!';
    if (ms < 250) return 'Virs vidējā';
    if (ms < 300) return 'Vidējs';
    if (ms < 400) return 'Zem vidējā';
    return 'Lens';
}

function getRatingColor(ms) {
    if (ms < 150) return '#4ade80';
    if (ms < 200) return '#86efac';
    if (ms < 250) return '#a07cf8';
    if (ms < 300) return '#c4b5fd';
    if (ms < 400) return '#facc15';
    return '#f87171';
}

function showStats(e) {
    if (e) e.stopPropagation();

    var panel = document.getElementById('stats-panel');
    panel.style.display = panel.style.display === 'none' ? '' : 'none';
}

function updateStats() {
    if (results.length === 0) return;

    var best  = results[0];
    var worst = results[0];
    var total = 0;

    for (var i = 0; i < results.length; i++) {
        if (results[i] < best)  best  = results[i];
        if (results[i] > worst) worst = results[i];
        total += results[i];
    }

    var average = Math.round(total / results.length);

    document.getElementById('stat-best').textContent  = best;
    document.getElementById('stat-avg').textContent   = average;
    document.getElementById('stat-worst').textContent = worst;
    document.getElementById('stat-count').textContent = results.length;

    var row = document.getElementById('history-row');
    row.innerHTML = '';

    var startIndex = Math.max(0, results.length - 10);

    for (var j = startIndex; j < results.length; j++) {
        var ms  = results[j];
        var dot = document.createElement('div');
        dot.className        = 'history-dot';
        dot.style.background = getRatingColor(ms);

        var tip = document.createElement('span');
        tip.className   = 'history-tip';
        tip.textContent = ms + ' ms';

        dot.appendChild(tip);
        row.appendChild(dot);
    }

    document.getElementById('stats-panel').style.display = '';
}
</script>

</body>
</html>

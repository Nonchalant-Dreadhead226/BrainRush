
<!-- Register Modal -->
<div id="id01" class="modal" <?php echo $_SESSION['AddRegisterDisplay']; ?>>
    <span class="close" onclick="document.getElementById('id01').style.display='none'" title="Close Modal">&times;</span>
    <form class="modal-content" method="POST" action="signup.php" novalidate>
        <div class="containers">
            <h2>Reģistrēties</h2>
            <p>Lūdzu, aizpildiet šo veidlapu, lai izveidotu kontu.</p>
            <hr>
            <?php if (!empty($_SESSION['signup_error'])): ?>
                <p class="form-error"><?= htmlspecialchars($_SESSION['signup_error']) ?></p>
                <?php unset($_SESSION['signup_error']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['signup_success'])): ?>
                <p class="form-success">Reģistrācija veiksmīga! Tagad vari ielogoties.</p>
                <?php unset($_SESSION['signup_success']); ?>
            <?php endif; ?>

            <label for="name"><b>Lietotājvārds</b></label>
            <input type="text" id="name" placeholder="Ievadi savu Lietotājvārdu" name="name" required>

            <label for="email"><b>E-pasts</b></label>
            <input type="text" id="email" placeholder="Ievadi E-pastu" name="email" required>

            <label for="psw"><b>Parole</b></label>
            <input type="password" id="psw" placeholder="Ievadi Paroli" name="psw" required>

            <label for="password_confirmation"><b>Atkārtot Paroli</b></label>
            <input type="password" id="password_confirmation" placeholder="Atkārtot Paroli" name="password_confirmation" required>

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Atcelt</button>
                <button type="submit" class="signupbtn">Reģistrēties</button>
            </div>
        </div>
    </form>
</div>

<!-- Login Modal -->
<div id="id02" class="modal" <?php echo $_SESSION['AddLoginDisplay']; ?>>
    <span class="close" onclick="document.getElementById('id02').style.display='none'" title="Close Modal">&times;</span>
    <form class="modal-content" method="POST" action="login.php" novalidate>
        <div class="containers">
            <h2>Login</h2>
            <p>Lūdzu, aizpildiet šo veidlapu, lai ielogotos savā kontā.</p>
            <hr>
            <?php if (!empty($is_invalid)): ?>
                <p class="form-error">Nepareizs e-pasts vai parole.</p>
            <?php endif; ?>

            <label for="login_email"><b>E-pasts</b></label>
            <input type="text" id="login_email" placeholder="Ievadi E-pastu" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

            <label for="login_psw"><b>Parole</b></label>
            <input type="password" id="login_psw" placeholder="Ievadi Paroli" name="psw" required>

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Atcelt</button>
                <button type="submit" class="signupbtn">Login</button>
            </div>
        </div>
    </form>
</div>
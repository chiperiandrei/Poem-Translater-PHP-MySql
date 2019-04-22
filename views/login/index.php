<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="../../public/scss/login.css">

<?php require_once('views/login/components/header.php'); ?>

<main>
    <div class="container">
        <div class="introduction">
            <h1>The poems of the week</h1>
            <article>
                <div class="poem-infos">
                    <h1 class="poem-title">
                        <a href="poems/Peneş-Curcanul.html">Peneş Curcanul</a>
                    </h1>
                    <h4 class="poem-author">
                        <a href="">Vasile Alecsandri</a>
                    </h4>
                </div>
                <div class="poem-strophe">
                    <p>"Plecat-am nouă din Vaslui,</p>
                    <p>Şi cu sergentul, zece,</p>
                    <p>Şi nu-i era, zău, nimănui</p>
                    <p>În piept inima rece.</p>
                    <p>Voioşi ca şoimul cel uşor</p>
                    <p>Ce zboară de pe munte,</p>
                    <p>Aveam chiar pene la picior,</p>
                    <p>Ş-aveam şi pene-n frunte."</p>
                    <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                </div>
            </article>
            <article>
                <div class="poem-infos">
                    <h1 class="poem-title">
                        <a href="poems/Peneş-Curcanul.html">Peneş Curcanul</a>
                    </h1>
                    <h4 class="poem-author">
                        <a href="">Vasile Alecsandri</a>
                    </h4>
                </div>
                <div class="poem-strophe">
                    <p>"Plecat-am nouă din Vaslui,</p>
                    <p>Şi cu sergentul, zece,</p>
                    <p>Şi nu-i era, zău, nimănui</p>
                    <p>În piept inima rece.</p>
                    <p>Voioşi ca şoimul cel uşor</p>
                    <p>Ce zboară de pe munte,</p>
                    <p>Aveam chiar pene la picior,</p>
                    <p>Ş-aveam şi pene-n frunte."</p>
                    <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                </div>
            </article>
        </div>
        <form action="/login/connect" method="POST">
            <div class="login">
                <h1>Connect with Us</h1>
                <div class="login-text">
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="jhon.doe@example.com" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="login-text">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="*******" required>
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <span id="forgot-password-event">Forgot password?</span>
                    <div>
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <button type="submit" id="login">Login</button>
                </div>
                <?php if (Session::exists('error')) : ?>
                    <div>
                    <span id="login-error">
                        <?php Session::print('error'); ?>
                    </span>
                    </div>
                <?php endif; ?>
                <div>
                    <span id="create-account-on">
                        <i class="fas fa-user-plus"></i>Create account
                    </span>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require_once('views/login/components/create-account.php'); ?>

<script src="public/js/login.js" type="text/javascript"></script>

<?php require_once('views/components/footer.php'); ?>
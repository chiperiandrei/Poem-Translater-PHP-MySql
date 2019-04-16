<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('components/connect.component.php');
    require_once('components/head.component.php');
    require_once('components/header.component.php');

    $_SESSION['login']    = FALSE;
    $_SESSION['email']    = 'NULL';
    $_SESSION['password'] = 'NULL';
    ?>
    <link rel="stylesheet" href="assets/sass/login.css">
</head>
<body>
    <header>
        <?php PT_GET_HEADER($_SESSION['login'], 'login.php'); ?>
    </header>
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
            <form action="components/login.component.php" method="POST">
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
                    <div>
                        <span id="create-acount-on">
                            <i class="fas fa-user-plus"></i>Create account
                        </span>
                    </div>
                </div>  
            </form>
		</div>
    </main>
    <section id="create-acount" class="create-account">
        <div class="container">
            <div class="title">
                <h1>Create a new account</h1>   
                <button class="close" id="create-acount-off">Close<i class="fas fa-times"></i></button>
            </div>
            <div class="first-name">
                <label for="first-name">First name:</label>
                <input type="text" name="first-name" placeholder="John" required>
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last-name">Last name:</label>
                <input type="text" name="last-name" placeholder="Doe" required>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="text" name="rank" placeholder="johndoe@exemple.com" required>
                <span><i class="fas fa-at"></i></span>
            </div>
            <div class="password">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="*******" required>
                <span><i class="fas fa-key"></i></span>
            </div>
            <div class="repeat-password">
                <label for="repeat-password">Repeat password:</label>
                <input type="password" name="repeat-password" placeholder="*******" required>
            </div>
            <div class="capcha">
                TODO: Capcha
            </div>
            <div class="submit">
                <button type="submit"><i class="fas fa-share"></i>Send</button>
            </div>
        </div>
    </section>
    <script src="assets/js/script-login.js"></script>
</body>
</html>

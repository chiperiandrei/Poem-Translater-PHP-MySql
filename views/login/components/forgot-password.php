<form action="/login/forgot-password" method="POST">
    <section id="forgot-password" class="forgot-password">
        <div class="container">
            <div class="title">
                <h1>Have you forgotten your password?</h1>
                <button class="close" id="forgot-password-off">Close<i class="fas fa-times"></i></button>
            </div>
            <div class="email">
                <label for="email">Your email:</label>
                <input type="email" name="email" placeholder="johndoe@exemple.com" required>
                <span><i class="fas fa-at"></i></span>
            </div>
            <div class="submit">
                <button type="submit"><i class="fas fa-share"></i>Send</button>
            </div>
        </div>
    </section>
</form>

<?php if (Session::exists('log-register')) : ?>
<div>
    <span id="reg-ok">
        <?php Session::print('log-register'); ?>
    </span>
</div>
<?php endif; ?>

<?php if (Session::exists('error-forgot')) : ?>
<div>
    <span id="login-ok">
        <?php Session::print('error-forgot'); ?>
    </span>
</div>
<?php endif; ?>

<?php if (Session::exists('cui')) : ?>
<div>
    <span id="login-ok">
        We sent you an e-mail.<?php Session::print('cui'); ?>
    </span>
</div>
<?php endif; ?>

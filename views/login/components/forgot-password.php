<form action="/login/forgot" method="POST" >
    Email:<br>
    <input type="email" name="email"><br>


    <input type="submit">
</form>
<?php if (Session::exists('reg-ok')) : ?>
    <div>
                        <span id="reg-ok">
                            <?php Session::print('reg-ok'); ?>
                        </span>
    </div>
<?php endif; ?>

<?php if (Session::exists('eroareEmail')) : ?>
    <div>
                        <span id="login-ok">
                            <font color="red">
                            <?php Session::print('eroareEmail'); ?></font>
                        </span>
    </div>
<?php endif; ?>

<?php if (Session::exists('cui')) : ?>
    <div>
                        <span id="login-ok">Am trimis un email la
                            <?php Session::print('cui'); ?>
                        </span>
    </div>
<?php endif; ?>




<?php require_once('views/components/meta.php'); ?>

    <link rel="stylesheet" href="/public/css/contact.css">

<?php

if (Session::exists('user_id')) {
    require_once('views/contact/components/header.php');
} else {
    require_once('views/contact/components/header-generic.php');
}

?>


    <form action="/settings/edit-info" method="POST">
        <br>
        <br>
        <br>
        <br>        <br>
        <br>        <br>
        <br>        <br>
        <br>        <br>
        <br>        <br>
        <br>






            <div class="container">
                UPDATE INFO !!!!!!!
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
                    <input type="email" name="email" placeholder="johndoe@exemple.com" required>
                    <span><i class="fas fa-at"></i></span>
                </div>
                <div class="username">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="john_doe" required>
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
                <div class="submit">
                    <button type="submit"><i class="fas fa-share"></i>Send</button>
                </div>
            </div>
    </form>

<font color="red">UPDATE PHOTO!!!!!!!!!</font>
    <form action="/settings/edit-photo">
        <input type="file" name="fileupload" value="fileupload" id="fileupload">
        <label for="fileupload"> Select a file to upload</label>
        <br><input type="image" alt="Submit" width="100">
    </form>
<?php if (Session::exists('update-info-complete')) : ?>
    <div>
                        <span id="login-ok">
                            <?php Session::print('update-info-complete'); ?>
                        </span>
    </div>
<?php endif; ?>

<?php if (Session::exists('update-info-email-already-exists')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('update-info-email-already-exists'); ?>
                        </span>
    </div>
<?php endif; ?>
<?php if (Session::exists('update-info-username-already-exists')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('update-info-username-already-exists'); ?>
                        </span>
    </div>
<?php endif; ?>
<?php if (Session::exists('something-went-wrong-try-again-later')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('something-went-wrong-try-again-later'); ?>
                        </span>
    </div>
<?php endif; ?>

<?php if (Session::exists('password-dont-match')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('password-dont-match'); ?>
                        </span>
    </div>
<?php endif; ?>
    <script src="public/js/main.js" type="text/javascript"></script>
<?php require_once('views/components/footer.php'); ?>
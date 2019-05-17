<?php require_once('views/components/meta.php'); ?>

    <link rel="stylesheet" href="/public/css/contact.css">

<?php

if (Session::exists('user_id')) {
    require_once('views/contact/components/header.php');
} else {
    require_once('views/contact/components/header-generic.php');
}

?>
<?php if (Session::exists('user_id')) : ?>

    <form action="/settings/edit-info" method="POST">
        <br>
        <br>
        <br>
        <br> <br>
        <br> <br>
        <br> <br>
        <br> <br>
        <br> <br>
        <br>


        <div class="container">
            UPDATE INFO !!!!!!!
            <div class="first-name">
                <label for="first-name">First name:</label>
                <input type="text" name="first-name" placeholder="John">
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last-name">Last name:</label>
                <input type="text" name="last-name" placeholder="Doe" >
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="johndoe@exemple.com" >
                <span><i class="fas fa-at"></i></span>
            </div>
            <div class="username">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="john_doe" >
            </div>
            <div class="password">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="*******" >
                <span><i class="fas fa-key"></i></span>
            </div>
            <div class="repeat-password">
                <label for="repeat-password">Repeat password:</label>
                <input type="password" name="repeat-password" placeholder="*******" >
            </div>
            <div class="submit">
                <button type="submit"><i class="fas fa-share"></i>Send</button>
            </div>
        </div>
    </form>

    <font color="red">UPDATE PHOTO!!!!!!!!!</font>
    <form action="/settings/edit-photo" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
<?php else:
    http_response_code(403);
    require_once('views/errors/404.php');
    exit();


endif; ?>
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


<?php if (Session::exists('upload-complete')) : ?>
    <div>
                        <span id="login-ok">
                            <?php Session::print('upload-complete'); ?>
                        </span>
    </div>
<?php endif; ?>

<?php if (Session::exists('error-upload')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('error-upload'); ?>
                        </span>
    </div>
<?php endif; ?>
<?php if (Session::exists('not-valid')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('not-valid'); ?>
                        </span>
    </div>
<?php endif; ?>
<?php if (Session::exists('not-image')) : ?>
    <div>
                        <span id="login-error">
                            <?php Session::print('not-image'); ?>
                        </span>
    </div>
<?php endif; ?>

    <script src="public/js/main.js" type="text/javascript"></script>
<?php require_once('views/components/footer.php'); ?>
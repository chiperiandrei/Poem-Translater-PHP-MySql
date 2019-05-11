<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/contact.css">

<?php

if (Session::exists('user_id')) {
    require_once('views/contact/components/header.php');
} else {
    require_once('views/contact/components/header-generic.php');
}

?>

<main>
    <div class="container">
        <?php if (Session::exists('contact-error')) : ?>
            <div>
                        <span id="contact-error">
                            <?php Session::print('contact-error'); ?>
                        </span>
            </div>
        <?php endif; ?>
        <?php if (Session::exists('contact-sent')) : ?>
            <div>
                        <span id="contact-ok">
                            <?php Session::print('contact-sent'); ?>
                        </span>
            </div>
        <?php endif; ?>
        <form action="/contact/contact" method="post">
            <div class="first-name">
                <label for="first_name">First name:</label>
                <input type="text" name="first-name" placeholder="John" id="first_name" required>
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last_name">Last name:</label>
                <input type="text" name="last-name" placeholder="Doe" id="last_name" required>
                <span><i class="fas fa-feather-alt"></i></span>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="john.doe@example.com" id="email" required>
                <span><i class="fas fa-at"></i></span>
            </div>
            <div class="textarea">
                <label for="textarea">Content for your message:</label>
                <textarea name="text"></textarea>
            </div>
            <div class="submit">
                <button>Send<i class="fas fa-reply"></i></button>
            </div>
        </form>
    </div>
</main>

<script src="/public/js/main.js" type="text/javascript"></script>

<?php require_once('views/components/footer.php'); ?>
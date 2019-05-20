<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/flags.min.css">
<link rel="stylesheet" href="/public/css/main.css">
<link rel="stylesheet" href="/public/css/user.css">

<?php
if (Session::exists('user_id')) {
    require_once('views/components/header.php');
} else {
    require_once('views/components/header-generic.php');
}
?>

<main>
    <div class="container">
        <div class="photo">
            <img id="image"
                 src="<?php Session::print('avatar'); ?>"
                 alt="<?php Session::print('complete_name'); ?>">
        </div>
        <div class="about-info">
            <div class="first-name">
                <label for="first-name">First name:</label>
                <input type="text" name="first-name" placeholder="Joe" disabled="disabled" value="<?php Session::print('first_name');?>">
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last-name">Last name:</label>
                <input type="text" name="last-name" placeholder="Doe" disabled="disabled" value="<?php Session::print('last_name');?>">
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="username">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="john_doe" disabled="disabled" value="<?php Session::print('username');?>">
                <span><i class="fas fa-user-tag"></i></span>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="john_doe@exemple.com" disabled="disabled" value="<?php Session::print('email');?>">
                <span><i class="fas fa-envelope-open-text"></i></span>
            </div>
        </div>
        <div class="translate">
            <div class="intro">List of translated poems:</div>
            <ol>
                <?php if($this->poems) : foreach ($this->poems as $poem) : ?>
                <li>
                    <a href="<?php echo $poem['link']; ?>">
                    <?php echo $poem['title']; ?>
                    <img src="/public/img/flags/blank.gif"
                         class="flag flag-<?php echo $poem['language']; ?>"
                         alt="<?php echo $poem['language']; ?>"/>
                    </a>
                </li>
                <?php endforeach; else: ?>
                <div class="no-translation">
                    This user did not translate any poems, yet.
                <?php endif; ?>
            </ol>
        </div>
    </div>
</main>

<script src="/public/js/main.js" type="text/javascript"></script>

<?php require_once('views/components/footer.php'); ?>
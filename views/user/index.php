<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/flags.min.css">
<link rel="stylesheet" href="/public/css/main.css">
<link rel="stylesheet" href="/public/css/user.css">

<?php require_once('views/components/header.php'); ?>

<main>
    <div class="container">
        <div class="photo">
            <img id="image"
                 src="<?php echo $this->user['avatar']; ?>"
                 alt="<?php echo $this->user['complete_name']; ?>">
        </div>
        <div class="about-info">
            <div class="first-name">
                <label for="first-name">First name:</label>
                <input type="text" name="first-name" id="first-name" disabled="disabled"
                       value="<?php echo $this->user['first_name'];?>">
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last-name">Last name:</label>
                <input type="text" name="last-name" id="last-name" disabled="disabled"
                       value="<?php echo $this->user['last_name'];?>">
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="username">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" disabled="disabled"
                       value="<?php echo $this->user['username'];?>">
                <span><i class="fas fa-user-tag"></i></span>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" disabled="disabled"
                       value="<?php echo $this->user['email'];?>">
                <span><i class="fas fa-envelope-open-text"></i></span>
            </div>
        </div>
        <div class="translate">
            <div class="intro">List of translated poems:</div>
            <?php if($this->poems) : ?>
            <ol>
                <?php foreach ($this->poems as $poem) : ?>
                <li>
                    <a href="<?php echo $poem['link']; ?>"><?php echo $poem['title']; ?>
                    <img src="/public/img/flags/blank.gif"
                         class="flag flag-<?php echo $poem['language']; ?>"
                         alt="<?php echo $poem['language']; ?>"/>
                    </a>
                </li>
                <?php endforeach;; ?>
            </ol>
            <?php else: ?>
            <div class="no-translation">
                This user did not translate any poems, yet.
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script src="/public/js/main.js"></script>

<?php require_once('views/components/footer.php'); ?>


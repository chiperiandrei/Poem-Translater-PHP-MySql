<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="../../public/css/login.css">

<?php require_once('views/login/components/header.php'); ?>

<main>
    <div class="container">
        <div class="introduction">
            <h1>The poems of the week</h1>
            <?php for ($i = 0; $i < 2; $i++) :
            $poem_title   = $this->poemHeader[$i]['POEM_TITLE'];
            $poem_content = $this->poemContent[$i]['POEM_CONTENT'];
            $poem_link    = 'poems/' . $this->poemHeader[$i]['LANGUAGE'] . '/' .
                            str_replace(' ', '-', $poem_title);
            $author_name  = $this->poemHeader[$i]['AUTHOR_NAME'];
            $author_link  = 'authors/' .
                            str_replace(' ', '-', $author_name);
            ?>
            <article>
                <div class="poem-infos">
                    <h1 class="poem-title">
                        <a href="<?php echo $poem_link ?>">
                            <?php echo $poem_title ?>
                        </a>
                    </h1>
                    <h4 class="poem-author">
                        <a href="<?php echo $author_link ?>">
                            <?php echo $author_name ?>
                        </a>
                    </h4>
                </div>
                <div class="poem-strophe">
                    <pre><?php echo $poem_content ?></pre>
                    <a href="<?php echo $poem_link ?>" class="poem-read-more">[Read more]</a>
                </div>
            </article>
            <?php endfor; ?>
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
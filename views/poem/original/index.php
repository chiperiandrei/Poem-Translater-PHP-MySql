<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/poem.css">
<link rel="stylesheet" href="/public/css/flags.min.css">

<?php
if (Session::exists('user_id')) {
    require_once('views/components/header.php');
} else {
    require_once('views/components/header-generic.php');
}
?>

<main>
    <div class="container">
        <section class="poem">
            <div class="control">
                <a href="<?php echo $this->poem_header['title']; ?>/share/wordpress">Share <i class="fab fa-wordpress"></i></i></a>
                <a href="">Translate <i class="fas fa-language"></i></a>
            </div>
            <h1 class="poem-title">
                <a href="<?php echo '/poem/' . $this->poem_header['language'] . '/' .
                               str_replace(' ', '+', $this->poem_header['title']); ?>">
                    <?php echo $this->poem_header['title']; ?>
                </a>
            </h1>
            <div class="poem-author">
                <a href="<?php echo '/author/' . str_replace(' ', '+', $this->poem_header['author_name']); ?>">
                    <?php echo $this->poem_header['author_name']; ?>
                </a>
            </div>
            <div class="poem-strophes">
                <?php foreach($this->poem_body as $poem_strophe) :
                    echo "<pre>$poem_strophe</pre>";
                endforeach; ?>
            </div>
        </section>
    </div>
    <div class="comments">
        <section>
            <?php if ($this->poem_comments) : ?>
                <?php foreach ($this->poem_comments as $comment) : ?>
                <div class="comment">
                    <div class="avatar">
                        <img src="<?php echo $comment['user']['avatar']; ?>" alt="<?php echo $comment['user']['name']; ?>">
                    </div>
                    <div class="name">
                        <a href="<?php echo $comment['user']['link']; ?>">
                            <?php echo $comment['user']['name']; ?>
                        </a>
                    </div>
                    <div class="username">
                        <a href="<?php echo $comment['user']['link']; ?>">
                            (<?php echo $comment['user']['username']; ?>)
                        </a>
                    </div>
                    <?php if (Session::exists('username')) : ?>
                        <?php if ($comment['user']['username'] == Session::get('username')) : ?>
                            <div class="delete">
                                <a href="">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="text">
                        <?php echo $comment['text']; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-comment">
                    There is no comment yet.
                </div>
            <?php endif; ?>
        </section>
        <section>
            <?php if (Session::exists('user_id')) : ?>
            <div class="add-comment">
                <div class="avatar">
                    <img src="<?php Session::print('avatar'); ?>" alt="<?php Session::print('complete_name'); ?>">
                </div>
                <div class="name">
                    <a href="<?php Session::print('user_link'); ?>">
                        <?php Session::print('complete_name'); ?>
                    </a>
                </div>
                <div class="username">
                    <a href="<?php Session::print('user_link'); ?>">
                        (<?php Session::print('username'); ?>)
                    </a>
                </div>
                <div class="input">
                    <textarea name="" id=""></textarea>
                </div>
                <div class="submit">
                    <input type="submit" value="Add">
                </div>
            </div>
            <?php endif; ?>
        </section>
    </div>
    <nav class="menu-languages">
        <a class="active"
           href="<?php echo '/poem/' . $this->poem_header['language'] . '/' .
               str_replace(' ', '+', $this->poem_header['title']); ?>">
            <img src="../../../public/img/flags/blank.gif"
                 class="flag flag-<?php echo $this->poem_header['language']; ?>"
                 alt="<?php echo $this->poem_header['language']; ?>"/>
            <?php echo $this->poem_header['language']; ?>
        </a>
        <?php foreach($this->poem_languages as $language) : ?>
            <a href="<?php echo "/poem/$language/" . str_replace(' ', '+', $this->poem_header['title']); ?>">
                <img src="../../../public/img/flags/blank.gif"
                     class="flag flag-<?php echo $language === 'en' ? 'gb' : $language; ?>"
                     alt="<?php echo $language; ?>"/>
                <?php echo $language; ?>
            </a>
        <?php endforeach; ?>
        <a href="" class="arrow"><i class="fas fa-angle-double-down"></i></a>
    </nav>
    <div id="add-comment-menu" hidden>
        <form action="/add-comment" method="post">
            <textarea name="comment" id="comment"></textarea>
            <input name="submit" type="submit" value="Add">
        </form>
    </div>
</main>

<script src="../../../public/js/poem.js"></script>

<?php require_once('views/components/footer.php'); ?>

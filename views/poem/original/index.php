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
            <?php if(Session::exists('user_id')) : ?>
            <div class="control">
                <button onclick="shareWordpress()" id="sharewordpress">Share <i class="fab fa-wordpress"></i></i></button>
                <button onclick="showAddTranslation()">Translate <i class="fas fa-language"></i></button>
            </div>
            <?php endif; ?>
            <h1 class="poem-title">
                <a href="<?php echo $this->poem_header['link']; ?>">
                    <?php echo $this->poem_header['title']; ?>
                </a>
            </h1>
            <div class="poem-author">
                <a href="<?php echo $this->poem_header['author_link']; ?>">
                    <?php echo $this->poem_header['author_name']; ?>
                </a>
            </div>
            <div class="poem-strophes">
                <?php foreach($this->poem_body as $poem_strophe) : ?>
                    <pre><?php echo $poem_strophe['text']; ?></pre>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
    <?php require_once('views/poem/components/comments.php'); ?>
    <nav class="menu-languages">
        <a class="active"
           href="<?php echo $this->poem_header['link']; ?>">
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
        <textarea name="comment" id="comment"></textarea>
        <input name="submit" type="submit" value="Add">
    </div>
</main>

<?php require_once('views/poem/components/translation.php'); ?>

<script src="../../../public/js/poem.js"></script>

<?php if (Session::exists('user_id')) : ?>
<script>
    let poemTitle = '<?php echo str_replace("'", "\'", $this->poem_header['title']); ?>';
</script>
<?php endif; ?>


<?php require_once('views/components/footer.php'); ?>

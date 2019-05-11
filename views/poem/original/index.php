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
        <textarea></textarea>
        <input type="submit" value="Add comment">
    </div>
</main>

<script src="../../../public/js/poem.js"></script>

<?php require_once('views/components/footer.php'); ?>

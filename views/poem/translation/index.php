<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/translation.css">
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
                <a href="<?php echo '/poem/' . $this->poem_language . '/' .
                               str_replace(' ', '-', $this->poem_title); ?>">
                    <?php echo $this->poem_title; ?>
                </a>
            </h1>
            <div class="poem-author">
                <a href="<?php echo '/author/' . str_replace(' ', '-', $this->poem_author); ?>">
                    <?php echo $this->poem_author; ?>
                </a>
            </div>
        </section>
        <section class="translations">
            <?php foreach ($this->translations as $translation) : ?>
            <div class="translation">
                <?php var_dump($translation); ?>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
    <nav class="menu-languages">
        <a href="<?php echo '/poem/' . $this->poem_language . '/' . str_replace(' ', '-', $this->poem_title); ?>">
            <img src="../../../public/img/flags/blank.gif"
                 class="flag flag-<?php echo $this->poem_language; ?>"
                 alt="<?php echo $this->poem_language; ?>"/>
            <?php echo $this->poem_language; ?>
        </a>
        <?php foreach($this->poem_languages as $language) : ?>
        <a href="<?php
            echo "/poem/$language/" . str_replace(' ', '-', $this->poem_title) . '"';
            if ($language == $this->translation_language) : echo ' class="active"'; endif; ?>>
            <img src="../../../public/img/flags/blank.gif"
                 class="flag flag-<?php echo $language === 'en' ? 'gb' : $language; ?>"
                 alt="<?php echo $language; ?>"/>
            <?php echo $language; ?>
        </a>
        <?php endforeach; ?>
        <a href="" class="arrow"><i class="fas fa-angle-double-down"></i></a>
    </nav>
</main>

<?php require_once('views/components/footer.php'); ?>


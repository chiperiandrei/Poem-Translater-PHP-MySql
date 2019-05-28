<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/translations.css">
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
        <section class="info">
            Translation<?php if (count($this->translations) > 1) : echo 's'; endif; ?> for:
        </section>
        <section class="poem">
            <h1 class="poem-title">
                <a href="<?php echo $this->poem_link; ?>">
                    <?php echo $this->poem_title; ?>
                </a>
            </h1>
            <div class="poem-author">
                <a href="<?php echo $this->author_link ?>">
                    <?php echo $this->author_name; ?>
                </a>
            </div>
        </section>
        <section class="about">
            <div class="container">
                <div class="language">Language</div>
                <div class="user">Translator / User</div>
                <div class="rating">Rating</div>
            </div>
        </section>
        <section class="translations">
            <?php $id = 0; foreach ($this->translations as $translation) : $id++ ?>
            <div id="translation-<?php echo $id; ?>" class="translation">
                <a class="language"
                   href="<?php echo '/poem/' . $this->translation_language . '/' .
                   str_replace(' ', '+', $this->poem_title) . '/' .
                   $translation['username'] ; ?>">
                    <img src="../../../public/img/flags/blank.gif"
                         class="flag flag-<?php echo $this->translation_language === 'en' ? 'gb' : $this->translation_language; ?> ?>"
                         alt="<?php echo $this->translation_language; ?>"/>
                    <?php echo $this->translation_language; ?>
                </a>
                <div class="first-name"><?php echo $translation['user_fn']; ?></div>
                <div class="last-name"><?php echo $translation['user_ln']; ?></div>
                <div class="username">(<?php echo $translation['username']; ?>)</div>
                <div class="rating">
                    <?php if(Session::exists('user_id')) :
                    if ($translation['user_id'] == Session::get('user_id')) : ?>
                    <div class="delete">
                        <form action="./<?php echo str_replace(' ', '+', $this->poem_title) . '/' . $translation['username']; ?>/delete-translation"
                              method="POST">
                            <?php
                            Session::set('translation_id' , $translation['translation_id']);
                            Session::set('poem_link', $this->poem_link);
                            ?>
                            <button type="submit"><i class="fas fa-times"></i></button>
                        </form>
                    </div>
                    <?php endif;
                    endif;
                    for ($i = 0; $i < $translation['rating']; $i++) :
                        echo '<i class="fas fa-star"></i>';
                    endfor;
                    for ($i =  $translation['rating']; $i < 5; $i++) :
                        echo '<i class="far fa-star"></i>';
                    endfor;
                    ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
    <nav class="menu-languages">
        <a href="<?php echo '/poem/' . $this->poem_language . '/' . str_replace(' ', '+', $this->poem_title); ?>">
            <img src="../../../public/img/flags/blank.gif"
                 class="flag flag-<?php echo $this->poem_language == 'en' ? 'gb' : $this->poem_language; ?>"
                 alt="<?php echo $this->poem_language; ?>"/>
            <?php echo $this->poem_language; ?>
        </a>
        <?php foreach($this->poem_languages as $language) : ?>
        <a href="<?php
            echo "/poem/$language/" . str_replace(' ', '+', $this->poem_title) . '"';
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

<script src="/public/js/translations.js" type="text/javascript"></script>

<?php require_once('views/components/footer.php'); ?>


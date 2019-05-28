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
        <section class="control">
            <?php if(Session::exists('user_id')) :
                if ($this->user['id'] == Session::get('user_id')) : ?>
                    <div class="delete">
                        <form action="<?php echo $this->translation['language']['link']; ?>/delete-translation"
                              method="POST">
                            <?php
                            Session::set('translation_id' , $this->translation['id']);
                            Session::set('poem_link', $this->poem['language']['link']);
                            ?>
                            <button type="submit">Delete <i class="fas fa-times"></i></button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <section class="info">
            Translation for:
        </section>
        <section class="poem">
            <h1 class="poem-title">
                <a href="<?php echo $this->poem['language']['link'] ?>">
                    <?php echo $this->poem['title']; ?>
                </a>
            </h1>
            <div class="poem-author">
                <a href="<?php echo $this->poem['author']['link']; ?>">
                    <?php echo $this->poem['author']['name'];; ?>
                </a>
            </div>
            <div class="poem-strophes">
                <?php foreach($this->translation['strophes'] as $strophe) :
                    if ($strophe == null) :
                        echo '<pre class="announce">This strophe was not translated!</pre>';
                    else :
                        echo '<pre>' . $strophe . '</pre>';
                    endif;
                endforeach; ?>
            </div>
        </section>
        <section class="author">
            <div class="container">
                Translation made by:
                <a href="<?php echo $this->user['link']; ?>">
                    <?php echo $this->user['first_name']; ?>
                    <?php echo $this->user['last_name']; ?>
                </a>
            </div>
        </section>
    </div>
    <nav class="menu-languages">
        <a href="<?php echo $this->poem['language']['link']; ?>">
            <img src="../../../../public/img/flags/blank.gif"
                 class="<?php echo $this->poem['language']['flag']; ?>"
                 alt="<?php echo $this->poem['language']['name']; ?>"/>
            <?php echo $this->poem['language']['name']; ?>
        </a>
        <?php foreach($this->translation['translations'] as $language) :
            echo '<a href="' . $language['link'] . '"';
            if ($language['name'] == $this->translation['language']['name']) :
                echo ' class="active"';
            endif;
            echo '>'; ?>
            <img src="../../../public/img/flags/blank.gif"
                 class="<?php echo $language['flag']; ?>"
                 alt="<?php echo $language['name']; ?>"/>
            <?php echo $language['name'];
            echo '</a>';
        endforeach; ?>
        <a href="" class="arrow"><i class="fas fa-angle-double-down"></i></a>
    </nav>
</main>

<script src="../../../public/js/poem.js"></script>

<?php require_once('views/components/footer.php'); ?>

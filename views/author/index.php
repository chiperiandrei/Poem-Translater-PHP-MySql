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
            <div class="poem-title">
                <?php echo $this->author_info['NUME']; ?>
            </div>
            <div class="poem-author">
                <?php echo $this->author_info['DATA_NASTERE']; ?> - <?php echo $this->author_info['DATA_DECEDARE']; ?>
            </div>
            <?php if ($this->photo['IMAGINE']) : ?>
            <div class="author-picture">
                <img src="/storage/authors/<?php echo $this->photo['IMAGINE']; ?>"
                     alt="<?php echo $this->author_info['NUME']; ?>";
            </div>
            <?php endif; ?>
            <div class="author-poems">
                <div class="intro">List of poems:</div>
                <ol>
                    <?php foreach ($this->poems_by_author as $poem) :
                        echo '<li><a href="' . $poem['link'] . '">' . $poem['title'] . '</a></li>';
                    endforeach; ?>
                </ol>
            </div>
        </section>
    </div>
</main>

<script src="../../public/js/poem.js"></script>
<?php require_once('views/components/footer.php'); ?>
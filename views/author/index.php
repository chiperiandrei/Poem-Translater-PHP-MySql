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
                <a href="<?php echo $this->author['link']; ?>">
                    <?php echo $this->author['name']; ?>
                </a>
            </div>
            <div class="poem-author">
                <?php echo $this->author['birth_date']; ?> - <?php echo $this->author['death_date']; ?>
            </div>
            <?php if ($this->author['avatar_path'] != null) : ?>
            <div class="author-picture">
                <img src="<?php echo $this->author['avatar']; ?>"
                     alt="<?php echo $this->author['name']; ?>";
            </div>
            <?php endif; ?>
            <div class="author-poems">
                <div class="intro">List of poems:</div>
                <ol>
                    <?php foreach ($this->poems as $poem) :
                        echo '<li><a href="' . $poem['link'] . '">' . $poem['title'] . '</a></li>';
                    endforeach; ?>
                </ol>
            </div>
        </section>
    </div>
</main>

<script src="../../public/js/poem.js"></script>
<?php require_once('views/components/footer.php'); ?>
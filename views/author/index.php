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
        <img src="../storage/authors/vasilealecsandri<?php echo $this->photo['IMAGINE'] ?>" >
        <div class="container">
            <section class="poem" id="poem">
                <div class="poem-title">
                    <?php echo $this->author_info['NUME']; ?>
                </div>
                <div class="poem-author">
                    <?php echo $this->author_info['DATA_NASTERE']; ?>
                    - <?php echo $this->author_info['DATA_DECEDARE']; ?>
                </div>
                <div class="poem-strophes">
                    <ol>
                    <?php
                        foreach ($this->poems_by_author as $poem) {
                            echo "<li>".$poem['title']."</li>";
                        }
                    ?>
                    </ol>
                </div>
            </section>
        </div>
        <div id="add-comment-menu" hidden>
            <textarea></textarea>
            <input type="submit" value="Add comment">
        </div>
    </main>

<?php require_once('views/components/footer.php'); ?>
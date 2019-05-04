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
        <section class="poem" id="poem">
            <div class="poem-title">
               <?php echo $this->author_info['nume'];?>
            </div>
            <div class="poem-author">
                Nume
            </div>
            <div class="poem-strophes">
               poem
            </div>
        </section>
    </div>
    <nav class="menu-languages">
        <a href="" class="active">
           asdadsa
        </a>
        <a href="" class="arrow"><i class="fas fa-angle-double-down"></i></a>
    </nav>

    <div id="add-comment-menu" hidden>
        <textarea></textarea>
        <input type="submit" value="Add comment">
    </div>
</main>

<?php require_once('views/components/footer.php'); ?>

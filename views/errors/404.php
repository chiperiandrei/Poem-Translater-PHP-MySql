<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/config/constants.php'); ?>

<?php require_once(PT_ROOT . '/views/components/meta.php'); ?>

<link rel="stylesheet" href="<?php echo PT_DOMAIN; ?>/public/css/error.css">

<?php require_once(PT_ROOT . '/views/errors/components/header.php'); ?>

<main>
    <div class="container">
        <h1>404</h1>
        <span><i class="fas fa-exclamation-triangle"></i>Not Found</span>
    </div>
</main>

<?php require_once(PT_ROOT . '/views/components/footer.php'); ?>

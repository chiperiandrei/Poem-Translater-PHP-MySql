<?php require_once('../../views/components/meta.php'); ?>

<?php $URL = "http://$_SERVER[HTTP_HOST]"; ?>

<link rel="stylesheet" href="<?php echo $URL; ?>/public/css/error.css">

<?php require_once('../../views/errors/components/header.php'); ?>

<main>
    <div class="container">
        <h1>403</h1>
        <span><i class="fas fa-user-lock"></i>Forbidden</span>
    </div>
</main>

<?php require_once('../../views/components/footer.php'); ?>
<?php require_once('views/components/meta.php'); ?>

<?php $URL = "http://$_SERVER[HTTP_HOST]"; ?>

<link rel="stylesheet" href="/public/css/error.css">

<?php require_once('views/errors/components/header.php'); ?>

<main>
    <div class="container">
        <h1>404</h1>
        <span><i class="fas fa-exclamation-triangle"></i>Not Found</span>
    </div>
</main>

<?php require_once('views/components/footer.php'); ?>

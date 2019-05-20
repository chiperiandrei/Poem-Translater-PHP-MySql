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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="poem-strophes">

    <ol>
        <li>
            <?php
            echo "<hr>Nume : " . $this->userInformation['FIRST_NAME'] . "        <br> Usernamme:  " . $this->userInformation['USERNAME'] . "   <br> Lastname:  " . $this->userInformation["LAST_NAME"] . " <hr>";

            ?>

            <img src=../storage/users/<?php echo $this->userInformation['USERNAME']; ?>/<?php echo $this->avatar; ?>>

        </li>
    </ol>
</div>

<script src="/public/js/main.js" type="text/javascript"></script>

<?php require_once('views/components/footer.php'); ?>
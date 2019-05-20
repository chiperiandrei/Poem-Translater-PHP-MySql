<?php if (Session::exists('user_id')) : ?>

<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/main.css">
<link rel="stylesheet" href="/public/css/settings.css">

<?php require_once('views/contact/components/header.php'); ?>

<main>
    <div class="container">
        <div class="photo">
            <form action="/settings/edit-photo" method="POST" enctype="multipart/form-data">
                <div>
                    <img id="image"
                         src="<?php Session::print('avatar'); ?>"
                         alt="<?php Session::print('complete_name'); ?>">
                </div>
                <div>
                    <input type="file" name="file" id="file" accept="image/*" onchange="previewFile()">
                </div>
                <div>
                    <input type="submit" value="Upload Image" name="submit">
                </div>
            </form>
        </div>
        <div class="about-info">
            <form action="/settings/edit-info" method="POST">
                <div class="first-name">
                    <label for="first-name">First name:</label>
                    <input type="text" name="first-name" placeholder="Joe" value="<?php Session::print('first_name');?>">
                    <span><i class="fas fa-user"></i></span>
                </div>
                <div class="last-name">
                    <label for="last-name">Last name:</label>
                    <input type="text" name="last-name" placeholder="Doe" value="<?php Session::print('last_name');?>">
                    <span><i class="fas fa-user"></i></span>
                </div>
                <div class="username">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="john_doe" value="<?php Session::print('username');?>">
                    <span><i class="fas fa-user-tag"></i></span>
                </div>
                <div class="password">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="*******" required>
                    <span><i class="fas fa-key"></i></span>
                </div>
                <div class="submit">
                    <button type="submit"><i class="fas fa-share"></i>Save</button>
                </div>
            </form>
        </div>
        <div class="about-password">
            <form action="/settings/edit-password" method="POST">
                <div class="old-password">
                    <label for="old-password">Old password:</label>
                    <input type="password" name="old-password" placeholder="*******">
                    <span><i class="fas fa-key"></i></span>
                </div>
                <div class="password">
                    <label for="password">New password:</label>
                    <input type="password" name="password" placeholder="*******">
                    <span><i class="fas fa-key"></i></span>
                </div>
                <div class="repeat-password">
                    <label for="repeat-password">Repeat password:</label>
                    <input type="password" name="repeat-password" placeholder="*******">
                    <span><i class="fas fa-key"></i></span>
                </div>
                <div class="submit">
                    <button type="submit"><i class="fas fa-share"></i>Change</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="/public/js/settings.js" type="text/javascript"></script>
<?php require_once('views/components/footer.php'); ?>

<?php else:
    http_response_code(404);
    require_once('views/errors/404.php');
    exit();
?>

<?php endif; ?>

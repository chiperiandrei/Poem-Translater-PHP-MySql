<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('components/head.component.php'); ?>
    <?php require_once('components/header.component.php'); ?>
    <link rel="stylesheet" href="assets/sass/contact.css">
</head>
<body>
    <header>
        <?php PT_GET_HEADER(true, 'contact.php'); ?>
    </header>
    <main>
        <div class="container">
            <div class="first-name">
                <label for="first_name">First name:</label>
                <input type="text" placeholder="John" id="first_name" required>
                <span><i class="fas fa-user"></i></span>
            </div>
            <div class="last-name">
                <label for="last_name">Last name:</label>
                <input type="text" placeholder="Doe" id="last_name" required>
                <span><i class="fas fa-feather-alt"></i></span>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="text" placeholder="john.doe@example.com" id="email" required>
                <span><i class="fas fa-at"></i></span>
            </div>
            <div class="textarea">
                <label for="textarea">The content of the message:</label>
                <textarea></textarea>
            </div>
            <div class="submit">
                <button>Send<i class="fas fa-reply"></i></button>
            </div>
        </div>
    </main>
    <footer></footer>
    <script src="assets/js/script.js"></script>
</body>
</html>
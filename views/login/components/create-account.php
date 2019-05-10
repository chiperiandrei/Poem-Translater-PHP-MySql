<form action="/login/create-account" method="POST">
<section id="create-account" class="create-account">
    <div class="container">
        <div class="title">
            <h1>Create a new account</h1>
            <button class="close" id="create-account-off">Close<i class="fas fa-times"></i></button>
        </div>
        <div class="first-name">
            <label for="first-name">First name:</label>
            <input type="text" name="first-name" placeholder="John" required>
            <span><i class="fas fa-user"></i></span>
        </div>
        <div class="last-name">
            <label for="last-name">Last name:</label>
            <input type="text" name="last-name" placeholder="Doe" required>
        </div>
        <div class="email">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="johndoe@exemple.com" required>
            <span><i class="fas fa-at"></i></span>
        </div>
        <div class="username">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="john_doe" required>
        </div>
        <div class="password">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="*******" required>
            <span><i class="fas fa-key"></i></span>
        </div>
        <div class="repeat-password">
            <label for="repeat-password">Repeat password:</label>
            <input type="password" name="repeat-password" placeholder="*******" required>
        </div>
        <div class="captcha">
            <label for="captcha">Captcha:</label>
            <?php echo $this->captcha; ?>
            <input type="text" name="captcha" placeholder="Write the captcha code here" required>
        </div>
        <div class="submit">
            <button type="submit"><i class="fas fa-share"></i>Send</button>
        </div>
    </div>
</section>
</form>
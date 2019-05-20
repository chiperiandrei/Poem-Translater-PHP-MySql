</head>
<header>
    <div class="container">
        <div class="title">
            <a href="<?php echo 'http://' . PT_DB_SERVER; ?>">Poem Translator</a>
        </div>
        <nav class="navigation">
            <a class="navigation-link" href="/">Poems<i class="fas fa-feather-alt"></i></a>
            <a class="navigation-link" href="favorites">Favorites<i class="fas fa-star"></i></a>
            <div id="navigation-user">
                <div class="user-label">
                    <span class="user-name">
                        <?php Session::print('first_name'); ?>
                    </span>
                    <span class="user-avatar">
                        <img src="<?php Session::print('avatar'); ?>"
                             alt="<?php Session::print('complete_name'); ?>">
                    </span>
                </div>
                <div id="user-menu" class="hidden">
                    <a href="<?php Session::print('user_link'); ?>"><i class="fas fa-user"></i>Profile</a>
                    <a href="settings"><i class="fas fa-cog"></i>Settings</a>
                    <a href="login/disconnect"><i class="fas fa-sign-out-alt"></i>Log out</a>
                </div>
            </div>
        </nav>
    </div>
</header>
<body>
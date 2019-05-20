</head>
<body>
<header>
    <div class="container">
        <div class="title">
            <a href="<?php Session::print('current_page'); ?>">Poem Translator</a>
        </div>
        <nav class="navigation">
            <a class="navigation-link" href="http://poem-translator.tw/contact">Contact<i class="fas fa-comments"></i></a>
            <a class="navigation-link" href="http://poem-translator.tw/favorites">Favorites<i class="fas fa-star"></i></a>
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
                    <a href="http://poem-translator.tw/<?php Session::print('user_link'); ?>"><i class="fas fa-user"></i>Profile</a>
                    <a href="http://poem-translator.tw/settings"><i class="fas fa-cog"></i>Settings</a>
                    <a href="http://poem-translator.tw/login/disconnect"><i class="fas fa-sign-out-alt"></i>Log out</a>
                </div>
            </div>
        </nav>
    </div>
</header>
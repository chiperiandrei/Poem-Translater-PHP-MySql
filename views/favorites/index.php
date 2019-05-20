<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/main.css">
<link rel="stylesheet" href="/public/css/flags.min.css">

<?php require_once('views/components/header.php'); ?>

<main>
    <div class="container">
        <section class="main-search">
            <div class="search">
                <input type="text" placeholder="Search in the wonderful world of poems and authors...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <select class="filter">
                <option disabled selected hidden>Filter your poems</option>
                <option value="filter-popular-poems">Popular poems</option>
                <option value="filter-popular-authors">Popular authors</option>
                <option value="filter-popular-language">Popular language</option>
                <option value="filter-newest-poem">The newest poems</option>
                <option value="filter-oldest-poem">The oldest poems</option>
            </select>
            <button class="sort"><i class="fas fa-sort-alpha-down"></i></button>
        </section>
        <section class="main-poems">
            <section>
                <?php for($i = 0; $i < $this->count; $i += 2) : ?>
                    <article>
                        <div class="poem">
                            <?php if (Session::exists('user_id')) : ?>
                                <span class="poem-bookmark" id="poem-bookmark-<?php echo $i; ?>">
                                <i class="fas fa-bookmark"></i>
                            </span>
                            <?php endif; ?>
                            <h1 class="poem-title">
                                <a href="<?php echo $this->poems[$i]['link']; ?>">
                                    <?php echo $this->poems[$i]['title']; ?>
                                </a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="<?php echo $this->poems[$i]['author_link']; ?>">
                                    <?php echo $this->poems[$i]['author_name']; ?>
                                </a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <pre><?php echo $this->poems[$i]['content']; ?></pre>
                            <a href="<?php echo $this->poems[$i]['link']; ?>" class="poem-read-more">[Read more]</a>
                        </div>
                        <span class="poem-language">
                            <img src="/public/img/flags/blank.gif"
                                 class="flag flag-<?php echo $this->poems[$i]['language']; ?>"
                                 alt="<?php echo $this->poems[$i]['language']; ?>">
                        </span>
                    </article>
                <?php endfor; ?>
            </section>
            <section>
                <?php for($i = 1; $i < $this->count; $i += 2) : ?>
                    <article>
                        <div class="poem">
                            <?php if (Session::exists('user_id')) : ?>
                                <span class="poem-bookmark" id="poem-bookmark-<?php echo $i; ?>">
                                <i class="fas fa-bookmark"></i>
                            </span>
                            <?php endif; ?>
                            <h1 class="poem-title">
                                <a href="<?php echo $this->poems[$i]['link']; ?>">
                                    <?php echo $this->poems[$i]['title']; ?>
                                </a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="<?php echo $this->poems[$i]['author_link']; ?>">
                                    <?php echo $this->poems[$i]['author_name']; ?>
                                </a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <pre><?php echo $this->poems[$i]['content']; ?></pre>
                            <a href="<?php echo $this->poems[$i]['link']; ?>" class="poem-read-more">[Read more]</a>
                        </div>
                        <span class="poem-language">
                            <img src="/public/img/flags/blank.gif"
                                 class="flag flag-<?php echo $this->poems[$i]['language']; ?>"
                                 alt="<?php echo $this->poems[$i]['language']; ?>">
                        </span>
                    </article>
                <?php endfor; ?>
            </section>

        </section>
    </div>
</main>

<script src="/public/js/main.js" type="text/javascript"></script>

</body>
</html>
<?php require_once('views/components/meta.php'); ?>

<link rel="stylesheet" href="/public/css/main.css">
<link rel="stylesheet" href="/public/css/flags.min.css">

<?php

if (Session::exists('user_id')) {
    require_once('views/components/header.php');
} else {
    require_once('views/components/header-generic.php');
}

?>

<main>
    <div class="container">
        <section class="main-search">
            <div class="search">
                <input type="text" name="keyword" onkeyup="searchResult(this.value)"
                       placeholder="Search in the wonderful world of poems and authors...">
                <select name="search-result" id="search-result" multiple></select>
                </select>
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
        <?php if (Session::exists('admin')) : ?>
        <section class="main-admin">
            <div class="panel">
                <span class="info">Admin zone:</span>
                <button onclick="showAddAuthor()">Add an author <i class="fas fa-user-plus"></i></button>
                <button onclick="showDeleteAuthor()">Remove an author <i class="fas fa-user-minus"></i></button>
                <button onclick="showAddPoem()">Add a poem <i class="fas fa-plus"></i></button>
                <button onclick="showDeletePoem()">Delete a poem <i class="fas fa-minus"></i></button>
            </div>
        </section>
        <?php endif; ?>
        <section class="main-poems">
            <section>
                <?php for($i = 0; $i < $this->count; $i += 2) : ?>
                    <article>
                        <div class="poem">
                            <?php if (Session::exists('user_id')) :
                                if ($this->poems[$i]['favorite'] == true) : ?>
                                    <span class="poem-bookmark"
                                          onclick="setFavorites(this, <?php echo $this->poems[$i]['id']; ?>, 'delete')">
                                    <i class="fas fa-bookmark"></i>
                                </span>
                                <?php else : ?>
                                    <span class="poem-bookmark"
                                          onclick="setFavorites(this, <?php echo $this->poems[$i]['id']; ?>, 'add')">
                                    <i class="far fa-bookmark"></i>
                                </span>
                                <?php endif;
                            endif; ?>
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
                            <?php if (Session::exists('user_id')) :
                                if ($this->poems[$i]['favorite'] == true) : ?>
                                    <span class="poem-bookmark"
                                          onclick="setFavorites(this, <?php echo $this->poems[$i]['id']; ?>, 'delete')">
                                    <i class="fas fa-bookmark"></i>
                                </span>
                                <?php else : ?>
                                    <span class="poem-bookmark"
                                          onclick="setFavorites(this, <?php echo $this->poems[$i]['id']; ?>, 'add')">
                                    <i class="far fa-bookmark"></i>
                                </span>
                                <?php endif;
                            endif; ?>
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

<?php require_once('views/index/components/add-poem.php'); ?>
<?php require_once('views/index/components/delete-poem.php'); ?>
<?php require_once('views/index/components/add-author.php'); ?>
<?php require_once('views/index/components/delete-author.php'); ?>


<script src="/public/js/main.js" type="text/javascript"></script>

</body>
</html>

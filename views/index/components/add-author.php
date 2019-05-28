<?php if (Session::exists('user_id')) : ?>
<section id="add-author" class="add-author">
    <div class="container">
        <div class="close-area">
            <button onclick="hideAddAuthor()">Close <i class="fas fa-times"></i></button>
        </div>
        <form action="./index/add-author" method="POST">
            <div class="author-name">
                <label for="author-name">The name of the author</label>
                <input type="text" name="author-name" id="author-name" placeholder="William Shakespeare">
            </div>
            <div class="author-dates">
                <label for="birth">Birth date</label>
                <input type="number" name="birth" id="birth">
                <label for="death">Death date</label>
                <input type="number" name="death" id="death">
            </div>
            <div class="submit">
                <span class="button" onclick="resetAddAuthor()">Reset <i class="fas fa-bomb"></i></span>
                <button value="submit">Add author <i class="fas fa-user-plus"></i></button>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>
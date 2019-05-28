<?php if (Session::exists('user_id')) : ?>
<section id="delete-author" class="delete-author">
    <div class="container">
        <div class="close-area">
            <button onclick="hideDeleteAuthor()">Close <i class="fas fa-times"></i></button>
        </div>
        <form action="./index/delete-author" method="POST">
            <div class="author-name">
                <label for="selected-author">Select the desired poem</label>
                <select name="selected-author" id="selected-author">
                    <option selected disabled>Choose author</option>
                    <?php foreach ($this->authors as $author) : ?>
                        <option value="<?php echo $author['id']; ?>"><?php echo $author['full_info']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Delete</button>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>
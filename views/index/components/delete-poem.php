<?php if (Session::exists('user_id')) : ?>
<section id="delete-poem" class="delete-poem">
    <div class="container">
        <div class="close-area">
            <button onclick="hideDeletePoem()">Close <i class="fas fa-times"></i></button>
        </div>
        <form action="./index/delete-poem" method="POST">
            <div class="poem-name">
                <label for="poem">Select the desired poem</label>
                <select name="poem" id="poem">
                    <option selected disabled>Choose poem</option>
                    <?php foreach ($this->poemLanguages as $language) : ?>
                        <optgroup label="<?php echo $language ?>">
                            <?php foreach($this->poemAndAuthor[$language] as $poem) : ?>
                                <option value="<?php echo $poem['id']; ?>"><?php echo $poem['full_info']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Delete</button>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>
<?php if (Session::exists('user_id')) : ?>
    <section id="add-poem" class="add-poem">
        <div class="container">
            <div class="close-area">
                <button onclick="hideAddPoem()">Close <i class="fas fa-times"></i></button>
            </div>
            <form action="./index/add-poem" method="POST">
                <div class="poem-name">
                    <label for="name">The title of the poem</label>
                    <input type="text" name="name" id="name" placeholder="Romeo and Juliet">
                </div>
                <div class="poem-author">
                    <label for="author">Select author for poem</label>
                    <select name="author" id="author">
                        <?php foreach ($this->authors as $author) : ?>
                            <option value="<?php echo $author['id']; ?>"><?php echo $author['full_info']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="poem-language">
                    <label for="language">Select the language of the poem</label>
                    <select name="language" id="language">
                        <?php foreach ($this->languages as $language) : ?>
                            <option value="<?php echo $language['name']; ?>"><?php echo $language['en_name'] . ' - ' . $language['native_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="strophes-count">
                    <label for="count">Number of strophes</label>
                    <input type="number" name="count" id="count" min="1" onblur="triggerTextAreas()">
                </div>
                <div id="strophes">
                    <span>*Click outside of the thicker border input.</span>
                </div>
                <div id="submit"></div>
            </form>
        </div>
    </section>
<?php endif; ?>

<!--

<div class="strophe">
    <label for="strophe-1">Strophe 1</label>
    <textarea name="strophe-1" id="strophe-1"></textarea>
</div>
<div class="strophe">
    <label for="strophe-2">Strophe 2</label>
    <textarea name="strophe-2" id="strophe-2"></textarea>
</div>
-->

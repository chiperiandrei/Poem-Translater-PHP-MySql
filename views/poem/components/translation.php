<?php if (Session::exists('user_id')) : ?>
<section id="add-translation" class="add-translation">
    <div class="container">
        <div class="close-area">
            <button onclick="hideAddTranslation()">Close <i class="fas fa-times"></i></button>
        </div>
        <div class="poem-title">
            <a href="<?php echo $this->poem_header['link']; ?>">
                <?php echo $this->poem_header['title']; ?>
            </a>
        </div>
        <div class="poem-author">
            <a href="<?php echo $this->poem_header['author_link']; ?>">
                <?php echo $this->poem_header['author_name']; ?>
            </a>
        </div>
        <form action="<?php echo $this->poem_header['link']; ?>/add-translation" method="POST">
            <div class="select-language">
                <label for="language">Select translation language
                </label>
                <select name="language" id="language">
                    <?php foreach ($this->languages as $language) :
                        if ($this->poem_header['language'] != $language['name']) : ?>
                            <option value="<?php echo $language['name']; ?>"><?php echo $language['en_name'] . ' - ' . $language['native_name']; ?></option>
                        <?php endif;
                    endforeach; ?>
                </select>
            </div>
            <div class="poem-content">
                <?php $i = 0; foreach($this->poem_body as $poem_strophe) : ?>
                <div class="poem-strophe">
                    <section>
                        <textarea rows="<?php echo $poem_strophe['count']; ?>" disabled><?php echo $poem_strophe['text']; ?></textarea>
                    </section>
                    <section>
                        <textarea name="strophe-<?php echo $i ?>" id="strophe-<?php echo $i ?>"></textarea>
                    </section>
                </div>
                <?php $i++; endforeach; ?>
                <?php Session::set('poem_strophes_count', $i); ?>
            </div>
            <div class="submit-area">
                <?php Session::set('poem_data', $this->poem_header); ?>
                <button type="submit">Add translation <i class="fas fa-sign-language"></i></button>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>
<?php if (Session::exists('user_id')) : ?>
    <section id="add-poem" class="add-poem">
        <div class="container">
            <div class="close-area">
                <button onclick="hideAddPoem()">Close <i class="fas fa-times"></i></button>
            </div>
            <form action="">
                <div class="poem-name">
                    <label for="name">The title of the poem</label>
                    <input type="text" name="name" id="name" placeholder="">
                </div>
                <div class="poem-author">
                    <label for="author">Select author for poem</label>
                    <select name="author" id="author">

                    </select>
                </div>
                <div class="strophes-count">
                    <label for="count">Number of strophes</label>
                    <input type="number" name="count" id="count" min="1" onblur="triggerTextAreas()">
                </div>
                <div id="strophes">
                    <span>*Click outside of the thicker border input.</span>
                </div>
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

<div class="comments">
    <section id="comment-area">
        <?php if ($this->poem_comments) : ?>
            <?php foreach ($this->poem_comments as $comment) : ?>
                <div class="comment">
                    <div class="avatar">
                        <img src="<?php echo $comment['user']['avatar']; ?>" alt="<?php echo $comment['user']['name']; ?>">
                    </div>
                    <div class="name">
                        <a href="<?php echo $comment['user']['link']; ?>">
                            <?php echo $comment['user']['name']; ?>
                        </a>
                    </div>
                    <div class="username">
                        <a href="<?php echo $comment['user']['link']; ?>">
                            (<?php echo $comment['user']['username']; ?>)
                        </a>
                    </div>
                    <?php if (Session::exists('username')) : ?>
                        <?php if ($comment['user']['username'] == Session::get('username') or Session::exists('admin')) : ?>
                            <div class="delete">
                                <a href="<?php echo $this->poem_header['link']; ?>/delete-comment/<?php echo $comment['id'] ?>">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="text">
                        <?php echo $comment['text']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="no-comment-area" class="no-comment">
                There is no comment yet.
            </div>
        <?php endif; ?>
    </section>
    <section>
        <?php if (Session::exists('user_id')) : ?>
            <div class="add-comment">
                <div class="avatar" id="js-avatar">
                    <img src="<?php Session::print('avatar'); ?>" alt="<?php Session::print('complete_name'); ?>">
                </div>
                <div class="name" id="js-name">
                    <a href="<?php Session::print('user_link'); ?>">
                        <?php Session::print('complete_name'); ?>
                    </a>
                </div>
                <div class="username" id="js-username">
                    <a href="<?php Session::print('user_link'); ?>">
                        (<?php Session::print('username'); ?>)
                    </a>
                </div>
                <div class="input">
                    <textarea name="add-comment" id="add-comment"></textarea>
                </div>
                <div class="submit">
                    <button onclick="addComment()">Add</button>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>
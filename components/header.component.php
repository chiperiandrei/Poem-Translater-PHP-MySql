<?php 

class PT_Header {
    private $loged_in_status = false; 
    private $current_page = 'none';

    public function __construct($loged_in_status, $current_page) {
        $this->loged_in_status = $loged_in_status;
        $this->current_page = $current_page;
    }

    public function setTitle() {
        // ../ means index.php because index.* is searched 
        echo ($this->loged_in_status === true ? '../' : 'login');
    }

    public function setUserMenu() {
        if ($this->loged_in_status === true) {
            require_once('menu.component.php'); 
        }
    }

    public function setActiveClass($name) {
        echo ($this->current_page === $name ? 'active' : '');
    }  
}

/*
TODO:
elimina parametru din PT_GET_HEADER, deoarece
$_SESION['login'] poate fi accesat si de aici
*/

function PT_GET_HEADER($loged_in_status, $current_page) {
    $h = new PT_Header($loged_in_status, $current_page); ?>
    <div class="container">
        <div class="title">
            <a href="<?php $h->setTitle(); ?>">Poem-Translater</a>
            
        </div>
        <nav class="navigation">
        <?php if ($current_page === 'login.php') : ?>
            <a class="navigation-link <?php $h->setActiveClass('index.php'); ?>" href="../">
                More poems<i class="fas fa-feather-alt"></i>
            </a>
            <a class="navigation-link <?php $h->setActiveClass('contact.php'); ?>" href="contact">
                Contact<i class="fas fa-comments"></i>
            </a>
        <?php else : ?>
            <a class="navigation-link <?php $h->setActiveClass('contact.php'); ?>" href="contact">
                Contact<i class="fas fa-comments"></i>
            </a>
            <a class="navigation-link <?php $h->setActiveClass('favorites.php'); ?>" href="favorites">
                Favorites<i class="fas fa-star"></i>
            </a>
            <?php $h->setUserMenu(); ?>
        <?php endif; ?>
        </nav>
    </div>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <?php 
    require_once('components/connect.component.php');
    require_once('components/head.component.php');
    require_once('components/header.component.php');
    ?>
    <link rel="stylesheet" href="assets/sass/main.css">
</head>
<body>
    <header>
        <?php PT_GET_HEADER($_SESSION['login'], 'index.php'); ?>
    </header>
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
                    <!-- Peneş Curcanul -->
                    <article>
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-1">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Peneş Curcanul</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">Vasile Alecsandri</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>Plecat-am nouă din Vaslui,</p>
                            <p>Şi cu sergentul, zece,</p>
                            <p>Şi nu-i era, zău, nimănui</p>
                            <p>În piept inima rece.</p>
                            <p>Voioşi ca şoimul cel uşor</p>
                            <p>Ce zboară de pe munte,</p>
                            <p>Aveam chiar pene la picior,</p>
                            <p>Ş-aveam şi pene-n frunte.</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                        </div>
                    </article>
                    <!-- Luceafărul -->
                    <article>
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-2">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Luceafărul</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">Mihai Eminescu</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>A fost odată ca-n povești,</p>
                            <p>A fost ca niciodată,</p>
                            <p>Din rude mari împărătești,</p>
                            <p>O prea frumoasă fată.</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>        
                        </div>
                        <div class="poem-date">1883</div>  
                    </article>
                    <!-- Liceu -->
                    <article>
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-3">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Liceu</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">George Bacovia</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>Liceu, - cimitir</p>
                            <p>Al tinereţii mele -</p>
                            <p>Pedanţi profesori</p>
                            <p>Şi examene grele...</p>
                            <p>Şi azi mă-nfiori</p>
                            <p>Liceu, - cimitir</p>
                            <p>Al tinereţii mele!</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                        </div>
                    </article>
                </section>
                <section>
                    <!-- Plumb -->
                    <article>      
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-4">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Plumb</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">George Bacovia</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>Dormeau adânc sicriele de plumb,</p>
                            <p>Si flori de plumb si funerar vestmint --</p>
                            <p>Stam singur în cavou... si era vint...</p>
                            <p>Si scirtiiau coroanele de plumb.</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                        </div>
                        <div class="poem-date">1902</div>  
                    </article>
                    <!-- Iarna pe uliţă -->
                    <article>
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-5">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Iarna pe uliţă</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">George Coşbuc</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>A-nceput de ieri să cadă</p>
                            <p>Câte-un fulg, acum a stat,</p>
                            <p>Norii s-au mai răzbunat</p>
                            <p>Spre apus, dar stau grămadă</p>
                            <p>Peste sat.</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                        </div>
                    </article>
                    <!-- Floare albastră -->
                    <article>
                        <div class="poem">
                            <span class="poem-bookmark" id="poem-bookmark-6">
                                <i class="far fa-bookmark"></i>
                            </span>
                            <h1 class="poem-title">
                                <a href="poems/Peneş-Curcanul.html">Floare albastră</a>
                            </h1>
                            <h4 class="poem-author">
                                <a href="">Mihai Eminescu</a>
                            </h4>
                        </div>
                        <div class="poem-strophe">
                            <p>Iar te-ai cufundat în stele</p>
                            <p>Și în nori și-n ceruri nalte?</p>
                            <p>De nu m-ai uita încalte,</p>
                            <p>Sufletul vieții mele.</p>
                            <a href="poems/Peneş-Curcanul.html" class="poem-read-more">[Read more]</a>
                        </div>
                    </article>
                </section>
            </section>
        </div>
    </main>
    <footer>
        <p>Made with <i class="fas fa-heart"></i> in Iași by <a href="https://github.com/denyky">@denypatrascu</a> & <a href="https://github.com/chiperiandrei">@andreichiperi</a>.</p>
    </footer>
    <script src="assets/js/script.js"></script>
</body>
</html>
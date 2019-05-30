<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poem Translator</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=latin-ext">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="/public/css/documentation.css">
</head>
<body>
    <header>
        <h1 class="title">
            <a href="/">Poem Translator</a>
        </h1>
        <section typeof="sa:AuthorsList">
            <h2>Creatorii și dezvolatorii aplicației:</h2>
            <ul>
                <li typeof="sa:ContributorRole" property="schema:author">
                    <span typeof="schema:Person">
                        <meta property="schema:givenName" content="Andrei">
                        <meta property="schema:familyName" content="Chiperi">
                        <span property="schema:name">Andrei Chiperi</span>
                    </span>
                    <ul>
                        <li property="schema:roleContactPoint" typeof="schema:ContactPoint">
                            <a href="mailto:jholland@umich.edu"
                               property="schema:email">andrei.chiperi98@gmail.com</a>
                        </li>
                    </ul>
                </li>
                <li typeof="sa:ContributorRole" property="schema:author">
                    <span typeof="schema:Person">
                        <meta property="schema:givenName" content="Deny">
                        <meta property="schema:additionalName" content="Constantin">
                        <meta property="schema:familyName" content="Pătrașcu">
                        <span property="schema:name">Deny-Constantin Pătrașcu</span>
                    </span>
                    <ul>
                        <li property="schema:roleContactPoint" typeof="schema:ContactPoint">
                            <a href="mailto:denypatrascu@gmail.com"
                               property="schema:email">denypatrascu@gmail.com</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </header>
    <main>
        <section>
            <h2>1. Descrierea aplicației:</h2>
            <p>
                Poem Translator este o aplicație Web care pune la dispoziția utilizatorilor acesteia o serie de poeme sau poezii.
                Acestea pot fi comentate și traduse în diferite limbi de către utilizatorii înregistrați în baza de date a aplicației.
                Poeziile pot fi, de asemenea, distribuite pe wordpress sau salvate în zona poeziilor favorite.
                Site-ul oferă utilizatorilor posibilitatea de a căuta o poezie sau un autor, cât și posibilitatea de a vedea profilul celorlați traducători.
                Un utilizator iși poate alege pe langă datele de înregistrare și o fotografie pentru profilul acestuia.
            </p>
            <p>Rezultatul mai multor poezii traduse este în avantajul utilizatorilor numiți în continuare și traducători, întrucât aceștia își vor largi spectrul cultural.</p>
            <p>Conceptual aplicația Poem Translater reușește să creeze o legătură între iubitorii de poezii din diferite țări. </p>
        </section>
        <section>
            <h2>2. Definirea actorilor și a rolurilor acestora:</h2>
            <p>
                Numim <strong>utilizator neconectat/nelogat</strong> acea persoană care nu este autentificată, având acces la un număr limitat de permisiuni.
                Printre acestea se numără: înregistrarea, completarea formularului de contact, vizualizarea poemelor, cautarea poemelor, vizualizarea comentariilor.
            </p>
            <p>
                Definim un <strong>traducător</strong> ca persoană care poate efectua operațiile mai sus menționate a unui utilizator neconectat la care se  traducerea unui poem, adăugarea/ștergerea comentariilor, adăugarea/ștergerea unui poem din secțiunea de favorite, plus operații asupra propriului profil (editare nume/prenume, modificare parolă, schimbare poză de profil).
            </p>
            <p>
                Atribuim rangul de <strong>moderator</strong> celui care are acces la panoul "Admin zone:" ce oferă posibilitatea adăugării/ștergerii poemelor și autorilor.
                Moderatorul poate șterge toate comentariile, nu doar cele care îi aparțin.
                Rolul moderatorului este de a menține o comunitate unită și etică.
            </p>
            <section>
                <h3>2. 1 Diagramă Use Case</h3>
                <figure typeof="sa:image" class="center">
                    <img src="/public/img/documentation/USE_CASE.png" alt="Diagramă Use Case" style="width: 100%">
                    <figcaption>Fig. 0: Diagramă Use Case</figcaption>
                </figure>
            </section>
        </section>
        <section>
            <h2>3. Arhitectura aplicației</h2>
            <p>Arhitectura este exemplificată în următoarea diagramă C4:</p>
            <figure typeof="sa:image" class="center">
                <img src = "/public/img/documentation/C4_1.png" alt="C4 Nivel 1">
                <figcaption>Fig. 1: Diagramă C4 (1)</figcaption>
            </figure>
            <figure typeof="sa:image" class="center">
                <img src="/public/img/documentation/C4_2.png" alt="C4 Nivel 2">
                <figcaption>Fig. 2: Diagramă C4 (2)</figcaption>
            </figure>
            <figure typeof="sa:image" class="center">
                <img src="/public/img/documentation/C4_3.png" alt="C4 Nivel 3">
                <figcaption>Fig. 3: Diagramă C4 (3)</figcaption>
            </figure>
            <figure typeof="sa:image" class="center">
                <img src="/public/img/documentation/C4_4.jpg" alt="C4 Nivel 4">
                <figcaption>Fig. 4: Diagramă C4 (4)</figcaption>
            </figure>
        </section>
        <section>
            <h3>3.1 Baza de date</h3>
            <figure typeof="sa:image" class="center">
                <img src="/public/img/documentation/MySQL.png" alt="DB MySQL" style="width: 100%">
                <figcaption>Fig. 5: Diagramă Bază de date</figcaption>
            </figure>
            <h3>3.2 Structura folderele și fișierelor</h3>
            <figure typeof="sa:image" class="center">
                <img src="/public/img/documentation/StructuraFoldere.png" alt="Structură">
                <figcaption>Fig. 6: Structura folderele și fișierelor</figcaption>
            </figure>
        </section>
        <section>
            <h2>4. Funcționalitățile aplicației</h2>
            <section style="padding-left: 20px">
                <section>
                    <h3>4.1 Funcționalități pentru un utilizator nelogat</h3>
                    <ul>
                        <li>Creare cont</li>
                        <li>Logare în aplicație</li>
                        <li>Mi-am uitat parola</li>
                        <li>Vizualizare/Căutare poem</li>
                        <li>Vizualizare traduceri</li>
                        <li>Vizualizare comentarii</li>
                        <li>Mesaj contact administrator</li>
                        <li>Vizualizare documentație</li>
                        <li>Utilizare API</li>
                    </ul>
                </section>
                <section>
                    <h3>4.2 Funcționalități pentru traducator</h3>
                    <ul>
                        <li>Toate funcționalitățile de mai sus</li>
                        <li>Adăugare/Ștergere comentariu</li>
                        <li>Adăugare traducere</li>
                        <li>Editare informații precum email, nume de utilizator, parola</li>
                        <li>Schimbare poză de profil</li>
                    </ul>
                </section>
                <section>
                    <h3>4.2 Funcționalități pentru moderator</h3>
                    <ul>
                        <li>Adăugare/Ștergere poem</li>
                        <li>Adăugare/Ștergere autor</li>
                        <li>Ștergere comentarii</li>
                    </ul>
                </section>
            </section>
        </section>
        <section>
            <h2>5. Stagiile de dezvoltare ale proiectului</h2>
            <ol>
                <li>Crearea bazei de date</li>
                <li>Popularea bazei de date</li>
                <li>Creare interfață utilizatori</li>
                <li>
                    Elaborarea arghitecturii MVC:
                    <ul>
                        <li>Creare claselor necesare (Controller, Model, View, etc.)</li>
                        <li>Realizarea legăturii cu baza de date</li>
                        <li>Crearea serviciilor, implementarea funcțiilor</li>
                        <li>Crearea de controllere prin care apelăm funcțiile implementate</li>
                    </ul>
                </li>
                <li>Testarea tuturor funcționalităților</li>
                <li>Code review și legarea modulelor</li>
            </ol>
        </section>
    </main>
    <footer>
        <section>
            <h1>6. Bibliografie</h1>
            <ol></ol>
        </section>
    </footer>
</body>
</html>
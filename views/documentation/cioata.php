<!DOCTYPE html>
<html lang = "ro-RO">
<head>
    <meta charset = "utf-8">
    <title> Documentatie AcaTisM </title>
    <link rel = "stylesheet" href = "Documentatie.css">
</head>
<body>
<article>
    <header>
        <h1 style = "font-size:250% !important;">
            Academic Thesis Manager
        </h1>
        <section typeof = sa:AuthorList>
            <h2 style = "font-size:150% !important;">
                Dezvoltat de:
            </h2>
            <ul style = "list-style-type : none;">
                <li typeOf = "sa:ContributorRole" property = "schema:Author">
							<span typeof="schema:Person">
								<span property="schema:name">Cercel Irina-Elena</span>
							</span>
                </li>
                <li typeOf = "sa:ContributorRole" property = "schema:Author">
							<span typeof="schema:Person">
								<span property="schema:name">Cioată Matei-Alexandru</span>
							</span>
                </li>
                <li typeOf = "sa:ContributorRole" property = "schema:Author">
							<span typeof="schema:Person">
								<span property="schema:name">Hălăucă Andrei</span>
							</span>
                </li>
                <li typeOf = "sa:ContributorRole" property = "schema:Author">
							<span typeof="schema:Person">
								<span property="schema:name">Rezmeriță Mihnea-Ioan</span>
							</span>
                </li>
            </ul>
        </section>
    </header>
    <section>
        <h2> 1. Descrierea aplicației </h2>
        <p> &emsp; &emsp; Aplicația "Academic Thesis Manager" este o aplicație Web ce se ocupă cu
            gestionarea lucrărilor de licență în Facultatea de Informatică. Prin intermediul acesteia, studenții își pot găsi îndrumători și se pot interesa de proiecte. După aplicarea la un proiect, studentul trebuie să aștepte răspunsul profesorului, iar în cazul unui răspuns afirmativ, trebuie să respecte cerințele proiectului și deadline-urile impuse de profesor, pentru a putea continua colaborarea cu acesta. Studenții și profesorii vor putea comunica între ei prin mesaje, vor avea profile personale pe care le pot modifica și își vor putea alege anumite domenii de interes. În momentul sosirii unui deadline, după ce studentul și-a îndeplinit sarcinile și a încărcat pe GitHub ce a avut de făcut, acesta este obligat să dea detalii despre acest pas în aplicație pentru a-i da de știre profesorului și pentru a-i fi validate acțiunile (de exemplu, dacă formatul este cel cerut). Noutățile importante (de exemplu, un profesor a modificat un deadline la proiectul la care lucrează deja un anumit student, sau un student a terminat sarcinile pentru un deadline, etc.) va duce la trimiterea unui mail pentru înștiințare (pentru a evita riscul în care destinatarul nu a intrat un timp pe aplicație). Toate aceste operațiuni vor putea fi efectuate în urma unei autentificări (conturile pentru studenții și profesorii din facultate vor fi existând deja în baza de date).
        </p>
        <p> &emsp; &emsp; Pentru dezvoltarea aplicației vor fi utilizate: HTML și CSS pentru front-end, PHP pentru back-end, MySQL pentru baza de date.
    </section>
    <section>
        <h2> 2. Baza de date a aplicației </h2>
        <figure typeOf = "sa:image">
            <img src = "Diagrams/FinalBDDiagram.jpg" alt = "DB Diagram" style = "width:100%;">
            <figcaption style = "text-align: center;">Fig. 1: DB Diagram</figcaption>
        </figure>
        <p>
            &emsp; &emsp; Pentru a stoca informațiile despre studenți, profesori, proiecte, etc., avem nevoie de o baza de date, deoarece sunt extrem de multe
            pentru a putea fi reținute local. După cum arată diagrama de mai sus, avem următoarele tabele:
        </p>
        <ol>
            <li> <em>Students</em> reține toate informațiile de care este nevoie pe profilul studenților: nume, prenume, contact, scurtă descriere, etc..</li>
            <li> <em>Teachers</em> reține toate informațiile de care este nevoie pe profilul profesorilor: nume, prenume, contact, scurtă descriere, etc..</li>
            <li> <em>Projects</em> reține toate informațiile despre proiecte de care este nevoie pentru ca studenții să fie lămuriți și să poată duce lucrarea la bun sfârșit: nume, scurtă descriere, descriere in detaliu, recomandări, etc..</li>
            <li> <em>Domains</em> reține toate domeniile existente în aplicație. Acest tabel are rolul de a ajuta la realizarea filtrărilor proiectelor după domeniu, sau la găsirea profesorilor cu domenii de interes asemănătoare cu ale studentului care caută.</li>
            <li> <em>Work</em> este o tabelă de legătură dintre profesori și domenii. Ne spune pe ce domenii lucrează toți profesorii.</li>
            <li> <em>Interests</em> este o tabelă de legătură dintre studenți și domenii. Ne spune de ce domenii sunt interesați toți studenții.</li>
            <li> <em>Subjects</em> este o tabelă de legătură dintre proiecte și domenii. Ne spune pe ce domenii sunt concentrate proiectele existente în baza de date.</li>
            <li> <em>Collaborations</em> este o tabelă de legătură dintre profesori și studenți. Aici vom putea găsi studenții care au îndrumător de licență și pentru fiecare este specificat colaboratorul.</li>
            <li> <em>Concepts</em> este o tabelă de legătură dintre profesori și proiecte. Aici se găsesc toți profesorii care au avut măcar o idee de proiect, împreună cu ideile lor.</li>
            <li> <em>Theses</em> este o tabelă de legătură dintre studenți și proiecte. Aici se găsesc toți studenții care și-au găsit deja colaborator de licență, împreună cu proiectul lor asignat.</li>
            <li> <em>Requests</em> este o tabelă de legătură dintre studenți și proiecte. Aceasta reține cererile studenților de înscriere la proiecte.</li>
            <li> <em>Messages</em> este o tabelă care reține mesajele dintre studenți și profesori (de exemplu, întrebări ale studenților despre proiect, răspuns, etc.).</li>
            <li> <em>Deadlines</em> este o tabelă care reține toate deadline-urile pentru fiecare proiect. Un deadline este setat de un profesor pentru un proiect și are mai multe atribute: data, extensia fișierului care trebuie încărcat (sau fișierelor), formatul, etc..</li>
            <li> <em>Commits</em> este o tabelă de legătură dintre studenți și deadline-uri. Toți studenții cu un proiect de licență deja asignat, după ce și-au terminat sarcinile aferente unui deadline și au încărcat pe GitHub, sunt obligați să dea și pe aplicație informații despre ce au făcut pentru a putea fi înștiințat profesorul coordonator. Această tabelă găzduiește aceste informații.</li>
        </ol>
        <p>
            &emsp; &emsp; De asemenea, un lucru important de menționat este că, detaliile conturilor utilizatorilor (studenții și profesorii) sunt salvate în baza de date.
            Așadar, pentru salvarea parolei (și eventual a username-ului), vom recurge la utilizarea unei funcții de hashing deja existente, cum ar fi <b>SHA256</b>.
            Parola va fi salvată codificat in BD, iar pentru verificarea datelor la o încercare de locare, se va codifica parola introdusă de utilizator și apoi se vor compara formele codificate.
        </p>
    </section>
    <section>
        <h2>3. Diagrama UseCase</h2>
        <figure typeOf = "sa:image">
            <img src = "Diagrams/UseCase.jpg" alt = "UseCase Diagram" style = "width:100%;">
            <figcaption style = "text-align: center;">Fig. 2: UseCase Diagram</figcaption>
        </figure>
    </section>
    <section>
        <h2>4. Funcționalitățile aplicației</h2>
        <section>
            <h3> 4.1 Funcționalități pentru profesori</h3>
            <ul>
                <li>Logare în aplicație - profesorul se autentifică cu datele de cont salvate în baza de date. Trebuie să își completeze username-ul și parola. Are și alte opțiuni precum schimbarea parolei.</li>
                <li>Vizualizare profil - profesorul își poate vizualiza profilul.</li>
                <li>Modificare profil - profesorul își poate modifica datele de pe profilul propriu. Aceste date vor fi preluate prima data din BD pentru o orientare mai ușoară, iar câmpurile modificate vor fi suprascrise înapoi.</li>
                <li>Adăugare proiect - profesorul poate adăuga proiecte noi în aplicație, pe care le pot vedea studenții și la care pot aplica. Proiectele noi vor fi adăugate și in baza de date.</li>
                <li>Modificare proiect - profesorul poate modifica anumite aspecte ale proiectelor sale din aplicație pe parcurs. Acestea constituie modificări importante pentru studenții asignați și de aceea ei vor primi un e-mail după actualizări, pentru cazul în care ei nu mai intră pe aplicație un timp. Modificările vor fi efectuate și în baza de date. Studenții au o pagină specială cu noutăți despre licență, atât din aplicație cât și din lumea exterioară. Vor apărea și aici aceste modificări.</li>
                <li>Ștergere proiect - profesorul își poate șterge proiectele propuse din aplicație DACĂ niciun student nu lucrează la ele. Ștergerea de va face și în baza de date.</li>
                <li>Acceptare/refuz studenți - când studentul aplică la un proiect, profesorul care a propus acel proiect are dreptul de a accepta/refuza acel student. În cazul acceptării, se vor insera legături în baza de date între student și profesor, respectiv între student și proiect. Din acest moment, profesorul și studentul vor colabora. În ambele cazuri, studentul va fi atenționat prin e-mail.</li>
                <li>Ștergere student de sub îndrumare - dacă un student nu respectă deadline-urile si sarcinile obligatorii, sau dacă cei doi au luat o decizie împreună, profesorul poate încheia colaborarea cu acel student. Se vor șterge legăturile aferente în baza de date.</li>
                <li>Trimitere/citire mesaj student - profesorii și studenții au șansa de a comunica chiar în aplicație în cazul unor întrebări despre proiect, deadline-uri, etc.. Profesorul poate citi aceste mesaje de la student și îi poate răspunde. După trimitere, ele vor fi salvate în baza de date.</li>
                <li>Vizualizare profil student/repository student - profesorul poate vizita profilul studenților săi și le poate vizualiza istoricul de commit-uri din aplicație, respectiv repository-ul de pe GitHub.</li>
                <li>Căutare proiect / studenți - profesorul poate filtra proiectele și studenții săi dupa nume sau domenii de interes, pentru a ajunge mai ușor la entitatea dorită.</li>
            </ul>
        </section>
        <section>
            <h3> 4.2 Funcționalități pentru studenți</h3>
            <ul>
                <li>Logare în aplicație - studentul se autentifică cu datele de cont salvate în baza de date. Trebuie să își completeze username-ul și parola. Are și alte opțiuni precum schimbarea parolei.</li>
                <li>Vizualizare profil - studentul își poate vizualiza profilul.</li>
                <li>Modificare profil - studentul își poate modifica datele de pe profilul propriu. Aceste date vor fi preluate prima dată din BD pentru o orientare mai ușoară, iar câmpurile modificate vor fi suprascrise înapoi.</li>
                <li>Căutare proiecte/profesori - pentru căutarea proiectului dorit de licență, studentul poate căuta mai ușor profesorii și proiectele din aplicație după nume și domenii de interes.</li>
                <li>Vizualizare proiecte/profesori - după căutarea unor proiecte și profesori, studentul poate opta să vadă mai multe informații.</li>
                <li>Aplicare pentru proiecte - După ce s-a decis pe unul/mai multe proiecte, acesta poate aplica pentru ele. Profesorul aferent va primi un e-mail de înștiințare și are datoria de a accepta sau de a refuza studentul. Aplicările care nu au fost încă răspunse vor fi salvate în tabela REQUESTS din baza de date.</li>
                <li>Trimitere/citire mesaj profesor - profesorii și studenții au șansa de a comunica chiar în aplicație în cazul unor întrebări despre proiect, deadline-uri, rezolvări, etc.. Studentul poate citi aceste mesaje de la profesor și poate răspunde. După trimitere, ele vor fi salvate în baza de date.</li>
                <li>Vizualizare repository - studentul are o pagină specială unde vor putea fi găsite link-ul către proiect și link-ul către documentație. Tot aici, el este obligat să mențină actualizat istoricul de lucru, având detalii despre ce a realizat și cum a realizat pentru fiecare deadline. Studentul poate da un astfel de "commit" doar odată pentru fiecare deadline, doar atunci când este sigur că a terminat toate sarcinile. Profesorul este înștiințat printr-un e-mail când studentul a încărcat un commit și poate verifica lucrarea. Commit-urile vor fi salvate in baza de date.</li>
            </ul>
        </section>
        <section>
            <h3> 4.3 Funcționalități automate</h3>
            <ul>
                <li>Notificări prin e-mail în situațiile importante menționate mai sus. Acestea sunt informații care trebuie transmise urgent. De exemplu, un profesor a setat un deadline cu o săptămână mai devreme și studentul crede că nu are de ce să mai intre pe aplicație cateva zile, caz în care nu vede modificarea efectuată.</li>
                <li>Verificare cerințe proiecte - când un student aplică la un proiect, trebuie în primul rând să fie interesat de ceea ce va lucra. De aceea, aplicația va verifica interesele studentului cu subiectele proiectului înainte ca înscrierea să fie validată. După ce sunt verificate domeniile și studentul se califică pentru acest proiect, abia atunci este profesorul corespunzător atenționat prin e-mail.</li>
                <li>Verificare commit-uri - aplicația verifică dacă ceea ce a lucrat studentul este în conformitate cu ce a cerut profesorul pentru deadline-ul respectiv (se vor verifica formatul, extensia fișierului/fișierelor, etc.). Dacă nu au fost respectate aceste cerințe, studentul trebuie să lucreze în continuare. După încărcarea unui commit valid, profesorul este înștiințat și poate intra să verifice lucrarea studentului.</li>
                <li>Monitorizare deadline-uri - studenții care nu respectă un deadline sunt avertizați prin e-mail că au depășit limita de timp și vor avea colaborarea întreruptă.</li>
                <li>Update news pentru studenți - de fiecare dată când o modificare importantă este realizată în aplicație sau când apare un program/articol important pe internet, va apărea în pagina de noutăți pe care o pot accesa studenții.</li>
            </ul>
        </section>
    </section>
    <section>
        <h2>5. Diagrame MVC</h2>
        <section>
            <h3>5.1 Profesori</h3>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/LoginProf.jpeg" alt = "Login Profesor" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 3: Login Profesor</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/ViewProfile.jpeg" alt = "View Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 4: View Profile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/EditProfile.jpeg" alt = "Edit Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 5: EditProfile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/AddProject.jpeg" alt = "Add Project" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 6: Add Project</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/EditProject.jpeg" alt = "Edit Project" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 7: Edit Project</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/RemoveProject.jpeg" alt = "Remove Project" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 8: Remove Project</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/AcceptStudent.jpeg" alt = "Accept Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 9: Accept Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/DeclineStudent.jpeg" alt = "Decline Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 10: Decline Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/RemoveStudent.jpeg" alt = "Remove Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 11: Remove Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/SearchProject.jpeg" alt = "Search Projects" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 12: Search Projects</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/SearchStudent.jpeg" alt = "Search Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 13: Search Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/ViewStudentProfile.jpeg" alt = "View Student Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 14: View Student Profile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/ViewStudentRepository.jpeg" alt = "View Student Repository" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 15: View Student Repository</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/ReceiveMessageFromStudent.jpeg" alt = "Read Message from Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 16: Read Message from Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/ProfMVC/SendMessageToStudent.jpeg" alt = "Send Message to Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 17: Send Message to Student</figcaption>
            </figure>
        </section>
        <section>
            <h3>5.2 Studenți</h3>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/loginStudent.jpg" alt = "Login Student" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 18: Login Student</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/vizualizareProfilStudent.jpg" alt = "View Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 19: View Profile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/editareProfilStudent.jpg" alt = "Edit Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 20: Edit Profile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/cautareProfesori.jpg" alt = "Search Teachers" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 21: Search Teachers</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/vizualizareProfilProfesor.jpg" alt = "View Teacher Profile" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 22: View Teacher Profile</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/cautareProiecte.jpg" alt = "Search Projects" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 23: Search Projects</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/vizualizareProiecte.jpg" alt = "View Projects" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 24: View Projects</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/aplicaProiect.jpg" alt = "Send Request" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 25: Send Request</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/vizualizareRepository.jpg" alt = "View Repository" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 26: View Repository</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/actualizareSolutieCurenta.jpg" alt = "Add Commit" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 27: Add Commit</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/citireMesajProfesor.jpg" alt = "Read Message from Teacher" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 28: Read Message from Teacher</figcaption>
            </figure>
            <figure typeOf = "sa:image">
                <img src = "Diagrams/StudMVC/trimitereMesajProfesor.jpg" alt = "Send Message to Teacher" style = "width:100%;">
                <figcaption style = "text-align: center;">Fig. 29: Send Message to Teacher</figcaption>
            </figure>
        </section>
    </section>
    <section>
        <h2>6. Stadii de dezvoltare ale proiectului</h2>
        <ol>
            <li>Crearea bazei de date;</li>
            <li>Popularea bazei de date (cu studenți și profesori în stadiul de început, după care vor fi inserate date la efectuarea operațiilor în aplicație);</li>
            <li>Crearea claselor necesare (studenți, proiecte, profesori, etc.);</li>
            <li>
                Elaborarea modelului:
                <ul>
                    <li>Realizarea legăturii cu baza de date;</li>
                    <li>Crearea serviciilor, implementarea funcțiilor;</li>
                    <li>Crearea de controllere prin care apelăm funcțiile implementate;</li>
                    <li>Opțional, crearea unui packet REPOSITORY care se va ocupa de interacțiunea cu baza de date. Funcțiile acestui pachet vor fi apelate în servicii;</li>
                </ul>
            </li>
            <li>Testarea tuturor funcționalităților;</li>
            <li>Code review și legarea modulelor;</li>
        </ol>
    </section>
    <section>
        <h2>7. Împărțirea pe module</h2>
        <p>
            &emsp; &emsp; <b>După o discuție cu toți membrii echipei, am căzut de acord să avem următoarea împărțire provizorie pe module:</b>
        </p>
        <p>
            &emsp; &emsp; Cercel Irina-Elena se va ocupa de sistemul de mesagerie al aplicației, prin care pot comunica studenții și profesorii (citire și trimitere de mesaje). Pe lângă aceasta, ea va realiza și funcționalitățile de afișare NEWS și LATEST PROJECTS.
        </p>
        <p>
            &emsp; &emsp; Cioată Matei-Alexandru va crea baza de date, o va popula cu studenți și profesori (și date despre aceștia) și se va ocupa de următoarele funcționalități pentru profesori: ADD/EDIT/DELETE PROJECTS, respectiv ACCEPT/DECLINE/DELETE STUDENTS.
        </p>
        <p>
            &emsp; &emsp; Hălăucă Andrei va realiza funcția de LOGIN împreună cu criptarea parolei, opțiunea de schimbare a parolei, pe lângă funcțiile de: căutare profesori și proiecte după nume și domenii din perspectiva studentului, respectiv de căutare studenți și proiecte din perspectiva profesorului.
        </p>
        <p>
            &emsp; &emsp; Rezmeriță Mihnea-Ioan se va ocupa de managementul profilelor: VIEW/EDIT, de repository-ul studenților cu verificările aferente ale detaliilor commit-urilor și validarea acestora, și de funcția de aplicare la proiecte pentru studenți.
        </p>
    </section>
    <section>
        <h2>8. Bibliografie</h2>
        <ol>
            <li><a href = "https://www.draw.io/"> Draw.io </a></li>
            <li><a href = "https://www.lucidchart.com/"> LucidChart </a></li>
            <li><a href = "https://www.tutorialspoint.com/design_pattern/mvc_pattern.htm?fbclid=IwAR38aNICM-vyy0tWCwM7IMnXB8cGkDnWp1YyJvgdPqLAtYtOFkh_UZ0WKhY"> Despre MVC pattern </a></li>
            <li><a href = "https://profs.info.uaic.ro/~adiftene/Scoala/2019/IP/index.html"> Despre diagrame UML și diagrame UseCase </a></li>
            <li><a href = "https://profs.info.uaic.ro/~andrei.panu/"> Resurse </a></li>
            <li><a href = "https://profs.info.uaic.ro/~busaco/teach/courses/web/web-projects.html"> Informare și documentare </a></li>
            <li><a href = "https://w3c.github.io/scholarly-html/"> Scholarly HTML </a></li>
        </ol>
    </section>
</article>
</body>
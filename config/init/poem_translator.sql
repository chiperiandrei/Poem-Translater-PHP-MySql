-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Mai 2019 la 10:43
-- Versiune server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poem_translator`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `authors`
--

CREATE TABLE `authors` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `BIRTH_DATE` int(4) UNSIGNED DEFAULT NULL,
  `DEATH_DATE` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Salvarea datelor din tabel `authors`
--

INSERT INTO `authors` (`ID`, `NAME`, `BIRTH_DATE`, `DEATH_DATE`) VALUES
(1, 'Mihai Eminescu', 1850, 1889),
(2, 'Vasile Alecsandri', 1821, 1890),
(3, 'George Bacovia', 1881, 1957),
(4, 'Ion Luca Caragiale', 1852, 1912),
(5, 'Tudor Arghezi', 1880, 1967),
(6, 'Maya Angelou', 1928, 2014),
(7, 'Victor Hugo', 1802, 1885),
(8, 'Torquato Tasso', 1544, 1595);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `author_images`
--

CREATE TABLE `author_images` (
  `ID_AUTHOR` int(11) NOT NULL,
  `PATH` varchar(100) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `author_images`
--

INSERT INTO `author_images` (`ID_AUTHOR`, `PATH`) VALUES
(2, '/vasile_alecsandri.jpg');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `poems`
--

CREATE TABLE `poems` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(75) CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `ID_AUTHOR` int(11) NOT NULL,
  `LANGUAGE` enum('RO','EN','DE','IT','FR','ES') CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `ID_STAFF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `poems`
--

INSERT INTO `poems` (`ID`, `TITLE`, `ID_AUTHOR`, `LANGUAGE`, `ID_STAFF`) VALUES
(1, 'Peneş Curcanul', 2, 'RO', 1),
(2, 'Liceu', 3, 'RO', 1),
(3, 'Phenomenal Woman', 6, 'EN', 1),
(4, 'Demain, dès l\'aube', 7, 'FR', 1),
(5, 'Io v\'amo sol perche', 8, 'IT', 1),
(6, 'Ecco mormorar l\'onde', 8, 'IT', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `staff`
--

INSERT INTO `staff` (`ID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `strophes`
--

CREATE TABLE `strophes` (
  `ID_POEM` int(11) NOT NULL,
  `NTH` int(3) NOT NULL,
  `TEXT` text COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `strophes`
--

INSERT INTO `strophes` (`ID_POEM`, `NTH`, `TEXT`) VALUES
(1, 1, 'Plecat-am nouă din Vaslui,\r\nŞi cu sergentul, zece,\r\nŞi nu-i era, zău, nimănui\r\nÎn piept inima rece.\r\nVoioşi ca şoimul cel uşor\r\nCe zboară de pe munte,\r\nAveam chiar pene la picior,\r\nŞ-aveam şi pene-n frunte.'),
(1, 2, 'Toţi dorobanţi, toţi căciulari,\r\nRomâni de viţă veche,\r\nPurtând opinci, suman, iţari\r\nŞi cuşma pe-o ureche.\r\nNe dase nume de Curcani\r\nUn hâtru bun de glume,\r\nNoi am schimbat lângă Balcani\r\nPorecla în renume!'),
(1, 3, 'Din câmp, de-acasă, de la plug\r\nPlecat-am astă-vară\r\nCa să scăpăm de turci, de jug\r\nSărmana, scumpa ţară.\r\nAşa ne spuse-n graiul său\r\nSergentul Mătrăgună,\r\nŞi noi ne-am dus cu Dumnezeu,\r\nNe-am dus cu voie bună.'),
(1, 4, 'Oricine-n cale ne-ntâlnea\r\nCântând în gura mare,\r\nStătea pe loc, s-ademenea\r\nCuprins de admirare;\r\nApoi în treacăt ne-ntreba\r\nDe mergem la vro nuntă?\r\nNoi răspundeam în hohot: \"Ba,\r\nZburăm la luptă cruntă!\"'),
(1, 5, '\"Cu zile mergeţi, dragii mei,\r\nŞi să veniţi cu zile!\"\r\nZiceau atunci bătrâni, femei,\r\nŞi preoţi, şi copile;\r\nDar cel sergent făr\' de musteţi\r\nRăcnea: \"Să n-aveţi teamă,\r\nRomânul are şapte vieţi\r\nÎn pieptu-i de aramă!\"'),
(1, 6, 'Ah! cui ar fi trecut prin gând\r\nŞ-ar fi crezut vrodată\r\nCă mulţi lipsi-vor în curând\r\nDin mândra noastră ceaţă!\r\nPriviţi! Din nouă câţi eram,\r\nŞi cu sergentul, zece,\r\nRămas-am singur eu... şi am\r\nÎn piept inima rece!'),
(1, 7, 'Crud e când intră prin stejari\r\nNăprasnica secure,\r\nDe-abate toţi copacii mari\r\nDin falnica pădure!\r\nDar vai de-a lumii neagră stea\r\nCând moartea nemiloasă\r\nCa-n codru viu pătrunde-n ea\r\nŞi când securea-i coasă!'),
(1, 8, 'Copii! aduceţi un ulcior\r\nDe apă de sub stâncă,\r\nSă sting pojarul meu de dor\r\nŞi jalea mea adâncă.\r\nAh! ochii-mi sunt plini de scântei\r\nŞi mult cumplit mă doare\r\nCând mă gândesc la fraţii mei,\r\nCu toţi pieriţi în floare.'),
(1, 9, 'Cobuz ciobanu-n Calafat\r\nCânta voios din fluier,\r\nIar noi jucam hora din sat,\r\nRâzând de-a bombei şuier.\r\nDeodat-o schijă de obuz\r\nTrăsnind... mânca-o-ar focul!\r\nRetează capul lui Cobuz\r\nŞ-astfel ne curmă jocul.'),
(1, 10, 'Trei zile-n urmă am răzbit\r\nPrin Dunărea umflată,\r\nŞi nu departe-am tăbărât\r\nDe Plevna blestemată.\r\nÎn faţa noastră se-nălţa\r\nA Griviţei redută,\r\nBalaur crunt ce-ameninţa\r\nCu gheara-i nevăzută.'),
(1, 11, 'Dar şi noi încă o pândeam\r\nCum se pândeşte-o fiară\r\nŞi tot chiteam şi ne gândeam\r\nCum să ne cadă-n gheară?\r\nDin zori în zori şi turci şi noi\r\nZvârleam în aer plumbii\r\nCum zvârli grăunţi de păpuşoi\r\nCa să hrăneşti porumbii.'),
(1, 12, 'Şi tunuri sute bubuiau...\r\nSe clătina pământul!\r\nŞi mii de bombe vâjâiau\r\nTrecând în zbor ca vântul.\r\nŞedea ascuns turcu-n ocol\r\nCa ursu-n vizunie.\r\nPe când trăgeam noi tot în gol,\r\nEl tot în carne vie...'),
(1, 13, 'Ţinteş era dibaci tunar,\r\nCăci toate-a lui ghiulele\r\nLoveau turcescul furnicar,\r\nDucând moartea cu ele.\r\nDar într-o zi veni din fort\r\nUn glonte, numai unul,\r\nŞi bietul Ţinteş căzu mort,\r\nÎmbrăţişându-şi tunul.'),
(1, 14, 'Pe-o noapte oarbă, Bran şi Vlad\r\nErau în sentinele.\r\nFierbea văzduhul ca un iad\r\nDe bombe, de şrapnele.\r\nÎn zori găsit-am pe-amândoi\r\nTăiaţi de iatagane,\r\nAlăture c-un moviloi\r\nDe leşuri musulmane.'),
(1, 15, 'Sărmanii! bine s-au luptat\r\nCu litfa cea păgână\r\nŞi chiar murind ei n-au lăsat\r\nSă cadă-arma din mână.\r\nDar ce folos, ceaţa scădea!\r\nŞ-acuma rămăsese\r\nCinci numai, cinci flăcăi din ea,\r\nŞi cu sergentul, şese!...'),
(1, 16, 'Veni şi ziua de asalt,\r\nCea zi de sânge udă!\r\nPărea tot omul mai înalt\r\nFaţă cu moartea crudă.\r\nSergentul nostru, pui de zmeu,\r\nNe zise-aste cuvinte:\r\n\"Cât n-om fi morţi, voi cinci şi eu,\r\nCopii, tot înainte!\"\r\n'),
(1, 17, 'Făcând trei cruci, noi am răspuns:\r\n\"Amin! şi Doamne-ajută!\"\r\nApoi la fugă am împuns\r\nSpre-a turcilor redută.\r\nAlelei! Doamne, cum zburau\r\nVoinicii toţi cu mine!\r\nŞi cum la şanţuri alergau\r\nCu scări şi cu faşine!'),
(1, 18, 'Iată-ne-ajunşi!... încă un pas.\r\n\"Ura!-nainte, ura!...\"\r\nDar mulţi rămân fără de glas.\r\nLe-nchide moartea gura!\r\nReduta-n noi repede-un foc\r\nCât nu-1 încape gândul.\r\nUn şir întreg s-abate-n loc,\r\nDar altul îi ia rândul.'),
(1, 19, 'Burcel în şant moare zdrobind\r\nO tidvă păgânească.\r\nŞoimu-n redan cade răcnind:\r\n\"Moldova să trăiască!\"\r\nDoi fraţi Călini, ciuntiţi de vii,\r\nSe zvârcolesc în sânge;\r\nNici unul însă, dragi copii,\r\nNici unul nu se plânge.'),
(1, 20, 'Atunci viteazul căpitan,\r\nCu-o largă brazdă-n frunte,\r\nStrigă voios: \"Cine-i Curcan,\r\nSă fie şoim de munte!\"\r\nCu steagu-n mâini, el sprintenel\r\nViu suie-o scară-naltă.\r\nEu cu sergentul după el\r\nSărim delaolaltă.'),
(1, 21, 'Prin foc, prin spăgi, prin glonţi, prin fum,\r\nPrin mii de baionete,\r\nUrcăm, luptăm... iată-ne-acum\r\nSus, sus, la parapete.\r\n\"Allah! Allah!\" turcii răcnesc,\r\nSărind pe noi o sută.\r\nNoi punem steagul românesc\r\nPe crâncena redută.'),
(1, 22, 'Ura! măreţ se-naltă-n vânt\r\nStindardul României!\r\nNoi însă zacem la pământ,\r\nCăzuţi pradă urgiei!\r\nSergentul moare şuierând\r\nPe turci în risipire,\r\nIar căpitanul admirând\r\nStindardu-n fâlfâire!'),
(1, 23, 'Şi eu, când ochii am închis,\r\nCând mi-am luat osânda:\r\n\"Ah! pot să mor de-acum, am zis\r\nA noastră e izbânda!\"\r\nApoi, când iarăşi m-am trezit\r\nDin noaptea cea amară,\r\nColea pe răni eu am găsit\r\n\"Virtutea militară\"!...'),
(1, 24, 'Ah! da-o-ar pomnul să-mi îndrept\r\nAceastă mână ruptă,\r\nSă-mi vindec rănile din piept,\r\nIar să mă-ntorc la luptă,\r\nCăci nu-i mai scump nimică azi\r\nPe lumea pământească\r\nDecât un nume de viteaz\r\nŞi moartea vitejească!'),
(2, 1, 'Liceu, - cimitir\r\nAl tinereţii mele -\r\nPedanţi profesori\r\nŞi examene grele...\r\nŞi azi mă-nfiori\r\nLiceu, - cimitir\r\nAl tinereţii mele!'),
(2, 2, 'Liceu, - cimitir\r\nCu lungi coridoare -\r\nAzi nu mai sunt eu\r\nŞi mintea mă doare...\r\nNimic nu mai vreu -\r\nLiceu, - cimitir\r\nCu lungi coridoare...'),
(2, 3, 'Liceu, - cimitir\r\nAl tinereţii mele -\r\nÎn lume m-ai dat\r\nÎn vâltorile grele,\r\nAtât de blazat...\r\nLiceu, - cimitir\r\nAl tinereţii mele!'),
(3, 1, 'Pretty women wonder where my secret lies.\r\nI’m not cute or built to suit a fashion model’s size   \r\nBut when I start to tell them,\r\nThey think I’m telling lies.\r\nI say,\r\nIt’s in the reach of my arms,\r\nThe span of my hips,   \r\nThe stride of my step,   \r\nThe curl of my lips.   \r\nI’m a woman\r\nPhenomenally.\r\nPhenomenal woman,   \r\nThat’s me.'),
(3, 2, 'I walk into a room\r\nJust as cool as you please,   \r\nAnd to a man,\r\nThe fellows stand or\r\nFall down on their knees.   \r\nThen they swarm around me,\r\nA hive of honey bees.   \r\nI say,\r\nIt’s the fire in my eyes,   \r\nAnd the flash of my teeth,   \r\nThe swing in my waist,   \r\nAnd the joy in my feet.   \r\nI’m a woman\r\nPhenomenally.'),
(3, 3, 'Phenomenal woman,\r\nThat’s me.'),
(3, 4, 'Men themselves have wondered   \r\nWhat they see in me.\r\nThey try so much\r\nBut they can’t touch\r\nMy inner mystery.\r\nWhen I try to show them,   \r\nThey say they still can’t see.   \r\nI say,\r\nIt’s in the arch of my back,   \r\nThe sun of my smile,\r\nThe ride of my breasts,\r\nThe grace of my style.\r\nI’m a woman\r\nPhenomenally.\r\nPhenomenal woman,\r\nThat’s me.'),
(3, 5, 'Now you understand\r\nJust why my head’s not bowed.   \r\nI don’t shout or jump about\r\nOr have to talk real loud.   \r\nWhen you see me passing,\r\nIt ought to make you proud.\r\nI say,\r\nIt’s in the click of my heels,   \r\nThe bend of my hair,   \r\nthe palm of my hand,   \r\nThe need for my care.   \r\n’Cause I’m a woman\r\nPhenomenally.\r\nPhenomenal woman,\r\nThat’s me.\r\n'),
(4, 1, 'Demain, dès l’aube, à l’heure où blanchit la campagne,\r\nJe partirai. Vois-tu, je sais que tu m’attends.\r\nJ’irai par la forêt, j’irai par la montagne.\r\nJe ne puis demeurer loin de toi plus longtemps.'),
(4, 2, 'Je marcherai les yeux fixés sur mes pensées,\r\nSans rien voir au dehors, sans entendre aucun bruit,\r\nSeul, inconnu, le dos courbé, les mains croisées,\r\nTriste, et le jour pour moi sera comme la nuit.'),
(4, 3, 'Je ne regarderai ni l’or du soir qui tombe,\r\nNi les voiles au loin descendant vers Harfleur,\r\nEt quand j’arriverai, je mettrai sur ta tombe\r\nUn bouquet de houx vert et de bruyère en fleur.'),
(5, 1, 'Io v\'amo sol perchè voi siete bella,\r\ne perchè vuol mia stella,\r\nnon ch\'io speri da voi, dolce mio bene,\r\naltro che pene.'),
(5, 2, 'E se talor gli occhi miei mostrate\r\naver qualche pietate,\r\nio non spero da voi del pianger tanto\r\naltro che pianto.'),
(5, 3, 'Nè, perchè udite i miei sospiri ardenti\r\nche per voi sprago a i venti,\r\naltro spera da voi questo mio core\r\nse non dolore.'),
(5, 4, 'Lasciate pur ch\'io v\'ami e ch\'io vi miri\r\ne che per voi sospiri,\r\nchè pene pianto e doglia è sol mercede\r\nde la mia fede.'),
(6, 1, 'Ecco mormorar l\'onde,\r\nE tremolar le fronde\r\nA l\'aura mattutina, e gli arboscelli,\r\nE sovra i verdi rami i vaghi augelli\r\nCantar soavemente,\r\nE rider l\'Oriente;\r\nEcco già l\'alba appare,\r\nE si specchia nel mare,\r\nE rasserena il cielo,\r\nE le campagne imperla il dolce gelo,\r\nE gli alti monti indora:\r\nO bella e vaga Aurora,\r\nL\'aura è tua messaggera, e tu de l\'aura\r\nCh\'ogni arso cor ristaura.');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `translations`
--

CREATE TABLE `translations` (
  `ID` int(11) NOT NULL,
  `ID_POEM` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `RATING` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0',
  `LANGUAGE` enum('RO','EN','DE','IT','FR','ES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `translations`
--

INSERT INTO `translations` (`ID`, `ID_POEM`, `ID_USER`, `RATING`, `LANGUAGE`) VALUES
(1, 2, 2, '3', 'EN'),
(2, 2, 2, '2', 'IT');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `translation_strophes`
--

CREATE TABLE `translation_strophes` (
  `ID_TRANSLATION` int(11) NOT NULL,
  `NTH` int(3) NOT NULL,
  `TEXT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `translation_strophes`
--

INSERT INTO `translation_strophes` (`ID_TRANSLATION`, `NTH`, `TEXT`) VALUES
(1, 1, 'High school, - cemetery\r\nMy youth -\r\nPedant teachers\r\nAnd heavy exams ...\r\nAnd today you are\r\nHigh school, - cemetery\r\nMy youth!'),
(1, 2, 'High school, - cemetery\r\nWith long corridors -\r\nToday is no longer me\r\nAnd my mind hurts ...\r\nNothing I ever want -\r\nHigh school, - cemetery\r\nWith long corridors ...'),
(1, 3, 'High school, - cemetery\r\nMy youth -\r\nThe world you gave me\r\nIn heavy rains,\r\nSo blasted ...\r\nHigh school, - cemetery\r\nMy youth!');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `LAST_NAME` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `USERNAME` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `USERNAME`, `PASSWORD`) VALUES
(1, 'John', ' Doe', 'admin@poem-translator.tw', 'admin', '21232F297A57A5A743894A0E4A801FC3'),
(2, 'Deny-Constantin', 'Pătrașcu', 'denypatrascu@gmail.com', 'denypatrascu', '8287458823FACB8FF918DBFABCD22CCB'),
(3, 'Andrei', 'Chiperi', 'chiperi.andrei@yahoo.ro', 'chiperiandrei', '8287458823FACB8FF918DBFABCD22CCB');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_images`
--

CREATE TABLE `user_images` (
  `ID_USER` int(11) NOT NULL,
  `PATH` varchar(100) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Salvarea datelor din tabel `user_images`
--

INSERT INTO `user_images` (`ID_USER`, `PATH`) VALUES
(2, 'profile_picture.jpg'),
(3, 'profile_picture.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `author_images`
--
ALTER TABLE `author_images`
  ADD PRIMARY KEY (`ID_AUTHOR`);

--
-- Indexes for table `poems`
--
ALTER TABLE `poems`
  ADD PRIMARY KEY (`ID`,`ID_AUTHOR`,`ID_STAFF`),
  ADD KEY `fk_poems__authors` (`ID_AUTHOR`),
  ADD KEY `fk_poems__staff` (`ID_STAFF`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `strophes`
--
ALTER TABLE `strophes`
  ADD PRIMARY KEY (`ID_POEM`,`NTH`) USING BTREE;

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_translations__poems` (`ID_POEM`),
  ADD KEY `fk_translations__usrs` (`ID_USER`);

--
-- Indexes for table `translation_strophes`
--
ALTER TABLE `translation_strophes`
  ADD PRIMARY KEY (`ID_TRANSLATION`,`NTH`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `poems`
--
ALTER TABLE `poems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `author_images`
--
ALTER TABLE `author_images`
  ADD CONSTRAINT `fk_author_images__authors` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `authors` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `poems`
--
ALTER TABLE `poems`
  ADD CONSTRAINT `fk_poems__authors` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `authors` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_poems__staff` FOREIGN KEY (`ID_STAFF`) REFERENCES `staff` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staff__users` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `strophes`
--
ALTER TABLE `strophes`
  ADD CONSTRAINT `fk_strophes__poems` FOREIGN KEY (`ID_POEM`) REFERENCES `poems` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `translations`
--
ALTER TABLE `translations`
  ADD CONSTRAINT `fk_translations__poems` FOREIGN KEY (`ID_POEM`) REFERENCES `poems` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_translations__usrs` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `translation_strophes`
--
ALTER TABLE `translation_strophes`
  ADD CONSTRAINT `fk_translation_strophes__translations` FOREIGN KEY (`ID_TRANSLATION`) REFERENCES `translations` (`ID`);

--
-- Restrictii pentru tabele `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `fk_user_images__users` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

use blogphpdb;


drop table if exists comment;
drop table if exists blogpost;
drop table if exists account;

#-------------------------ACCOUNT 

create table account
(id_account INT AUTO_INCREMENT PRIMARY KEY,
type ENUM('Admin', 'Moderateur') DEFAULT 'Moderateur' NOT NULL,
nom VARCHAR(50) NOT NULL,
prenom VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
mot_de_passe VARCHAR(50) NOT NULL,
statut ENUM('En attente de validation', 'Validé') DEFAULT 'En attente de validation' NOT NULL);

#-------------------------BLOGPOST 

create table blogpost
(id_blogpost INT AUTO_INCREMENT PRIMARY KEY,
titre VARCHAR(100) NOT NULL,
date DATETIME NOT NULL,
auteur INT NOT NULL,
chapo TEXT NOT NULL,
contenu TEXT NOT NULL,
imgheader VARCHAR(50) NOT NULL,
imgsecondary VARCHAR(50),
FOREIGN KEY (auteur)
        REFERENCES account(id_account)
        ON DELETE CASCADE);

#-------------------------COMMENT

create table comment
(id_comment INT AUTO_INCREMENT PRIMARY KEY,
id_blogpost INT NOT NULL,
pseudo VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
date DATETIME NOT NULL,
message TEXT NOT NULL,
statut ENUM('En attente de validation', 'Validé') DEFAULT 'En attente de validation' NOT NULL,
FOREIGN KEY (id_blogpost)
        REFERENCES blogpost(id_blogpost)
        ON DELETE CASCADE);
        
#-------------------------- INSERTION PREALABLE DES ACCOUNTS
insert into account(type, nom, prenom, email, mot_de_passe, statut) values('Admin', 'Bressano', 'Aurore', 'aurorebressano@gmail.com', 'motDePasseBlog', "Validé");

select * from account;
describe comment;

#------------------------- INSERTION POSTS
insert into blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) values("Bordeaux : Le public peut découvrir le bébé jaguar né au zoo de Pessac", NOW(), 1, " EVENEMENT - Une naissance de jaguar en captivité reste « rare et exceptionnelle » assure le zoo de Pessac en Gironde ", "<p>C’est un événement, que les équipes du zoo de Pessac, près de Bordeaux (Gironde), peuvent désormais partager avec le public. Le bébé jaguar né dans l’enceinte du zoo le 28 août dernier, peut désormais être admiré par les visiteurs, annonce l’établissement. « Sa première sortie a eu lieu le week-end dernier et s’est très bien déroulée » explique le zoo, qui attendait ces premiers pas avec impatience. L’animal, qui pesait 4,9 kg après cinq semaines est né du rapprochement au sein du zoo de Catalina et Mato, ses deux parents, il y a cinq ans.</p><p> Espèce menacée

Il s’agit d’une « excellente nouvelle pour la conservation, se réjouit le zoo, puisque le jaguar est une espèce menacée, inscrit sur la liste rouge de l’UICN (Union internationale pour la conservation de la nature). »

Une naissance de jaguar en captivité reste « rare et exceptionnelle. » « En 2021, seulement six jaguars sont nés sur l’ensemble des parcs membres de l’EAZA (Association européenne des zoos et aquariums) et deux en 2020.»</p>",
"jaguar1.jpg", "jaguar2.jpg");

insert into blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) values("Les services de sécurité et de secours bientôt équipés d’un réseau de communication très haut débit", NOW(), 1, "Equipements - Ce « Réseau Radio du Futur » permettra aux agents des services de secours et de sécurité de communiquer de manière plus efficace à partir de 2024 ", "<p>Le gouvernement a annoncé le renouvellement des équipements de communication des services de secours et de sécurité, comme l’avait annoncé Emmanuel Macron dès 2017. </p><p> Ce jeudi, le ministère de l’Intérieur a ainsi dévoilé le « Réseau Radio du Futur » destiné à remplacer des équipements datant des années 1990, rapportent nos confrères de BFM TV.

Ce système fournira des équipements 4G et 5G aux sapeurs-pompiers ou encore aux policiers afin de leur permettre de communiquer instantanément entre le terrain et les salles de commandement.</p>",
"reseau1.jpg", "reseau2.jpg");

insert into blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) values("Zedu-1, la voiture vraiment zéro émissions", NOW(), 1, "AUTO - Imaginée par DLR, l’agence aérospatiale allemande, la Zedu-1 est la future voiture zéro émission ! ", "<p>Une électrique plus propre que jamais, c’est le projet de la DLR avec la Zedu-1 (Zero Emission Drive Unit). </p><p>Cette voiture vise en effet à récupérer ses propres polluants, puisqu’un dispositif installé autour des roues a pour mission de récolter les particules des pneus et des freins. Un véhicule réellement neutre en émissions, donc. Le ministère allemand de l’Économie a d’ailleurs investi six millions d’euros dans le projet. </p>",
"voiture1.jpg", "voiture2.jpg");

insert into blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) values("Le boisement extensif augmente les précipitations sur le plateau de Lœss", NOW(), 1, "NATURE - Garnir d'arbres un espace peut-il jouer sur le climat régional ? Et, dans ce cas, quel est le rôle des précipitations ? Une équipe de chercheurs chinois révèle ses observations sur le sujet. ", "<p>Des chercheurs chinois ont récemment révélé que le boisement à grande échelle a contribué à augmenter les précipitations sur le plateau de Lœss, dans le nord-ouest du pays, en intensifiant le cycle de l'eau atmosphérique. 
Selon les chercheurs de l'université de Lanzhou, cette dernière étude permet de mieux comprendre comment le boisement affecte le climat régional du point de vue du recyclage des précipitations, et soutient les stratégies de boisement durable.</p><p>
Le boisement est une approche qui vise à contrôler l'érosion des sols, mais il consomme des ressources en eau supplémentaires et affecte les précipitations locales.

La Chine a procédé à un boisement extensif sur le plateau de Lœss pour atténuer l'érosion des sols et, par conséquent, il est essentiel d'étudier comment le cycle de l'eau atmosphérique réagit au boisement à grande échelle dans le contexte du changement climatique.</p>",
"foret1.jpg", "foret2.jpg");

insert into blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) values("Métavers : Qui sont les nouveaux architectes des mondes virtuels ?", NOW(), 1, " ARCHITECTURE - Alors que les métavers se développent, des architectes d’un nouveau genre tentent de créer de nouveaux mondes virtuels qui défient les lois du réel ", "<p>Voler, sauter, ne plus avoir besoin d’escaliers ou visiter des lieux sous l’eau : les promesses sont grandes autour des métavers, dont celui promu par Méta (anciennement Facebook). Si la révolution autour du Web3, des cryptomonnaies aux mondes virtuels en passant par les NFT semble s’accélérer, les mondes virtuels de demain ressemblent pour l’instant terriblement au nôtre. </p><p> Bureaux en 3D ressemblant à des immenses tours de La Défense, rues grises, ou simples reproductions du réel : pour beaucoup, l’expérience fournie par les métavers ne semble pas si différente d’un jeu comme Les Sims. Alors, d’autres essayent de changer les règles du jeu : c’est le cas de Neal Robert et Adrien Mouginot, cofondateurs de Bem. builders, une entreprise qui s’attelle à créer des expériences architecturales et artistiques dans les métavers, notamment pour des marques.

« On pense que l’expérience du virtuel doit être complémentaire, et non pas une pâle copie du monde physique. Ça doit être poétique et magique ! » défend Neal Robert. Avec ses cinq associés, il a créé une « metaverse experience factory », et utiliser le métavers comme outil pour construire des expériences.</p><p> « On sait que le Web3 reste un microcosme élitiste, donc on va chercher des grandes marques pour en démocratiser l’accès » appuie le cofondateur. Bem. builders a ainsi collaboré avec le groupe Casino, ou encore Carrefour et son NFBEEs, un supermarché de NFT dans le métavers destinés à sauver les abeilles. Pour ces architectes nouvelle génération, il s’agit donc de créer des expériences, et de repousser les limites de l’architecture.</p>
<h4>Un manifeste et une villa parfaite</h4>

<p>Pixel par pixel, Bem. builders compte imaginer d’autres mondes virtuels et d’autres paradigmes. Ils ont ainsi développé un « Manifeste de l’antigravité », manifeste architectural pour les métavers, destiné à imaginer des mondes « où chaque objet et chaque chose s’affranchit des normes de conception d’une réalité contraignante ». Pour Neal Robert, cette nouvelle définition des règles d’architecture adaptée au virtuel est nécessaire : « dans un monde virtuel, il n’y a pas d’escalier : on peut voler, sauter, se déplacer autrement. Alors si on est emmenés à repenser quelque chose aussi simple que des escaliers, il faut revoir les règles de mobilité et les espaces ». Changer de regard, ça s’apprend. « Quand je me déplace avec un PC ou un casque de réalité virtuelle, c’est une caméra que je déplace, et non un corps. On peut être actif au sein de l’espace et créer de nouveaux regards » explique Adrien Mouginot, directeur créatif et un de ses architectes du futur.</p>",
"metavers1.jpg", "metavers2.jpg");

describe blogpost;
select * from blogpost;
SELECT * FROM account WHERE email='aurorebressano@gmail.com' AND mot_de_passe='motDePasseBlog' AND statut="Validé";
select * from comment;
select * from account;
#------------------------- INSERTION COMMENTAIRES
insert into comment(id_blogpost, pseudo, email, date, message) values(1, 'aurore', 'aurorebressano@gmail.com', '2023-01-15', 'test!');

INSERT INTO account(nom, prenom, email, mot_de_passe) VALUES('test', 'testprenom', 'test@gmail.com', 'test');
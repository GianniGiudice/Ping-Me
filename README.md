<img src="Public/Images/logo.png" width=60 align="right"> 

# Ping-Me

## Contexte

### Explications / Présentation

Ce projet entre dans le cadre du cours de **CyberSécurité** du Semestre 1 de 1ère année de Master III à l'Université Catholique de Lille, FGES.

Le sujet est le suivant : création d'un site web volontairement vulnérable (**contenant des failles de sécurité**) et analyse de sécurité / propositions pour combler ces failles. Les technologies utilisées ainsi que les fonctionnalités proposées sont libres.

### To-do

- Le projet doit pouvoir être **lancé avec une commande docker** (et donc doit avoir un Dockerfile). 
   - Si la commande Docker ne fonctionne pas, la note sera sévère parce que je vais pas débugger le code de 30 personnes.
   - La commande doit apparaitre dans /README.md
- Le projet doit faire apparaitre un **dossier /tests** qui contiendra les tests unitaires qui permettraient de trouver les vulnérabilités dans votre code (vous avez carte blanche sur votre framework de test)
  - Par exemple : Un test d'injection SQL sur un paramètre GET
- Le projet doit faire un apparaitre un **dossier /exploit** qui contiendra les scripts qui permettront d'exploiter les vulnérabilités (vous avez carte blanche sur le langage du script, il faut que le script soit concis)
- Le projet doit être un **dépôt github publique**, pour que je puisse y jeter des coups d'oeil et pour les corrections
-  Le **code doit être lisible et donc correctement commenté** pour quelqu'un qui n'est pas dev (genre moi) mais qui sait lire de code (pas de "i++; // on incrémente i"). Si le code n'est pas propre et me fait perdre du temps quand je le lis, il y aura des malus.
- Le fichier README.md doit faire apparaitre les **objectifs de sécurité** de l'application :
  - Ses objectif en Confidentialité, Intégrité et Disponibilité (note /5)
- Le fichier README.md doit faire apparaitre un **graph mermaidjs** avec la surface d'attaque
- Un fichier Excel avec la même **analyse de sécurité** que le premier TP doit aussi apparaitre.

## Présentation du projet

### Description

Ping-Me est un Site Web sur le thème du Tennis de Table. Il représente l'ébauche d'un **simulateur de compétition de Tennis de Table**.

Ce projet a été créé **à partir de zéro et uniquement pour le projet de Cybersécurité**.

### Fonctionnalités

- Inscription
- Connexion
- Création / modification des données de la raquette / des revêtements
- Visualisation d'un ratio [ victoires - défaires ]
- Affrontement avec d'autres joueurs

### Technologies utilisées

Le projet est un site web réalisé avec **PHP7, HTML, CSS, Javascript, JQuery, SQL**.

Le site se lance via **apache**.

#### Pourquoi ce choix

Ayant l'habitude de développer sous Symfony (framework PHP), je me suis rapidement dirigé vers ce choix car c'est avant tout un sujet sur le cybersécurité et non sur le développement en soit. (je voulais donc une **technologie sur laquelle j'étais le plus à l'aise**) J'ai délaissé le framework Symfony pour ce projet car beaucoup de failles sont comblées / empêchées par le framework. En PHP natif, créer des failles est beaucoup plus simple et approprié.

## Installation et utilisation

### Installation

Il faut tout d'abord cloner le projet git via la commande suivante :

`git clone https://github.com/GianniGiudice/Ping-Me.git`

Un Dockerfile est présent à la racine du projet et va permettre l'installation des dépendances du projet, à savoir :
- Apache
- Mysql
- PHP

Il installera également la base de données nécessaire au projet.

Pour lancer le docker, il faudra **se positionner à la racine du projet** et lancer la commande suivante :

```
docker-compose up --build
```

L'application sera alors accessible via navigateur à l'adresse suivante :

`127.0.0.1:8001/Pingme`

**/!\ Attention :** seuls les caractères alphabétiques sont acceptés pour l'inscription. Il faudra donc vous nommer par exemple "Loic" au lieu de "Loïc".

## Deux applications différentes

### Sécurisée

### Vulnérable

Une version vulnérable se situe sur la branche **vulnerable** et permet de

#### La faille SQL

La faille SQL volontairement intégrée à cette branche va consister à permettre à l'utilisateur de modifier une requête SQL via un champ input.

On pourra par exemple créer un utilisateur dont le mail est test@test.com. Il sera possible de s'y connecter sans mettre le bon mot de passe en remplissant simplement le champ adresse mail par :

```
test@test.com';--
```

En mettant alors n'importe quel mot de passe, il sera possible de se connecter à ce compte. Cela fonctionne avec n'importe quelle adresse mail existante. 

Cette faille est très dangereuse car permet à un utilisateur un peu vicieux de se connecter sur n'importe quel compte à condition qu'il en connaisse l'identifiant / l'adresse mail.

##### Explication

Dans notre code vulnérable, voici comment nous gérons la connexion d'un utilisateur :

```
$sql = "SELECT * FROM user WHERE email = '" . $mail_address . "' AND password = '" . $password . "'";
$result = $this->executeRequest($sql);

if ($result->rowCount() > 0) {
    return true;
}
return false;
```

Et voici ce que donne ce code après l'entrée du pirate :

```
$sql = "SELECT * FROM user WHERE email = 'test@test.com';--' AND password = '" . $password . "'";
$result = $this->executeRequest($sql);

if ($result->rowCount() > 0) {
    return true;
}
return false;
```

Ainsi, à cause des caractères '; la requête se termine et les caractères -- sont des commentaires en SQL et permettent d'ignorer la suite de la ligne.

Le script généré va donc tout simplement récupérer un utilisateur en ne vérifiant que son adresse mail.

##### Protection

Pour contrer la faille SQL, il suffit heureusement de mettre en place ce qui est devenu la norme depuis l'arrivée de PDO : les requêtes préparées qui n'interprètent pas les caractères spéciaux. En utilisant des requêtes préparées, vous ne pourrez plus avoir à faire avec des failles SQL.

## Sécurisation de l'application

### Diagramme Mermaid : Surface d'attaque

<img src="mermaid-diagram.png">

### Les critères DICT

**Disponibilité**

Il n'y a aucune information visible de la part d'un joueur sur les autres joueurs du jeu. Il peut uniquement voir la liste des autres joueurs ainsi que leur ratio [victoires - défaites]. Ce dernier pouvant indiquer si un joueur est plutôt fort ou faible, cela peut être intéressant pour le choix d'adversaire lors d'une compétition. J'estime donc que la disponibilité devrait être à **1/5**.

**Intégrité**

Il est très important pour un joueur que ses données (notamment le matériel) ainsi que celles des autres joueurs (ratio compétition) restent inchangées et exactes car ayant peu d'informations, il est primordial que celles-ci soient les bonnes. J'estime donc que l'intégrité devrait être à **5/5**.

**Confidentialité**

Il est important pour un joueur de ne pas voir ses informations sur son équipement actuel dévoilées aux autres joueurs. Il serait alors trop facile aux joueurs de choisir leurs adversaires en prenant les combinaisons les plus faibles. C'est pour cette raison que j'estime que la confidentialité devrait être à **4/5**.

**Traçabilité**

Dans le cadre d'une application de simulation d'un joueur de tennis de table, il n'est pas essentiel d'avoir un historique des actions menées par le joueur et / ou ses adversaires. Il serait cependant intéressant pour lui de pouvoir consulter un historique de ses victoires / défaites avec les statistiques de sa raquette / de ses revêtements à chaque match afin qu'il puisse étudier quelle est la meilleure combinaison possible. C'est pour cette raison que j'estime que la traçabilité devrait être à **2/5**.

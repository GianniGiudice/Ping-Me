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

### Fonctionnalités

- Inscription
- Connexion
- Choix du matériel
- Amélioration des compétences
- Affrontement avec d'autres joueurs

### Technologies utilisées

Le projet est un site web réalisé avec **PHP7, HTML, CSS, Javascript, JQuery, SQL**.

Le site se lance via **apache**.

#### Pourquoi ce choix

Ayant l'habitude de développer sous Symfony (framework PHP), je me suis rapidement dirigé vers ce choix car c'est avant tout un sujet sur le cybersécurité et non sur le développement en soit. (je voulais donc une **technologie sur laquelle j'étais le plus à l'aise**) J'ai délaissé le framework Symfony pour ce projet car beaucoup de failles sont comblées / empêchées par le framework. En PHP natif, créer des failles est beaucoup plus simple et approprié.

# Autheur : CAZZOLI Valentin et PETRE Christophe 

## Projet PHP et projet tutuoré du s5
- Création d'un jeu de société

## Version de php utilisé lors du développement
- PHP 8.0.14

## navigateur testé
- Google chrome (entièrement développé dessus)
- Opera 
- Edge Chromium


## Rendu du projet PHP
- La base de données SQL ce trouve dans le répertoire public/assets/sql
- La base de données fournie donne accès à un jeu de données pour pouvoir essayer le site
- Le site respecte les consignes et donne accès à un espace de management des questions et des utilisateurs pour les admin
- De plus pour les utilisateurs non admin il y a la possibilité de modifié son profil sur la page profil
- Le site possède une gestion des routes sur la base du framework fait en cours
- Le site possède une gestion des sessions
- Le site possède une architecture Modèle (src/Core/Metier) un répertoire Controller (src/Core/Controller) un répertoire service (src/App/Controller) un répertoire pour les vues (/templates) plus un ensemble d'asset pour le bon fonctionnement des vues (/public/assets)
- Le site possède pour certaine page des appels AJAX.

## Github 
- https://github.com/chrisdemon8/board-game

## Technologies utilisées
- Php 8.0.14
- Ratchet
- JavaScript
- PHPMailer
- API google pour générer un qr Code
- Twig
- Composer


## Bilan sur les fonctionnalités

- Ajout / Supression / Modification User : Fonctionnel
- Ajout / Supression / Modification Question : Fonctionnel
- Ajout / Supression / Modification Réponse : Fonctionnel

- Creation d'une partie : Fonctionnel
- Déroulement d'une partie : Fonctionnel

## Taches des membres

- Christophe PETRE :
    - Liaison back et front
    - Appel Ajax
    - Websocket
    - Design


- Valentin CAZZOLI : 
    - Mise en place MVC
    - QRCode
    - Completion
    - Mail


## Manuel d'installation

Creer un fichier app.env.local dans config avec dedans 
<?php
return [
    'APP_ENV'=> 'dev',
    'DBNAME' => 'VOTRE NOM BDD', 
    'USERNAME' => 'VOTRE USERNAME BDD', 
    'PASSWORD' => 'VOTRE PASSWORD BDD',
    'MAIL'=>'VOTRE MAIL',(veuillez utiliser une adresse gmail ou modifiez le smtp ainsi que le port dans CreateGame.php)
    'MAIL_PASSWORD'=>'Votre mot de passe mail'
];

Génerez votre bdd grace au scripts dans App/bdd

utilisez composer et faites composer i dans /board-game

Démarez les websocket avec 'php .\SocketServerCommand.php' dans board-game/src/Command

et c'est partis !
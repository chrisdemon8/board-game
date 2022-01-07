# Autheur : CAZZOLI Valentin et PETRE Christophe 

## Projet PHP et projet tutuoré du s5
- Création d'un jeu de société

## Version de php utilisé lors du développement
- PHP 8.0.14

## navigateur testé
- Google chrome (entièrement développé dessus)
- Opera 
- Edge Chromium

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

Creer un fichier app.env.local dans public/assets/sql avec dedans 
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
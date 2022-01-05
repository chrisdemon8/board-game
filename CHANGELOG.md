# Changelog 
Tous les changements de ce projet seront documentés dans ce fichier.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).*
  
## 05-01-2022
 ## Added 
- Ajout de la partie permettant l'intéraction entre les joueurs et la partie
- Gestion du plateau de jeu et du système questions réponse avec maître du jeu en temps réel avec websocket
- Ajout de l'auto-complete

## 04-01-2022
 ## Added 
- Ajout du mailer  
- Ajout de la class Game ainsi que son controller 
- Ajout du lobby permettant la connexion des bons utilisateurs à une partie 


## 03-01-2022
## Added 
- Formatage des données pour que le back puissent avoir les joueurs, les couleurs afin de créer la partie 

## Fixed
- Fix d'un problème venant des chemins non absolu pour les assets

## 29-12-2021
## Added 
- Ajout dans la page d'accueil du formulaire pour créer une partie 
- Gestion complète en js du choix des différents username et couleur

## 23-12-2021
## Changed
- Adaptation du la gestion du tableau users comme la partie questions
- Meilleur gestion des erreurs dans le cas des appels ajax pour la partie users
- Dans la classe métier la date est passé en string par soucis de convertion avec la fonction jsonSerialize

## Fixed
- Ajout des lettres avec accents dans le regex qui vérifie les nom et les prénoms
- bug page inscription pour les helpertext
- Résolution problème date  

## 22-12-2021
## Added 
- Ajout des snackbar pour informer l'utilisateur en cas de succès ou d'erreur

## Changed
- Meilleur gestion des erreurs dans le cas des appels ajax pour la partie questions

## 21-12-2021 
## Added  
- Ajout du code SQL pour avoir une base de données avec un jeu de données minimales
- Ajout de la suppression d'une réponse
- Amélioration de la gestion du design des tableaux / changement couleur bouton
 
 ## Fixed 
- Dans les modals affichages des bons niveaux de difficultés
- Return uniquement les erreurs dans le cas d'appel ajax et non pas du templates twig error 


## 17-12-2021 
## Added 
- Ajout page 404
- Ajout du système de souscription pour les websockets 

## Fixed
- Sécurisation des routes 


## 14-12-2021 
## Added
- Ajout et implémentation de dataTable librairie JS (juste pour les questions)
- Ajout du serveur de websocket

## 13-12-2021 
## Changed
- Verification des entrées users et affichages d'informations pour aider l'utilisateur
- Message lui avertissant que l'email / pseudo est déjà utilisé et que le format n'est pas bon

## 09-12-2021 
## Changed
- Verification des entrées users ( plus de " ou ' pour noms et prénoms)

## Changed
- Ajout des questions sur la page même

## Fixed
- Bug des modifications de profils

## 09-12-2021 
## Added
- Ajout des actions back-end pour ajouter et/ou modifier les questions

## 08-12-2021 
## Added
- Modal pour ajouter et/ou modifier les questions

## 08-12-2021 
## Added
- Ajout des fonctions conform/allDataSet afin de vérifier que les objets passer en parametres
    dans les controllers sont remplis;
- Ajout de la modification d'une question pour les champs niveaux et label
- Ajout de la suppression d'une question 

## Fixed
- Hydrate dans la classe abstraite modele

## Changed to
- Ajout du Port pour la classe MyConnection

## 07-12-2021 
## Fixed
- Host récupéré avec app local
 
## Fixed
- jsonSerialize passé en récursif
 
## Added 
- Mise en place de l'affichage pour la liste des questions 
- Page pour l'admin 
- Gestion de l'accueil en fonction du role
- Ajout design pour les formulaires 

 
## Changed
- changement de la fonction jsonSerialize

## Fixed
- pas de mot de passe renvoyé au front au moment du chargement d'un utilisateur 
- jsonSerialize passé en récursif


## 04-12-2021
## Added
- Ajout class Modele pour la serialisations

## Changed
- Attribut des classes métier passés de private a protected


## 02-12-2021
## Added
- Ajout design bouton et inpu

## Changed
- Optimisation du fichier users.js pour la partie chargement des données, clique sur le bouton modifier et annulation

## 02-12-2021
## Added
- Ajout du bouton pour annuler l'édition d'une ligne
- Ajout du javascript qui gère l'affichage des modifications dans le tableau liste des utilisateur (rush pour que ça marche mais à opti --')
- Ajout des boutons pour modifier et supprimer lorsque vous êtes admin
- Ajout des fonctions pour supprimer dans la base de données au moment du clique sur supprimer
- Ajout de l'update du profil et changement de mot de passe pour un utilisateur


## 01-12-2021

## Added 
- Ajout des sessions 
- Ajout du système de connexion et de déconnexion
- Ajout du hash du password 
- Ajout de l'update du profil

## Changed
- vérification compte avec username possible 

## 30-11-2021
## Added 
- Ajout de l'affichage d'une question / style liste utilisateurs
- Ajout du formulaire de connexion / connexion controller et requête SQL

## Fixed 
- Correction de la vérification de l'utilisateur unique et de l'email unique
- Correction templates chemin pour une question

## 25-11-2021

- Ajout des answer / answer controller
- Ajout des question / question controller
- Ajout des templates basique pour question
- Mise en place d'ErrorManager
- Mise en place des restrictions sur user lors de l'inscription en back (pas de check en avant l'envoi du formulaire)
- et je ne sais plus le reste


## 24-11-2021

- Ajout des users / users controller
- Ajout des gestion basique de base de bdd
- Ajout d'exception basique
- Ajout des template basique d'affichage des users

## 24-11-2021

- Ajout de la structure de la base de donnée en script SQL dans assets/sql/php_project.sql

## 22-11-2021

### Added 
- Mise en place du framework (système de rooting et de templates)
- Mise en place des dépendances avec composer

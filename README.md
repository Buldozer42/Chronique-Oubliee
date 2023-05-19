# Chronique oubliée 📖

Bienvenue dans le projet "**Chronique oubliée**" ! Ce projet a été développé en utilisant le framework PHP Symfony pour faciliter la vie des maîtres du jeu dans le jeu de rôle "Chronique oubliée". Ce README.md vous fournira toutes les informations nécessaires pour démarrer le projet et l'utiliser efficacement.

# Table des matières 
- [Chronique oubliée 📖](#chronique-oubliée-)
- [Table des matières](#table-des-matières)
- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Installation](#installation)
  - [Pré requis](#pré-requis)
- [Configuration](#configuration)
- [Utilisation](#utilisation)
  - [Lancement](#lancement)
  - [Arrêt](#arrêt)
- [Dévelopeur 🧑‍💻](#dévelopeur-)

# Présentation
Chronique oubliée est un jeu de rôle populaire dans lequel les joueurs et le maître du jeu (MJ) explorent un univers fantastique rempli de créatures, de magie et d'aventures. 
Ce projet vise à faciliter la vie du MJ en fournissant une plateforme centralisée pour gérer divers aspects du jeu, y compris la création de personnages, 
la gestion des sessions de jeu, des combats et bien plus encore.

# Fonctionnalités
Le projet est actuellement en cours de développement. Les fonctionnalités suivantes sont déjà implémentées :
  * Gestion des personnages et des créature : création, modification et suppression de personnages avec leurs attributs, compétences et équipements.
  * Gestion des combats : création et gestion des combats grâce à un générateur de rencontres, aide pour créer des combats équilibrés.
  * Gestion des règles : accès rapide aux règles du jeu, aux références et aux ressources utiles pour le MJ.
  * Accès rapide aux aides de jeu : accès rapide aux aides de jeu, aux références et aux ressources utiles pour le MJ.
  * Accès à des playlists musicales : accès à des playlists musicales pour accompagner les sessions de jeu pendant les combats, les phases calme et les tavernes.
# Installation

## Pré requis
Pour installer et exécuter le projet localement, vous devez disposer des éléments suivants :
  * PHP 7.4 ou supérieur
  * Composer
  * Symfony CLI
  * MySQL 5.7 ou supérieur
  * Git
  * Wamp ou LAMP

Pour installer et exécuter le projet localement, suivez ces étapes :
  * Clonez le dépôt du projet dans le répertoire wwww de votre serveur local :
```bash
git clone https://github.com/Buldozer42/Chronique-Oubliee.git
```
  * Accédez au répertoire du projet.

````bash
cd Chronique-Oubliee
````

  * Installez les dépendances du projet à l'aide de Composer.
```bash
composer install
```
  * Configurez les paramètres d'environnement selon vos besoins (voir la section suivante).

Pour un guide d'installation plus détaillé, veuillez consulter le fichier [INSTALL.md](INSTALL.md).

# Configuration
Le projet nécessite certaines configurations pour fonctionner correctement. Suivez les étapes ci-dessous pour les configurer :
 * Créer un fichier `.env.local` et ajoutez y le lien de votre base de donnée :
```bash
# .env.local
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# or
DATABASE_URL="mysql://!name!:!mdp!@127.0.0.1:3306/drs?serverVersion=8&charset=utf8mb4"
# or
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```
 * Pour créer et remplir la base de donnée utiliser le script suivant [import.sql](import.sql), il est possible de l'importer directement dans phpMyAdmin.

# Utilisation
## Lancement
* Lancer WampServer (un éxécutable)
* Aller dans `C:\wamp64\www\Chronique-Oubliee` et faite clique droit `Ouvrir dans le terminal`
* Exécuter la commande `symfony server:start`

Le serveur est lancé, vous pouvez accéder au site via l'adresse `http://127.0.0.1:8000/` ou `http://localhost:8000/`

## Arrêt
* Aller dans le terminal ouvert précédemment et faire `Ctrl + C`
* Exectuer la commande `symfony server:stop`
* Fermer WampServer
    * Faire clique droit sur l'icone WampServer dans la barre des tâches
    * Cliquer sur `Fermer`

# Dévelopeur 🧑‍💻
- [Noé Garnier](https://www.github.com/Buldozer42)  

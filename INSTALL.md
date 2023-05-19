# Guide d'instalation

Ce guide d'installation vous permettra d'installer et d'exécuter le projet localement sur votre machine. Il s'addresse à tous les utilisateurs, qu'ils soient développeurs ou non. Il part également du principe que vous utilisez un système d'exploitation Windows et que vous n'avez aucun des prérequis nécessaires à l'installation du projet.

## WampServer

La première étape de l'installation consiste à installer WampServer. WampServer est un environnement de développement web pour Windows. Il vous permettra d'installer et de configurer un serveur web local sur votre machine. Pour installer WampServer, suivez les étapes ci-dessous :
* Téléchargez les dépendances de WampServer aux addrese suivante :
  * [Visual Studio 2010 Service Pack 1 (KB2736182)](https://www.microsoft.com/fr-fr/download/confirmation.aspx?id=34677) 
  * [Visual C++ Redistributable for Visual Studio 2012 Update 4](https://www.microsoft.com/en-us/download/details.aspx?id=30679)
  * [Visual C++ 2013 Redistributable for Visual Studio Update 5](https://www.microsoft.com/en-us/download/details.aspx?id=48145)
  * [Visual C++ Redistributable Packages for Visual Studio 2015-2022](https://aka.ms/vs/17/release/VC_redist.x64.exe)
  
Chaque lien coreespond à une version de VC Redistributable. Elle doivent toute être installer. Pour vérifier que tout as bien été instaler, Wamp fournit un outils disponible ici : [VC_Redist_Checker](http://wampserver.aviatechno.net/files/tools/check_vcredist.exe)

* Téléchargez la dernière version de WampServer à l'adresse suivante : [WampServer](https://www.wampserver.com/en/#download-wrapper)
* Exécutez le fichier téléchargé et suivez les instructions d'installation. Vous n'avez normalement pas besoin de modifier les paramètres par défaut.
* Une fois l'installation terminée, lancez WampServer. L'icône de WampServer devrait apparaître dans la barre des tâches de Windows. Si ce n'est pas le cas, redémarrez votre ordinateur.
* Vous avez désormais l'icône de WampServer dans la barre des tâches lorsqu'il passe au vert c'est que tout est bon.

### Configuration de mysql

Nous allons désormaise configurer mysql, un système de gestion de base de données, installer avec Wamp Server. Pour cela, suivez les étapes ci-dessous :
* Cliquez sur l'icône de WampServer dans la barre des tâches de Windows.
* Aller dans mysql et lancer mysql console.
* Appuie sur `ok` puis sur `enter` quand il vous demande un mot de passe.

On va changer le mots de passe de votre compte root, pour que l'applications puisse se connecter à la base de données. Pour cela, exécutez les commandes suivantes, une par une, en remplaçant `NEW_USER_PASSWORD` par le mot de passe de votre choix :
```sql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'NEW_USER_PASSWORD';
FLUSH PRIVILEGES;
```

## Symfony CLI

Wamp est désormais configuré, nous allons maintenant installer Symfony CLI. Symfony CLI est un outil qui permet de créer et de gérer des projets Symfony. Pour installer Symfony CLI, suivez les étapes ci-dessous :
* Ouvrez une invite de commande Windows powershel.(taper powershel dans la barre de recherche windows)
* Exécutez les commandes suivantes, une par une :
```bash
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex # Installe Scoop, neccessaire pour installer Symfony CLI
scoop install symfony-cli # Installe Symfony CLI
```

C'est tout, Symfony CLI est désormais installé sur votre machine.

## Composer

Nous allons maintenant installer Composer. Composer est un gestionnaire de dépendances pour PHP. Il permet de gérer les dépendances d'un projet PHP et vas surtout nous permettre d'installer les dépendances du projet. Pour installer Composer, suivez les étapes ci-dessous :

* Téléchargez la dernière version de Composer à l'adresse suivante : [Composer](https://getcomposer.org/Composer-Setup.exe)
* Exécutez l'instralleur en suivant les instructions. Vous n'avez normalement pas besoin de modifier les paramètres par défaut.

## Git

Nous allons maintenant installer Git. Git est un logiciel de gestion de versions décentralisé. Il permet de gérer l'évolution du code source d'un projet et vas surtout nous permettre de récupérer le code source du projet. Pour installer Git, suivez les étapes ci-dessous :

* Téléchargez la dernière version de Git à l'adresse suivante : [Git](https://gitforwindows.org)
* Exécutez l'installeur, pas besoin de modifier les paramètres par défaut.

## Installation et configuration du projet

Nous allons enfin récupérer le code source du projet et l'installer sur votre machine. Pour cela, suivez les étapes ci-dessous :
Il y a deux méthodes :
  * Ouvir un terminal powershell et taper la commande `cd C:\wamp64\www`, elle vous permet de vous déplacer dans le dossier `www` de WampServer.
  * Exécuter la commande `git clone https://github.com/Buldozer42/Chronique-Oubliee.git`

Ou bien :  
  * Aller dans le dossier `C:\wamp64\www`
  * Faite clique droit et cliquer sur `Ouvrir dans le terminal`
  * Exécuter la commande `git clone https://github.com/Buldozer42/Chronique-Oubliee.git`

Le code source du projet est désormais sur votre machine. Nous allons maintenant installer les dépendances du projet. Pour cela, dans le terminal powershell, exécutez les commandes suivantes, une par une :
```bash
cd Chronique-Oubliee # Se déplacer dans le dossier du projet
composer install # Installer les dépendances du projet
```

Nous allons maintenant configurer le projet. 
* Créer un fichier .env.local à la racine du projet. Il doit contenir la suivante :
```env
DATABASE_URL="mysql://root:!mdp!@127.0.0.1:3306/drs?serverVersion=8&charset=utf8mb4"
```
* Remplacer `!mdp!` par le mot de passe que vous avez choisi pour votre compte root mysql (celui que vous avez choisie lors de la configuration de mysql).

L'application peut désormais accéder à la base de données. Nous allons maintenant créer et remplir la base de données. Pour cela, nous allons utiliser PhpMyAdmin, un outil fournit par WampServer. Voici les étapes à suivre :
* Cliquez sur l'icône de WampServer dans la barre des tâches de Windows.
* Aller dans phpMyAdmin et cliquer sur la version la plus récente.
* Une page internet devrait s'ouvrir, connectez-vous avec le nom d'utilisateur `root` et le mot de passe que vous avez choisi pour votre compte root mysql.
* Cliquer sur `Nouvelle base de données` dans le menu de gauche.
* Donner lui le nom `drs` et cliquer sur `Créer`.
* Aller dans l'onglet `Importer` en haut de la page.
* Cliquer sur `Choisir un fichier` et sélectionner le fichier `import.sql` qui se trouve a la racine du projet.
* Cliquer sur `Exécuter` en bas de la page. La base de données vas se remplir (cela peut prendre quelques minutes).

## Conclusion

Le projet est désormais installé et configuré sur votre machine. Je vous invite à vous reporter aux [README.md](README.md). pour voir comment lancer le projet et comment l'utiliser.
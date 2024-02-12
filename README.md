# Application de chat en ligne

## Installation 

### Mise en place du projet

- Cloner le repository dans le dossier ``Homestead/code`` 
- Modifier le fichier ``Homestead.yaml`` dans le dossier ``Homestead``
- Ajouter dans ``sites`` :

    ```php
      - map: chatdevops.test
        to: /home/vagrant/code/chatdevops/public
    ```

- Ajouter dans ``databases`` :

    ```php
      - chatdevops
    ```

- Modifier le fichier ``host`` qui se situe dans le répertoire ``C:\Windows\System32\drivers\etc`` en ajoutant la ligne ``192.168.56.56 chatdevops.test`` puis sauvegarder


### Paramétrage de la base de données

- Copier le fichier ``.env.example`` et coller au même endroit puis renommer ce dernier en ``.env``
- Modifier le fichier ``.env`` en changeant les lignes suivantes : 

    ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=chatdevops
        DB_USERNAME=root
        DB_PASSWORD=secret
    ```

- Exécuter le cmd Windows, puis aller dans le dossier ``Homestead/`` 
- Exécuter ces lignes de commande :

    ```bash
        vagrant ssh
        cd /code/chatdevops
        composer install
        npm install
        npm run dev
        art migrate
    ```

## Création de l'utilisateur admin

### Tinker : 

- Créer l'utilisateur :

    ```bash
        artisan tinker
        User::create(["name"=> "admin","email"=>"admin@gmail.com","password"=>bcrypt("JppJaiP@rachute123")]);
    ```

## Gestion du rôle et habilitations

### Bouncer

- Se rendre à l'utilisateur admin avec les commandes suivantes (ici l'id numéro 1) :

    ```bash
        $user = User::find(1);
        Bouncer::allow('admin')->to('message-delete');
        Bouncer::assign('admin')->to($user);
        Bouncer::refresh;
        exit
    ```

## Utilisation de l'application web

ATTENTION ! Il y a un problème de CSS avec Bouncer !

- Créer un utilisateur sans les privilèges d'administrateur en entrant sur votre navigateur ``http://chatdevops.test/register`` et rentrer les informations souhaitées
- Une fois le compte créé, une redirection a lieu vers la page du chat


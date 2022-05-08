# Accueil

### Url
    /home

### Description courte
    La page d'accueil accueille les utilisateurs avec un message de bienvenue et présente notre site avec une description de ce que nous y louons. 

### Fonctionnalité principale
    Présentation du site et accueil des utilisateurs.

### Règles d'accès par profil
    Tout le monde peut accéder à cette page quelque soit son profil.

### Zones de la page
    Message de bienvenue
    Présentation des zombies
    Présentation des services proposés
    Présentation du système de rang

### Contenu
    La présentation des zombies se décline avec un titre (texte) et une description (texte).
    La présentation des services proposés se décline à l'aide d'une liste qui comporte, à chaque ligne :
        - le nom du service (texte)
        - la description du service (texte).
    La présentation du système de rang se décline également avec un titre (texte) et une description (texte).

### Appels asynchrones
    Appel à la base de données sur la table servicesType pour récupérer les noms et descriptions de tous les services.
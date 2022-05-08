# Connexion

### Url
    /login

### Description courte
    Il s'agit du dormulaire de connexion, il suffit de rentrer son email et son mot de passe pour se connecter sur le site en tant que client, gestionnaire ou administrateur en fonction de son rôle. Si on est un client, on accède à la page d'accueil du site et si on est administrateur ou gestionnaire, on accède à la liste des commandes côté back. Depuis cette page nous donnons aussi la possiblité au visiteur de se créer un compte.

### Fonctionnalité principale
    Connexion au site deadlivery.

### Règles d'accès par profil
    Tout le monde a accès à cette page

### Zones de la page
    Formulaire de connexion
    Boutons d'actions

### Contenu
    Le formulaire de connexion contient les champs suivants :
        - Email (email)
        - Mot de passe (password)
    Les boutons d'actions sont les suivant :
        - "Connexion", permet d'envoyer les données contenu dans les champs à la base de données et de tester leur existence dans la table user
        - "Mot de passe oublié", renvoit à la page mot de passe oublié
        - "Pas encore de compte ?", permet d'accéder à la page de création de compte client.

### Appels asynchrones
    Aucun appel asynchrone.
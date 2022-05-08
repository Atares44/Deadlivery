# Nouveau client

### Url
    /newaccount

### Description courte
    Un visiteur n'ayant pas encore de compte client peut en créer un sur cette page en remplissant le formulaire de création de compte. Toutefois, si l'email a déjà été utilisé, l'utilisateur ne pourra pas créer de compte client avec cette même adresse email. En cliquant sur valider, le visiteur envoie les données suivantes à la base de données : son nom, son prénom, son mot de passe, son pseudo, son adresse email, numéro de téléphone, son adresse.

### Fonctionnalité principale
    Création d'un nouveau compte client.

### Règles d'accès par profil
    Seuls les utilisateurs anonymes peuvent accéder à cette page.

### Zones de la page
    Titre
    Formulaire de création de compte
    Boutons d'actions

### Contenu
    Le formulaire contient les champs suivants :
        - Nom (texte)
        - Prénom (texte)
        - Pseudo (texte)
        - Mot de passe (password)
        - Confirmation du mot de passe (password)
        - Email (email)
        - Téléphone (tel)
        - Numéro de rue (texte)
        - Nom de rue (texte)
        - Code postal (texte)
        - Ville (texte)
        - Pays (texte)
    
    Les boutons d'actions sont les suivants :
        - "Valider", envoie les données à la base de données
        - "Annuler", renvoie à la page d'accueil.

### Appels asynchrones
    Aucun appel asynchrone.
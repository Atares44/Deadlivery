# Mon compte

### Url
    /myaccount

### Description courte
    Cette page retranscrit toutes les informations renseignées par le client, à savoir : son nom, son prénom, son pseudo, son adresse email, son numéro de téléphone, ses adresses. Cette page ne retranscrit pas le mot de passe, même crypté, pour des raisons de sécurité. A partir de cette page, l'utilisateur peut cliquer sur le bouton modifier pour accéder à la page modification du compte. Il peut aussi avoir accès à la liste de ses commandes passées et en cours ou encore supprimer son compte.

### Fonctionnalité principale
    Affichage des informations personnelles de l'utilisateur courant.

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les administrateurs peuvent accéder à cette page.

### Zones de la page
    Titre
    Informations du compte
    Boutons d'actions

### Contenu
    Les informations du compte sont présentées sous la forme d'une vue de détails comprenant :
        - Nom (texte)
        - Prénom (texte)
        - Pseudo (texte)
        - Email (email)
        - Téléphone (tel)
        - Une liste d'adresses comprenant les champs suivants pour chaque ligne :
            - Numéro de rue (texte)
            - Nom de rue (texte)
            - Code postal (texte)
            - Ville (texte)
            - Pays (texte)
    
    A la fin du formulaire se trouve plusieurs boutons dont :
        - le bouton "Modifier" qui renvoit vers la page de modification du compte
        - le bouton "Voir les commandes" qui renvoit vers les commandes en cours et passées
        - le bouton "Supprimer" qui permet à l'utilisateur de supprimer son propre compte.

### Appels asynchrones
    Appel à la base de données sur la table user pour récupérérer les informations de l'utilisateur courant.
    Appel à la base de données sur la table adress pour récupérer les informations des adresses de l'utilisateur courant.
# Modification du compte

### Url
    /myaccount/edit

### Description courte
    Cette page permet à l'utilisateur courant de modifier ses informations personnelles comme : son nom, son prénom, son pseudo, son adresse email, son numéro de téléphone et ses adresses.
   
### Fonctionnalité principale
    Modification des informations personnelles de l'utilisateur courant.

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Formulaire de modification
    Boutons d'actions

### Contenu
    Le formulaire de modification de compte contient les champs suivants :
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
    La dernière ligne de cette liste comprend uniquement des champs vides afin de rajouter une nouvelle adresse.
    
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", envoie les données du formulaire à la base de données pour les remplacer 
        - "Annuler", renvoie à la page "mon compte".

### Appels asynchrones
    Appel à la base de données sur la table user pour récupérérer les informations de l'utilisateur courant.
    Appel à la base de données sur la table adress pour récupérer les informations des adresses de l'utilisateur courant.
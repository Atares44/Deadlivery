# Paiement de la commande

### Url
    /payment

### Description courte
    Cette page sert à payer une commande en passant par les étapes de paiement habituelles. On commence donc par le choix du moyen de paiement, ensuite on choisit l'adresse de livraison puis l'adresse de facturation et enfin on finalise la commande avec le paiement de celle-ci.

### Fonctionnalité principale
    Paiement de la commande

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Moyen de paiement
    Adresses
    Boutons d'actions

### Contenu
    La première partie de la page consiste en le choix du moyen de paiement et un formulaire ensuite si le choix est la carte bancaire. Le formulaire comporte les champs suivants :
        - Type de carte (liste déroulante, choix unique)
        - Propriétaire de la carte (texte)
        - Numéro de carte (texte)
        - Date d'expiration mois (liste déroulante, choix unique)
        - Date d'expiration année (liste déroulante, choix unique)
        - Cryptogramme visuel (texte)
    
    La seconde partie de la page sera consacrée au choix des adresses de livraison et de facturation. Pour ces deux adresses l'utilisateur aura le choix entre toutes les adresses qu'il aura précédemment reliées à son compte. Il pourra donc en séléctionné une à l'aide d'un select sur la liste de ses adresses enregistrées, cette liste comprend les champs suivants :
        - Numéro de rue (texte)
        - Nom de rue (texte)
        - Code postal (texte)
        - Ville (texte)
        - Pays (texte)
    
    Les boutons d'actions à la fin sont les suivants :
        - "Valider", qui valide la commande et envoie les informations à la base de données
        - "Annuler", qui renvoie à la page du panier.

### Appels asynchrones
    Appel à la base de données sur la table adress pour récupérer les informations des adresses de l'utilisateur courant.
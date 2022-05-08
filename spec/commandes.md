# Commandes

### Url
    /orders

### Description courte
    C'est sur cette page que l'utilisateur courant va avoir un récapitulatif de ses commandes en cours et de ses commandes passées. Au clic sur la ligne d'une commande, l'utilisateur aura accès au récapitulatif de celle-ci ou, si c'est une commande en cours de livraison, au suivi de la commande.

### Fonctionnalité principale
    Affichage des commandes en cours et passées de l'utilisateur courant

### Règles d'accès par profil
    Seuls les utilisateurs conectés, les gestionnaires et les administrateurs ont accès à cette page

### Zones de la page
    Commandes en cours
    Commandes passées

### Contenu
    Les commandes en cours et passées sont présentées sous la forme de deux listes avec les mêmes champs :
        - Numéro de commande (texte)
        - Prix total de la commande (texte)
        - Etat de la commande (texte)
        - Date de passage de la commande (date)
        - Date de livraison ou date de livraison estimée (date)

### Appels asynchrones
    Appel à la base de données sur la table orders pour récupérer les informations des commandes.

# Suivi de commande

### Url
    /orders/{id_order}

### Description courte
    Sur cette page le client peut suivre l'avancement de la livraison de sa commande. La commande peut passer par plusieurs étapes : en préparation, en cours de livraison, livrée. Un client qui souhaite louer un zombie actuellement loué peut voir à quelle étape de la location le zombie se trouve, ainsi que la date de fin de location pour le louer dès que la location se termine. S'il y a des incidents retardant la location le client peut aussi y avoir accès.

### Fonctionnalité principale 
    Suivi de la commande en cours

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les admiistrateurs ont accès à cette page.

### Zones de la page
    Informations sur la commande
    Etapes de la livraison
    Bouton "Retour"

### Contenu
    Les informations liées à la commande se présentent sous la forme d'une liste récapitulant les éléments suivants :
        - Nom du/des produit(s) (texte)
        - Quantité de chaque produit (nombre)
        - Prix total de la commande (texte)
        - Adresses de livraison et de facturation (texte)
        - Numéro de commande (texte)
        - Date de la commande (date)

    Dans une deuxième partie, l'utilisateur pourra voir les étapes de la livraison par lesquelles sa commande est passée, sous la forme d'une liste contenant les éléments suivants pour chaque ligne :
        - Nom de l'étape (texte)
        - Commentaires laissés par les administrateurs (texte)
    Dans cette partie on peut également voir la date de livraison estimée (date).
    Juste en dessous se trouve un bouton "Retour" qui permet de retourner à la page de la liste des commandes.

### Appels asynchrones
    Appel à la base de données sur la table orders pour récupérer les informations de la commande et l'état de celle-ci.
    Appel à la base de données sur la table adress pour récupérer les informations des adresses de livraison et de facturation liées à la commande.
# Récapitulatif de commande

### Url
    /orders/{id_order}

### Description courte
    Cette page récapitule toutes les informations concernant une commande précise, à savoir la numéro de la commande, les produits, ainsi que leur quantité, et le prix tolal de la commande. On y retrouve également les adresses de livraison et de facturation ainsi que la date à laquelle a été livrée la commande.

### Fonctionnalité principale
    Affichage des informations de la commande

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Informations de la commande
    Bouton "Retour"

### Contenu
    Les informations de la commande sont présentées sous la forme d'une vue de détails qui affiche les informations de la commande avec les champs suivants :
        - Numéro de commande (texte)
        - Liste du contenu de la commande, avec pour chaque ligne :
            - Nom du produit (texte)
            - Quantité (nombre)
        - Prix total (texte)
        - Adresse de livraison (texte)
        - Adresse de facturation (texte)
        - Date de livraison (date)
    Sous cette vue se trouve un bouton "Retour" qui permet de retourner à la page de la liste des commandes.

### Appels asynchrones
    Appel de la base de données sur la table orders pour récupérer les informations de la commande.
    Appel de la base de données sur la table adress pour récupérer les informations des adresses de livraison et de facturation.
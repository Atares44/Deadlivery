# Panier

### Url
    /panier

### Description courte
    Il s'agit de l'affichage du panier de l'utilisateur avec les produits qu'il y a ajouté précédemment ainsi que le sous total et total qui y sont calculés et présentés. Le sous total est la somme des prix des produits sans les frais de livraison et le total comprend les frais de livraison et les promotions. L'utilisateur peut ici supprimer des produits de son panier, modifier la quantité d'un même produit dans son panier ou encore passer au paiement de sa commande.

### Fonctionnalité principale
    Affichage et modification du panier.

### Règles d'accès par profil
    Seuls les utilisateurs connectés, les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Récapitulatif panier
    Sous total et total
    Boutons d'actions

### Contenu
    Le panier est présenté avec une liste récapitulant les achats de l'utilisateur courant, avec pour chaque ligne :
        - Nom du produit (texte)
        - Quantité (nombre)
        - Prix (nombre)
        - Bouton "Modifier", qui permet de modifier la quantité du produit
        - Bouton "Supprimer", qui permet de supprimer le produit du panier.
    
    On affiche ensuite sous la forme d'une liste les données finales du panier avec le sous-total et le total avec sur chaque ligne :
        - Titre (texte), soit le nom du produit, soit sous-total ou total
        - Quantité (nombre), pour les lignes de produit
        - Prix (nombre).
    
    Les boutons d'actions sont les suivants : 
        - "Valider", qui sert à valider le panier et passer à la page de paiment de celui-ci
        - "Annuler", qui sert à retourner à la derière page visitée.

### Appels asynchrones
    Appel à la base de données sur la table prducts pour récupérer les noms et les prix des produits contenus dans le panier.
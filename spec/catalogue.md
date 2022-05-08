# Catalogue

### Url
    /products

### Description courte
    Le catalogue présente tous les zombies s'il n'y a aucun filtre sélectionné par l'utilisateur. L'utilisateur peut utiliser un ou plusieurs filtres parmis les suivants : un mot clé, une nature de zombie, un service ou encore un intervalle de prix. L'affichage du catalogue se modifie alors selon le ou les filtres choisit par l'utilisateur. L'utilisateur peut ensuite cliquer sur un produit pour découvrir sa fiche.

### Fonctionnalité principale
    Affichage de tous les zombies, filtré en fonction des choix de l'utilisateur.

### Règles d'accès par profil
    Tout le monde a accès à cette page.

### Zones de la page
    Espace de recherche
    Produits

### Contenu
    L'espace de recherche comporte une barre de recherche où l'on peut rentrer un ou plusieurs mots clés et plusieurs dropdowns qui correspondent aux filtres, qui sont :
        - la nature du zombie
        - le service
        - un intervalle de prix
    Pour chaque produit, on affiche son image, son nom et son prix.

### Appels asynchrones
    Sans filtre :
        Appel à la base de données sur la table products pour afficher tous les produits.
    Avec filtre(s) :
        Appel à la base de données sur la table products pour afficher les produits correspondants à la recherche.
# Liste des produits

### Url
    /admin/products/

### Description courte
    Cette page affiche tous les produits.
    Depuis cette page, on peut supprimer ou ajouter un produit.
    On peut aussi avoir accès au détail du produit en cliquant dessus.
   
### Fonctionnalité principale
    Affichage de tous les produits.

### Règles d'accès par profil
    Seuls les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Liste des produits
    Bouton d'ajout

### Contenu
    La liste des produits est affichée sous ce format :
        - Nom du produit (texte), cliquable pour accéder au détail du produit
        - Bouton "Supprimer" pour supprimer depuis la liste un produit
    Le bouton d'action "Ajouter" permet d'accéder au formulaire d'ajout d'un produit.
 
### Appels asynchrones
    Appel à la base de données sur la table products pour récupérer les noms et ID de tous les produits.
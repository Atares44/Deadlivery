# Affichage d'un produit

### Url
    /admin/products/{id}

### Description courte
    Cette page affiche les informations concernant le produit séléctionné.
    Depuis cette page, on peut modifier le produit, le supprimer ou encore retourner sur la liste de tous les produits.
   
### Fonctionnalité principale
    Affichage d'un produit avec ses informations.

### Règles d'accès par profil
    Seuls les administrateurs et les gestionnaires ont accès à cette page.

### Zones de la page
    Nom du produit
    Informations sur le produit
    Boutons d'actions

### Contenu
    Les informations du produit sont:
        - Description du produit (texte)
        - Nature du produit (texte)
        - Service proposé par le produit (texte)
        - Image du produit (image)
        - Prix du produit (nombre)
    Les boutons d'actions sont :
        - "Modifier", pour accéder au formulaire de modification du produit
        - "Supprimer", pour supprimer le produit
        - "Retour", pour accéder à la liste des produits.
 
### Appels asynchrones
    Appel à la base de données sur la table products pour récupérer les informations du produit.
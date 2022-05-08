# Ajout d'un produit
   
### Url
    /admin/products/new

### Description courte
    Cette page affiche un formulaire vierge pour créer et ajouter un nouveau produit. 
    L'ajout peut être validé ou bien l'on peut revenir sur la liste des produits en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Ajout d'un produit.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Titre
    Formulaire d'ajout
    Boutons d'actions

### Contenu
    Le formulaire d'ajout d'un produit contient les champs suivants :
        - Nom du produit (texte)
        - Description du produit (texte)
        - Nature du produit (séléction)
        - Service proposé par le produit (séléction)
        - Image du produit (image)
        - Prix du produit (nombre)
    A la fin du formulaire on trouve deux boutons :
        - "Ajouter", qui ajoute le nouveau produit en base
        - "Annuler", qui renvoie à la liste des produits.

### Appels asynchrones
    Aucun appel asynchrone.
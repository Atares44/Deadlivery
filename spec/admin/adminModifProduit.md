# Modification d'un produit
   
### Url
    /admin/products/{id}/edit

### Description courte
    Cette page affiche un formulaire pré-rempli avec les informations du produit pour les modifier, soit son nom, sa description, sa nature, le service auquel il est rattaché, son image et son prix.
    La modification peut être validée ou bien l'on peut revenir sur la page d'affichage du produit en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Modification d'un produit.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Nom du produit
    Formulaire de modification
    Bontons d'actions

### Contenu
    Le formulaire de modification du produit contient les champs suivants :
        - Nom du produit (texte)
        - Description du produit (texte)
        - Nature du produit (séléction)
        - Service proposé par le produit (séléction)
        - Image du produit (image)
        - Prix du produit (nombre)
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", qui valide les modifications
        - "Annuler", qui renvoie à la page de visualisation du produit.
     
### Appels asynchrones
    Appel à la base de données sur la table products pour récupérer les informations du produit.
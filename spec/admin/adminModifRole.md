# Modification d'un rôle

### Url
    /admin/roles/{id}/edit

### Description courte
    Cette page affiche un formulaire pré-rempli avec les informations du rôle pour les modifier, soit son nom.
    La modification peut être validée ou bien l'on peut revenir sur la page d'affichage du rôle en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Modification du rôle.

### Règles d'accès par profil
    Seuls les administrateurs ont accès à cette page.

### Zones de la page
    Nom du rôle
    Formulaire de modification
    Boutons d'actions

### Contenu
    Le formulaire de modification contient les champs suivants :
        - Nom du rôle (texte)
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", qui valide les modifications
        - "Annuler", qui renvoie à la page de visualisation du rôle.
  
### Appels asynchrones
    Appel à la base de données sur la table role pour récupérer les informations du rôle.
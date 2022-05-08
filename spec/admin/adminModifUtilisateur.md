# Modification d'un utilisateur
   
### Url
    /admin/users/{id}/edit

### Description courte
    Cette page affiche un formulaire pré-rempli avec les informations de l'utilisateur pour les modifier, soit son nom, son prénom, son pseudo, son email, son numéro de téléphone et son rôle.
    La modification peut être validée ou bien l'on peut revenir sur la page d'affichage de l'utilisateur en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Modification d'un utilisateur.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Nom et prénom de l'utilisateur
    Formulaire de modification
    Boutons d'actions

### Contenu
    Le formulaire de modification de l'utilisateur contient les champs suivants :
        - Nom (texte)
        - Prénom (texte)
        - Pseudo (texte)
        - Email (email)
        - Numéro de téléphone (tel)
        - Rôle (sélection)
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", qui valide les modifications
        - "Annuler", qui renvoie à la page de visualisation de l'utilisateur.

### Appels asynchrones
    Appel à la base de données sur la table user pour récupérer les informations de l'utilisateur.
# Ajout d'un utilisateur
   
### Url
    /admin/users/new

### Description courte
    Cette page affiche un formulaire vierge pour créer et ajouter un nouvel utilisateur. 
    L'ajout peut être validé ou bien l'on peut revenir sur la liste des utilisateurs en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Ajout d'un utilisateur.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Titre
    Formulaire d'ajout
    Boutons d'actions

### Contenu
    Le formulaire d'ajout d'un utilisateur contient les champs suivants :
        - Nom (texte)
        - Prénom (texte)
        - Pseudo (texte)
        - Email (email)
        - Numéro de téléphone (tel)
        - Rôle (sélection)
    A la fin du formulaire on trouve deux boutons :
        - "Ajouter", qui ajoute le nouvel utilisateur en base
        - "Annuler", qui renvoie à la liste des utilisateurs.

### Appels asynchrones
    Aucun appel asynchrone.
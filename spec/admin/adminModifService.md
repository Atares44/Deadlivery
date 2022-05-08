# Modification d'un service
   
### Url
    /admin/services-type/{id}/edit

### Description courte
    Cette page affiche un formulaire pré-rempli avec les informations du service pour les modifier, soit son nom et sa description.
    La modification peut être validée ou bien l'on peut revenir sur la page d'affichage du service en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Modification d'un service.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Nom du service
    Formulaire de modification
    Boutons d'actions

### Contenu
    Le formulaire de modification de service contient les champs suivants :
        - Nom du service (texte)
        - Description du service (texte)
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", qui valide les modifications
        - "Annuler", qui renvoie à la page de visualisation du service.
     
### Appels asynchrones
    Appel à la base de données sur la table servicesType pour récupérer les informations du service.
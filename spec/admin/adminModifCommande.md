# Modification d'une commande
   
### Url
    /admin/orders/{id}/edit

### Description courte
    Cette page affiche un formulaire pré-rempli avec les informations, modifiables, de la commande en cours pour les modifier, soit son état, le commentaires qui lui ai lié et sa date de livraison estimée.
    La modification peut être validée ou bien l'on peut revenir sur la page d'affichage de la commande en cliquant sur le bouton "Annuler".
   
### Fonctionnalité principale
    Modification d'une commande.

### Règles d'accès par profil
    Seuls les profils de gestionnaires et d'administrateurs ont accès à cette page.
    
### Zones de la page
    Numéro de la commande
    Formulaire de modification
    Boutons d'actions

### Contenu
    Le formulaire de modification de la commande contient les champs suivants :
        - Etat de la commande (sélection)
        - Commentaires (textarea vide)
        - Date de livraison estimée (date)
    A la fin du formulaire on trouve deux boutons :
        - "Modifier", qui valide les modifications
        - "Annuler", qui renvoie à la page de visualisation de la commande.

### Appels asynchrones
    Appel à la base de données sur la table orders pour récupérer les informations de la commande.
# Affichage d'un utilisateur

### Url
    /admin/users/{id}

### Description courte
    Cette page affiche les informations concernant l'utilisateur séléctionné.
    Depuis cette page, on peut modifier l'utilisateur, le supprimer ou encore retourner sur la liste de tous les utilisateurs.
   
### Fonctionnalité principale
    Affichage d'un utilisateur avec ses informations.

### Règles d'accès par profil
    Seuls les administrateurs et les gestionnaires ont accès à cette page.

### Zones de la page
    Nom et Prénom de l'utilisateur
    Informations de l'utilisateur
    Boutons d'actions

### Contenu
    Les informations de l'utilisateur sont :
        - Pseudo (texte)
        - Email (email)
        - Numéro de téléphone (tel)
        - Rôle (texte)
    Les boutons d'actions sont :
        - "Modifier", pour accéder au formulaire de modification de l'utilisateur
        - "Supprimer", pour supprimer l'utilisateur
        - "Retour", pour accéder à la liste des utilisateurs.
 
### Appels asynchrones
    Appel à la base de données sur la table user pour récupérer les informations de l'utilisateur.
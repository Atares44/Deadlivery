# Affichage d'un rôle

### Url
    /admin/roles/{id}

### Description courte
    Cette page affiche les informations concernant le rôle séléctionné.
    Depuis cette page, on peut modifier le rôle, le supprimer ou encore retourner sur la liste de tous les rôles.
   
### Fonctionnalité principale
    Affichage d'un rôle avec ses informations.

### Règles d'accès par profil
    Seuls les administrateurs ont accès à cette page.

### Zones de la page
    Nom du rôle
    Liste des utilisateurs
    Boutons d'actions

### Contenu
    La liste d'utilisateurs ayant le rôle sélectionné est affichée sous ce format :
        - Nom et prénom de l'utilisateur (texte), cliquable pour accèder au profil de cet utilisateur
        - Pseudo de l'utilisateur (texte)
        - Adresse mail de l'utilsateur (email)
    Les boutons d'actions sont :
        - "Modifier", pour accéder au formulaire de modification du rôle
        - "Supprimer", pour supprimer le rôle
        - "Retour", pour accéder à la liste des rôles.
 
### Appels asynchrones
    Appel à la base de données sur la table role pour récupérer les informations du rôle.
    Appel à la base de données sur la table users pour récupérer les noms, prénoms, pseudos et adresses mail des utilisateurs ayant ce rôle.
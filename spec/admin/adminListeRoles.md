# Liste des rôles

### Url
    /admin/roles/

### Description courte
    Cette page affiche tous les rôles.
    Depuis cette page, on peut supprimer ou ajouter un rôle.
    On peut aussi avoir accès au détail du rôle en cliquant dessus.
   
### Fonctionnalité principale
    Affichage de tous les rôles.

### Règles d'accès par profil
    Seuls les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Liste des rôles
    Bouton d'ajout

### Contenu
    La liste des rôles est affichée sous ce format :
        - Nom de rôle (texte), cliquable pour accéder au détail du rôle
        - Bouton "Supprimer" pour supprimer depuis la liste un rôle
    Le bouton d'action "Ajouter" permet d'accéder au formulaire d'ajout de rôle.
 
### Appels asynchrones
    Appel à la base de données sur la table role pour récupérer les noms et ID de tous les rôles.
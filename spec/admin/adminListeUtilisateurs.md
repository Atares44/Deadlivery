# Liste des utilisateurs

### Url
	/admin/users/

### Description courte
	Cette page affiche tous les utilisateurs.
    Depuis cette page, on peut supprimer ou ajouter un utilisateur.
    On peut aussi avoir accès aux informations de l'utilisateur en cliquant dessus.

### Fonctionnalité principale
	Affichage de tous les utilisateurs.

### Règles d'accès par profil
    Seuls les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Liste des utilisateurs
    Bouton d'ajout

### Contenu
    La liste des produits est affichée sous ce format :
        - Nom et prénom de l'utilisateur (texte), cliquable pour accéder au détail de l'utilisateur
        - Bouton "Supprimer" pour supprimer depuis la liste un utilisateur
    Le bouton d'action "Ajouter" permet d'accéder au formulaire d'ajout d'un utilisateur.
 
### Appels asynchrones
    Appel à la base de données sur la table user pour récupérer les noms, prénoms et ID de tous les utilisateurs.
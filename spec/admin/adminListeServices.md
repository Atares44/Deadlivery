# Liste des services

### Url
    /admin/services-type/

### Description courte
    Cette page affiche tous les services.
    Depuis cette page, on peut supprimer ou ajouter un service.
    On peut aussi avoir accès au détail du service en cliquant dessus.
   
### Fonctionnalité principale
    Affichage de tous les services proposés par le site.

### Règles d'accès par profil
    Seuls les administrateurs et les gestionnaires ont accès à cette page.

### Zones de la page
    Titre
    Liste des services
    Bouton d'ajout

### Contenu
    La liste des services affiche tous les services proposés sur notre site sous ce format :
        - Nom du service (texte), cliquable pour accèder au détail du service
        - Un bouton "Supprimer" pour supprimer un service depuis la liste
    Le bouton d'action "Ajouter" permet d'accéder au formulaire d'ajout de service.

### Appels asynchrones
    Appel à la base de données sur la table servicesType pour récupérer les noms et ID de tous les services.
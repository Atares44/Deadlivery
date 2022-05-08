# Liste des commandes

### Url
    /admin/orders/

### Description courte
    Cette page affiche toutes les commandes.
    Depuis cette page on peut avoir accès au détail de la commande en cliquant dessus.
   
### Fonctionnalité principale
    Affichage de toutes les commandes.

### Règles d'accès par profil
    Seuls les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Liste des commandes

### Contenu
    La liste des commandes est affichée sous ce format :
        - Numéro de la commande (nombre), cliquable pour accéder au détail de la commande
        - Etat de la commande (texte), c'est-à-dire la dernière étape à laquelle elle est arrivée
        - Nom et prénom du client lié à la commande (texte)
 
### Appels asynchrones
    Appel à la base de données sur la table orders pour récupérer les numéros et ID de toutes les commandes.
    Appel à la base de données sur la table user pour récupérer les nom, prénom et ID de l'utilisateur qui a passé la commande pour chaque ligne.
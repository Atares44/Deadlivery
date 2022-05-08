# Liste des commentaires à approuver

### Url
    /admin/comments/

### Description courte
    Cette page affiche tous les commentaires à approuver.
    Depuis cette page on peut avoir accès au détail du commentaire en cliquant dessus.
   
### Fonctionnalité principale
    Affichage de tous les commentaires à approuver.

### Règles d'accès par profil
    Seuls les gestionnaires et les administrateurs ont accès à cette page.

### Zones de la page
    Titre
    Liste des commentaires

### Contenu
    La liste des commentaires est affichée sous ce format :
        - Titre du commentaire (texte), cliquable pour accéder au détail du commentaire
        - Nom et prénom du client lié au commetaire (texte)
        - Date du commentaire (date)
 
### Appels asynchrones
    Appel à la base de données sur la table comments pour récupérer les titres, dates et ID de tous les commentaires.
    Appel à la base de données sur la table user pour récupérer les nom, prénom et ID de l'utilisateur qui a laissé le commentaire pour chaque ligne.
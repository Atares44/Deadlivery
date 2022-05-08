# Affichage d'un commentaire

### Url
    /admin/comments/{id}

### Description courte
    Cette page affiche les informations concernant le commentaire séléctionné.
    Depuis cette page, on peut approuver ou refuser un commentaire ou encore retourner sur la liste de tous les commentaires.
   
### Fonctionnalité principale
    Affichage d'un commentaire avec ses informations.

### Règles d'accès par profil
    Seuls les administrateurs et les gestionnaires ont accès à cette page.

### Zones de la page
    Titre du commentaire
    Informations du commentaire
    Boutons d'actions

### Contenu
    Les informations du commentaire sont :
        - Note sur 10 (nombre)
        - Contenu du commentaire (texte)
        - Nom et prénom du client ayant écrit le commentaire (texte)
        - Date à laquelle le commentaire a été écrit (date)
        - Date de livraison de la commande liée au commentaire (date)
    Les boutons d'actions sont :
        - "Approuver", pour approuver le commentaire et l'afficher sur le site, côté front, ainsi qu'envoyer un mail au client l'ayant écrit pour l'en informer
        - "Refuser", pour refuser le commentaire et envoyer un mail au client l'ayant écrit après avoir écrit la raison de refus pour l'en informer
        - "Retour", pour accéder à la liste des commentaires
 
### Appels asynchrones
    Appel à la base de données sur la table comments pour récupérer les informations du commentaire.
    Appel à la base de données sur la table user pour récupérer les nom, prénom, email et ID de l'utilisateur qui a laissé le commentaire.
    Appel à la base de données sur la table order pour récupérer la date de livraison de la commande liée au commentaire.
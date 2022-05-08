# Affichage d'un service 
   
### Url
    /admin/services-type/{id} 

### Description courte
    Cette page affiche les informations concernant le service séléctionné.
    Depuis cette page, on peut modifier le service, le supprimer ou encore retourner sur la liste de tous les services.
   
### Fonctionnalité principale
    Affichage d'un service avec ses informations.

### Règles d'accès par profil
    Seuls les administratuers et les gestionnaires ont accès à cette page.

### Zones de la page
    Nom du service
    Description du service
    Liste des produits
    Boutons d'actions

### Contenu
    La liste des produits liés à ce service se présente sous le format :
        - Nom du produit (texte) cliquable pour avoir accès à la page du produit
        - Nature du produit (texte)
    Les boutons d'actions sont :
        - "Modifier", pour accéder au formulaire de modification du service
        - "Supprimer", pour supprimer le service
        - "Retour", pour accéder à la liste des services.

### Appels asynchrones
    Appel à la base de données sur la table servicesType pour récupérer les informations du service.
    Appel à la base de données sur la table products pour récupérer les noms et natures des produits liés à ce service.
 
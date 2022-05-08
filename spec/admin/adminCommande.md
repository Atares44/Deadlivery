# Affichage d'une commande

### Url
    /admin/orders/{id}

### Description courte
    Cette page affiche les informations concernant la commande séléctionnée.
    Depuis cette page, on peut modifier l'état de la commande, possible uniquement s'il s'agit d'une commande en cours, ou retourner sur la liste de toutes les commandes.
   
### Fonctionnalité principale
    Affichage d'une commande avec ses informations.

### Règles d'accès par profil
    Seuls les administrateurs et les gestionnaires ont accès à cette page.

### Zones de la page
    Numéro de la commande
    Informations sur la commande
    Boutons d'actions

### Contenu
    Les informations de la commande sont :
        - Liste du contenu de la commande, avec pour chaque ligne :
            - Nom du produit (texte)
            - Quantité (nombre)
        - Prix total (texte)
        - Adresse de livraison (texte)
        - Adresse de facturation (texte)
        - Nom et prénom du client ayant passé la commande (texte)
        - Liste des étapes de la livraison, avec pour chaque ligne :
            - Nom de l'étape (texte)
            - Commentaires (texte)
        - Date de livraison ou date de livraison estimée (date)
    Les boutons d'actions sont :
        - "Modifier", pour accéder au formulaire de modification de l'état de la commande (uniquement s'il s'agit d'une commande en cours)
        - "Retour", pour accéder à la liste des commandes.
 
### Appels asynchrones
    Appel à la base de données sur la table orders pour récupérer les informations de la commande.
    Appel à la base de données sur la table user pour récupérer les nom, prénom et ID de l'utilisateur qui a passé la commande.
    Appel à la base de données sur la table adress pour récupérer les adresses de livraison et de facturation liées au client ayant passé la commande.
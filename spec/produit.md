# Produit

### Url
    /products/{id_product}

### Description courte
    Le zombie est présenté avec son nom, son image, sa description, le service auquel il est rattaché, sa nature (amorphe, accommodant ou agressif). Un zombie a également une note moyenne, calculée en fonction des notes et des commentaires que lui ont laissés les clients qui l'ont loué. L'utilisateur peut ajouter le produit à son panier ou ajouter un commentaire s'il a déjà commandé ce produit.

### Fonctionnalité principale
    Affichage d'un produit (zombie).

### Règles d'accès par profil
    Tout le monde a accès à cette page.

### Zones de la page
    Produit
    Bouton "Ajouter au panier" 
    Commentaires du produit

### Contenu
    Le produit est présenté grâce à son image, son nom, la note moyenne donnée par les utilisateurs qui l'ont déjà commandé, sa description, sa nature, le service auquel il est rattaché et son prix.
    Un bouton "ajouter au panier" suit directement l'affichage du produit, qui permet à l'utilisateur d'ajouter le produit à son panier.
    
    Une section "Commentaires" se trouve à la suite de ceci. Dans cette section on retrouve tous les commentaires des clients liés à ce produit sous la forme d'une liste de vues de détails et un client connecté peut également ajouter son propre commentaire à l'aide d'un formulaire qui contient les mêmes champs que ceux des vues de détails. Ces champs sont :
        - Titre du commentaire (texte)
        - Note sur 10 (nombre)
        - Contenu du commentaire (texte)
    Sous ce formulaire se trouve un bouton "Envoyer" qui envoit le commentaire à la base de données pour qu'il soit valider par un administrateur et afficher ensuite dans la liste des commentaires.

### Appels asynchrones
    Appel à la base de données sur la table products pour récupérer les informations du produit.
    Appel à la base de données sur la tale comments pour récupérer les commentaires clients liés à ce produit.
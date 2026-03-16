# Test entretien technique

### Démarrer le projet : 

``` bash 
$ docker compose up -d --build
$ docker exec -it test_slap_digital-php-1 bash
```

Une fois dans le container :

``` bash
$ composer install
$ symfony console doctrine:database:create
$ symfony console doctrine:migrations:migrate
$ symfony console doctrine:fixtures:load
$ symfony serve --port=8000 --allow-http --no-tls --listen-ip=0.0.0.0
```

### Premier atelier : Estimation d'un correctif

Voici la demande fournie par le client. 
Nous souhaitons pour cette demande pouvoir analyser l'existant, comprendre ce qui ne va pas et pouvoir leur donner une estimation adéquate du temps de correction nécessaire pour ce problème.

> Nous avons remarqué un problème de performance sur la page qui récapitule l’ensemble des commandes d’un utilisateur. La base de données est trop souvent appellée pour les informations à afficher.
> Nous aimerions savoir d’où provient le problème ainsi que savoir comment résoudre cela. Nous souhaitons un compte-rendu sous la forme suivante : 
>
> **Le contexte :**
>
> **Ce qu’il faut faire :**
>
> **Le détail de l’estimation :**
>
> **TOTAL : XX.XXH**

### Second atelier : Résolution technique

>Voici une demande transmise par notre client. Nous souhaitons pouvoir réaliser l'ajout technique de cette demande.
>
>Nous avons actuellement pour notre site e-commerce des prix standards appliqués sur chacun de nos variants.
>
>Nous voulons pour la suite pouvoir appliquer à certains de nos utilisateurs un tarif personnalisé pour un variant donné. Un échantillon de flux CSV vous sera transmis afin de commencer à préparer les développements. Nous n’avons pas encore le retour de notre ERP mais nous savons pour sur que nous aurons plusieurs centaines de milliers de lignes à terme. Le fichier CSV contiendra les colonnes suivantes : 
>
>user_email;variant_code;price
>
>Nous voulons donc ensuite pouvoir calculer le prix minimum d’un produit en fonction de l’utilisateur connecté : 
>
>- Si l’utilisateur n’est pas connecté, nous déterminons le prix minimum d’un produit avec les prix standards de ses variants
>- Si l’utilisateur est connecté, nous déterminons le prix minimum d’un produit avec les prix personnalisés de l’utilisateur. Si un utilisateur n’a pas de prix personnalisés sur l’ensemble des variants d’un produit, pour les variants n’ayant pas de prix personnalisés, nous prendrons alors les prix standards pour effectuer les comparaisons nécessaires
>
>Nous souhaitons pour finir qu’une fois le prix minimum a été calculé pour un client et pour un produit donné, qu’il ne soit plus recalculé par la suite jusqu’au lendemain
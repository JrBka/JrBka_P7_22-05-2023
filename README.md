** Notice d'utilisation du projet avec lancement sous XAMPP **

Pour utiliser ce projet veuillez, cloner ce référentiel. Rendez-vous dans le terminal de votre éditeur de code et 
entrez : git clone https://github.com/JrBka/JrBka_P7_22-05-2023.git

Quelques modifications sont nécessaires avant que le projet soit fonctionnel :

- installez composer à la racine du projet avec la commande ' composer install '.
- créez un dossier appelé ' jwt ' dans le dossier 'config'.
- générez les clé SSL qui serviront pour le token JWT. Pour cela ouvrez un terminal git bash dans votre IDE puis lancez ces commandes:


        openssl genpkey -out ./config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
et

        openssl pkey -in ./config/jwt/private.pem -out ./config/jwt/public.pem -pubout
- à la suite de ces commande il vous sera demandé de renseigné une passe phrase secrete, elle devra être identique pour les deux clés.
- ouvrez le fichier .env et remplacez la valeur de ' JWT_PASSPHRASE ' par votre passe phrase secrete.
- toujours dans le fichier .env remplacez la valeur de ' DATABASE_URL ' par la valeur correspondante à votre installation.

Une fois le projet installé et configuré, lancez XAMPP et importez-y la base de données bilemoapi.sql .

Rendez-vous dans votre terminal et entrez : 'symfony serve'.

Le projet est en place, rendez-vous dans votre navigateur à l'adresse http://localhost:8000/api pour l'utiliser.
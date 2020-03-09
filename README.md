Guide d'installation :

Veuillez cloner le projet en local :
git clone https://github.com/Phetparisouk/voyage_phet.git 

Vous deplacer dans le dossier du projet :
cd voyage_phet

et utiliser les commandes suivante pour pouvoir faire fonctionner le projet :
composer update
npm run watch
npm install
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
symfony console doctrine:database:create (utilisez le nom "trip" pour le nom de la BDD)

Une fois tout terminer, utiliser la commande pour activer le serveur :
symfony serve
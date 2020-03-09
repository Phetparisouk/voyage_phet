Guide d'installation :

Veuillez cloner le projet en local :
<br/>git clone https://github.com/Phetparisouk/voyage_phet.git 

Vous deplacer dans le dossier du projet :
<br/>cd voyage_phet

Et utiliser les commandes suivante pour pouvoir faire fonctionner le projet :
<br/>composer update
<br/>npm run watch
<br/>npm install
<br/>symfony console doctrine:migrations:migrate
<br/>symfony console doctrine:fixtures:load
<br/>symfony console doctrine:database:create (utilisez le nom "trip" pour le nom de la BDD)

Une fois tout terminer, utiliser la commande pour activer le serveur :
<br/>symfony serve
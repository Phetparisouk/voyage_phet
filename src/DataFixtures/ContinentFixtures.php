<?php

namespace App\DataFixtures;

use App\Entity\Continent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;
//use Doctrine\Migrations\Version\Factory;

class ContinentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker::create();

    	// création de plusieurs continent
	    for($i = 0; $i < 5; $i++) {
	    	// instanciation d'une entité
			$continent = new Continent();
			$continent->setName( $faker->unique()->word );
			
			//creer des ref : mise en memoire d'object reutilisable
			$this->addReference("continent$i", $continent);

		    // doctrine : méthode persist permet de créer un enregistrement (INSERT INTO)
		    $manager->persist($continent);
	    }

	    // doctrine : méthode flush permet d'exécuter les requêtes SQL (à exécuter une seule fois)
        $manager->flush();
    }
}

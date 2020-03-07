<?php

namespace App\DataFixtures;

use App\Entity\Decouverte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Doctrine\Migrations\Version\Factory;

class DecouverteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

    	// création de plusieurs decouverte
	    for($i = 0; $i < 10; $i++) {
	    	// instanciation d'une entité
			$decouverte = new Decouverte();
            $decouverte->setPays( $faker->unique()->word );
            $decouverte->setImage( 'default.jpg' );
            $decouverte->setDescription( $faker->text(200) );
			
			//creer des ref : mise en memoire d'object reutilisable
            $randomContinent = random_int(0, 4);
            $continent = $this->getReference("continent$randomContinent");
            $decouverte->setContinent($continent);

		    // doctrine : méthode persist permet de créer un enregistrement (INSERT INTO)
		    $manager->persist($decouverte);
        }
        $manager->flush();
    }
}

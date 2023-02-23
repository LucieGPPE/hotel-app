<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use App\Entity\Image;
use App\Entity\Suite;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadAdmin($manager);
        $this->loadClient($manager);
        $this->loadEtablissement($manager);
        $this->loadSuite($manager);
        $this->loadImage($manager);
    }

    public function loadEtablissement(ObjectManager $manager): void{
        $faker = Faker\Factory::create("fr_FR");

        for($i=0; $i<16 ; $i++){
            $product = new Etablissement();
        

            $product->setNom($faker->word());
            $product->setVille($faker->word());
            $product->setAdresse($faker->sentence());
            $product->setDescription(implode($faker->sentences()));
         

            $manager->persist($product);

            $this->addReference('Etablissement_'.$i,$product);
            
        }
        $manager->flush();
    }


    public function loadImage(ObjectManager $manager):void {
        $faker = Faker\Factory::create("fr_FR");

        for($i=0; $i<16 ; $i++){
            $product = new Image();
        

            $product->setUrl($faker->imageUrl(640, 480, 'animals', true));
            $product->setDescription($faker->word());
            $product->setSuiteId($this->getReference('Suite_'.mt_rand(0,15)));
            $manager->persist($product);
            
        }
        $manager->flush();
    }

    public function loadSuite(ObjectManager $manager):void {
        $faker = Faker\Factory::create("fr_FR");

        for($i=0; $i<50 ; $i++){
            $product = new Suite();

            $newEtablissement = $this->getReference('Etablissement_'.mt_rand(0,15));

            $product->setTitre($faker->word());
            $product->setDescription($faker->sentence());   
            $product->setImage($faker->imageUrl(640, 480, 'animals', true)); 
            $product->setPrix($faker->numberBetween(20,600));   

            $product->setEtablissement($newEtablissement);

            $manager->persist($product);
            $this->addReference('Suite_'.$i,$product);
        }
        $manager->flush();
    }


    private $userPasswordHasherInterface;
    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    private function loadClient(ObjectManager $manager):void{
        $faker = Faker\Factory::create("fr_FR");

        for($i=0; $i<16;$i++){
             $client = new User();
            $client->setEmail($faker->email());
            $client->setRoles(['ROLE_USER']);
            $client->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $client, $faker->password()
            )
            );
            $manager->persist($client);
        }
       
        $manager->flush();
    }

    private function loadAdmin(ObjectManager $manager):void{
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
          $this->userPasswordHasherInterface->hashPassword(
            $admin, 'admin1234'
          )
        );
        $manager->persist($admin);
        $manager->flush();
    }
}

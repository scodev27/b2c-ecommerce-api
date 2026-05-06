<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@terraacasa.cat');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, '123456');
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $productes = [
            ['name' => 'Capsa Verdures Petita', 'desc' => 'Ideal per a 1-2 persones. Verdures de temporada.', 'price' => 1500, 'stock' => 10],
            ['name' => 'Capsa Verdures Mitjana', 'desc' => 'Perfecte per a famílies de 3-4 persones.', 'price' => 2500, 'stock' => 5],
            ['name' => 'Capsa Fruita i Verdura', 'desc' => 'Mix equilibrat de la millor fruita i verdura ecològica.', 'price' => 3000, 'stock' => 8],
        ];

        foreach ($productes as $p) {
            $product = new Product();
            $product->setName($p['name']);
            $product->setDescription($p['desc']);
            $product->setPrice($p['price']);
            $product->setStock($p['stock']);
            $product->setImage('capsa_verdura.jpeg');
            $manager->persist($product);
        }

        $manager->flush();
    }
}

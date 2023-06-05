<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Manager;
use App\Entity\Mobile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager1 = new Manager();
        $manager1->setEmail('BileMo@super_admin.com')
            ->setPlainPassword('Password123$')
            ->setRoles(["ROLE_SUPER_ADMIN"]);
        $manager->persist($manager1);

        $client1 = new Client();
        $client1->setEmail('mobile-shop@admin.com')
            ->setPlainPassword('Password123$')
            ->setRoles(["ROLE_ADMIN"])
            ->setAuthorizedUntil(new \DateTimeImmutable('+30days'));
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setEmail('mobileAvenue@admin.com')
            ->setPlainPassword('Password123$')
            ->setRoles(["ROLE_ADMIN"])
            ->setAuthorizedUntil(new \DateTimeImmutable('+30days'));
        $manager->persist($client2);

        for ($i = 1; $i < 26; $i++){
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com')
                ->setPlainPassword('Password123$')
                ->setRoles(["ROLE_USER"])
                ->setClient($client1);
            $manager->persist($user);
        }

        for ($i = 100; $i < 116; $i++){
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com')
                ->setPlainPassword('Password123$')
                ->setRoles(["ROLE_USER"])
                ->setClient($client2);
            $manager->persist($user);
        }

        for ($i = 1; $i < 11; $i++){
            $mobile = new Mobile();
            $mobile->setName('galaxy s'.$i)
                ->setPrice('980 €')
                ->setBrand('samsung')
                ->setStorage('64GB')
                ->setDescription('Le Samsung Galaxy S10 est le flagship de Samsung pour 2019. Il est équipé 
                d\'un SoC Samsung Exynos 9820 gravé en 8 nm, d\'un triple capteur et d\'un nouvel écran sans bord avec la caméra logée dans une bulle.');

            $manager->persist($mobile);
        }

        for ($i = 1; $i < 11; $i++){
            $mobile = new Mobile();
            $mobile->setName('iphone'.$i)
                ->setPrice('980 €')
                ->setBrand('apple')
                ->setStorage('64GB')
                ->setDescription('L\'écran de l\'iPhone 12 a des angles arrondis qui suivent la ligne élégante 
                de l\'appareil et s\'inscrivent dans un rectangle standard. Si l\'on mesure ce rectangle, l\'écran affiche
                 une diagonale de 6,06 pouces (la zone d\'affichage réelle est moindre)');

            $manager->persist($mobile);
        }

        $manager->flush();
    }
}

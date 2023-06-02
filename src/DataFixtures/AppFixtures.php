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
            ->setPassword('$2y$13$hsJdf98mrBE1nEQS7Dd1mOSQmvY5aVwENroZzbAnffcmr7Pv1uOoW');
        $manager->persist($manager1);

        $client1 = new Client();
        $client1->setRoles(["ROLE_ADMIN"])
            ->setEmail('mobile-shop@admin.com')
            ->setPassword('$2y$13$0Su4E0I2Cii1/mP06ZXKoOK07Xx97tY2rSYu6O3wc32rpZ64qp5/S')
            ->setAuthorizedUntil(new \DateTimeImmutable('+30days'));
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setRoles(["ROLE_ADMIN"])
            ->setEmail('mobileAvenue@admin.com')
            ->setPassword('$2y$13$aHg94vrwoic9W6CROE8d1eF..TuUXtNZHywt2/mewY5bzwewuVtMa')
            ->setAuthorizedUntil(new \DateTimeImmutable('+30days'));
        $manager->persist($client2);

        for ($i = 1; $i < 26; $i++){
            $user = new User();
            $user->setRoles(["ROLE_USER"])
                ->setEmail('user'.$i.'@gmail.com')
                ->setPassword('$2y$13$l6ErF9BvYu4VF/yGS0nviugMZSgyqPuou84j00FVUQ8fPqNfDK0GS')
                ->setClient($client1);
            $manager->persist($user);
        }

        for ($i = 100; $i < 116; $i++){
            $user = new User();
            $user->setRoles(["ROLE_USER"])
                ->setEmail('user'.$i.'@gmail.com')
                ->setPassword('$2y$13$l6ErF9BvYu4VF/yGS0nviugMZSgyqPuou84j00FVUQ8fPqNfDK0GS')
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

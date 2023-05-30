<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Mobile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client->setRoles(["ROLE_ADMIN"])
            ->setEmail('mobile-shop@admin.com')
            ->setPassword('$2y$13$0Su4E0I2Cii1/mP06ZXKoOK07Xx97tY2rSYu6O3wc32rpZ64qp5/S');
        $manager->persist($client);

        for ($i = 1; $i < 26; $i++){
            $user = new User();
            $user->setRoles(["ROLE_USER"])
                ->setEmail('user'.$i.'@gmail.com')
                ->setPassword('$2y$13$l6ErF9BvYu4VF/yGS0nviugMZSgyqPuou84j00FVUQ8fPqNfDK0GS')
                ->setClient($client);
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

        $manager->flush();
    }
}

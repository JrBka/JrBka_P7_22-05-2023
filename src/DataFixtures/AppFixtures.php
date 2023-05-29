<?php

namespace App\DataFixtures;

use App\Entity\Mobile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setRoles(["ROLE_ADMIN"])
            ->setEmail('bilmoAPI@admin.com')
            ->setPassword('$2y$13$3RUCF4.19GjbkJXuuR1Wg.ZKV4ul4pLHu6biON.qxQjunDjfZLIsW');
        $manager->persist($admin);

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

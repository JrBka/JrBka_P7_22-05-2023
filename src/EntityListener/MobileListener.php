<?php

namespace App\EntityListener;

use App\Entity\Client;
use App\Entity\Manager;
use App\Entity\Mobile;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MobileListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Mobile $mobile):void
    {
        $manager = $this->security->getUser();

        if (isset($manager) && $manager instanceof Manager){
            $mobile->setManager($manager);
        }else{
            throw new JsonException('Only managers can add new mobiles');
        }
    }

    /**
     * This function applies a dateTime before the entity update
     */
    public function preUpdate(Mobile $mobile) : Mobile
    {
        return $mobile->setUpdatedAt(new \DateTimeImmutable());
    }
}

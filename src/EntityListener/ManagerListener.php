<?php

namespace App\EntityListener;

use App\Entity\Manager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ManagerListener
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(Manager $Manager){
        $this->encodePassword($Manager);
    }

    public function preUpdate(Manager $Manager):void
    {
        $this->encodePassword($Manager);
    }

    /**
     * This function hashes the password
     */
    public function encodePassword(Manager $Manager):void
    {
        if (empty($Manager->getPlainPassword())){
            return;
        }else{
            $Manager->setPassword(
                $this->hasher->hashPassword(
                    $Manager,
                    $Manager->getPlainPassword()
                )
            );
        }
    }

}
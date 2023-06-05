<?php

namespace App\EntityListener;

use App\Entity\Client;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    private $security;
    private UserPasswordHasherInterface $hasher;

    public function __construct(Security $security, UserPasswordHasherInterface $hasher)
    {
        $this->security = $security;
        $this->hasher = $hasher;
    }

    public function prePersist(User $user){
        $client = $this->security->getUser();

        if (isset($client) && $client instanceof Client){
            $user->setClient($client);
        }
        $this->encodePassword($user);
    }

    public function preUpdate(User $user):void
    {
        $this->encodePassword($user);
    }

    /**
     * This function hashes the password
     */
    public function encodePassword(User $user):void
    {
        if (empty($user->getPlainPassword())){
            return;
        }else{
            $user->setPassword(
                $this->hasher->hashPassword(
                    $user,
                    $user->getPlainPassword()
                )
            );
        }
    }

}
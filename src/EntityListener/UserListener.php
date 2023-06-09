<?php

namespace App\EntityListener;

use App\Entity\Client;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Exception\JsonException;
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

    /**
     * Hashes the password and sets the client before entity persistence
     */
    public function prePersist(User $user):void
    {
        $client = $this->security->getUser();

        if (isset($client) && $client instanceof Client){
            $user->setClient($client);
        }else{
            throw new JsonException('Only clients can add new users to their list');
        }
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

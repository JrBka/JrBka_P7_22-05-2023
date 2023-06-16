<?php

namespace App\EntityListener;

use App\Entity\Client;
use App\Entity\Manager;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientListener
{
    private $security;
    private UserPasswordHasherInterface $hasher;

    public function __construct(Security $security, UserPasswordHasherInterface $hasher)
    {
        $this->security = $security;
        $this->hasher = $hasher;
    }

    /**
     * Hashes password before entity persistence
     */
    public function prePersist(Client $client):void
    {
        $manager = $this->security->getUser();

        if (isset($manager) && $manager instanceof Manager){
            $client->setManager($manager);
        }else{
            throw new JsonException('Only managers can add new clients to their list');
        }
        $this->encodePassword($client);
    }

    /**
     * Hashes password before entity update
     */
    public function preUpdate(Client $client):void
    {
        $this->encodePassword($client);
    }

    /**
     * This function hashes the password
     */
    public function encodePassword(Client $client):void
    {
        if (empty($client->getPlainPassword())){
            return;
        }else{
            $client->setPassword(
                $this->hasher->hashPassword(
                    $client,
                    $client->getPlainPassword()
                )
            );
        }
    }

}


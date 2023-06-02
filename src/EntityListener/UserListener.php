<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

class UserListener
{
    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(User $user){
        if ($this->security->getUser()->getRoles()[0] == "ROLE_ADMIN"){
            $user->setClient($this->security->getUser());
        }
    }

}
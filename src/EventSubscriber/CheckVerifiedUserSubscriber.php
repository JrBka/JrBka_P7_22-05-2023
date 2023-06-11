<?php

namespace App\EventSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface
{

    /**
     * This function refuses the connection if the client linked to the user no longer has permission to access the API
     */
    public function onCheckPassport(CheckPassportEvent $event)
    {
        $user = $event->getPassport()->getUser();
        $role = $user->getRoles();
        if ($role[0] == 'ROLE_USER'){
            $clientAuthorisation = $user->getClient()->getAuthorizedUntil();
            if ($clientAuthorisation < new \DateTime()){
                throw new HttpException(403, 'Access Denied.');
            }
        }
    }

    public static function getSubscribedEvents():array
    {
        return [
            CheckPassportEvent::class => 'onCheckPassport',
        ];
    }
}

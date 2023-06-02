<?php

namespace App\EventSubscriber;
use App\Repository\ClientRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly ClientRepository $clientRepository)
    {
    }

    public function onCheckPassport(CheckPassportEvent $event,)
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

    public static function getSubscribedEvents()
    {
        return [
            CheckPassportEvent::class => 'onCheckPassport',
        ];
    }
}

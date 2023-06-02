<?php

namespace App\EventListener;

use App\Repository\ClientRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{

    private $requestStack;
    private bool $isClient;
    private $authorizedUntil;

    public function __construct(RequestStack $requestStack, ClientRepository $clientRepository)
    {
        $this->requestStack = $requestStack;
        $request = $this->requestStack->getCurrentRequest()->toArray();
        $client = $clientRepository->findOneBy(['email'=>$request['username']]);

        if ($client){
            return [$this->isClient = true, $this->authorizedUntil = $client->getAuthorizedUntil()];
        }else{
            return $this->isClient = false;
        }
    }

    public function onJWTCreated(JWTCreatedEvent $event):void
    {
        if ($this->isClient){
            $expiration = $this->authorizedUntil;

            $payload = $event->getData();
            $payload['exp'] = $expiration->getTimestamp();

            $event->setData($payload);
        }

    }
}


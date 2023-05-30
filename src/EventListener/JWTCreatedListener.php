<?php

namespace App\EventListener;

use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{

    private $requestStack;
    private bool $isClient;

    public function __construct(RequestStack $requestStack, ClientRepository $clientRepository)
    {
        $this->requestStack = $requestStack;
        $request = $this->requestStack->getCurrentRequest()->toArray();

        if ($clientRepository->findOneBy(['email'=>$request['username']])){
            return $this->isClient = true ;
        }else{
            return $this->isClient = false;
        }
    }

    public function onJWTCreated(JWTCreatedEvent $event):void
    {
        if ($this->isClient){
            $expiration = new \DateTime();
            $expiration->setDate(2023,8,30);

            $payload = $event->getData();
            $payload['exp'] = $expiration->getTimestamp();

            $event->setData($payload);
        }

    }
}


<?php

namespace App\Events;

use App\Entity\Log;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class EventListener 
{
    private $doctrine;

    private $request;


    /**
     * @param $doctrine
     * @param $request
     */
    public function __construct($doctrine, $request)
    {
        $this->doctrine= $doctrine;
        $this->request= $request;

    }
   
    /**
     * onAuthenticationSuccess
     *
     * @param InteractiveLoginEvent $event
     */
    public function onAuthenticationSuccess(InteractiveLoginEvent $event)
    {
        $username = $event->getAuthenticationToken()->getUsername();
        $this->LogFunc($username, true);

    }

       /**
     * onAuthenticationSuccess
     *
     * @param $username
     */
    private function LogFunc($username) {
        $log = new Log();
        $log->setUsername($username);
        $dateObject = new \DateTime(); 
        $log->setIp($this->request->getCurrentRequest()->getClientIp());
        $log->setDateTime($dateObject);


        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($log);
        $entityManager->flush();
    }

}


<?php

namespace App\EventListener;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use App\Repository\UserRepository;

final class AuthListener
{
    protected EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[AsEventListener(event: 'security.authentication.success')]
    public function onSecurityAuthenticationSuccess(AuthenticationSuccessEvent $event) : void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLoginDate(new DateTime());
        $this->em->persist($user);
        $this->em->flush();
    }
}

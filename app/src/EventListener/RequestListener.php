<?php

namespace App\EventListener;

use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Authenticator\Token\PostAuthenticationToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

final class RequestListener
{
    protected EntityManagerInterface $em;
    protected Security $sec;
    protected UrlGeneratorInterface $urlGenerator;

    public function __construct(EntityManagerInterface $em, Security $sec, UrlGeneratorInterface $urlGenerator){
        $this->em = $em;
        $this->sec = $sec;
        $this->urlGenerator = $urlGenerator;
    }

    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function onKernelRequest(RequestEvent $event) : void
    {
        // $req = $event->getRequest();
        // $user = null;
        // $session = $req->hasSession() ? $req->getSession() : null;
        // $req->attributes->set('_sess_id', $session ? $session->getId() : null);
        // if (!$req->attributes->has('_user_id')) {
        //     $user = $this->sec->getUser();
        //     if (!$user && $session && $session->has('_security_main')) {
        //         $token = unserialize($session->get('_security_main'));
        //         if ($token instanceof PostAuthenticationToken)
        //         $user = $token->getUser();
        //         if($user->getStatus() === 0){

        //         }
        //     }
        // }
    }
}

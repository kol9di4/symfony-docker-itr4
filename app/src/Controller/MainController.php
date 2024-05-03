<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        // return $this->render('main/index.html.twig', [
        //     'controller_name' => 'MainController',
        // ]);
        return new RedirectResponse($urlGenerator->generate('app_table'));
    }
}

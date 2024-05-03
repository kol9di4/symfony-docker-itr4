<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class TableController extends AbstractController
{
    #[Route('/table', name: 'app_table')]
    public function index(UserRepository $ur): Response
    {
        $users =  $ur->findAll();
        return $this->render('table/index.html.twig', [
            'users' => $users
        ]);
    }
}

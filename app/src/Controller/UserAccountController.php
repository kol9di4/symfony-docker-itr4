<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Location;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class UserAccountController extends AbstractController
{   
    #[Route('/user/block', name: 'app_user_account_block')]
    public function block(Request $request, UserRepository $ur, Security $sec, UrlGeneratorInterface $urlGenerator)
    {
        $autUserId = $sec->getUser()->getId()??null;
        $needLogOut = false;
        $usersForBlock = $request->request->all();
        foreach ($usersForBlock as $userId){
            $ur->manageUser($userId, 0);
            $user = $ur->findOneBy(['id'=>$userId]);
            $user->isEqualTo($user);
            if ($autUserId === (int)$userId){
                $needLogOut =true;
            }
        }
        $users =  $ur->findAll();
        $table = $this->render('table/table.html.twig', [
            'users' => $users
        ]);
        if($needLogOut){
            return new RedirectResponse($urlGenerator->generate('app_logout'));
            exit;
        }
        echo json_encode($table->getContent());
        exit;
    }


    #[Route('/user/unblock', name: 'app_user_account_unblock')]
    public function unblock(Request $request, UserRepository $ur): void
    {
        $usersForBlock = $request->request->all();
        foreach ($usersForBlock as $userId){
            $ur->manageUser($userId, 1);

        }
        $users =  $ur->findAll();
        $table = $this->render('table/table.html.twig', [
            'users' => $users
        ]);
        echo json_encode($table->getContent());
        exit;
    }

    #[Route('/user/delete', name: 'app_user_account_delete')]
    public function delete(Request $request, UserRepository $ur): void
    {
        $usersForBlock = $request->request->all();
        foreach ($usersForBlock as $userId){
            $ur->deleteUser($userId);
        }
        $users =  $ur->findAll();
        $table = $this->render('table/table.html.twig', [
            'users' => $users
        ]);
        echo json_encode($table->getContent());
        exit;
    }
}

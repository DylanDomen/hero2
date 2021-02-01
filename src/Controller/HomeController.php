<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function AfficheProfile(UserRepository $rep): Response
    {
        $userID = $this->getUser()->getId();
        if($userID > 0){
        $userInfo = $rep->findUser($userID);
            
            return $this->render('home/profile.html.twig',["userInfo"=>$userInfo]);
        }else{
            return $this->redirectToRoute('app_login');
        } 
    }
}

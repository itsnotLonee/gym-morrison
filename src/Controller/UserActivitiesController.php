<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserActivitiesController extends AbstractController
{
    // Actividades en las que se apunta el usuario

    /**
     * @Route("/user/activities", name="user_activities")
     */
    public function index()
    {



        return $this->render('user_activities/index.html.twig', [
            'controller_name' => 'UserActivitiesController',
        ]);
    }
}

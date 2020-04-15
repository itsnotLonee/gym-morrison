<?php

namespace App\Controller;

use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository( User::class)->find($id);
        if ($this->getUser() == $user) {
            return $this->render('profile/index.html.twig',
                ['user' => $user]
            );
        } else {
            return $this->redirectToRoute('dashboard');
        }
    }
}

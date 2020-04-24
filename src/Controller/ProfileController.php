<?php

namespace App\Controller;

use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/my-profile", options={"expose"=true}, name="myprofile", methods={"GET"})
     */
    public function myProfile(Request $request){
        $user = $this->getUser();

            $data = [
                'id'=> $user->getId(),
                'email' => $user->getEmail(),
                'rol' => $user->getRoles(),
                'dni' => $user->getDni(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'sex' => $user->getSex(),
                'phone' => $user->getPhone(),
                'address' => $user->getAddress(),
                'birth' => $user->getBirthdate(),
            ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['password']->getData()
            ));
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito', User::REGISTRO_EXITOSO);
            return $this->redirectToRoute('register');
        }
        return $this->render('registro/index.html.twig', [
            'formulario' => $form->createView()
        ]);
    }
}

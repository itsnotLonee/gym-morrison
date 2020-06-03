<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\User;
use App\Form\UserType;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistroController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, SluggerInterface $slugger)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $email = $form->get('email')->getData();
            $exist = $em->getRepository(User::class)->findOneBy(['email'=> $email]);
            if ($exist) {
                $this->addFlash('fail', 'User already exists');
                return $this->render('registro/index.html.twig', [
                    'formulario' => $form->createView()
                ]);
            }
            if ($em->getRepository(User::class)->findAll()){
                $user->setRoles(['ROLE_USER']);
            } else {
                $user->setRoles(['ROLE_ADMIN']);
            }

            $brochureFile = $form->get('profile_photo')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Error in upload');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setProfilePhoto($newFilename);
            }


            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['password']->getData()
            ));
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito', User::REGISTRO_EXITOSO);
            return $this->redirectToRoute('app_login');
        }
        return $this->render('registro/index.html.twig', [
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/checkEmail", name="checkEmail")
     */
    public function checkEmail(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $email = $request->request->get('email');
        $exist = $em->getRepository(User::class)->findOneBy(['email'=> $email]);

        if ($exist) {
            return new JsonResponse(false, Response::HTTP_OK);
        }
        return new JsonResponse(true, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

}

<?php

namespace App\Controller;

use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

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
                'photo' => $user->getProfilePhoto(),
            ];

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/edit-user", name="editUser")
     */
    public function edit(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $str = $request->request->get('str');
            $type = $request->request->get('type');

            $u = $this->getUser();
            $user = $em->getRepository(User::class)->find($u);

            if ($type == 'name') {
                $user->setName($str);
            } elseif ($type == 'surname') {
                $user->setSurname($str);
            } elseif ($type == 'email') {
                $user->setEmail($str);
            } elseif ($type == 'phone') {
                $user->setPhone($str);
            }
    //        elseif ($type == 'pass') {
    //            $user->setPassword($encoder->encodePassword(
    //                $user,
    //                $str
    //            ));
    //            return $this->redirectToRoute('/logout');
    //        }

            $em->persist($user);
            $em->flush();
        } else {
            throw new \Exception('Not allowed');
        }
        return new JsonResponse('Change Done', Response::HTTP_OK);;
    }

    /**
     * @Route("/promote", name="promote")
     */
    public function promote()
    {
        return $this->render('profile/promote.html.twig');
    }

    /**
     * @Route("/promote-user", name="promoteUser")
     */
    public function promoteUser(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id = $request->request->get('id');

            $u = $this->getUser();
            $user = $em->getRepository(User::class)->find($id);

            $rol_user = $user->getRoles()[0];
            if ($rol_user == 'ROLE_USER') {
                $user->setRoles(['ROLE_STAFF']);
            } elseif ($rol_user == 'ROLE_STAFF') {
                $user->setRoles(['ROLE_USER']);
            }

            $em->persist($user);
            $em->flush();
        } else {
            throw new \Exception('Not allowed');
        }
        return new JsonResponse('Change Done', Response::HTTP_OK);;
    }

    /**
     * @Route("/get-users", name="getUsers", methods={"GET"})
     */
    public function getUsers(Request $request){
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository(User::class)->findAll();

            for ($i = 0; $i < count($users); $i++) {
                $data[$i] = [
                    'id'=> $users[$i]->getId(),
                    'email' => $users[$i]->getEmail(),
                    'rol' => $users[$i]->getRoles(),
                    'dni' => $users[$i]->getDni(),
                    'name' => $users[$i]->getName(),
                    'surname' => $users[$i]->getSurname(),
                    'phone' => $users[$i]->getPhone(),
                    'photo' => $users[$i]->getProfilePhoto(),
                ];
            }
        } else {
            throw new \Exception('Not allowed');
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

}

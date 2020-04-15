<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\UsersActivities;
use App\Form\ActivitiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivitiesController extends AbstractController
{
    /**
     * @Route("/register-activity", name="RegisterActivity")
     */
    public function index(Request $request)
    {
        $activity = new Activities();
        $form = $this->createForm(ActivitiesType::class, $activity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $activity->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('activities/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activity/{id}", name="ActivityId")
     */
    public function VerActividad($id){
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository( Activities::class)->find($id);
        return $this->render('activities/showActivity.html.twig', ['activity' => $activity]);
    }

    /**
     * @Route("/my-activities", name="MyActivities")
     */
    public function MisActividades(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $activities = $em->getRepository(Activities::class)->findBy(['user'=>$user]);
        return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/join", options={"expose"=true}, name="join")
     */
    public function Join(Request $request){
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $query = $em->getRepository(UsersActivities::class)->findBy(['user'=>$user]);
            $query2 = $em->getRepository(UsersActivities::class)->findBy(['activity'=>$id]);

            $activity = $em->getRepository( Activities::class)->find($id);
            $u_activity = new UsersActivities();
            if ($query == null || $query2 == null) {

                $u_activity->setUser($user);
                $u_activity->setActivity($activity);

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($u_activity);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
            }
            return new JsonResponse(['test'=>$activity]);
        } else {
            throw new \Exception('Not allowed');
        }
    }

    /**
     * @Route("/joined", options={"expose"=true}, name="joined")
     */
    public function Joined(Request $request){
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $query = $em->getRepository(UsersActivities::class)->findBy(['user'=>$user]);
            $query2 = $em->getRepository(UsersActivities::class)->findBy(['activity'=>$id]);

            $activity = $em->getRepository( Activities::class)->find($id);
            return new JsonResponse(['user'=>$query, 'activity' => $query2]);
        } else {
            throw new \Exception('Not allowed');
        }
    }

}

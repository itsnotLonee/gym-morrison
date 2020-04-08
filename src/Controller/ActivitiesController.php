<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Form\ActivitiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivitiesController extends AbstractController
{
    /**
     * @Route("/registrar-actividad", name="RegistrarActividad")
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
     * @Route("/actividad/{id}", name="ActividadId")
     */
    public function VerActividad($id){
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository( Activities::class)->find($id);
        return $this->render('activities/verActividad.html.twig', ['activity' => $activity]);
    }

    /**
     * @Route("/my-activities", name="MisActividades")
     */
    public function MisActividades(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $activities = $em->getRepository(Activities::class)->findBy(['user'=>$user]);
        return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }
}

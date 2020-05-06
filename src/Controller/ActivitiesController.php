<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\User;
use App\Entity\UsersActivities;
use App\Form\ActivitiesType;
use App\Repository\ActivitiesRepository;
use App\Repository\UsersActivitiesRepository;
use Seld\JsonLint\JsonParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


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
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $activity->setUser($user);
            $datetime = new \DateTime();
            $activity->setDateCreated($datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            return $this->redirectToRoute('MyActivities');
        }
        return $this->render('activities/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activity/{id}", name="ActivityId")
     */
    public function VerActividad($id)
    {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository(Activities::class)->find($id);
        // return new JsonResponse($activity);
        return $this->render('activities/showActivity.html.twig', ['activity' => $activity]);
    }

    /**
     * @Route("/get-activity", name="GetActivity")
     */
    public function GetActividad(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->request->get('id');
        $activity = $em->getRepository(Activities::class)->find($id);

        $owner = $activity->getUser()->getName() . " " . $activity->getUser()->getSurname();
        $data = [
            'id_id' => $activity->getId(),
            'title' => $activity->getTitle(),
            'content' => $activity->getContent(),
            'start_time' => $activity->getStartTime(),
            'end_time' => $activity->getEndTime(),
            'start_date' => $activity->getStartDate(),
            'end_date' => $activity->getEndDate(),
            'teacher' => $owner,
            'date_created' => $activity->getDateCreated(),
        ];


        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

//    /**
//     * @Route("/activity/{id}", name="ActivityId", methods={"GET"})
//     */
//    public function getActivity($id): JsonResponse
//    {
//        $em = $this->getDoctrine()->getManager();
//        $activity = $em->getRepository( Activities::class)->findOneBy(['id' => $id]);
//
//        $data = [
//            'id'=> $activity->getId(),
//            'name' => $activity->getTitle(),
//            'type' => $activity->getContent(),
//        ];
//
//        return new JsonResponse($data, Response::HTTP_OK);
//
//    }

    /**
     * @Route("/my-activities", name="MyActivities")
     */
    public function MisActividades(Request $request)
    {
        return $this->render('activities/MyActivities.html.twig');
    }

    /**
     * @Route("/get-my-activities", options={"expose"=true}, name="GetMyActivities", methods={"GET"})
     */
    public function GetMisActividades(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $activities = $em->getRepository(Activities::class)->findBy(['user' => $user]);

        for ($i = 0; $i < count($activities); $i++) {
            $owner = $activities[$i]->getUser()->getName() . " " . $activities[$i]->getUser()->getSurname();
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $owner,
                'date_created' => $activities[$i]->getDateCreated(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/get-today-myactivities", options={"expose"=true}, name="GetTodayMyActivities", methods={"GET"})
     */
    public function GetTodayMisActividades(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        // $activities = $em->getRepository(Activities::class)->findBy(['user' => $user]);
        $activities = $em->getRepository(Activities::class)->findTodayMyActivities($this->getUser());


        for ($i = 0; $i < count($activities); $i++) {
            $owner = $activities[$i]->getUser()->getName() . " " . $activities[$i]->getUser()->getSurname();
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $owner,
                'date_created' => $activities[$i]->getDateCreated(),
            ];

        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/get-today-activities", options={"expose"=true}, name="GetTodayActivities", methods={"GET"})
     */
    public function GetTodayActividades(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        // $activities = $em->getRepository(Activities::class)->findBy(['user' => $user]);
        $activities = $em->getRepository(Activities::class)->findTodayActivities();


        for ($i = 0; $i < count($activities); $i++) {
            $owner = $activities[$i]->getUser()->getName() . " " . $activities[$i]->getUser()->getSurname();
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $owner,
                'date_created' => $activities[$i]->getDateCreated(),
            ];

        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/all-activities", name="AllActivities")
     */
    public function TodasActividades(Request $request)
    {
        return $this->render('activities/AllActivities.html.twig');
    }


    /**
     * @Route("/get-all-activities", options={"expose"=true}, name="GetAllActivities", methods={"GET"})
     */
    public function GetTodasActividades(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $activities = $em->getRepository(Activities::class)->findAllActivities();

        for ($i = 0; $i < count($activities); $i++) {
            $owner = $activities[$i]->getUser()->getName() . " " . $activities[$i]->getUser()->getSurname();
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $owner,
                'date_created' => $activities[$i]->getDateCreated(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/removeActivity", options={"expose"=true}, name="removeActivity")
     */
    public function RemoveActivity(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $activity = $em->getRepository(Activities::class)->find($id);

            if ($user == $activity->getUser()) {
                $em->remove($activity);
                $em->flush();
                return new JsonResponse('Activity deleted succesfully', Response::HTTP_OK);
            } else {
                return new JsonResponse('You are not the owner', Response::HTTP_FORBIDDEN);
            }

        } else {
            throw new \Exception('Not allowed');
        }
    }

    /**
     * @Route("/edit-activity/{id}", name="editActivity")
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository(Activities::class)->find($id);

        $form = $this->createForm(ActivitiesType::class, $activity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $activity->setUser($user);
            $datetime = new \DateTime();
            $activity->setDateCreated($datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            return $this->redirectToRoute('MyActivities');
        }
        return $this->render('activities/editActivity.html.twig', [
            'form' => $form->createView(),
        ]);
    }



}

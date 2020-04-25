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
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $activity->setUser($user);
            $datetime = new \DateTime();
            $activity->setDateCreated($datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('activities/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/activity/{id}", name="ActivityId")
//     */
//    public function VerActividad($id){
//        $em = $this->getDoctrine()->getManager();
//        $activity = $em->getRepository( Activities::class)->find($id);
//        // return new JsonResponse($activity);
//        return $this->render('activities/showActivity.html.twig', ['activity' => $activity]);
//    }

    /**
     * @Route("/activity/{id}", name="ActivityId", methods={"GET"})
     */
    public function getActivity($id): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository( Activities::class)->findOneBy(['id' => $id]);

        $data = [
            'id'=> $activity->getId(),
            'name' => $activity->getTitle(),
            'type' => $activity->getContent(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);

    }



    /**
     * @Route("/get-my-activities", options={"expose"=true}, name="MyActivities", methods={"GET"})
     */
    public function MisActividades(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $activities = $em->getRepository(Activities::class)->findBy(['user'=>$user]);

        for ($i=0; $i < count($activities); $i++){
            $data[$i] = [
                'id'=> $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $activities[$i]->getUser(),
                'date_created' => $activities[$i]->getDateCreated(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/get-all-activities", options={"expose"=true}, name="AllActivities", methods={"GET"})
     */
    public function TodasActividades(Request $request){
        $em = $this->getDoctrine()->getManager();
        $activities = $em->getRepository(Activities::class)->findAll();

        for ($i=0; $i < count($activities); $i++){
            $data[$i] = [
                'id'=> $activities[$i]->getId(),
                'title' => $activities[$i]->getTitle(),
                'content' => $activities[$i]->getContent(),
                'start_time' => $activities[$i]->getStartTime(),
                'end_time' => $activities[$i]->getEndTime(),
                'start_date' => $activities[$i]->getStartDate(),
                'end_date' => $activities[$i]->getEndDate(),
                'owner' => $activities[$i]->getUser(),
                'date_created' => $activities[$i]->getDateCreated(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
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
            return new JsonResponse(['user'=>$query, 'activity' => $query2]);
        } else {
            throw new \Exception('Not allowed');
        }
    }

//    /**
//     * @Route("/removeActivity", options={"expose"=true}, name="removeActivity")
//     */
//    public function RemoveActivity(Request $request){
//        if ($request->isXmlHttpRequest()){
//            $em = $this->getDoctrine()->getManager();
//            $user = $this->getUser();
//            $id = $request->request->get('id');
//
//            $activity = $em->getRepository(Activities::class)->find(intval($id));
//            $u_act = $em->getRepository(UsersActivitiesRepository::class)->Apuntado($user);
//
//
//            //$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')
//            //$em -> remove($u_act);
//            //$em -> flush();
//            return new JsonResponse(['user'=>$activity, 'u_act' => $u_act]);
//        } else {
//            throw new \Exception('Not allowed');
//        }
//    }

    /**
     * @Route("/activity/{id}", name="deleteActivity", methods={"DELETE"})
     */
    public function deleteActivity($id): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository( Activities::class)->findOneBy(['id' => $id]);

        $em->getRepository( Activities::class)->removeActivity($activity);

        return new JsonResponse(['status' => 'Activity deleted'], Response::HTTP_OK);

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

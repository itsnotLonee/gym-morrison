<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\UsersActivities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserActivitiesController extends AbstractController
{
    // Actividades en las que se apunta el usuario

    /**
     * @Route("/get-user-activities", options={"expose"=true}, name="GetUserActivitiesHistory", methods={"GET"})
     */
    public function GetUserActividadesHistory(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        // $activities = $em->getRepository(Activities::class)->findBy(['user' => $user]);
        $activities = $em->getRepository(UsersActivities::class)->ApuntadoActividades($user);

        // $data = $activities->getUser()->getName();

        for ($i = 0; $i < count($activities); $i++) {
            $users_joined = $em->getRepository(UsersActivities::class)->findBy(['activity' => $activities[$i]->getId()]);
            $userJoined = $activities[$i]->getUser()->getName()." ".$activities[$i]->getUser()->getSurname();
            $teacher = $activities[$i]->getActivity()->getUser()->getName()." ".$activities[$i]->getActivity()->getUser()->getSurname();
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'user_joined' => $userJoined,
                'activity_id' => $activities[$i]->getActivity()->getID(),
                'activity_photo' => $activities[$i]->getActivity()->getPhoto(),
                'activity_teacher' => $teacher,
                'activity_title' => $activities[$i]->getActivity()->getTitle(),
                'activity_content' => $activities[$i]->getActivity()->getContent(),
                'activity_starttime' => $activities[$i]->getActivity()->getStartTime(),
                'activity_endtime' => $activities[$i]->getActivity()->getEndTime(),
                'activity_startdate' => $activities[$i]->getActivity()->getStartDate(),
                'activity_enddate' => $activities[$i]->getActivity()->getEndDate(),
                'activity_users' => count($users_joined)
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/get-user-today-activities", options={"expose"=true}, name="GetUserActivities", methods={"GET"})
     */
    public function GetTodayUserActividades(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        // $activities = $em->getRepository(Activities::class)->findBy(['user' => $user]);
        $activities = $em->getRepository(UsersActivities::class)->ApuntadoActividades($user);

        for ($i = 0; $i < count($activities); $i++) {
            $userJoined = $activities[$i]->getUser()->getName()." ".$activities[$i]->getUser()->getSurname();
            $teacher = $activities[$i]->getActivity()->getUser()->getName()." ".$activities[$i]->getActivity()->getUser()->getSurname();
            $users_joined = $em->getRepository(UsersActivities::class)->findBy(['activity' => $activities[$i]->getId()]);
            $data[$i] = [
                'id' => $activities[$i]->getId(),
                'user_joined' => $userJoined,
                'activity_id' => $activities[$i]->getActivity()->getID(),
                'activity_photo' => $activities[$i]->getActivity()->getPhoto(),
                'activity_teacher' => $teacher,
                'activity_title' => $activities[$i]->getActivity()->getTitle(),
                'activity_content' => $activities[$i]->getActivity()->getContent(),
                'activity_starttime' => $activities[$i]->getActivity()->getStartTime(),
                'activity_endtime' => $activities[$i]->getActivity()->getEndTime(),
                'activity_startdate' => $activities[$i]->getActivity()->getStartDate(),
                'activity_enddate' => $activities[$i]->getActivity()->getEndDate(),
                'activity_users' => count($users_joined)
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
        // return ($jsonfile);
        // return $this->render('activities/MyActivities.html.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/join", options={"expose"=true}, name="join")
     */
    public function Join(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $query = $em->getRepository(UsersActivities::class)->findOneBy(['user' => $user, 'activity' => $id]);

            if ($query == null) {

                $activity = $em->getRepository(Activities::class)->find($id);
                $u_activity = new UsersActivities();
                $u_activity->setUser($user);
                $u_activity->setActivity($activity);

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($u_activity);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
                return new JsonResponse('Joined');
            }
            return new JsonResponse('Already joined');
        } else {
            throw new \Exception('Not allowed');
        }
    }
    /**
     * @Route("/removeFromActivity", options={"expose"=true}, name="remove")
     */
    public function RemoveFrom(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $activity = $em->getRepository(Activities::class)->find($id);
            // $query = $em->getRepository(UsersActivities::class)->Apuntado($user, $id);
            $query = $em->getRepository(UsersActivities::class)->findOneBy(['user' => $user, 'activity' => $activity]);

            $em->remove($query);
            $em->flush();

            return new JsonResponse($query, Response::HTTP_OK);
        } else {
            throw new \Exception('Not allowed');
        }
    }

}

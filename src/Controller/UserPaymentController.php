<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\UsersPayment;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPaymentController extends AbstractController
{
    /**
     * @Route("/user-payment", name="user_payment")
     */
    public function index()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($user->getRoles()[0] == 'ROLE_USER') {

            $query = $em->getRepository(UsersPayment::class)->findOneBy(['user' => $user]);


            if ($query == null ) {
                return $this->render('user_payment/index.html.twig', [
                    'controller_name' => 'UserPaymentController',
                ]);
            }
        }
        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route("/newSub", options={"expose"=true}, name="newSub")
     */
    public function Join(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $query = $em->getRepository(UsersPayment::class)->findBy(['user' => $user]);

            if ($query == null) {
                $pay = $em->getRepository(Payment::class)->find($id);
                $payment = new UsersPayment();

                $payment->setUser($user);
                $payment->setPayment($pay);
                $datetime = new \DateTime();
                $payment->setDatePurchase($datetime);

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($payment);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();
                return new JsonResponse( 'Payment approved');
            }
            return new JsonResponse( 'Already paid');
        } else {
            throw new \Exception('Not allowed');
        }
    }

    /**
     * @Route("/daysLeft", options={"expose"=true}, name="daysLeft")
     */
    public function daysLeft(Request $request) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $id = $request->request->get('id');

            $query = $em->getRepository(UsersPayment::class)->findOneBy(['user' => $user]);

            $dayPurchase = $query->getDatePurchase();
            $addDays = $query->getPayment()->getDays() + 1;

            $dayPurchase->modify('+'.$addDays.' day');
            $today = new DateTime();

            $data = [
                'user' => $user,
                'days_left' => $dayPurchase->diff($today)
            ];

            return new JsonResponse($data, Response::HTTP_OK);
    }

}

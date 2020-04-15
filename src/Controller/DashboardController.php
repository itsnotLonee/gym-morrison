<?php

namespace App\Controller;

use App\Entity\Activities;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Extra\Intl\IntlExtension;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $user = $this->getUser();
        if ($user){
            $em = $this->getDoctrine()->getManager();
            //$query = $em->getRepository(Activities::class)->findAll();
            $query = $em->getRepository(Activities::class)->BuscarTodasActividades();
            // $activity = $em->getRepository(Activities::class)->findBy(['user'=>$user]);
            $pag1 = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                6 /*limit per page*/
            );
            return $this->render('dashboard/index.html.twig', [
                'pag1' => $pag1,
                'test' => $query
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }

    }



}

<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\UsersActivities;
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
            $pag = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                8 /*limit per page*/
            );
            if ($user->getRoles()[0] == 'ROLE_STAFF') {
                return $this->render('dashboard/admin.html.twig', [
                    'pag' => $pag,
                    'usuario' => $user->getRoles()[0]
                ]);
            } else {
                return $this->render('dashboard/index.html.twig', [
                    'pag' => $pag,
                    'usuario' => $user->getRoles()[0]
                ]);
            }
        }else{
            return $this->redirectToRoute('app_login');
        }
    }
}

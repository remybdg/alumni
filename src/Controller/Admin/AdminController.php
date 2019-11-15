<?php


namespace App\Controller\Admin;


use App\Repository\PromotionRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Degree;
use App\Repository\DegreeRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name ="admin.index")
     */

    public function index(DegreeRepository $degreeRepo, YearRepository $yearRepo, PromotionRepository $promoRepo) {
        $degrees = $degreeRepo->findBy([], ['name'=> 'ASC']);
        $years = $yearRepo->findBy([], ['title'=> 'ASC']);
        $promos = $promoRepo->findBy([], ['degree'=> 'DESC','year' => 'ASC' ]);

        return $this->render('admin/index.html.twig', ['degrees' => $degrees, 'years' => $years, 'promos' => $promos ]);
    }
}
<?php


namespace App\Controller;

use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{

    /**
     * @Route("/promotions", name ="promotions.index")
     */
    public function index(PromotionRepository $promoRepo)
    {
        $promos = $promoRepo->getAllOrderByDegreeAndYear();
        return $this->render('promotions.html.twig',['promos' => $promos ] );
    }

    /**
     * @Route("/promotions/{id}", name ="promotions.fiche")
     */
    public function fiche(Promotion $promotion)
    {

        return $this->render('fiche.promotion.twig', ['promotion' => $promotion]);
    }

}
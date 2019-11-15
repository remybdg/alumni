<?php


namespace App\Controller\Admin;


use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController
{
    /**
     * @Route("/admin/promotion/new", name ="admin.prom.new")
     */

    public function new(Request $request)
    {

        $form = $this->createForm(PromotionFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prom = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($prom);
            $em->flush();
            $this->addFlash('success', 'Nouvelle promotion ajoutée !');
            return $this->redirectToRoute('admin.index', ['_fragment' => 'promotions']);
        }
        return $this->render('admin/promotion/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/edit", name ="admin.prom.edit")
     */

    public function edit(Promotion $promotion, Request $request)
    {

        $form = $this->createForm(PromotionFormType::class, $promotion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Promotion modifiée !');
//            dd($promotion);
            return $this->redirectToRoute('admin.index', ['_fragment' => 'promotions']);
        }
        return $this->render('admin/promotion/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/rem", name ="admin.prom.rem")
     */

    public function remove(Promotion $promotion, Request $request)
    {
        $id = 'promo-'.$promotion->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($promotion);
        $em->flush();
//        $this->addFlash('success', 'Promotion supprimée !');
//        return $this->redirectToRoute('admin.index', ['_fragment' => 'promotions']);
        return $this->json($id);
    }
}
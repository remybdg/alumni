<?php


namespace App\Controller\Admin;


use App\Entity\Year;
use App\Form\YearFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminYearController extends AbstractController
{
    /**
     * @Route("/admin/year/new", name ="admin.year.new")
     */

    public function new(Request $request) {

        $form = $this->createForm(YearFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $year = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($year);
            $em->flush();
            $this->addFlash('success', 'Nouvelle année ajoutée !');
            return $this->redirectToRoute('admin.index', ['_fragment' => 'annees']);
        }
        return $this->render('admin/year/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/year/{id}/edit", name ="admin.year.edit")
     */

    public function edit(Year $year, Request $request) {
        $form = $this->createForm(YearFormType::class, $year);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Année modifiée!');
            return $this->redirectToRoute('admin.index', ['_fragment' => 'annees']);
        }
        return $this->render('admin/year/edit.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/year/{id}/rem", name ="admin.year.rem")
     */

    public function remove(Year $year) {
        $id = 'year-'.$year->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($year);
        $em->flush();
//        $this->addFlash('success', 'Année supprimée!');
//        return $this->redirectToRoute('admin.index', ['_fragment' => 'annees']);
        return $this->json($id);
    }

}
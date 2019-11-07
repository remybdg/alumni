<?php


namespace App\Controller;


use App\Entity\Degree;
use App\Repository\DegreeRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name ="home.index")
     */
    public function index(Request $request,UserRepository $userRepo, DegreeRepository $degreeRepo, YearRepository $yearRepo) {
//        $degreeRepo= $this->getDoctrine()->getRepository(Degree::class);
        $degrees = $degreeRepo->findAll();
        $years = $yearRepo->findAll();
        $users = [];
        if($request->request->count()) {
            $degree = $request->request->get('degree');
            $year = $request->request->get('year');
            $users = $userRepo->search($degree, $year);
//            dd($users);
        }

        return $this->render('home.html.twig', ['degrees' => $degrees, 'years' => $years, 'users' => $users]);
    }

}
<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;


class UserController extends AbstractController
{

    /**
     * @var SvgAvatarFactory
     */
    private $SvgAvatarFactory;
    /**
     * @var FileSystemHelper
     */
    private $FileSystemHelper;
    private $uploadPath;

    public function __construct(SvgAvatarFactory $SvgAvatarFactory, FileSystemHelper $FileSystemHelper, $uploadPath) {
        $this->SvgAvatarFactory = $SvgAvatarFactory;
        $this->FileSystemHelper = $FileSystemHelper;
        $this->uploadPath = $uploadPath;
    }
    /**
     * @Route("/moncompte/{id}/{slug}", name ="user.index")
     */
    public function index(User $user, $slug) {
        return $this->render('user.html.twig', ['user' => $user ]);
    }


    /**
     * @Route("/moncompte/{id}/{slug}/newavatar", name ="user.index.newavatar")
     */
    public function newAvatar() {
        $svg = $this->SvgAvatarFactory->getAvatar(2,5);

        $filename  = sha1(uniqid(rand(), true)). '.svg';
        $filePath = $this->uploadPath .'/'. SvgAvatarFactory::AVATAR_DIR.'/'. $filename ;
        $this->FileSystemHelper->write($filePath, $svg);
        return $this->json($filename);

    }

    /**
     * @Route("/moncompte/{id}/{slug}/saveavatar", name ="user.index.saveavatar")
     */
    public function saveNewAvatar(user $user) {
//        $user->setAvatar()

    }
}

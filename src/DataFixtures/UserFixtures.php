<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture implements DependentFixtureInterface
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

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function getDependencies() {
        return [DegreeFixtures::class, YearFixtures::class,PromotionFixtures::class];
    }

    public function __construct(SvgAvatarFactory $SvgAvatarFactory, FileSystemHelper $FileSystemHelper, UserPasswordEncoderInterface $passwordEncoder, $uploadPath) {
        parent::__construct();
        $this->SvgAvatarFactory = $SvgAvatarFactory;
        $this->FileSystemHelper = $FileSystemHelper;
        $this->uploadPath = $uploadPath;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getAvatar() {
        $svg = $this->SvgAvatarFactory->getAvatar(2,5);

        $filename  = sha1(uniqid(rand(), true)). '.svg';
        $filePath = $this->uploadPath .'/'. SvgAvatarFactory::AVATAR_DIR.'/'. $filename ;
        $this->FileSystemHelper->write($filePath, $svg);
        return $filename;
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = factory::create('fr_FR');
        $promotions = $this->getReferences('Promotion');

        for($i = 0; $i < 250; $i++) {

            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->name);
            $user->setEmail($faker->email);
//            $user->setPassword(password_hash($faker->password, PASSWORD_DEFAULT));
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'));
            $user->setCity($faker->city);
            $user->setBirthdate(new \DateTime(rand(1930, 2000).'-'.$faker->month.'-'.$faker->dayOfMonth));

//            $promo = $promotions[rand(0, count($promotions) - 1)];
            $promos = $faker->randomElements($promotions, rand(1, 2));
            foreach ($promos as $promo) {
                $user-> addPromotion($promo);
            }

            $user->setAvatar($this->getAvatar());

            $admin = new User();
            $admin->setFirstname('Remy');
            $admin->setLastname('Boisdanghien');
            $admin->setEmail('remyb@live.com');

            $passwordHashed = $this->passwordEncoder->encodePassword($admin, 'admin');
            $admin->setPassword($passwordHashed);

            $admin->setCity('Aix');
            $admin->setBirthdate(new \DateTime('1980-04-23'));
            $admin->setAvatar($this->getAvatar());
            $admin->setRoles(['ROLE_ADMIN']);


            $manager->persist($user);
            $manager->persist($admin);
        }



        $manager->flush();
    }
}

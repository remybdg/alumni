<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $arr = ['Developpement', 'Webdesign', 'Electricité', 'Bureautique', 'Hotellerie'];

        for($cpt = 0; $cpt< count($arr); $cpt++) {
            $degree = new Degree();
            $degree-> setName($arr[$cpt]);
            $this->addReference('Degree_'.$cpt, $degree);
            $manager -> persist($degree);
        }


        $manager->flush();
    }
}

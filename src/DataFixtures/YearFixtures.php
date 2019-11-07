<?php

namespace App\DataFixtures;

use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class YearFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($cpt = 2010; $cpt< 2020; $cpt++) {
            $year = new Year();
            $year->setTitle($cpt);
            $this->addReference('Year_' . $cpt, $year);
            $manager->persist($year);
        }
        $manager->flush();
    }
}

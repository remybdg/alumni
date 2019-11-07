<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use App\DataFixtures\BaseFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies() {
        return [DegreeFixtures::class, YearFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $degrees = $this->getReferences('Degree');
        $years = $this->getReferences('Year');
        $cpt = 0;
        foreach ($degrees as $degree) {
            foreach ($years as $year) {
                $promotion = new Promotion();
                $promotion->setDegree($degree);
                $promotion->setYear($year);
                $this->addReference('Promotion_' . $cpt, $promotion);

                $manager->persist($promotion);
                $cpt++;
            }
        }
        $manager->flush();
    }
}

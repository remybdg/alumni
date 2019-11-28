<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use App\DataFixtures\BaseFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies() {
        return [DegreeFixtures::class, YearFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    //creation d'un objet faker
        $faker = factory::create('fr_FR');

        $degrees = $this->getReferences('Degree');
        $years = $this->getReferences('Year');
        $cpt = 0;
        foreach ($degrees as $degree) {
            foreach ($years as $year) {
                $promotion = new Promotion();
                $promotion->setDegree($degree);
                $promotion->setYear($year);

    //utilisation de faker pour generer des data pour startDate, endDate et notes
                $promotion->setStartDate(new \DateTime(rand(1970, 2020).'-'.$faker->month.'-'.$faker->dayOfMonth));
                $promotion->setEndDate(new \DateTime(rand(1970, 2020).'-'.$faker->month.'-'.$faker->dayOfMonth));
                $promotion->setNotes($faker->text($maxNbChars = 250));

                $this->addReference('Promotion_' . $cpt, $promotion);

                $manager->persist($promotion);
                $cpt++;

            }
        }
        $manager->flush();
    }
}

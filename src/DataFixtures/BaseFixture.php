<?php


namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class BaseFixture extends Fixture
{
    private $references;

    public function __construct()
    {
        $this->references = [];
    }

    protected function getReferences(string $name) {
        if(!array_key_exists($name, $this->references)) {
            $this->references[$name] = [];
            foreach ($this->referenceRepository->getReferences() as $ref => $entity) {
                if (strpos($ref, $name) === 0) {
                    $this->references[$name][] = $this->getReference($ref);
                }
            }
        }
        return $this->references[$name];
    }
}

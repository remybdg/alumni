<?php

namespace App\Service\Avatar;

class AvatarMatrix
{
    const DEFAULT_SIZE = 4;
    const DEFAULT_COLORS = ['black', 'white'];

    private $size;
    private $colors;
    private $matrix;

    public function __construct() {
		$this->size = self::DEFAULT_SIZE;
		$this->colors = self::DEFAULT_COLORS;
		$this->matrix = [];
	}

    public function build() {
        $array = [];
        $currentColumn = $this->columnBuilder();
        if($this->size % 2 != 0) {
            array_push($array, $currentColumn);
        }
        $cptMax = round($this->size/2, 0, PHP_ROUND_HALF_DOWN);
        for ($cpt=0; $cpt<$cptMax; $cpt++) {
            // var_dump('cpt', $cpt);
            // echo "<br>";
            $currentColumn = $this->columnBuilder();
            array_push($array, $currentColumn);
            array_unshift($array, $currentColumn);
        }
        $this->matrix = $array;
    }

    public function columnBuilder() {
        $column = [];
        $cpt;
        for ($cpt=0; $cpt<$this->size; $cpt++) {
            array_push($column, $this->setRandom());
        }
        // var_dump($column);
        // echo "<br>";
        return $column;
    }

    public function setRandom() {
        $max = (count($this->colors)-1);
        $randomIndex = (rand(0, $max));
        // var_dump('couleur', $max, $randomIndex);
        return $this->colors[$randomIndex];
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }

    public function setColors($colors) {
        $this->colors = $colors;
    }

    public function getMatrix() {
        return $this->matrix;
    }

}
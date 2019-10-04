<?php

namespace App\Service\Tools;

class ColorTools {

    public static function getRandomColor()
    {
        $chars = str_split('ABCDEF0123456789');
        $color = '#';
        for($i = 0 ; $i < 6 ; $i++){
            $color .= $chars[rand(0, count($chars) - 1)];
        }
        return $color;        
    }


    public static function getRandomColors(int $n)
    {
        $colorsArray = [];
        for ($i = 0 ; $i < $n ; $i++) {
            // $colorsArray[] = getRandomColor();
            $color = self::getRandomColor();
            array_push($colorsArray, $color);
        }
        return $colorsArray;
    }
}
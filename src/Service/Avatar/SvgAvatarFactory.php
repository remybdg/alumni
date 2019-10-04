<?php

namespace App\Service\Avatar;

use App\Service\Tools\ColorTools;

class SvgAvatarFactory {

    const AVATAR_DIR = 'avatars';
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function getAvatar(int $nbColors, int $casesNumber) {
        $colors = ColorTools::getRandomColors($nbColors);

        $matrix = new AvatarMatrix;

        $matrix->setColors($colors);
        $matrix->setSize($casesNumber);
        $svgAvatarRenderer = new SvgAvatarRenderer($this->template);
    
        $svg = $svgAvatarRenderer->render($matrix);
        return $svg;
    }
}
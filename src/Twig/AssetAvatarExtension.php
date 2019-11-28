<?php

namespace App\Twig;

use App\Service\Avatar\SvgAvatarFactory;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetAvatarExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('asset_avatar', array($this, 'assetAvatar')),
        );
    }

    public function assetavatar($avatarName)
    {
        return '/'.$this->uploadDir."/".SvgAvatarFactory::AVATAR_DIR . '/' . $avatarName;
    }

    private $uploadDir;

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }
}
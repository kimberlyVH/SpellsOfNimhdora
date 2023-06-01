<?php
//Business/AvatarService.php

declare(strict_types=1);
namespace Business;

use Entities\Avatar;
use Data\AvatarDAO;

class AvatarService
{
    public function giveAvatarList(): array
    {
        $avatarDAO = new AvatarDAO();
        $avatarListData = $avatarDAO->getAllAvatarImages();

        $avatarList = array();
        foreach ($avatarListData as $avatarData)
        {
            $avatar = Avatar::create((int) $avatarData["id"], (string) $avatarData["avatar_naam"], (string) $avatarData["avatar_imgSrc"]);
            array_push($avatarList, $avatar);
        }

        return $avatarList;
    }
    public function giveAvatar_image(int $avatarId): Avatar
    {
        $avatarDAO = new AvatarDAO();
        $avatarData = $avatarDAO->getAvatarById((int) $avatarId);
        $avatar = Avatar::create((int) $avatarData["id"], (string) $avatarData["avatar_naam"], (string) $avatarData["avatar_imgSrc"]);
        return $avatar;
    }
}

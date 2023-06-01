<?php
//Entities/accountService.php

declare(strict_types=1);

namespace Business;

use Entities\UserAccount;
use Data\UserAccountDAO;
use Business\AvatarService;
use Exceptions\UpdateFailedException;

class UserAccountService
{
    public function createUserAccount(): UserAccount
    {
        $avatarService = new AvatarService();
        $avatar = $avatarService->giveAvatar_image(0);
        //0 -> avatarId of standard_image;

        $newUserAccount = new UserAccount();
        $newUserAccount->setAvatar($avatar);

        $useraccountDAO = new UserAccountDAO();
        $LastaddedAccount = $useraccountDAO->addNewUserAccount(
            (int) $avatar->getId(),
            (int) $newUserAccount->getPlayerAge(),
            (string) $newUserAccount->getPlayerGender(),
            (string) $newUserAccount->getPlayerBio(),
            (int) $newUserAccount->getLevel(),
            (int) $newUserAccount->getXp()
        );

        $newUserAccount->setUserAccountNr((int) $LastaddedAccount);
        return $newUserAccount;
    }

    public function giveUserAccount($accountNr): UserAccount
    {
        $userAccountDAO = new UserAccountDAO();
        $userAccountData = $userAccountDAO->getUserAccountByAccountNr($accountNr);

        $userAccount = new UserAccount();
        $userAccount->setUserAccountNr($accountNr);
        $userAccount->setPlayerAge((int) $userAccountData["playerAge"]);
        $userAccount->setPlayerGender((string) $userAccountData["playerGender"]);
        $userAccount->setPlayerBio((string) $userAccountData["playerBio"]);
        $userAccount->setlevel((int) $userAccountData["LVL"]);
        $userAccount->setXp((int) $userAccountData["XP"]);

        $avatarService = new avatarService();
        $avatar = $avatarService->giveAvatar_image((int) $userAccountData["avatarId"]);

        $userAccount->setAvatar($avatar);
        return $userAccount;
    }

    public function saveProfileChanges(UserAccount $userAccount)
    {
        $userAccountDAO = new UserAccountDAO();
        $avatar = $userAccount->getAvatar();

        $userAccountDAO->updateUserAccount(
            (int) $userAccount->getUserAccountNr(),
            (int) $avatar->getId(),
            (int) $userAccount->getPlayerAge(),
            (string) $userAccount->getPlayerGender(),
            (string) $userAccount->getPlayerBio()
        );
    }

    public function delete($accountNr) {
        $userAccountDAO = new UserAccountDAO();
        $userAccountDAO->deleteUserAccount($accountNr);
    }
}

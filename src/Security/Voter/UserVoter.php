<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

Use App\Entity\User;

class UserVoter extends Voter
{
    const USER_EDIT   = "USER_EDIT";
    const USER_SHOW   = "USER_SHOW";
    const USER_DELETE = "USER_DELETE";

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array(
            $attribute,
            [
                self::USER_EDIT,
                self::USER_SHOW,
                self::USER_DELETE
            ])
            && ($subject instanceof User || $subject == null);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::USER_EDIT:
            case self::USER_SHOW:
                return in_array("ROLE_ADMIN", $user->getRoles()) || $user === $subject;
            case self::USER_DELETE:
                return in_array("ROLE_ADMIN", $user->getRoles());
        }

        return false;
    }
}

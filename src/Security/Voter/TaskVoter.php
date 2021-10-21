<?php

namespace App\Security\Voter;

use App\Entity\Task;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskVoter extends Voter
{
    public const TASKS_LIST = 'TASKS_LIST';
    public const TASK_EDIT = 'TASK_EDIT';
    public const TASK_TOGGLE = 'TASK_TOGGLE';
    public const TASK_DELETE = 'TASK_DELETE';
    public const TASK_CREATE = 'TASK_CREATE';
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array(
            $attribute,
            [
                self::TASKS_LIST,
                self::TASK_EDIT,
                self::TASK_TOGGLE,
                self::TASK_DELETE,
                self::TASK_CREATE,
            ]
        ) && ($subject instanceof \App\Entity\Task || null == $subject);
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
            case self::TASKS_LIST:
            case self::TASK_CREATE:
                return true;
            case self::TASK_EDIT:
            case self::TASK_TOGGLE:
            case self::TASK_DELETE:
                if (!$subject instanceof Task) {
                    return false;
                }

                return ($this->security->isGranted('ROLE_ADMIN') && null == $subject->getAuthor()) || $subject->getAuthor() === $user;
        }

        return false;
    }
}

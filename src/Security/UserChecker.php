<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

//Esto comprueba que el usuario esté verificado cuando se logea
class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAccountStatusException(
                'Debes verificar tu correo electrónico antes de iniciar sesión.'
            );
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // No necesitamos nada aquí
    }
}

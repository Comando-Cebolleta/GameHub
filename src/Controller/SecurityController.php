<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // SI EL USUARIO YA ESTÁ LOGUEADO, REDIRIGE AL PERFIL
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profile');
        }

        // obtener el error de inicio de sesión si hay uno
        $error = $authenticationUtils->getLastAuthenticationError();

        // último nombre de usuario introducido por el usuario
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods: ["GET"])]
    public function logout(): void
    {
        // El controlador puede estar vacío: ¡nunca se llamará!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
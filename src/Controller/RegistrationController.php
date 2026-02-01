<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserSettingsType; // IMPORTANTE: Faltaba esta línea
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profile');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            $user->setIsVerified(false);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@gamehubsite.es', 'No Reply'))
                    ->to((string) $user->getEmail())
                    ->subject('Confirmación de registro')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            return $this->redirectToRoute('registration_flash_email_sent');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');
        if (null === $id) return $this->redirectToRoute('app_register');

        $user = $userRepository->find($id);
        if (null === $user) return $this->redirectToRoute('app_register');

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('success', 'Tu dirección de correo ha sido verificada.');
        return $this->redirectToRoute('registration_flash_email_verified');
    }

    #[Route('/flash/email-sent', name: 'registration_flash_email_sent')]
    public function flashEmailSent(): Response
    {
        return $this->render('registration/flash_email_sent.html.twig');
    }

    #[Route('/flash/email-verified', name: 'registration_flash_email_verified')]
    public function flashEmailVerified(): Response
    {
        return $this->render('registration/flash_email_verified.html.twig');
    }

    /* --- MÉTODO SETTINGS CORREGIDO --- */
    #[Route('/settings', name: 'app_settings')]
    public function settings(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserSettingsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Buscamos el archivo usando el nombre que pusimos en el FormType (fotoPerfil)
            $avatarFile = $form->get('fotoPerfil')->getData();

            if ($avatarFile) {
                $newFilename = uniqid().'.'.$avatarFile->guessExtension();

                try {
                    $avatarFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads/avatars',
                        $newFilename
                    );

                    // Actualizamos con el nombre de método correcto de tu entidad
                    $user->setFotoPerfil($newFilename);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'No se pudo subir la imagen.');
                }
            }

            $entityManager->flush();
            $this->addFlash('success', '¡Perfil actualizado con éxito!');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('user/settings.html.twig', [
            'settingsForm' => $form->createView(),
        ]);
    }
}
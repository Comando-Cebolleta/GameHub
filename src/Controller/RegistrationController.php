<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
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
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        Security $security
    ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // Cifrar la contraseña
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            //Usuario no verificado al inicio (se hace ya en la entidad, pero por si acaso)
            $user->setIsVerified(false);

            $entityManager->persist($user);
            $entityManager->flush();

            //$firewallName = 'main';

            // Crear el token de seguridad
            //$token = new UsernamePasswordToken($user, $firewallName, $user->getRoles());

            // Almacenamos el token en la sesión de seguridad
            //$tokenStorage->setToken($token);

            // Enviar correo de verificación
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@gamehubsite.es', 'No Reply'))
                    ->to((string) $user->getEmail())
                    ->subject('Confirmación de registro')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Redirige a un flash de aviso del email de verificación
            return $this->redirectToRoute('registration_flash_email_sent');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // Validar el enlace de confirmación de correo, establece User::isVerified=true y persiste
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('success', 'Your email address has been verified.');

        // Redirige a la página flash de "email confirmado"
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

}
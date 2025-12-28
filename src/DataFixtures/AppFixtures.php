<?php

namespace App\DataFixtures;

use App\Entity\ArmaPlantilla;
use App\Entity\ArtefactoPlantilla;
use App\Entity\PersonajePlantilla;
use App\Entity\PiezaTipo;
use App\Entity\SetArtefactos;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // 1. CREAR USUARIO DE PRUEBA
        $user = new User();
        $user->setEmail('admin@gamehub.es');
        $user->setUsername('AdminHub');
        $user->setIsVerified(true);
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        // 2. CREAR TIPOS DE PIEZA (FLOR, PLUMA, ETC.)
        $tipos = ['Flor', 'Pluma', 'Reloj', 'Copa', 'Casco'];
        $piezaEntities = [];

        foreach ($tipos as $nombreTipo) {
            $pieza = new PiezaTipo();
            $pieza->setNombre($nombreTipo);
            $pieza->setCodigo(strtoupper($nombreTipo)); // Ej: FLOR
            $manager->persist($pieza);
            $piezaEntities[$nombreTipo] = $pieza; // Guardamos referencia para usarla luego
        }

        // 3. CREAR UN SET DE ARTEFACTOS (Ej: Emblema del Destino)
        $setEmblema = new SetArtefactos();
        $setEmblema->setNombre('Emblema del Destino');
        $setEmblema->setEfectos('2p: Recarga Energía +20%. 4p: Aumenta daño Definitiva...');
        $setEmblema->setImagen('emblema_icon.webp');
        $manager->persist($setEmblema);

        // 4. CREAR PLANTILLAS DE ARTEFACTOS (Unir Set + Piezas)
        // Creamos las 5 piezas para el set Emblema
        foreach ($piezaEntities as $tipoPieza) {
            $artPlantilla = new ArtefactoPlantilla();
            $artPlantilla->setSetArtefactos($setEmblema);
            $artPlantilla->setPiezaTipo($tipoPieza);
            $artPlantilla->setJuego('genshin');
            $artPlantilla->setImagen('emblema_' . strtolower($tipoPieza->getNombre()) . '.webp');
            $manager->persist($artPlantilla);
        }

        // 5. CREAR PERSONAJE PLANTILLA (Raiden Shogun)
        $raiden = new PersonajePlantilla();
        $raiden->setNombre('Raiden Shogun');
        $raiden->setJuego('genshin');
        $raiden->setImagen('raiden.webp');
        $raiden->setStatsBase(['vida' => 12907, 'ataque' => 337, 'defensa' => 789]);
        $manager->persist($raiden);

        // 6. CREAR PERSONAJE PLANTILLA HSR (Kafka)
        $kafka = new PersonajePlantilla();
        $kafka->setNombre('Kafka');
        $kafka->setJuego('hsr');
        $kafka->setImagen('kafka.webp');
        $manager->persist($kafka);

        // 7. CREAR ARMA PLANTILLA (Engulfing Lightning)
        $arma = new ArmaPlantilla();
        $arma->setNombre('Luz del Segador');
        $arma->setJuego('genshin');
        $arma->setImagen('engulfing.webp');
        $manager->persist($arma);

        $manager->flush();
    }
}
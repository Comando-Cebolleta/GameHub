<?php

namespace App\Repository;

use App\Entity\ArtefactoPlantilla;
use App\Entity\SetArtefactos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtefactoPlantilla>
 */
class ArtefactoPlantillaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtefactoPlantilla::class);
    }

    public function findOneBySetAndType(SetArtefactos $set, string $codigoTipo): ?ArtefactoPlantilla
    {
        return $this->createQueryBuilder('ap')
            ->join('ap.piezaTipo', 'pt')       // join de tablas
            ->where('ap.setArtefactos = :set') // Filtramos por el set de artefactos
            ->andWhere('pt.codigo = :cod') // Filtramos por el nombre del tipo
            ->setParameter('set', $set)
            ->setParameter('cod', $codigoTipo)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260120091550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma_plantilla CHANGE stats_base stats_base JSON DEFAULT NULL, CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE artefacto CHANGE estadisticas estadisticas JSON NOT NULL');
        $this->addSql('ALTER TABLE personaje ADD nombre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE personaje_plantilla CHANGE stats_base stats_base JSON DEFAULT NULL, CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personaje DROP nombre');
        $this->addSql('ALTER TABLE personaje_plantilla CHANGE stats_base stats_base JSON DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE artefacto CHANGE estadisticas estadisticas JSON NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE arma_plantilla CHANGE stats_base stats_base JSON DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COLLATE `utf8mb4_bin`');
    }
}

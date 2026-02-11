<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209150106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma_plantilla CHANGE nombre nombre VARCHAR(50) NOT NULL, CHANGE imagen imagen VARCHAR(255) DEFAULT NULL, CHANGE juego juego VARCHAR(30) NOT NULL, CHANGE stats_base stats_base JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE pasiva pasiva VARCHAR(255) DEFAULT NULL, CHANGE tipo tipo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE artefacto CHANGE estadisticas estadisticas JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE personaje_plantilla CHANGE juego juego VARCHAR(30) NOT NULL, CHANGE nombre nombre VARCHAR(50) NOT NULL, CHANGE stats_base stats_base JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE stats_por_nivel stats_por_nivel JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE imagen imagen VARCHAR(255) DEFAULT NULL, CHANGE elemento elemento VARCHAR(255) DEFAULT NULL, CHANGE senda senda VARCHAR(255) DEFAULT NULL, CHANGE icono icono VARCHAR(255) DEFAULT NULL, CHANGE tipo_arma tipo_arma VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL, CHANGE foto_perfil foto_perfil VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma_plantilla CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagen imagen VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE juego juego VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE stats_base stats_base LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE stats_por_nivel stats_por_nivel LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE pasiva pasiva VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo tipo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE artefacto CHANGE estadisticas estadisticas LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE personaje_plantilla CHANGE juego juego VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE stats_base stats_base LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE stats_por_nivel stats_por_nivel LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE imagen imagen VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icono icono VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE elemento elemento VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE senda senda VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo_arma tipo_arma VARCHAR(50) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto_perfil foto_perfil VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

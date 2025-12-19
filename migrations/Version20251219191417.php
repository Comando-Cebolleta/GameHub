<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219191417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arma (id INT AUTO_INCREMENT NOT NULL, arma_plantilla_id INT DEFAULT NULL, nivel INT NOT NULL, INDEX IDX_1F4DB7603F28BF78 (arma_plantilla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arma_plantilla (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, imagen VARCHAR(255) DEFAULT NULL, juego VARCHAR(30) NOT NULL, stats_base JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', stats_por_nivel JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', pasiva VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_C49C530BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipo_personaje (personaje_id INT NOT NULL, equipo_id INT NOT NULL, posicion INT NOT NULL, INDEX IDX_ED7A2DF7121EFAFB (personaje_id), INDEX IDX_ED7A2DF723BFBED (equipo_id), PRIMARY KEY(personaje_id, equipo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personaje (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, arma_id INT DEFAULT NULL, personaje_plantilla_id INT DEFAULT NULL, nivel INT NOT NULL, dupe_num INT NOT NULL, INDEX IDX_53A41088A76ED395 (user_id), UNIQUE INDEX UNIQ_53A410888D7F0B5D (arma_id), INDEX IDX_53A410881F22B4C7 (personaje_plantilla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personaje_plantilla (id INT AUTO_INCREMENT NOT NULL, juego VARCHAR(30) NOT NULL, nombre VARCHAR(50) NOT NULL, stats_base JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', stats_por_nivel JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', imagen VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arma ADD CONSTRAINT FK_1F4DB7603F28BF78 FOREIGN KEY (arma_plantilla_id) REFERENCES arma_plantilla (id)');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipo_personaje ADD CONSTRAINT FK_ED7A2DF7121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id)');
        $this->addSql('ALTER TABLE equipo_personaje ADD CONSTRAINT FK_ED7A2DF723BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410888D7F0B5D FOREIGN KEY (arma_id) REFERENCES arma (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410881F22B4C7 FOREIGN KEY (personaje_plantilla_id) REFERENCES personaje_plantilla (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma DROP FOREIGN KEY FK_1F4DB7603F28BF78');
        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530BA76ED395');
        $this->addSql('ALTER TABLE equipo_personaje DROP FOREIGN KEY FK_ED7A2DF7121EFAFB');
        $this->addSql('ALTER TABLE equipo_personaje DROP FOREIGN KEY FK_ED7A2DF723BFBED');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088A76ED395');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410888D7F0B5D');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410881F22B4C7');
        $this->addSql('DROP TABLE arma');
        $this->addSql('DROP TABLE arma_plantilla');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE equipo_personaje');
        $this->addSql('DROP TABLE personaje');
        $this->addSql('DROP TABLE personaje_plantilla');
    }
}

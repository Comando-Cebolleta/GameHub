<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251222142622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artefacto (id INT AUTO_INCREMENT NOT NULL, artefacto_plantilla_id INT DEFAULT NULL, estadisticas JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_4A5DDABC4B44F0C4 (artefacto_plantilla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artefacto_plantilla (id INT AUTO_INCREMENT NOT NULL, pieza_tipo_id INT DEFAULT NULL, set_artefactos_id INT DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, juego VARCHAR(30) NOT NULL, INDEX IDX_BA3F7E33C6862B (pieza_tipo_id), INDEX IDX_BA3F7EC07AB4E2 (set_artefactos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE juego_pieza_tipo (juego VARCHAR(255) NOT NULL, pieza_tipo_id INT NOT NULL, INDEX IDX_20F42A6333C6862B (pieza_tipo_id), PRIMARY KEY(juego, pieza_tipo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personaje_artefacto (personaje_id INT NOT NULL, artefacto_id INT NOT NULL, INDEX IDX_62E96A79121EFAFB (personaje_id), INDEX IDX_62E96A79C408C2D2 (artefacto_id), PRIMARY KEY(personaje_id, artefacto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pieza_tipo (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(20) NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE set_artefactos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, efectos VARCHAR(1024) NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artefacto ADD CONSTRAINT FK_4A5DDABC4B44F0C4 FOREIGN KEY (artefacto_plantilla_id) REFERENCES artefacto_plantilla (id)');
        $this->addSql('ALTER TABLE artefacto_plantilla ADD CONSTRAINT FK_BA3F7E33C6862B FOREIGN KEY (pieza_tipo_id) REFERENCES pieza_tipo (id)');
        $this->addSql('ALTER TABLE artefacto_plantilla ADD CONSTRAINT FK_BA3F7EC07AB4E2 FOREIGN KEY (set_artefactos_id) REFERENCES set_artefactos (id)');
        $this->addSql('ALTER TABLE juego_pieza_tipo ADD CONSTRAINT FK_20F42A6333C6862B FOREIGN KEY (pieza_tipo_id) REFERENCES pieza_tipo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personaje_artefacto ADD CONSTRAINT FK_62E96A79121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personaje_artefacto ADD CONSTRAINT FK_62E96A79C408C2D2 FOREIGN KEY (artefacto_id) REFERENCES artefacto (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artefacto DROP FOREIGN KEY FK_4A5DDABC4B44F0C4');
        $this->addSql('ALTER TABLE artefacto_plantilla DROP FOREIGN KEY FK_BA3F7E33C6862B');
        $this->addSql('ALTER TABLE artefacto_plantilla DROP FOREIGN KEY FK_BA3F7EC07AB4E2');
        $this->addSql('ALTER TABLE juego_pieza_tipo DROP FOREIGN KEY FK_20F42A6333C6862B');
        $this->addSql('ALTER TABLE personaje_artefacto DROP FOREIGN KEY FK_62E96A79121EFAFB');
        $this->addSql('ALTER TABLE personaje_artefacto DROP FOREIGN KEY FK_62E96A79C408C2D2');
        $this->addSql('DROP TABLE artefacto');
        $this->addSql('DROP TABLE artefacto_plantilla');
        $this->addSql('DROP TABLE juego_pieza_tipo');
        $this->addSql('DROP TABLE personaje_artefacto');
        $this->addSql('DROP TABLE pieza_tipo');
        $this->addSql('DROP TABLE set_artefactos');
    }
}

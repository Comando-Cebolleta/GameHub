<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260111170514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma_plantilla CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE artefacto_plantilla CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE dupe CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE habilidad CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE pieza_tipo CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE set_artefactos CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arma_plantilla CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE artefacto_plantilla CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE dupe CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE habilidad CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE pieza_tipo CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE set_artefactos CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}

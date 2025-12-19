<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219192638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dupe (id INT AUTO_INCREMENT NOT NULL, personaje_plantilla_id INT DEFAULT NULL, numero INT NOT NULL, nombre VARCHAR(50) NOT NULL, efectos VARCHAR(255) NOT NULL, INDEX IDX_D5DDF9D21F22B4C7 (personaje_plantilla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dupe ADD CONSTRAINT FK_D5DDF9D21F22B4C7 FOREIGN KEY (personaje_plantilla_id) REFERENCES personaje_plantilla (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dupe DROP FOREIGN KEY FK_D5DDF9D21F22B4C7');
        $this->addSql('DROP TABLE dupe');
    }
}

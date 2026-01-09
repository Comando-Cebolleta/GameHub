<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251222131038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habilidad (id INT AUTO_INCREMENT NOT NULL, personaje_plantilla_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, efectos VARCHAR(1024) NOT NULL, INDEX IDX_4D2A2AF71F22B4C7 (personaje_plantilla_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personaje_habilidad (personaje_id INT NOT NULL, habilidad_id INT NOT NULL, nivel INT NOT NULL, INDEX IDX_659E9A32121EFAFB (personaje_id), INDEX IDX_659E9A32621AA5D6 (habilidad_id), PRIMARY KEY(personaje_id, habilidad_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habilidad ADD CONSTRAINT FK_4D2A2AF71F22B4C7 FOREIGN KEY (personaje_plantilla_id) REFERENCES personaje_plantilla (id)');
        $this->addSql('ALTER TABLE personaje_habilidad ADD CONSTRAINT FK_659E9A32121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id)');
        $this->addSql('ALTER TABLE personaje_habilidad ADD CONSTRAINT FK_659E9A32621AA5D6 FOREIGN KEY (habilidad_id) REFERENCES habilidad (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habilidad DROP FOREIGN KEY FK_4D2A2AF71F22B4C7');
        $this->addSql('ALTER TABLE personaje_habilidad DROP FOREIGN KEY FK_659E9A32121EFAFB');
        $this->addSql('ALTER TABLE personaje_habilidad DROP FOREIGN KEY FK_659E9A32621AA5D6');
        $this->addSql('DROP TABLE habilidad');
        $this->addSql('DROP TABLE personaje_habilidad');
    }
}

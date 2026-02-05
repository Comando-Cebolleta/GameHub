<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260205073814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego_pieza_tipo DROP FOREIGN KEY FK_20F42A6333C6862B');
        $this->addSql('DROP TABLE juego_pieza_tipo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juego_pieza_tipo (juego VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pieza_tipo_id INT NOT NULL, INDEX IDX_20F42A6333C6862B (pieza_tipo_id), PRIMARY KEY(juego, pieza_tipo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE juego_pieza_tipo ADD CONSTRAINT FK_20F42A6333C6862B FOREIGN KEY (pieza_tipo_id) REFERENCES pieza_tipo (id) ON DELETE CASCADE');
    }
}

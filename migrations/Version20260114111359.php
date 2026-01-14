<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260114111359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `like` MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON `like`');
        $this->addSql('ALTER TABLE `like` DROP id, CHANGE user_id user_id INT NOT NULL, CHANGE post_id post_id INT NOT NULL');
        $this->addSql('ALTER TABLE `like` ADD PRIMARY KEY (user_id, post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `like` ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE post_id post_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}

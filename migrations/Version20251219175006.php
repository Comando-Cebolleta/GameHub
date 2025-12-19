<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219175006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702E85F12B8');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7029D86650F');
        $this->addSql('DROP INDEX IDX_4B91E7029D86650F ON comentario');
        $this->addSql('DROP INDEX IDX_4B91E702E85F12B8 ON comentario');
        $this->addSql('ALTER TABLE comentario ADD post_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP post_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7024B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4B91E7024B89032C ON comentario (post_id)');
        $this->addSql('CREATE INDEX IDX_4B91E702A76ED395 ON comentario (user_id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D9D86650F');
        $this->addSql('DROP INDEX IDX_5A8A6C8D9D86650F ON post');
        $this->addSql('ALTER TABLE post CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
        $this->addSql('ALTER TABLE user CHANGE foto_perfil foto_perfil VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7024B89032C');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702A76ED395');
        $this->addSql('DROP INDEX IDX_4B91E7024B89032C ON comentario');
        $this->addSql('DROP INDEX IDX_4B91E702A76ED395 ON comentario');
        $this->addSql('ALTER TABLE comentario ADD post_id_id INT DEFAULT NULL, ADD user_id_id INT DEFAULT NULL, DROP post_id, DROP user_id');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702E85F12B8 FOREIGN KEY (post_id_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7029D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4B91E7029D86650F ON comentario (user_id_id)');
        $this->addSql('CREATE INDEX IDX_4B91E702E85F12B8 ON comentario (post_id_id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA76ED395 ON post');
        $this->addSql('ALTER TABLE post CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D9D86650F ON post (user_id_id)');
        $this->addSql('ALTER TABLE user CHANGE foto_perfil foto_perfil VARCHAR(255) NOT NULL');
    }
}

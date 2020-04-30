<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430183917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tipos DROP FOREIGN KEY FK_F3C63625AA5E6DA1');
        $this->addSql('DROP INDEX IDX_F3C63625AA5E6DA1 ON tipos');
        $this->addSql('ALTER TABLE tipos DROP partes_interesadas_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tipos ADD partes_interesadas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tipos ADD CONSTRAINT FK_F3C63625AA5E6DA1 FOREIGN KEY (partes_interesadas_id) REFERENCES partes_interesadas (id)');
        $this->addSql('CREATE INDEX IDX_F3C63625AA5E6DA1 ON tipos (partes_interesadas_id)');
    }
}

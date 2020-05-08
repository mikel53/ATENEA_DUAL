<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507171549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB9DB38439E');
        $this->addSql('DROP INDEX IDX_A031EEB9DB38439E ON usuario_rol_gestion');
        $this->addSql('ALTER TABLE usuario_rol_gestion DROP usuario_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB9DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('CREATE INDEX IDX_A031EEB9DB38439E ON usuario_rol_gestion (usuario_id)');
    }
}

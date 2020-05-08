<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505161748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion ADD usuarios_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB9F01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id)');
        $this->addSql('CREATE INDEX IDX_A031EEB9F01D3B25 ON usuario_rol_gestion (usuarios_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB9F01D3B25');
        $this->addSql('DROP INDEX IDX_A031EEB9F01D3B25 ON usuario_rol_gestion');
        $this->addSql('ALTER TABLE usuario_rol_gestion DROP usuarios_id');
    }
}

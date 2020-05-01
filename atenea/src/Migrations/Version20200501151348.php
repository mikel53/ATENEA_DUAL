<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501151348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE permisos (id INT AUTO_INCREMENT NOT NULL, tipos VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_rol_gestion (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, permiso_id INT DEFAULT NULL, unidad_gestion_id INT DEFAULT NULL, INDEX IDX_A031EEB9DB38439E (usuario_id), INDEX IDX_A031EEB96CEFAD37 (permiso_id), INDEX IDX_A031EEB99B2B1C2B (unidad_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB9DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB96CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permisos (id)');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB99B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB96CEFAD37');
        $this->addSql('DROP TABLE permisos');
        $this->addSql('DROP TABLE usuario_rol_gestion');
    }
}

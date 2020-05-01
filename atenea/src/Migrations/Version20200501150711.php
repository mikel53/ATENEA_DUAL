<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501150711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE unidad_gestion_usuarios');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE unidad_gestion_usuarios (unidad_gestion_id INT NOT NULL, usuarios_id INT NOT NULL, INDEX IDX_2445DA069B2B1C2B (unidad_gestion_id), INDEX IDX_2445DA06F01D3B25 (usuarios_id), PRIMARY KEY(unidad_gestion_id, usuarios_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE unidad_gestion_usuarios ADD CONSTRAINT FK_2445DA069B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unidad_gestion_usuarios ADD CONSTRAINT FK_2445DA06F01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id) ON DELETE CASCADE');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430182838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE unidad_gestion (id INT AUTO_INCREMENT NOT NULL, contratos_id INT DEFAULT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE NOT NULL, nombre VARCHAR(255) NOT NULL, coo_em_empl VARCHAR(255) NOT NULL, INDEX IDX_EE5615602DBBD1D4 (contratos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidad_gestion_usuarios (unidad_gestion_id INT NOT NULL, usuarios_id INT NOT NULL, INDEX IDX_2445DA069B2B1C2B (unidad_gestion_id), INDEX IDX_2445DA06F01D3B25 (usuarios_id), PRIMARY KEY(unidad_gestion_id, usuarios_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expectativa (id INT AUTO_INCREMENT NOT NULL, partes_interesadas_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_A9062C78AA5E6DA1 (partes_interesadas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partes_interesadas (id INT AUTO_INCREMENT NOT NULL, unidad_gestion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_FA9836F89B2B1C2B (unidad_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unidad_gestion ADD CONSTRAINT FK_EE5615602DBBD1D4 FOREIGN KEY (contratos_id) REFERENCES contratos (id)');
        $this->addSql('ALTER TABLE unidad_gestion_usuarios ADD CONSTRAINT FK_2445DA069B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unidad_gestion_usuarios ADD CONSTRAINT FK_2445DA06F01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expectativa ADD CONSTRAINT FK_A9062C78AA5E6DA1 FOREIGN KEY (partes_interesadas_id) REFERENCES partes_interesadas (id)');
        $this->addSql('ALTER TABLE partes_interesadas ADD CONSTRAINT FK_FA9836F89B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id)');
        $this->addSql('ALTER TABLE tipos ADD partes_interesadas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tipos ADD CONSTRAINT FK_F3C63625AA5E6DA1 FOREIGN KEY (partes_interesadas_id) REFERENCES partes_interesadas (id)');
        $this->addSql('CREATE INDEX IDX_F3C63625AA5E6DA1 ON tipos (partes_interesadas_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE unidad_gestion_usuarios DROP FOREIGN KEY FK_2445DA069B2B1C2B');
        $this->addSql('ALTER TABLE partes_interesadas DROP FOREIGN KEY FK_FA9836F89B2B1C2B');
        $this->addSql('ALTER TABLE expectativa DROP FOREIGN KEY FK_A9062C78AA5E6DA1');
        $this->addSql('ALTER TABLE tipos DROP FOREIGN KEY FK_F3C63625AA5E6DA1');
        $this->addSql('DROP TABLE unidad_gestion');
        $this->addSql('DROP TABLE unidad_gestion_usuarios');
        $this->addSql('DROP TABLE expectativa');
        $this->addSql('DROP TABLE partes_interesadas');
        $this->addSql('DROP INDEX IDX_F3C63625AA5E6DA1 ON tipos');
        $this->addSql('ALTER TABLE tipos DROP partes_interesadas_id');
    }
}

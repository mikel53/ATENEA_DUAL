<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430181816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE factores_riesgo (id INT AUTO_INCREMENT NOT NULL, fecha_alta DATE NOT NULL, decha_baja DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspectos (id INT AUTO_INCREMENT NOT NULL, favorable TINYINT(1) NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspectos_cuestiones (aspectos_id INT NOT NULL, cuestiones_id INT NOT NULL, INDEX IDX_62C1DBFA5E0E41E6 (aspectos_id), INDEX IDX_62C1DBFAA0EA9215 (cuestiones_id), PRIMARY KEY(aspectos_id, cuestiones_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contratos (id INT AUTO_INCREMENT NOT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspectos_cuestiones ADD CONSTRAINT FK_62C1DBFA5E0E41E6 FOREIGN KEY (aspectos_id) REFERENCES aspectos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspectos_cuestiones ADD CONSTRAINT FK_62C1DBFAA0EA9215 FOREIGN KEY (cuestiones_id) REFERENCES cuestiones (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspectos_cuestiones DROP FOREIGN KEY FK_62C1DBFA5E0E41E6');
        $this->addSql('DROP TABLE factores_riesgo');
        $this->addSql('DROP TABLE aspectos');
        $this->addSql('DROP TABLE aspectos_cuestiones');
        $this->addSql('DROP TABLE contratos');
    }
}

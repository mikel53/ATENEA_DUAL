<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430173607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipos (id INT AUTO_INCREMENT NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subtipos (id INT AUTO_INCREMENT NOT NULL, tipos_id INT DEFAULT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_8975D9FFA3DCB738 (tipos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cuestiones (id INT AUTO_INCREMENT NOT NULL, subtipos_id INT DEFAULT NULL, ineterno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_D2FED106A84C0AB1 (subtipos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subtipos ADD CONSTRAINT FK_8975D9FFA3DCB738 FOREIGN KEY (tipos_id) REFERENCES tipos (id)');
        $this->addSql('ALTER TABLE cuestiones ADD CONSTRAINT FK_D2FED106A84C0AB1 FOREIGN KEY (subtipos_id) REFERENCES subtipos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subtipos DROP FOREIGN KEY FK_8975D9FFA3DCB738');
        $this->addSql('ALTER TABLE cuestiones DROP FOREIGN KEY FK_D2FED106A84C0AB1');
        $this->addSql('DROP TABLE tipos');
        $this->addSql('DROP TABLE subtipos');
        $this->addSql('DROP TABLE cuestiones');
    }
}

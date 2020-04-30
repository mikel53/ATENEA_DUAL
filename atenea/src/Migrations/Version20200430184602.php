<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430184602 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cuestiones_unidad_gestion (cuestiones_id INT NOT NULL, unidad_gestion_id INT NOT NULL, INDEX IDX_795DA744A0EA9215 (cuestiones_id), INDEX IDX_795DA7449B2B1C2B (unidad_gestion_id), PRIMARY KEY(cuestiones_id, unidad_gestion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion ADD CONSTRAINT FK_795DA744A0EA9215 FOREIGN KEY (cuestiones_id) REFERENCES cuestiones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion ADD CONSTRAINT FK_795DA7449B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cuestiones_unidad_gestion');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430182008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE factores_riesgo_aspectos (factores_riesgo_id INT NOT NULL, aspectos_id INT NOT NULL, INDEX IDX_C9F89600ED17BD94 (factores_riesgo_id), INDEX IDX_C9F896005E0E41E6 (aspectos_id), PRIMARY KEY(factores_riesgo_id, aspectos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos ADD CONSTRAINT FK_C9F89600ED17BD94 FOREIGN KEY (factores_riesgo_id) REFERENCES factores_riesgo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos ADD CONSTRAINT FK_C9F896005E0E41E6 FOREIGN KEY (aspectos_id) REFERENCES aspectos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE factores_riesgo_aspectos');
    }
}

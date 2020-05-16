<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200508104223 extends AbstractMigration
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
        $this->addSql('CREATE TABLE subtipos (id INT AUTO_INCREMENT NOT NULL, tipos_id INT DEFAULT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_8975D9FFA3DCB738 (tipos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cuestiones (id INT AUTO_INCREMENT NOT NULL, subtipos_id INT DEFAULT NULL, ineterno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_D2FED106A84C0AB1 (subtipos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cuestiones_unidad_gestion (cuestiones_id INT NOT NULL, unidad_gestion_id INT NOT NULL, INDEX IDX_795DA744A0EA9215 (cuestiones_id), INDEX IDX_795DA7449B2B1C2B (unidad_gestion_id), PRIMARY KEY(cuestiones_id, unidad_gestion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, telefono INT NOT NULL, mail VARCHAR(255) NOT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factores_riesgo (id INT AUTO_INCREMENT NOT NULL, fecha_alta DATE NOT NULL, decha_baja DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factores_riesgo_aspectos (factores_riesgo_id INT NOT NULL, aspectos_id INT NOT NULL, INDEX IDX_C9F89600ED17BD94 (factores_riesgo_id), INDEX IDX_C9F896005E0E41E6 (aspectos_id), PRIMARY KEY(factores_riesgo_id, aspectos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_rol_gestion (id INT AUTO_INCREMENT NOT NULL, permiso_id INT DEFAULT NULL, unidad_gestion_id INT DEFAULT NULL, usuarios_id INT DEFAULT NULL, INDEX IDX_A031EEB96CEFAD37 (permiso_id), INDEX IDX_A031EEB99B2B1C2B (unidad_gestion_id), INDEX IDX_A031EEB9F01D3B25 (usuarios_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspectos (id INT AUTO_INCREMENT NOT NULL, favorable TINYINT(1) NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspectos_cuestiones (aspectos_id INT NOT NULL, cuestiones_id INT NOT NULL, INDEX IDX_62C1DBFA5E0E41E6 (aspectos_id), INDEX IDX_62C1DBFAA0EA9215 (cuestiones_id), PRIMARY KEY(aspectos_id, cuestiones_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expectativa (id INT AUTO_INCREMENT NOT NULL, partes_interesadas_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_A9062C78AA5E6DA1 (partes_interesadas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contratos (id INT AUTO_INCREMENT NOT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partes_interesadas (id INT AUTO_INCREMENT NOT NULL, unidad_gestion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_FA9836F89B2B1C2B (unidad_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidad_gestion (id INT AUTO_INCREMENT NOT NULL, contratos_id INT DEFAULT NULL, unidad_gestion_id INT DEFAULT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE NOT NULL, nombre VARCHAR(255) NOT NULL, coo_em_empl VARCHAR(255) NOT NULL, INDEX IDX_EE5615602DBBD1D4 (contratos_id), INDEX IDX_EE5615609B2B1C2B (unidad_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipos (id INT AUTO_INCREMENT NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subtipos ADD CONSTRAINT FK_8975D9FFA3DCB738 FOREIGN KEY (tipos_id) REFERENCES tipos (id)');
        $this->addSql('ALTER TABLE cuestiones ADD CONSTRAINT FK_D2FED106A84C0AB1 FOREIGN KEY (subtipos_id) REFERENCES subtipos (id)');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion ADD CONSTRAINT FK_795DA744A0EA9215 FOREIGN KEY (cuestiones_id) REFERENCES cuestiones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion ADD CONSTRAINT FK_795DA7449B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos ADD CONSTRAINT FK_C9F89600ED17BD94 FOREIGN KEY (factores_riesgo_id) REFERENCES factores_riesgo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos ADD CONSTRAINT FK_C9F896005E0E41E6 FOREIGN KEY (aspectos_id) REFERENCES aspectos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB96CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permisos (id)');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB99B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id)');
        $this->addSql('ALTER TABLE usuario_rol_gestion ADD CONSTRAINT FK_A031EEB9F01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE aspectos_cuestiones ADD CONSTRAINT FK_62C1DBFA5E0E41E6 FOREIGN KEY (aspectos_id) REFERENCES aspectos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspectos_cuestiones ADD CONSTRAINT FK_62C1DBFAA0EA9215 FOREIGN KEY (cuestiones_id) REFERENCES cuestiones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expectativa ADD CONSTRAINT FK_A9062C78AA5E6DA1 FOREIGN KEY (partes_interesadas_id) REFERENCES partes_interesadas (id)');
        $this->addSql('ALTER TABLE partes_interesadas ADD CONSTRAINT FK_FA9836F89B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id)');
        $this->addSql('ALTER TABLE unidad_gestion ADD CONSTRAINT FK_EE5615602DBBD1D4 FOREIGN KEY (contratos_id) REFERENCES contratos (id)');
        $this->addSql('ALTER TABLE unidad_gestion ADD CONSTRAINT FK_EE5615609B2B1C2B FOREIGN KEY (unidad_gestion_id) REFERENCES unidad_gestion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB96CEFAD37');
        $this->addSql('ALTER TABLE cuestiones DROP FOREIGN KEY FK_D2FED106A84C0AB1');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion DROP FOREIGN KEY FK_795DA744A0EA9215');
        $this->addSql('ALTER TABLE aspectos_cuestiones DROP FOREIGN KEY FK_62C1DBFAA0EA9215');
        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB9F01D3B25');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos DROP FOREIGN KEY FK_C9F89600ED17BD94');
        $this->addSql('ALTER TABLE factores_riesgo_aspectos DROP FOREIGN KEY FK_C9F896005E0E41E6');
        $this->addSql('ALTER TABLE aspectos_cuestiones DROP FOREIGN KEY FK_62C1DBFA5E0E41E6');
        $this->addSql('ALTER TABLE unidad_gestion DROP FOREIGN KEY FK_EE5615602DBBD1D4');
        $this->addSql('ALTER TABLE expectativa DROP FOREIGN KEY FK_A9062C78AA5E6DA1');
        $this->addSql('ALTER TABLE cuestiones_unidad_gestion DROP FOREIGN KEY FK_795DA7449B2B1C2B');
        $this->addSql('ALTER TABLE usuario_rol_gestion DROP FOREIGN KEY FK_A031EEB99B2B1C2B');
        $this->addSql('ALTER TABLE partes_interesadas DROP FOREIGN KEY FK_FA9836F89B2B1C2B');
        $this->addSql('ALTER TABLE unidad_gestion DROP FOREIGN KEY FK_EE5615609B2B1C2B');
        $this->addSql('ALTER TABLE subtipos DROP FOREIGN KEY FK_8975D9FFA3DCB738');
        $this->addSql('DROP TABLE permisos');
        $this->addSql('DROP TABLE subtipos');
        $this->addSql('DROP TABLE cuestiones');
        $this->addSql('DROP TABLE cuestiones_unidad_gestion');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('DROP TABLE factores_riesgo');
        $this->addSql('DROP TABLE factores_riesgo_aspectos');
        $this->addSql('DROP TABLE usuario_rol_gestion');
        $this->addSql('DROP TABLE aspectos');
        $this->addSql('DROP TABLE aspectos_cuestiones');
        $this->addSql('DROP TABLE expectativa');
        $this->addSql('DROP TABLE contratos');
        $this->addSql('DROP TABLE partes_interesadas');
        $this->addSql('DROP TABLE unidad_gestion');
        $this->addSql('DROP TABLE tipos');
    }
}

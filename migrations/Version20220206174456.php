<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206174456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coche (id INT AUTO_INCREMENT NOT NULL, marca_id INT NOT NULL, oficina_id INT NOT NULL, matricula VARCHAR(255) NOT NULL, modelo VARCHAR(100) NOT NULL, npuertas INT NOT NULL, cambio VARCHAR(40) NOT NULL, cv INT NOT NULL, precio INT NOT NULL, tipo VARCHAR(100) NOT NULL, color VARCHAR(50) NOT NULL, INDEX IDX_A1981CD481EF0041 (marca_id), INDEX IDX_A1981CD48A8639B7 (oficina_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD481EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD48A8639B7 FOREIGN KEY (oficina_id) REFERENCES oficina (id)');
        $this->addSql('ALTER TABLE fotos ADD coche_id INT NOT NULL');
        $this->addSql('ALTER TABLE fotos ADD CONSTRAINT FK_CB8405C7F4621E56 FOREIGN KEY (coche_id) REFERENCES coche (id)');
        $this->addSql('CREATE INDEX IDX_CB8405C7F4621E56 ON fotos (coche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fotos DROP FOREIGN KEY FK_CB8405C7F4621E56');
        $this->addSql('DROP TABLE coche');
        $this->addSql('DROP INDEX IDX_CB8405C7F4621E56 ON fotos');
        $this->addSql('ALTER TABLE fotos DROP coche_id, CHANGE foto foto VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE marca CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE oficina CHANGE descripcion descripcion VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provincia CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

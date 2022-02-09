<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208193433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, coche_id INT NOT NULL, oficinadevolucion_id INT NOT NULL, oficina_recogida_id INT NOT NULL, fechaini DATETIME NOT NULL, fechafin DATETIME NOT NULL, precio_total INT NOT NULL, INDEX IDX_188D2E3BDB38439E (usuario_id), INDEX IDX_188D2E3BF4621E56 (coche_id), INDEX IDX_188D2E3B15151384 (oficinadevolucion_id), INDEX IDX_188D2E3B1D914F2D (oficina_recogida_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BF4621E56 FOREIGN KEY (coche_id) REFERENCES coche (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B15151384 FOREIGN KEY (oficinadevolucion_id) REFERENCES oficina (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B1D914F2D FOREIGN KEY (oficina_recogida_id) REFERENCES oficina (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reserva');
        $this->addSql('ALTER TABLE coche CHANGE matricula matricula VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE modelo modelo VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cambio cambio VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo tipo VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fotos CHANGE foto foto VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE marca CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE oficina CHANGE descripcion descripcion VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provincia CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dni dni VARCHAR(9) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telefono telefono VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

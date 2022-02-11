<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210094631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario DROP fechanac, CHANGE password password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coche CHANGE matricula matricula VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE modelo modelo VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cambio cambio VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo tipo VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fotos CHANGE foto foto VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE marca CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE oficina CHANGE descripcion descripcion VARCHAR(200) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE provincia CHANGE nombre nombre VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario ADD fechanac DATE NOT NULL, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dni dni VARCHAR(9) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telefono telefono VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

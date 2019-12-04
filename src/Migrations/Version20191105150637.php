<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105150637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car_rent (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, mark VARCHAR(255) NOT NULL, kilometer INT NOT NULL, availability TINYINT(1) NOT NULL, prix_day DOUBLE PRECISION NOT NULL, INDEX IDX_C91259607E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accommodation (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, description VARCHAR(255) NOT NULL, capacity INT NOT NULL, beds INT NOT NULL, baths INT NOT NULL, availability TINYINT(1) NOT NULL, prix_night DOUBLE PRECISION NOT NULL, address VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_2D3854127E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxi (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, registration_number VARCHAR(255) NOT NULL, taxi_number INT NOT NULL, mark VARCHAR(255) NOT NULL, on_service TINYINT(1) NOT NULL, INDEX IDX_5F8463C27E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_rent ADD CONSTRAINT FK_C91259607E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE accommodation ADD CONSTRAINT FK_2D3854127E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE taxi ADD CONSTRAINT FK_5F8463C27E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_rent DROP FOREIGN KEY FK_C91259607E3C61F9');
        $this->addSql('ALTER TABLE accommodation DROP FOREIGN KEY FK_2D3854127E3C61F9');
        $this->addSql('ALTER TABLE taxi DROP FOREIGN KEY FK_5F8463C27E3C61F9');
        $this->addSql('DROP TABLE car_rent');
        $this->addSql('DROP TABLE accommodation');
        $this->addSql('DROP TABLE taxi');
        $this->addSql('DROP TABLE owner');
    }
}

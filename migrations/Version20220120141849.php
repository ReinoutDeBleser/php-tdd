<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120141849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bookings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bookings (id INT NOT NULL, roomrelation_id INT DEFAULT NULL, user_relation_id INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7A853C3565EF113F ON bookings (roomrelation_id)');
        $this->addSql('CREATE INDEX IDX_7A853C359B4D58CE ON bookings (user_relation_id)');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, name VARCHAR(255) NOT NULL, only_for_premium_members BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, credit INT NOT NULL, premium_member BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C3565EF113F FOREIGN KEY (roomrelation_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C359B4D58CE FOREIGN KEY (user_relation_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bookings DROP CONSTRAINT FK_7A853C3565EF113F');
        $this->addSql('ALTER TABLE bookings DROP CONSTRAINT FK_7A853C359B4D58CE');
        $this->addSql('DROP SEQUENCE bookings_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE "user"');
    }
}

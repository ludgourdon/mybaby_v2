<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017191954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE baby_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE family_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE photo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sentence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE baby (id INT NOT NULL, user_id INT DEFAULT NULL, last_name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, nick_name VARCHAR(50) DEFAULT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, birth_place VARCHAR(50) DEFAULT NULL, sex VARCHAR(1) DEFAULT NULL, birth_hour TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, birth_height NUMERIC(3, 2) DEFAULT NULL, birth_weight NUMERIC(4, 3) DEFAULT NULL, first_step_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, baptism_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, hair_color VARCHAR(50) DEFAULT NULL, second_name VARCHAR(50) DEFAULT NULL, third_name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_876C813EA76ED395 ON baby (user_id)');
        $this->addSql('CREATE TABLE baby_family (baby_id INT NOT NULL, family_id INT NOT NULL, PRIMARY KEY(baby_id, family_id))');
        $this->addSql('CREATE INDEX IDX_5D29CB642E288954 ON baby_family (baby_id)');
        $this->addSql('CREATE INDEX IDX_5D29CB64C35E566A ON baby_family (family_id)');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, baby_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BAE0AA72E288954 ON event (baby_id)');
        $this->addSql('CREATE TABLE family (id INT NOT NULL, user_id INT DEFAULT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, birthdate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, birthplace VARCHAR(50) DEFAULT NULL, role VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215BA76ED395 ON family (user_id)');
        $this->addSql('CREATE TABLE pet (id INT NOT NULL, name VARCHAR(50) NOT NULL, birthDate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, breed VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE photo (id INT NOT NULL, event_id INT DEFAULT NULL, family_id INT DEFAULT NULL, baby_id INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, image_size INT NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, profile_picture BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14B78418B548B0F ON photo (path)');
        $this->addSql('CREATE INDEX IDX_14B7841871F7E88B ON photo (event_id)');
        $this->addSql('CREATE INDEX IDX_14B78418C35E566A ON photo (family_id)');
        $this->addSql('CREATE INDEX IDX_14B784182E288954 ON photo (baby_id)');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, family_member_id INT DEFAULT NULL, baby_id INT DEFAULT NULL, sentence VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D664ED5BC594993 ON sentence (family_member_id)');
        $this->addSql('CREATE INDEX IDX_9D664ED52E288954 ON sentence (baby_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE baby ADD CONSTRAINT FK_876C813EA76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE baby_family ADD CONSTRAINT FK_5D29CB642E288954 FOREIGN KEY (baby_id) REFERENCES baby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE baby_family ADD CONSTRAINT FK_5D29CB64C35E566A FOREIGN KEY (family_id) REFERENCES family (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA72E288954 FOREIGN KEY (baby_id) REFERENCES baby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BA76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841871F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418C35E566A FOREIGN KEY (family_id) REFERENCES family (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784182E288954 FOREIGN KEY (baby_id) REFERENCES baby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED5BC594993 FOREIGN KEY (family_member_id) REFERENCES family (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED52E288954 FOREIGN KEY (baby_id) REFERENCES baby (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE baby_family DROP CONSTRAINT FK_5D29CB642E288954');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA72E288954');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B784182E288954');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED52E288954');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B7841871F7E88B');
        $this->addSql('ALTER TABLE baby_family DROP CONSTRAINT FK_5D29CB64C35E566A');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B78418C35E566A');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED5BC594993');
        $this->addSql('ALTER TABLE baby DROP CONSTRAINT FK_876C813EA76ED395');
        $this->addSql('ALTER TABLE family DROP CONSTRAINT FK_A5E6215BA76ED395');
        $this->addSql('DROP SEQUENCE baby_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE family_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE photo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sentence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP TABLE baby');
        $this->addSql('DROP TABLE baby_family');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE sentence');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE account');
    }
}

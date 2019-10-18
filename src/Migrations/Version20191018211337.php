<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191018211337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX idx_876c813ea76ed395');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_876C813EC808BA5A ON baby (last_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_876C813EA9D1C132 ON baby (first_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_876C813EA76ED395 ON baby (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_876C813EC808BA5A');
        $this->addSql('DROP INDEX UNIQ_876C813EA9D1C132');
        $this->addSql('DROP INDEX UNIQ_876C813EA76ED395');
        $this->addSql('CREATE INDEX idx_876c813ea76ed395 ON baby (user_id)');
    }
}

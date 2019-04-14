<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190414221119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE permission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE module_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE permission (id INT NOT NULL, username_id INT NOT NULL, module_id INT NOT NULL, criar BOOLEAN NOT NULL, ler BOOLEAN NOT NULL, editar BOOLEAN NOT NULL, apagar BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E04992AAED766068 ON permission (username_id)');
        $this->addSql('CREATE INDEX IDX_E04992AAAFC2B591 ON permission (module_id)');
        $this->addSql('CREATE TABLE module (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AAED766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE permission DROP CONSTRAINT FK_E04992AAAFC2B591');
        $this->addSql('DROP SEQUENCE permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE module_id_seq CASCADE');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE module');
    }
}

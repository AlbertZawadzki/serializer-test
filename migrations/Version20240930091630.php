<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240930091630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_677D8034727ACA70 FOREIGN KEY (parent_id) REFERENCES parent_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_677D8034727ACA70 ON child_entity (parent_id)');
        $this->addSql('CREATE TABLE parent_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO parent_entity VALUES (1)');
        $this->addSql('INSERT INTO child_entity VALUES (1 , 1, "invisible")');
        $this->addSql('INSERT INTO child_entity VALUES (2 , 1, "visible")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE child_entity');
        $this->addSql('DROP TABLE parent_entity');
    }
}

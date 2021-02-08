<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208113404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE species ADD COLUMN description CLOB DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, genus, species, common_name, file_path, quizz FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genus VARCHAR(60) NOT NULL, species VARCHAR(60) NOT NULL, common_name VARCHAR(100) NOT NULL, file_path VARCHAR(255) NOT NULL, quizz INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO species (id, genus, species, common_name, file_path, quizz) SELECT id, genus, species, common_name, file_path, quizz FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
    }
}

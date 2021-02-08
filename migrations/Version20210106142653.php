<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106142653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE species ADD COLUMN quizz INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, genus, species, common_name, file_path FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genus VARCHAR(60) NOT NULL, species VARCHAR(60) NOT NULL, common_name VARCHAR(100) NOT NULL, file_path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO species (id, genus, species, common_name, file_path) SELECT id, genus, species, common_name, file_path FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
    }
}

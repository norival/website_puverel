<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212110759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genus VARCHAR(60) NOT NULL, species VARCHAR(60) NOT NULL, common_name VARCHAR(100) NOT NULL, file_path VARCHAR(255) NOT NULL)');
        $this->addSql('DROP TABLE quizz_feuillus');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz_feuillus (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, n_species INTEGER NOT NULL, species_list CLOB NOT NULL COLLATE BINARY --(DC2Type:array)
        , score INTEGER NOT NULL, current_species SMALLINT NOT NULL, history CLOB NOT NULL COLLATE BINARY --(DC2Type:simple_array)
        )');
        $this->addSql('DROP TABLE species');
    }
}

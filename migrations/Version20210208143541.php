<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208143541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz ADD COLUMN choices CLOB DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__quizz AS SELECT id, n_species, species_list, n_turns, current_turn, score FROM quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('CREATE TABLE quizz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, n_species INTEGER NOT NULL, species_list CLOB NOT NULL --(DC2Type:array)
        , n_turns INTEGER NOT NULL, current_turn INTEGER NOT NULL, score INTEGER NOT NULL)');
        $this->addSql('INSERT INTO quizz (id, n_species, species_list, n_turns, current_turn, score) SELECT id, n_species, species_list, n_turns, current_turn, score FROM __temp__quizz');
        $this->addSql('DROP TABLE __temp__quizz');
    }
}

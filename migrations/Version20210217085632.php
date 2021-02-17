<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217085632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu AS SELECT id, name FROM menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('CREATE TABLE menu (id CHAR(36) NOT NULL --(DC2Type:guid)
        , name VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO menu (id, name) SELECT id, name FROM __temp__menu');
        $this->addSql('DROP TABLE __temp__menu');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item AS SELECT id, path FROM menu_item');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('CREATE TABLE menu_item (id CHAR(36) NOT NULL --(DC2Type:guid)
        , path VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO menu_item (id, path) SELECT id, path FROM __temp__menu_item');
        $this->addSql('DROP TABLE __temp__menu_item');
        $this->addSql('DROP INDEX IDX_AC75195CCCD7E912');
        $this->addSql('DROP INDEX IDX_AC75195C9AB44FE0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item_menu AS SELECT menu_item_id, menu_id FROM menu_item_menu');
        $this->addSql('DROP TABLE menu_item_menu');
        $this->addSql('CREATE TABLE menu_item_menu (menu_item_id CHAR(36) NOT NULL --(DC2Type:guid)
        , menu_id CHAR(36) NOT NULL --(DC2Type:guid)
        , PRIMARY KEY(menu_item_id, menu_id), CONSTRAINT FK_AC75195C9AB44FE0 FOREIGN KEY (menu_item_id) REFERENCES menu_item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC75195CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO menu_item_menu (menu_item_id, menu_id) SELECT menu_item_id, menu_id FROM __temp__menu_item_menu');
        $this->addSql('DROP TABLE __temp__menu_item_menu');
        $this->addSql('CREATE INDEX IDX_AC75195CCCD7E912 ON menu_item_menu (menu_id)');
        $this->addSql('CREATE INDEX IDX_AC75195C9AB44FE0 ON menu_item_menu (menu_item_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quizz AS SELECT id, n_species, species_list, n_turns, current_turn, score, choices, state FROM quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('CREATE TABLE quizz (id CHAR(36) NOT NULL --(DC2Type:guid)
        , n_species INTEGER NOT NULL, species_list CLOB NOT NULL COLLATE BINARY --(DC2Type:array)
        , n_turns INTEGER NOT NULL, current_turn INTEGER NOT NULL, score INTEGER NOT NULL, choices CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:array)
        , state SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO quizz (id, n_species, species_list, n_turns, current_turn, score, choices, state) SELECT id, n_species, species_list, n_turns, current_turn, score, choices, state FROM __temp__quizz');
        $this->addSql('DROP TABLE __temp__quizz');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, genus, species, common_name, file_path, quizz, description FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id CHAR(36) NOT NULL --(DC2Type:guid)
        , genus VARCHAR(60) NOT NULL COLLATE BINARY, species VARCHAR(60) NOT NULL COLLATE BINARY, common_name VARCHAR(100) NOT NULL COLLATE BINARY, file_path VARCHAR(255) NOT NULL COLLATE BINARY, quizz INTEGER DEFAULT NULL, description CLOB DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO species (id, genus, species, common_name, file_path, quizz, description) SELECT id, genus, species, common_name, file_path, quizz, description FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu AS SELECT id, name FROM menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('CREATE TABLE menu (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO menu (id, name) SELECT id, name FROM __temp__menu');
        $this->addSql('DROP TABLE __temp__menu');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item AS SELECT id, path FROM menu_item');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('CREATE TABLE menu_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO menu_item (id, path) SELECT id, path FROM __temp__menu_item');
        $this->addSql('DROP TABLE __temp__menu_item');
        $this->addSql('DROP INDEX IDX_AC75195C9AB44FE0');
        $this->addSql('DROP INDEX IDX_AC75195CCCD7E912');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item_menu AS SELECT menu_item_id, menu_id FROM menu_item_menu');
        $this->addSql('DROP TABLE menu_item_menu');
        $this->addSql('CREATE TABLE menu_item_menu (menu_item_id INTEGER NOT NULL, menu_id INTEGER NOT NULL, PRIMARY KEY(menu_item_id, menu_id))');
        $this->addSql('INSERT INTO menu_item_menu (menu_item_id, menu_id) SELECT menu_item_id, menu_id FROM __temp__menu_item_menu');
        $this->addSql('DROP TABLE __temp__menu_item_menu');
        $this->addSql('CREATE INDEX IDX_AC75195C9AB44FE0 ON menu_item_menu (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_AC75195CCCD7E912 ON menu_item_menu (menu_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quizz AS SELECT id, n_species, species_list, n_turns, current_turn, score, choices, state FROM quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('CREATE TABLE quizz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, n_species INTEGER NOT NULL, species_list CLOB NOT NULL --(DC2Type:array)
        , n_turns INTEGER NOT NULL, current_turn INTEGER NOT NULL, score INTEGER NOT NULL, choices CLOB DEFAULT NULL --(DC2Type:array)
        , state SMALLINT DEFAULT NULL)');
        $this->addSql('INSERT INTO quizz (id, n_species, species_list, n_turns, current_turn, score, choices, state) SELECT id, n_species, species_list, n_turns, current_turn, score, choices, state FROM __temp__quizz');
        $this->addSql('DROP TABLE __temp__quizz');
        $this->addSql('CREATE TEMPORARY TABLE __temp__species AS SELECT id, genus, species, common_name, file_path, quizz, description FROM species');
        $this->addSql('DROP TABLE species');
        $this->addSql('CREATE TABLE species (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genus VARCHAR(60) NOT NULL, species VARCHAR(60) NOT NULL, common_name VARCHAR(100) NOT NULL, file_path VARCHAR(255) NOT NULL, quizz INTEGER DEFAULT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO species (id, genus, species, common_name, file_path, quizz, description) SELECT id, genus, species, common_name, file_path, quizz, description FROM __temp__species');
        $this->addSql('DROP TABLE __temp__species');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217092003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_item ADD COLUMN name VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_AC75195C9AB44FE0');
        $this->addSql('DROP INDEX IDX_AC75195CCCD7E912');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item_menu AS SELECT menu_item_id, menu_id FROM menu_item_menu');
        $this->addSql('DROP TABLE menu_item_menu');
        $this->addSql('CREATE TABLE menu_item_menu (menu_item_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        , menu_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:guid)
        , PRIMARY KEY(menu_item_id, menu_id), CONSTRAINT FK_AC75195C9AB44FE0 FOREIGN KEY (menu_item_id) REFERENCES menu_item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC75195CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO menu_item_menu (menu_item_id, menu_id) SELECT menu_item_id, menu_id FROM __temp__menu_item_menu');
        $this->addSql('DROP TABLE __temp__menu_item_menu');
        $this->addSql('CREATE INDEX IDX_AC75195C9AB44FE0 ON menu_item_menu (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_AC75195CCCD7E912 ON menu_item_menu (menu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item AS SELECT id, path FROM menu_item');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('CREATE TABLE menu_item (id CHAR(36) NOT NULL --(DC2Type:guid)
        , path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO menu_item (id, path) SELECT id, path FROM __temp__menu_item');
        $this->addSql('DROP TABLE __temp__menu_item');
        $this->addSql('DROP INDEX IDX_AC75195C9AB44FE0');
        $this->addSql('DROP INDEX IDX_AC75195CCCD7E912');
        $this->addSql('CREATE TEMPORARY TABLE __temp__menu_item_menu AS SELECT menu_item_id, menu_id FROM menu_item_menu');
        $this->addSql('DROP TABLE menu_item_menu');
        $this->addSql('CREATE TABLE menu_item_menu (menu_item_id CHAR(36) NOT NULL --(DC2Type:guid)
        , menu_id CHAR(36) NOT NULL --(DC2Type:guid)
        , PRIMARY KEY(menu_item_id, menu_id))');
        $this->addSql('INSERT INTO menu_item_menu (menu_item_id, menu_id) SELECT menu_item_id, menu_id FROM __temp__menu_item_menu');
        $this->addSql('DROP TABLE __temp__menu_item_menu');
        $this->addSql('CREATE INDEX IDX_AC75195C9AB44FE0 ON menu_item_menu (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_AC75195CCCD7E912 ON menu_item_menu (menu_id)');
    }
}

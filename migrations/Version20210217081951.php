<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217081951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE menu_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE menu_item_menu (menu_item_id INTEGER NOT NULL, menu_id INTEGER NOT NULL, PRIMARY KEY(menu_item_id, menu_id))');
        $this->addSql('CREATE INDEX IDX_AC75195C9AB44FE0 ON menu_item_menu (menu_item_id)');
        $this->addSql('CREATE INDEX IDX_AC75195CCCD7E912 ON menu_item_menu (menu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('DROP TABLE menu_item_menu');
    }
}

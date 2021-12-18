<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215212022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE link_keyword_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql(
            'CREATE TABLE click (id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, short_url VARCHAR(200) NOT NULL, referrer VARCHAR(200) NOT NULL, user_agent VARCHAR(255) NOT NULL, ip VARCHAR(41) NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN click.id IS \'(DC2Type:uuid)\'');
        $this->addSql(
            'CREATE TABLE link (keyword VARCHAR(200) NOT NULL, url VARCHAR(65535) NOT NULL, title VARCHAR(65535) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ip VARCHAR(41) NOT NULL, tags TEXT NOT NULL, clicks INT NOT NULL, PRIMARY KEY(keyword))'
        );
        $this->addSql('COMMENT ON COLUMN link.tags IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE link_keyword_seq CASCADE');
        $this->addSql('DROP TABLE click');
        $this->addSql('DROP TABLE link');
    }
}

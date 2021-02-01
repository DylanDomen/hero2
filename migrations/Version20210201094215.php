<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201094215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE hero_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hero (id INT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, pouvoirs VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51CE6E86A76ED395 ON hero (user_id)');
        $this->addSql('CREATE TABLE mission (id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, difficulte INT NOT NULL, datefin DATE NOT NULL, etat INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mission_hero (mission_id INT NOT NULL, hero_id INT NOT NULL, PRIMARY KEY(mission_id, hero_id))');
        $this->addSql('CREATE INDEX IDX_788CC289BE6CAE90 ON mission_hero (mission_id)');
        $this->addSql('CREATE INDEX IDX_788CC28945B0BCD ON mission_hero (hero_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_hero ADD CONSTRAINT FK_788CC289BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_hero ADD CONSTRAINT FK_788CC28945B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mission_hero DROP CONSTRAINT FK_788CC28945B0BCD');
        $this->addSql('ALTER TABLE mission_hero DROP CONSTRAINT FK_788CC289BE6CAE90');
        $this->addSql('ALTER TABLE hero DROP CONSTRAINT FK_51CE6E86A76ED395');
        $this->addSql('DROP SEQUENCE hero_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_hero');
        $this->addSql('DROP TABLE "user"');
    }
}

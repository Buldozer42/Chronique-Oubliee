<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505122354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE creature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, type VARCHAR(10) NOT NULL, family VARCHAR(25) NOT NULL, size VARCHAR(15) NOT NULL, natural_environment VARCHAR(50) NOT NULL, archetype VARCHAR(10) NOT NULL, boss_rank INT NOT NULL, boss_type VARCHAR(15) NOT NULL, nc INT NOT NULL, hp INT NOT NULL, max_hp INT NOT NULL, def INT NOT NULL, init INT NOT NULL, fo INT NOT NULL, dex INT NOT NULL, con INT NOT NULL, sag INT NOT NULL, cha INT NOT NULL, advantage_fo TINYINT(1) NOT NULL, advantage_dex TINYINT(1) NOT NULL, advantage_con TINYINT(1) NOT NULL, advantage_int TINYINT(1) NOT NULL, advantage_sag TINYINT(1) NOT NULL, advantage_cha TINYINT(1) NOT NULL, rd INT NOT NULL, description LONGTEXT DEFAULT NULL, story LONGTEXT DEFAULT NULL, attacks LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', skills JSON NOT NULL, special_skills LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE creature');
    }
}

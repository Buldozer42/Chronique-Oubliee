<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505130408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creature ADD `int` INT NOT NULL, CHANGE advantage_fo advantage_fo TINYINT(1) DEFAULT NULL, CHANGE advantage_dex advantage_dex TINYINT(1) DEFAULT NULL, CHANGE advantage_con advantage_con TINYINT(1) DEFAULT NULL, CHANGE advantage_int advantage_int TINYINT(1) DEFAULT NULL, CHANGE advantage_sag advantage_sag TINYINT(1) DEFAULT NULL, CHANGE advantage_cha advantage_cha TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creature DROP `int`, CHANGE advantage_fo advantage_fo TINYINT(1) NOT NULL, CHANGE advantage_dex advantage_dex TINYINT(1) NOT NULL, CHANGE advantage_con advantage_con TINYINT(1) NOT NULL, CHANGE advantage_int advantage_int TINYINT(1) NOT NULL, CHANGE advantage_sag advantage_sag TINYINT(1) NOT NULL, CHANGE advantage_cha advantage_cha TINYINT(1) NOT NULL');
    }
}

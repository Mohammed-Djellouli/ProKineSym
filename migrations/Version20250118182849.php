<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118182849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bilan_kine (id INT AUTO_INCREMENT NOT NULL, inspection VARCHAR(255) DEFAULT NULL, palpation VARCHAR(255) DEFAULT NULL, mensuration VARCHAR(255) DEFAULT NULL, bilan_algique VARCHAR(255) DEFAULT NULL, bilan_articulaire VARCHAR(255) DEFAULT NULL, bilan_musculaire VARCHAR(255) DEFAULT NULL, bilan_neurologique VARCHAR(255) DEFAULT NULL, bilan_psychologique VARCHAR(255) DEFAULT NULL, bilan_fonctionnel VARCHAR(255) DEFAULT NULL, tests_specifiques VARCHAR(255) DEFAULT NULL, remarque VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bilan_kine');
    }
}

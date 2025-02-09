<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119161037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient ADD sexe VARCHAR(10) DEFAULT NULL, ADD profession VARCHAR(255) DEFAULT NULL, ADD situation_familliale VARCHAR(20) DEFAULT NULL, ADD medecin_prescripteur VARCHAR(50) DEFAULT NULL, ADD diagnostic_medical VARCHAR(255) DEFAULT NULL, ADD histoire_maladi VARCHAR(255) DEFAULT NULL, ADD compte_rendu VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP sexe, DROP profession, DROP situation_familliale, DROP medecin_prescripteur, DROP diagnostic_medical, DROP histoire_maladi, DROP compte_rendu');
    }
}

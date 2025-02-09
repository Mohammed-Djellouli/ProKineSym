<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118212852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE decision (id INT AUTO_INCREMENT NOT NULL, prescription VARCHAR(255) DEFAULT NULL, conclusion VARCHAR(255) DEFAULT NULL, projet VARCHAR(255) DEFAULT NULL, diagnostique VARCHAR(255) DEFAULT NULL, objectifs VARCHAR(255) DEFAULT NULL, traitement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bilan_kine ADD patient_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE bilan_kine ADD CONSTRAINT FK_89E71C02EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89E71C02EA724598 ON bilan_kine (patient_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE decision');
        $this->addSql('ALTER TABLE bilan_kine DROP FOREIGN KEY FK_89E71C02EA724598');
        $this->addSql('DROP INDEX UNIQ_89E71C02EA724598 ON bilan_kine');
        $this->addSql('ALTER TABLE bilan_kine DROP patient_id_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116140817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, num_tel VARCHAR(10) DEFAULT NULL, age INT NOT NULL, date_naissance DATETIME DEFAULT NULL, grp_sanguin VARCHAR(255) DEFAULT NULL, is_fumeur TINYINT(1) DEFAULT NULL, is_diabetique TINYINT(1) DEFAULT NULL, has_maladie_cardiaque TINYINT(1) DEFAULT NULL, has_hypertension TINYINT(1) DEFAULT NULL, antecedents_medicaux VARCHAR(255) DEFAULT NULL, antecedents_chirurigicaux VARCHAR(255) DEFAULT NULL, INDEX IDX_1ADAD7EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA76ED395');
        $this->addSql('DROP TABLE patient');
    }
}

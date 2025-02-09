<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118214619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE decision ADD patient_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE decision ADD CONSTRAINT FK_84ACBE48EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_84ACBE48EA724598 ON decision (patient_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE decision DROP FOREIGN KEY FK_84ACBE48EA724598');
        $this->addSql('DROP INDEX UNIQ_84ACBE48EA724598 ON decision');
        $this->addSql('ALTER TABLE decision DROP patient_id_id');
    }
}

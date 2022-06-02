<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601151900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attache ADD nom_complet VARCHAR(255) NOT NULL, ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD nom_complet VARCHAR(255) NOT NULL, ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE module CHANGE rpd_id rpd_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rpd ADD nom_complet VARCHAR(255) NOT NULL, ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD nom_complet VARCHAR(255) NOT NULL, ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attache DROP nom_complet, DROP adresse, DROP sexe');
        $this->addSql('ALTER TABLE etudiant DROP nom_complet, DROP adresse, DROP sexe');
        $this->addSql('ALTER TABLE module CHANGE rpd_id rpd_id INT NOT NULL');
        $this->addSql('ALTER TABLE rpd DROP nom_complet, DROP adresse, DROP sexe');
        $this->addSql('ALTER TABLE user DROP nom_complet, DROP adresse, DROP sexe');
    }
}

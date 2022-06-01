<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601143209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, etat VARCHAR(25) NOT NULL, date VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attache ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP adresse, DROP sexe, CHANGE nom_complet password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_75BB0090E7927C74 ON attache (email)');
        $this->addSql('ALTER TABLE etudiant ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP adresse, DROP sexe, CHANGE nom_complet password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E7927C74 ON etudiant (email)');
        $this->addSql('ALTER TABLE rpd ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP adresse, DROP sexe, CHANGE nom_complet password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CDD4B99BE7927C74 ON rpd (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE motif');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_75BB0090E7927C74 ON attache');
        $this->addSql('ALTER TABLE attache ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL, DROP email, DROP roles, CHANGE password nom_complet VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_717E22E3E7927C74 ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL, DROP email, DROP roles, CHANGE password nom_complet VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_CDD4B99BE7927C74 ON rpd');
        $this->addSql('ALTER TABLE rpd ADD adresse VARCHAR(50) DEFAULT NULL, ADD sexe VARCHAR(10) DEFAULT NULL, DROP email, DROP roles, CHANGE password nom_complet VARCHAR(255) NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220213134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_utilisateur VARCHAR(100) NOT NULL, prenom_utilisateur VARCHAR(100) NOT NULL, sexe_utilisateur VARCHAR(1) NOT NULL, email_utilisateur VARCHAR(180) DEFAULT NULL, adresse_utilisateur VARCHAR(100) NOT NULL, telephone_utilisateur VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, level_utilisateur VARCHAR(3) NOT NULL, status_utilisateur TINYINT(1) NOT NULL, delete_utilisateur TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modifier DATETIME NOT NULL, INDEX IDX_1D1C63B3FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3FB88E14F');
        $this->addSql('DROP TABLE utilisateur');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106234809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE online (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, client_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, date_arrivee VARCHAR(100) NOT NULL, date_depart VARCHAR(100) NOT NULL, duree_reservation VARCHAR(255) DEFAULT NULL, delete_reservation TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, etat_reservation VARCHAR(255) NOT NULL, status_reservation TINYINT(1) NOT NULL, new_date_ajuster VARCHAR(255) DEFAULT NULL, new_date_depart VARCHAR(255) DEFAULT NULL, new_duree VARCHAR(255) DEFAULT NULL, duree_total VARCHAR(255) DEFAULT NULL, date_modifier DATETIME DEFAULT NULL, code_reservation VARCHAR(20) DEFAULT NULL, nombre_chambre VARCHAR(255) DEFAULT NULL, nombre_adulte VARCHAR(255) DEFAULT NULL, nombre_enfant VARCHAR(255) DEFAULT NULL, INDEX IDX_9E32BEEA9B177F54 (chambre_id), INDEX IDX_9E32BEEA19EB6921 (client_id), INDEX IDX_9E32BEEAFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE online ADD CONSTRAINT FK_9E32BEEA9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE online ADD CONSTRAINT FK_9E32BEEA19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE online ADD CONSTRAINT FK_9E32BEEAFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD online_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495570A5426E FOREIGN KEY (online_id) REFERENCES online (id)');
        $this->addSql('CREATE INDEX IDX_42C8495570A5426E ON reservation (online_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495570A5426E');
        $this->addSql('DROP TABLE online');
        $this->addSql('DROP INDEX IDX_42C8495570A5426E ON reservation');
        $this->addSql('ALTER TABLE reservation DROP online_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222135722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD chambre_categorie_id INT DEFAULT NULL, ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF7508CAD5 FOREIGN KEY (chambre_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF7508CAD5 ON chambre (chambre_categorie_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFFB88E14F ON chambre (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF7508CAD5');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFFB88E14F');
        $this->addSql('DROP INDEX IDX_C509E4FF7508CAD5 ON chambre');
        $this->addSql('DROP INDEX IDX_C509E4FFFB88E14F ON chambre');
        $this->addSql('ALTER TABLE chambre DROP chambre_categorie_id, DROP utilisateur_id');
    }
}

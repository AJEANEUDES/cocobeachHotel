<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106231939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation CHANGE nombre_chambre nombre_chambre VARCHAR(255) DEFAULT NULL, CHANGE nombre_adulte nombre_adulte VARCHAR(255) DEFAULT NULL, CHANGE nombre_enfant nombre_enfant VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation CHANGE nombre_chambre nombre_chambre INT DEFAULT NULL, CHANGE nombre_adulte nombre_adulte INT DEFAULT NULL, CHANGE nombre_enfant nombre_enfant INT DEFAULT NULL');
    }
}

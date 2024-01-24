<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124125739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fournisseur ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL, DROP produits');
        $this->addSql('ALTER TABLE salarie ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP nom, DROP prenom, DROP adresse, DROP tel');
        $this->addSql('ALTER TABLE fournisseur ADD produits LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP nom, DROP prenom, DROP adresse, DROP tel');
        $this->addSql('ALTER TABLE salarie DROP nom, DROP prenom, DROP adresse, DROP tel');
    }
}

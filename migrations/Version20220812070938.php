<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812070938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD dish_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13755FB9605 FOREIGN KEY (dish_type_id) REFERENCES dish (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13755FB9605 ON recipe (dish_type_id)');
        $this->addSql('ALTER TABLE type DROP subtype, DROP ingredient, DROP note');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13755FB9605');
        $this->addSql('DROP TABLE dish');
        $this->addSql('ALTER TABLE type ADD subtype VARCHAR(255) DEFAULT NULL, ADD ingredient VARCHAR(255) NOT NULL, ADD note LONGTEXT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_DA88B13755FB9605 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP dish_type_id');
    }
}

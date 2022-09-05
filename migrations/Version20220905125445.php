<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905125445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grocery_list ADD shop_id INT NOT NULL, DROP shop');
        $this->addSql('ALTER TABLE grocery_list ADD CONSTRAINT FK_D44D068C4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_D44D068C4D16C4DD ON grocery_list (shop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grocery_list DROP FOREIGN KEY FK_D44D068C4D16C4DD');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP INDEX IDX_D44D068C4D16C4DD ON grocery_list');
        $this->addSql('ALTER TABLE grocery_list ADD shop VARCHAR(255) DEFAULT NULL, DROP shop_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905115630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_recipe (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, unit_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_36F27176933FE08C (ingredient_id), INDEX IDX_36F27176F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_recipe_recipe (ingredient_recipe_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_8BC9C98153AA0A63 (ingredient_recipe_id), INDEX IDX_8BC9C98159D8A214 (recipe_id), PRIMARY KEY(ingredient_recipe_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE ingredient_recipe_recipe ADD CONSTRAINT FK_8BC9C98153AA0A63 FOREIGN KEY (ingredient_recipe_id) REFERENCES ingredient_recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_recipe_recipe ADD CONSTRAINT FK_8BC9C98159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176933FE08C');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176F8BD700D');
        $this->addSql('ALTER TABLE ingredient_recipe_recipe DROP FOREIGN KEY FK_8BC9C98153AA0A63');
        $this->addSql('ALTER TABLE ingredient_recipe_recipe DROP FOREIGN KEY FK_8BC9C98159D8A214');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('DROP TABLE ingredient_recipe_recipe');
        $this->addSql('DROP TABLE unit');
    }
}

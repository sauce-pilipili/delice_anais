<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529201510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE directions ADD recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE directions ADD CONSTRAINT FK_495867EC59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_495867EC59D8A214 ON directions (recipe_id)');
        $this->addSql('ALTER TABLE ingredient ADD recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE directions DROP FOREIGN KEY FK_495867EC59D8A214');
        $this->addSql('DROP INDEX IDX_495867EC59D8A214 ON directions');
        $this->addSql('ALTER TABLE directions DROP recipe_id');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787059D8A214');
        $this->addSql('DROP INDEX IDX_6BAF787059D8A214 ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP recipe_id');
    }
}

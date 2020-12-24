<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224214401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_attribute (product_id INT NOT NULL, attribute_id INT NOT NULL, INDEX IDX_94DA59764584665A (product_id), INDEX IDX_94DA5976B6E62EFA (attribute_id), PRIMARY KEY(product_id, attribute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attribute ADD CONSTRAINT FK_94DA59764584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attribute ADD CONSTRAINT FK_94DA5976B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_value ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute_value ADD CONSTRAINT FK_FE4FBB824584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_FE4FBB824584665A ON attribute_value (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_attribute');
        $this->addSql('ALTER TABLE attribute_value DROP FOREIGN KEY FK_FE4FBB824584665A');
        $this->addSql('DROP INDEX IDX_FE4FBB824584665A ON attribute_value');
        $this->addSql('ALTER TABLE attribute_value DROP product_id');
    }
}

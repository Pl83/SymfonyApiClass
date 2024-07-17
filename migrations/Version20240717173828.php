<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717173828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_beverage (order_id INT NOT NULL, beverage_id INT NOT NULL, INDEX IDX_DC744E0A8D9F6D38 (order_id), INDEX IDX_DC744E0A49F6E812 (beverage_id), PRIMARY KEY(order_id, beverage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_beverage ADD CONSTRAINT FK_DC744E0A8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_beverage ADD CONSTRAINT FK_DC744E0A49F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_beverage DROP FOREIGN KEY FK_DC744E0A8D9F6D38');
        $this->addSql('ALTER TABLE order_beverage DROP FOREIGN KEY FK_DC744E0A49F6E812');
        $this->addSql('DROP TABLE order_beverage');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717092713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, waiter_id INT NOT NULL, bartender_id INT DEFAULT NULL, ordered_at DATETIME NOT NULL, table_nb INT NOT NULL, status VARCHAR(150) NOT NULL, INDEX IDX_F5299398E9F3D07E (waiter_id), INDEX IDX_F5299398A816E25F (bartender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_user (order_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C062EC5E8D9F6D38 (order_id), INDEX IDX_C062EC5EA76ED395 (user_id), PRIMARY KEY(order_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E9F3D07E FOREIGN KEY (waiter_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A816E25F FOREIGN KEY (bartender_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_user ADD CONSTRAINT FK_C062EC5E8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_user ADD CONSTRAINT FK_C062EC5EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E9F3D07E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A816E25F');
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5E8D9F6D38');
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5EA76ED395');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_user');
    }
}

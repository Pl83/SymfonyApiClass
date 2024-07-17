<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717175245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, waiter_id INT NOT NULL, bartender_id INT DEFAULT NULL, ordered_at DATETIME NOT NULL, table_nb INT NOT NULL, status VARCHAR(100) NOT NULL, INDEX IDX_97A0ADA3E9F3D07E (waiter_id), INDEX IDX_97A0ADA3A816E25F (bartender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_beverage (ticket_id INT NOT NULL, beverage_id INT NOT NULL, INDEX IDX_B8E5503A700047D2 (ticket_id), INDEX IDX_B8E5503A49F6E812 (beverage_id), PRIMARY KEY(ticket_id, beverage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E9F3D07E FOREIGN KEY (waiter_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A816E25F FOREIGN KEY (bartender_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ticket_beverage ADD CONSTRAINT FK_B8E5503A700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_beverage ADD CONSTRAINT FK_B8E5503A49F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_beverage DROP FOREIGN KEY FK_DC744E0A49F6E812');
        $this->addSql('ALTER TABLE order_beverage DROP FOREIGN KEY FK_DC744E0A8D9F6D38');
        $this->addSql('DROP TABLE order_beverage');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E9F3D07E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A816E25F');
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5E8D9F6D38');
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5EA76ED395');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_beverage (order_id INT NOT NULL, beverage_id INT NOT NULL, INDEX IDX_DC744E0A8D9F6D38 (order_id), INDEX IDX_DC744E0A49F6E812 (beverage_id), PRIMARY KEY(order_id, beverage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_beverage ADD CONSTRAINT FK_DC744E0A49F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_beverage ADD CONSTRAINT FK_DC744E0A8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E9F3D07E');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A816E25F');
        $this->addSql('ALTER TABLE ticket_beverage DROP FOREIGN KEY FK_B8E5503A700047D2');
        $this->addSql('ALTER TABLE ticket_beverage DROP FOREIGN KEY FK_B8E5503A49F6E812');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_beverage');
    }
}

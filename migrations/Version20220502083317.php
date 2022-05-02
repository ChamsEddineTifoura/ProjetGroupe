<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502083317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE2279F37AE5');
        $this->addSql('DROP INDEX IDX_8244BE2279F37AE5 ON film');
        $this->addSql('ALTER TABLE film CHANGE id_user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8244BE22A76ED395 ON film (user_id)');
        $this->addSql('ALTER TABLE user DROP telephone');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22A76ED395');
        $this->addSql('DROP INDEX IDX_8244BE22A76ED395 ON film');
        $this->addSql('ALTER TABLE film CHANGE user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE2279F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8244BE2279F37AE5 ON film (id_user_id)');
        $this->addSql('ALTER TABLE `user` ADD telephone VARCHAR(255) DEFAULT NULL');
    }
}

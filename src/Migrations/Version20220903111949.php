<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220903111949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abenmada_media_media (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_media_tag (media_id INT NOT NULL, mediatag_id INT NOT NULL, INDEX IDX_8A51DBE3EA9FDD75 (media_id), INDEX IDX_8A51DBE32FF34B3C (mediatag_id), PRIMARY KEY(media_id, mediatag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_channel (media_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_9D3A3C3FEA9FDD75 (media_id), INDEX IDX_9D3A3C3F72F5A1AA (channel_id), PRIMARY KEY(media_id, channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_file (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, UNIQUE INDEX UNIQ_B51A8EC27E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_tag (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_tag_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, label VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_D4F2A86E2C2AC5D3 (translatable_id), UNIQUE INDEX abenmada_media_media_tag_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abenmada_media_media_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, description LONGTEXT DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_8A894ED22C2AC5D3 (translatable_id), UNIQUE INDEX abenmada_media_media_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abenmada_media_media_media_tag ADD CONSTRAINT FK_8A51DBE3EA9FDD75 FOREIGN KEY (media_id) REFERENCES abenmada_media_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_media_tag ADD CONSTRAINT FK_8A51DBE32FF34B3C FOREIGN KEY (mediatag_id) REFERENCES abenmada_media_media_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_channel ADD CONSTRAINT FK_9D3A3C3FEA9FDD75 FOREIGN KEY (media_id) REFERENCES abenmada_media_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_channel ADD CONSTRAINT FK_9D3A3C3F72F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_file ADD CONSTRAINT FK_B51A8EC27E3C61F9 FOREIGN KEY (owner_id) REFERENCES abenmada_media_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_tag_translation ADD CONSTRAINT FK_D4F2A86E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES abenmada_media_media_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abenmada_media_media_translation ADD CONSTRAINT FK_8A894ED22C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES abenmada_media_media (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abenmada_media_media_media_tag DROP FOREIGN KEY FK_8A51DBE3EA9FDD75');
        $this->addSql('ALTER TABLE abenmada_media_media_media_tag DROP FOREIGN KEY FK_8A51DBE32FF34B3C');
        $this->addSql('ALTER TABLE abenmada_media_media_channel DROP FOREIGN KEY FK_9D3A3C3FEA9FDD75');
        $this->addSql('ALTER TABLE abenmada_media_media_channel DROP FOREIGN KEY FK_9D3A3C3F72F5A1AA');
        $this->addSql('ALTER TABLE abenmada_media_media_file DROP FOREIGN KEY FK_B51A8EC27E3C61F9');
        $this->addSql('ALTER TABLE abenmada_media_media_tag_translation DROP FOREIGN KEY FK_D4F2A86E2C2AC5D3');
        $this->addSql('ALTER TABLE abenmada_media_media_translation DROP FOREIGN KEY FK_8A894ED22C2AC5D3');
        $this->addSql('DROP TABLE abenmada_media_media');
        $this->addSql('DROP TABLE abenmada_media_media_media_tag');
        $this->addSql('DROP TABLE abenmada_media_media_channel');
        $this->addSql('DROP TABLE abenmada_media_media_file');
        $this->addSql('DROP TABLE abenmada_media_media_tag');
        $this->addSql('DROP TABLE abenmada_media_media_tag_translation');
        $this->addSql('DROP TABLE abenmada_media_media_translation');
    }
}

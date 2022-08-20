<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220820075004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_comment (article_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_79A616DB7294869C (article_id), INDEX IDX_79A616DBF8697D13 (comment_id), PRIMARY KEY(article_id, comment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_comment ADD CONSTRAINT FK_79A616DB7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_comment ADD CONSTRAINT FK_79A616DBF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('DROP INDEX IDX_9474526C7294869C ON comment');
        $this->addSql('ALTER TABLE comment DROP article_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_comment DROP FOREIGN KEY FK_79A616DB7294869C');
        $this->addSql('ALTER TABLE article_comment DROP FOREIGN KEY FK_79A616DBF8697D13');
        $this->addSql('DROP TABLE article_comment');
        $this->addSql('ALTER TABLE comment ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
    }
}

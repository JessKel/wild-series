<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222164845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C362B62A0');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526C362B62A0 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment ADD episode_id_id INT NOT NULL, ADD author_id INT NOT NULL, DROP episode_id, DROP user_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C444E6803 FOREIGN KEY (episode_id_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C444E6803 ON comment (episode_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C444E6803');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526C444E6803 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment ADD episode_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP episode_id_id, DROP author_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526C362B62A0 ON comment (episode_id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
    }
}

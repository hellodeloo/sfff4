<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205094249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606F1849495');
        $this->addSql('DROP INDEX IDX_50D0C606F1849495 ON answers');
        $this->addSql('ALTER TABLE answers CHANGE players_id player_id INT NOT NULL');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C60699E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('CREATE INDEX IDX_50D0C60699E6F5DF ON answers (player_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C60699E6F5DF');
        $this->addSql('DROP INDEX IDX_50D0C60699E6F5DF ON answers');
        $this->addSql('ALTER TABLE answers CHANGE player_id players_id INT NOT NULL');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_50D0C606F1849495 ON answers (players_id)');
    }
}

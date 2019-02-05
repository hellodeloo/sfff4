<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131161903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answers_players (answers_id INT NOT NULL, players_id INT NOT NULL, INDEX IDX_1189D20979BF1BCE (answers_id), INDEX IDX_1189D209F1849495 (players_id), PRIMARY KEY(answers_id, players_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers_players ADD CONSTRAINT FK_1189D20979BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answers_players ADD CONSTRAINT FK_1189D209F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C60699E6F5DF');
        $this->addSql('DROP INDEX IDX_50D0C60699E6F5DF ON answers');
        $this->addSql('ALTER TABLE answers DROP player_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE answers_players');
        $this->addSql('ALTER TABLE answers ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C60699E6F5DF FOREIGN KEY (player_id) REFERENCES players (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_50D0C60699E6F5DF ON answers (player_id)');
    }
}

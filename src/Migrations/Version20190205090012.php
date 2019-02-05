<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205090012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answers_players DROP FOREIGN KEY FK_1189D20979BF1BCE');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE answers_players');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, answer VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, priority VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE answers_players (answers_id INT NOT NULL, players_id INT NOT NULL, INDEX IDX_1189D209F1849495 (players_id), INDEX IDX_1189D20979BF1BCE (answers_id), PRIMARY KEY(answers_id, players_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE answers_players ADD CONSTRAINT FK_1189D20979BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answers_players ADD CONSTRAINT FK_1189D209F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}

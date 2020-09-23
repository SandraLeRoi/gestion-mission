<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923100736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee_team (employee_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_7139EC588C03F15C (employee_id), INDEX IDX_7139EC58296CD8AE (team_id), PRIMARY KEY(employee_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_team ADD CONSTRAINT FK_7139EC588C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_team ADD CONSTRAINT FK_7139EC58296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD director_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F899FB366 FOREIGN KEY (director_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F899FB366 ON team (director_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee_team');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F899FB366');
        $this->addSql('DROP INDEX IDX_C4E0A61F899FB366 ON team');
        $this->addSql('ALTER TABLE team DROP director_id');
    }
}

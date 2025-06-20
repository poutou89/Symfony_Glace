<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250620140418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE toppings (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE toppings_glace (toppings_id INT NOT NULL, glace_id INT NOT NULL, INDEX IDX_F249DA0DBE2B4234 (toppings_id), INDEX IDX_F249DA0D7BD89A2B (glace_id), PRIMARY KEY(toppings_id, glace_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE toppings_glace ADD CONSTRAINT FK_F249DA0DBE2B4234 FOREIGN KEY (toppings_id) REFERENCES toppings (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE toppings_glace ADD CONSTRAINT FK_F249DA0D7BD89A2B FOREIGN KEY (glace_id) REFERENCES glace (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE toppings_glace DROP FOREIGN KEY FK_F249DA0DBE2B4234
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE toppings_glace DROP FOREIGN KEY FK_F249DA0D7BD89A2B
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE toppings
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE toppings_glace
        SQL);
    }
}

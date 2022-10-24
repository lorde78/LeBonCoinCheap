<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023182819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer ADD answer VARCHAR(255) NOT NULL, DROP title, DROP content');
        $this->addSql('ALTER TABLE question ADD question VARCHAR(255) NOT NULL, DROP title, DROP content');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer ADD content VARCHAR(255) NOT NULL, CHANGE answer title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD content VARCHAR(255) NOT NULL, CHANGE question title VARCHAR(255) NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250720193027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books (id UUID NOT NULL COMMENT \'(DC2Type:uuid_mariadb)\', title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(20) NOT NULL, number_copies INT NOT NULL, year_published INT NOT NULL, UNIQUE INDEX UNIQ_4A1B2A922B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loans (id UUID NOT NULL COMMENT \'(DC2Type:uuid_mariadb)\', book_id UUID DEFAULT NULL COMMENT \'(DC2Type:uuid_mariadb)\', user_id UUID DEFAULT NULL COMMENT \'(DC2Type:uuid_mariadb)\', return_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', rental_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_82C24DBC16A2B381 (book_id), INDEX IDX_82C24DBCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL COMMENT \'(DC2Type:uuid_mariadb)\', password VARCHAR(255) NOT NULL, fist_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loans ADD CONSTRAINT FK_82C24DBC16A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');
        $this->addSql('ALTER TABLE loans ADD CONSTRAINT FK_82C24DBCA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loans DROP FOREIGN KEY FK_82C24DBC16A2B381');
        $this->addSql('ALTER TABLE loans DROP FOREIGN KEY FK_82C24DBCA76ED395');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE loans');
        $this->addSql('DROP TABLE users');
    }
}

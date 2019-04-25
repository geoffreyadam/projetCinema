<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425070233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, runtime INT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, seance_id INT NOT NULL, capacity INT NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), UNIQUE INDEX UNIQ_42C84955E3797A94 (seance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screening (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, movietitle_id INT NOT NULL, movie_id INT NOT NULL, room VARCHAR(255) NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_B708297D54177093 (room_id), INDEX IDX_B708297D5E4124EE (movietitle_id), INDEX IDX_B708297D8F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E3797A94 FOREIGN KEY (seance_id) REFERENCES screening (id)');
        $this->addSql('ALTER TABLE screening ADD CONSTRAINT FK_B708297D54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE screening ADD CONSTRAINT FK_B708297D5E4124EE FOREIGN KEY (movietitle_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE screening ADD CONSTRAINT FK_B708297D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE screening DROP FOREIGN KEY FK_B708297D5E4124EE');
        $this->addSql('ALTER TABLE screening DROP FOREIGN KEY FK_B708297D8F93B6FC');
        $this->addSql('ALTER TABLE screening DROP FOREIGN KEY FK_B708297D54177093');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E3797A94');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE screening');
    }
}

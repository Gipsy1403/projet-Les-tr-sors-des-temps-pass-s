<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116083800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD user_id INT DEFAULT NULL, ADD umbrella_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBCEB4539 FOREIGN KEY (umbrella_id) REFERENCES umbrella (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526CBCEB4539 ON comment (umbrella_id)');
        $this->addSql('ALTER TABLE umbrella ADD category_id INT NOT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE umbrella ADD CONSTRAINT FK_1315305612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE umbrella ADD CONSTRAINT FK_13153056A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1315305612469DE2 ON umbrella (category_id)');
        $this->addSql('CREATE INDEX IDX_13153056A76ED395 ON umbrella (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBCEB4539');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CBCEB4539 ON comment');
        $this->addSql('ALTER TABLE comment DROP user_id, DROP umbrella_id');
        $this->addSql('ALTER TABLE umbrella DROP FOREIGN KEY FK_1315305612469DE2');
        $this->addSql('ALTER TABLE umbrella DROP FOREIGN KEY FK_13153056A76ED395');
        $this->addSql('DROP INDEX IDX_1315305612469DE2 ON umbrella');
        $this->addSql('DROP INDEX IDX_13153056A76ED395 ON umbrella');
        $this->addSql('ALTER TABLE umbrella DROP category_id, DROP user_id');
    }
}

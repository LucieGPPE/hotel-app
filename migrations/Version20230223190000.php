<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223190000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F59CDD37D');
        $this->addSql('DROP INDEX IDX_C53D045F59CDD37D ON image');
        $this->addSql('ALTER TABLE image CHANGE suite_id suite_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F59CDD37D FOREIGN KEY (suite_id_id) REFERENCES suite (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F59CDD37D ON image (suite_id_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495559CDD37D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559D86650F');
        $this->addSql('DROP INDEX IDX_42C849559D86650F ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495559CDD37D ON reservation');
        $this->addSql('ALTER TABLE reservation ADD user_id_id INT DEFAULT NULL, ADD suite_id_id INT DEFAULT NULL, DROP user_id, DROP suite_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495559CDD37D FOREIGN KEY (suite_id_id) REFERENCES suite (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C849559D86650F ON reservation (user_id_id)');
        $this->addSql('CREATE INDEX IDX_42C8495559CDD37D ON reservation (suite_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F59CDD37D');
        $this->addSql('DROP INDEX IDX_C53D045F59CDD37D ON image');
        $this->addSql('ALTER TABLE image CHANGE suite_id_id suite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F59CDD37D FOREIGN KEY (suite_id) REFERENCES suite (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F59CDD37D ON image (suite_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559D86650F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495559CDD37D');
        $this->addSql('DROP INDEX IDX_42C849559D86650F ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495559CDD37D ON reservation');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL, ADD suite_id INT DEFAULT NULL, DROP user_id_id, DROP suite_id_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495559CDD37D FOREIGN KEY (suite_id) REFERENCES suite (id)');
        $this->addSql('CREATE INDEX IDX_42C849559D86650F ON reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_42C8495559CDD37D ON reservation (suite_id)');
    }
}

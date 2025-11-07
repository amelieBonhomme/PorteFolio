<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107155207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE information_pro (ID_pro VARCHAR(50) NOT NULL, nom_entreprise VARCHAR(50) NOT NULL, titre_poste VARCHAR(50) NOT NULL, logo VARCHAR(50) NOT NULL, description_entreprise1 VARCHAR(50) NOT NULL, lien_site VARCHAR(50) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, info_pro_actif TINYINT(1) NOT NULL, PRIMARY KEY (ID_pro)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP TABLE informationpro');
        $this->addSql('ALTER TABLE informationpersonelle CHANGE description description VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE activite CHANGE descriptionActivite description_activite VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE competence ADD logo_ligne1 VARCHAR(50) NOT NULL, ADD logo_ligne2 VARCHAR(50) NOT NULL, DROP logoLigne1, DROP logoLigne2, CHANGE logoActif logo_actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE connaissance DROP FOREIGN KEY `connaissance_ibfk_2`');
        $this->addSql('DROP INDEX idcompetence ON connaissance');
        $this->addSql('CREATE INDEX IDX_3FCAE300C7D0216A ON connaissance (IDcompetence)');
        $this->addSql('ALTER TABLE connaissance ADD CONSTRAINT `connaissance_ibfk_2` FOREIGN KEY (IDcompetence) REFERENCES competence (IDcompetence)');
        $this->addSql('ALTER TABLE designe CHANGE imagePrincipale imagePrincipale VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY `padmin_ibfk_2`');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY `padmin_ibfk_1`');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY `padmin_ibfk_2`');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY `padmin_ibfk_3`');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT FK_F4CC5609337D1497 FOREIGN KEY (ID_pro) REFERENCES information_pro (ID_pro)');
        $this->addSql('DROP INDEX login ON padmin');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4CC5609AA08CB10 ON padmin (login)');
        $this->addSql('DROP INDEX iddesigne ON padmin');
        $this->addSql('CREATE INDEX IDX_F4CC56096D4DB737 ON padmin (IDdesigne)');
        $this->addSql('DROP INDEX id_pro ON padmin');
        $this->addSql('CREATE INDEX IDX_F4CC5609337D1497 ON padmin (ID_pro)');
        $this->addSql('DROP INDEX idinfop ON padmin');
        $this->addSql('CREATE INDEX IDX_F4CC560993788CA8 ON padmin (IDInfoP)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT `padmin_ibfk_1` FOREIGN KEY (IDdesigne) REFERENCES designe (IDdesigne)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT `padmin_ibfk_2` FOREIGN KEY (ID_pro) REFERENCES informationpro (ID_pro)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT `padmin_ibfk_3` FOREIGN KEY (IDInfoP) REFERENCES informationpersonelle (IDInfoP)');
        $this->addSql('ALTER TABLE presente DROP FOREIGN KEY `presente_ibfk_2`');
        $this->addSql('DROP INDEX idprojet ON presente');
        $this->addSql('CREATE INDEX IDX_6CF443332636ACF ON presente (IDprojet)');
        $this->addSql('ALTER TABLE presente ADD CONSTRAINT `presente_ibfk_2` FOREIGN KEY (IDprojet) REFERENCES projet (IDprojet)');
        $this->addSql('ALTER TABLE projet CHANGE titreP titre_p VARCHAR(50) NOT NULL, CHANGE projetActif projet_actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY `tache_ibfk_1`');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY `tache_ibfk_2`');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075337D1497 FOREIGN KEY (ID_pro) REFERENCES information_pro (ID_pro)');
        $this->addSql('DROP INDEX idactivite ON tache');
        $this->addSql('CREATE INDEX IDX_93872075DF0C9C6B ON tache (IDactivite)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (IDactivite) REFERENCES activite (IDactivite)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE informationpro (ID_pro VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nomEntreprise VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, titrePoste VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, logo VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descriptionEntreprise1 VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, lienSite VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateDebut DATE NOT NULL, dateFin DATE DEFAULT NULL, infoProActif TINYINT(1) NOT NULL, PRIMARY KEY (ID_pro)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE information_pro');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE activite CHANGE description_activite descriptionActivite VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE competence ADD logoLigne1 VARCHAR(50) NOT NULL, ADD logoLigne2 VARCHAR(50) NOT NULL, DROP logo_ligne1, DROP logo_ligne2, CHANGE logo_actif logoActif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE connaissance DROP FOREIGN KEY FK_3FCAE300C7D0216A');
        $this->addSql('DROP INDEX idx_3fcae300c7d0216a ON connaissance');
        $this->addSql('CREATE INDEX IDcompetence ON connaissance (IDcompetence)');
        $this->addSql('ALTER TABLE connaissance ADD CONSTRAINT FK_3FCAE300C7D0216A FOREIGN KEY (IDcompetence) REFERENCES competence (IDcompetence)');
        $this->addSql('ALTER TABLE designe CHANGE imagePrincipale imagePrincipale VARCHAR(250) NOT NULL');
        $this->addSql('ALTER TABLE InformationPersonelle CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY FK_F4CC5609337D1497');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY FK_F4CC56096D4DB737');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY FK_F4CC5609337D1497');
        $this->addSql('ALTER TABLE padmin DROP FOREIGN KEY FK_F4CC560993788CA8');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT `padmin_ibfk_2` FOREIGN KEY (ID_pro) REFERENCES informationpro (ID_pro)');
        $this->addSql('DROP INDEX idx_f4cc5609337d1497 ON padmin');
        $this->addSql('CREATE INDEX ID_pro ON padmin (ID_pro)');
        $this->addSql('DROP INDEX idx_f4cc560993788ca8 ON padmin');
        $this->addSql('CREATE INDEX IDInfoP ON padmin (IDInfoP)');
        $this->addSql('DROP INDEX uniq_f4cc5609aa08cb10 ON padmin');
        $this->addSql('CREATE UNIQUE INDEX login ON padmin (login)');
        $this->addSql('DROP INDEX idx_f4cc56096d4db737 ON padmin');
        $this->addSql('CREATE INDEX IDdesigne ON padmin (IDdesigne)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT FK_F4CC56096D4DB737 FOREIGN KEY (IDdesigne) REFERENCES designe (IDdesigne)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT FK_F4CC5609337D1497 FOREIGN KEY (ID_pro) REFERENCES information_pro (ID_pro)');
        $this->addSql('ALTER TABLE padmin ADD CONSTRAINT FK_F4CC560993788CA8 FOREIGN KEY (IDInfoP) REFERENCES InformationPersonelle (IDInfoP)');
        $this->addSql('ALTER TABLE presente DROP FOREIGN KEY FK_6CF443332636ACF');
        $this->addSql('DROP INDEX idx_6cf443332636acf ON presente');
        $this->addSql('CREATE INDEX IDprojet ON presente (IDprojet)');
        $this->addSql('ALTER TABLE presente ADD CONSTRAINT FK_6CF443332636ACF FOREIGN KEY (IDprojet) REFERENCES projet (IDprojet)');
        $this->addSql('ALTER TABLE projet CHANGE titre_p titreP VARCHAR(50) NOT NULL, CHANGE projet_actif projetActif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075337D1497');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075DF0C9C6B');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (ID_pro) REFERENCES informationpro (ID_pro)');
        $this->addSql('DROP INDEX idx_93872075df0c9c6b ON tache');
        $this->addSql('CREATE INDEX IDactivite ON tache (IDactivite)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075DF0C9C6B FOREIGN KEY (IDactivite) REFERENCES activite (IDactivite)');
    }
}

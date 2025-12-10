<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210213028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create humidity table';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('humidity')) {
            return;
        }

        $table = $schema->createTable('humidity');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);

        $table->addColumn('value', 'integer', [
            'notnull' => true,
        ]);

        $table->addColumn('analyzed_at', 'datetime', [
            'notnull' => true,
        ]);

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        if (!$schema->hasTable('humidity')) {
            return;
        }

        $this->addSql('DROP TABLE humidity');
    }
}

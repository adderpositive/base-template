<?php

use Phinx\Migration\AbstractMigration;

class MyNewMigration extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('base_table');
        $table->addColumn('id_user', 'integer')
              ->addColumn('text', 'string', ['limit' => 200])
              ->create();
    }

    public function down()
    {

    }
}

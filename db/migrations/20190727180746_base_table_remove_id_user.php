<?php

use Phinx\Migration\AbstractMigration;

class BaseTableRemoveIdUser extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('base_table');
        $table->removeColumn('id_user')
              ->save();
    }

    public function down()
    {

    }
}

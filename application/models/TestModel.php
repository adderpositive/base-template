<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model {

    // if $table is not specified, it will search TestModel table
    protected $table = 'tree_1';
}

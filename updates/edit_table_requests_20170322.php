<?php namespace Hambern\Request\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

/**
 * Class BuilderTableCreateHambernRequestRequests
 *
 * @package Hambern\Request\Updates
 */
class EditTableRequests20170322 extends Migration
{

    /**
     *
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->text('note')->nullable()->change();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->text('note')->change();
        });
    }
}

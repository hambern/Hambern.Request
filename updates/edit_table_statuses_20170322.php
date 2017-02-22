<?php namespace Hambern\Request\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

/**
 * Class BuilderTableCreateHambernRequestRequests
 *
 * @package Hambern\Request\Updates
 */
class EditTableStatuses20170322 extends Migration
{

    /**
     *
     */
    public function up()
    {
        Schema::table('hambern_request_statuses', function($table) {
            $table->integer('sort_order')->unsigned()->default(0)->index()->change();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::table('hambern_request_statuses', function($table) {
            $table->integer('sort_order')->unsigned()->index()->change();
        });
    }
}

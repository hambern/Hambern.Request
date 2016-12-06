<?php namespace Hambern\Request\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableUpdateHambernRequestStatuses extends Migration
{
    public function up()
    {
        Schema::table('hambern_request_statuses', function ($table) {
            $table->string('color', 10)->nullable();
        });
    }

    public function down()
    {
        Schema::table('hambern_request_statuses', function ($table) {
            $table->dropColumn('color');
        });
    }
}

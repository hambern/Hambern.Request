<?php namespace Hambern\Request\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateHambernRequestStatuses extends Migration
{
    public function up()
    {
        Schema::create('hambern_request_statuses', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('color', 10)->nullable();
            $table->integer('sort_order')->unsigned()->index();
            $table->string('title', 64);
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hambern_request_statuses');
    }
}

<?php namespace Hambern\Request\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class BuilderTableCreateHambernRequestRequests extends Migration
{
    public function up()
    {
        Schema::create('hambern_request_requests', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 64);
            $table->text('message');
            $table->string('name', 128);
            $table->string('phone', 64)->nullable();
            $table->string('email', 64)->nullable();
            $table->text('note');
            $table->integer('status_id')->nullable()->default(1);
            $table->dateTime('answered_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hambern_request_requests');
    }
}

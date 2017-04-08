<?php namespace Hambern\Request\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateHambernRequestRequests extends Migration
{
    public function up()
    {
        Schema::table('hambern_request_requests', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
            $table->renameColumn('note', 'notes');
        });
    }
    
    public function down()
    {
        Schema::table('hambern_request_requests', function($table)
        {
            $table->dropColumn('deleted_at');
            $table->renameColumn('notes', 'note');
        });
    }
}
